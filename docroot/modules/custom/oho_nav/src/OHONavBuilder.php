<?php

namespace Drupal\oho_nav;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Menu\MenuActiveTrailInterface;
use Drupal\Core\Menu\MenuLinkTreeInterface;
use Drupal\Core\Menu\MenuTreeParameters;

/**
 * The Nav Builder service.
 */
class OHONavBuilder {

  /**
   * The menu link tree service.
   *
   * @var \Drupal\Core\Menu\MenuLinkTreeInterface
   */
  protected $menuTree;

  /**
   * The active menu trail service.
   *
   * @var \Drupal\Core\Menu\MenuActiveTrailInterface
   */
  protected $menuActiveTrail;

  /**
   * The menu link content storage.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $menuLinkContentStorage;

  /**
   * Constructs a new OHONavBuilder.
   *
   * @param \Drupal\Core\Menu\MenuLinkTreeInterface $menu_tree
   *   The menu tree service.
   * @param \Drupal\Core\Menu\MenuActiveTrailInterface $menu_active_trail
   *   The active menu trail service.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_manager
   *   The entity manager.
   */
  public function __construct(MenuLinkTreeInterface $menu_tree, MenuActiveTrailInterface $menu_active_trail, EntityTypeManagerInterface $entity_manager) {
    $this->menuTree = $menu_tree;
    $this->menuActiveTrail = $menu_active_trail;
    $this->menuLinkContentStorage = $entity_manager->getStorage('menu_link_content');
  }

  /**
   * Build a fixed root nav.
   *
   * @param int $start_level
   *   Starting level for the nav.
   * @param int $depth
   *   Ending depth for the nav.
   * @param int $expand
   *   Whether to expand all menu links.
   * @param array $title_options
   *   Display options for the nav title.
   *   - 'nav_title_type': The type of nav title to show, if any.
   *   - 'nav_title_level': The level of item in the active trail.
   *
   * @return array
   *   A menu render array.
   */
  public function buildFixedRootNav($start_level, $depth, $expand, array $title_options = []) {
    $build = [];
    $menu_name = $this->getCurrentMenuName();
    $parameters = $this->getNavMenuTreeParameters($menu_name, $start_level, $depth, $expand, $title_options);
    if (!empty($parameters)) {
      $menu_tree = $this->buildMenuTree($menu_name, $parameters);
      $build = $this->buildNavDisplay($menu_tree, $parameters, $title_options);
    }
    return $build;
  }

  /**
   * Build a relative root nav.
   *
   * @param int $relative_level
   *   Starting level for the nav, relative to the current menu item.
   * @param int $depth
   *   Ending depth for the nav.
   * @param int $expand
   *   Whether to expand all menu links.
   * @param array $title_options
   *   Display options for the nav title.
   *   - 'nav_title_type': The type of nav title to show, if any.
   *   - 'nav_title_level': The level of item in the active trail.
   *
   * @return array
   *   A menu render array.
   */
  public function buildRelativeRootNav($relative_level, $depth, $expand, array $title_options = []) {
    $build = [];
    $menu_name = $this->getCurrentMenuName();
    $parameters = $this->getNavMenuTreeParameters($menu_name, 1, $depth, $expand, $title_options, FALSE, $relative_level);
    if (!empty($parameters)) {
      $menu_tree = $this->buildMenuTree($menu_name, $parameters);
      $build = $this->buildNavDisplay($menu_tree, $parameters, $title_options);
    }
    return $build;
  }

  /**
   * Build a fixed menu nav.
   *
   * @param int $menu_name
   *   Name of the menu to display.
   * @param int $start_level
   *   Starting level for the nav.
   * @param int $depth
   *   Ending depth for the nav.
   * @param int $expand
   *   Whether to expand all menu links.
   * @param array $title_options
   *   Display options for the nav title.
   *   - 'nav_title_type': The type of nav title to show, if any.
   *   - 'nav_title_level': The level of item in the active trail.
   *
   * @return array
   *   A menu render array.
   */
  public function buildFixedMenuNav($menu_name, $start_level, $depth, $expand, array $title_options = []) {
    $build = [];
    $parameters = $this->getNavMenuTreeParameters($menu_name, $start_level, $depth, $expand, $title_options);
    if (!empty($parameters)) {
      $menu_tree = $this->buildMenuTree($menu_name, $parameters);
      $build = $this->buildNavDisplay($menu_tree, $parameters, $title_options);
    }
    return $build;
  }

  /**
   * Get the active trail menu name.
   *
   * @return string
   *   Name of the current menu.
   */
  public function getCurrentMenuName() {
    $link = $this->menuActiveTrail->getActiveLink();
    $menu_name = !empty($link) ? $link->getMenuName() : '';
    return $menu_name;
  }

  /**
   * Get the menu tree parameters.
   *
   * @param string $menu_name
   *   The name of the menu.
   * @param int $level
   *   Starting level for the nav.
   * @param int $depth
   *   Ending depth for the nav.
   * @param int $expand
   *   Whether to expand all menu links.
   * @param array $title_options
   *   An array of title options.
   *   - nav_title_type
   *   - nav_title_level.
   * @param bool $fixed
   *   TRUE for a fixed nav and FALSE for a relative nav.
   * @param int $relative_level
   *   Relative level for the nav.
   *   - 0 for the current item
   *   - 1 for the parent item
   *   - 2 for the grandparent item.
   *
   * @return \Drupal\Core\Menu\MenuTreeParameters
   *   A MenuTreeParameters object.
   */
  protected function getNavMenuTreeParameters($menu_name, $level, $depth, $expand, array $title_options, $fixed = TRUE, $relative_level = 0) {
    $parameters = $this->menuTree->getCurrentRouteMenuTreeParameters($menu_name);

    // If expandedParents is empty, the whole menu tree is built.
    if ($expand) {
      $parameters->expandedParents = [];
    }

    // Fixed root.
    if ($fixed) {
      // Set the min depth.
      $parameters->setMinDepth($level);

      // When the depth is configured to zero, there is no depth limit. When
      // depth is non-zero, it indicates the number of levels that must be
      // displayed. Hence this is a relative depth that we must convert to
      // an actual (absolute) depth, that may never exceed the maximum depth.
      if ($depth > 0) {
        $parameters->setMaxDepth(min($level + $depth - 1, $this->menuTree->maxDepth()));
      }

      // For menu blocks with start level greater than 1, only show menu items
      // from the current active trail. Adjust the root according to the current
      // position in the menu in order to determine if we can show the subtree.
      if ($level > 1) {
        $at_count = count($parameters->activeTrail) - 1;

        // If the title type is level, check the title level against the current
        // depth to determine if the menu should show, even if the current level
        // is greater than the current depth.
        $show_because_of_title = FALSE;
        if (isset($title_options['nav_title_type']) && 'level' === $title_options['nav_title_type'] && isset($title_options['nav_title_level'])) {
          $show_because_of_title = $at_count >= $title_options['nav_title_level'];
        }

        if ($at_count >= $level || $show_because_of_title) {
          // Active trail array is child-first. Reverse it, and pull the new
          // menu root based on the parent of the configured start level.
          $menu_trail_ids = array_reverse(array_values($parameters->activeTrail));
          $menu_root = $menu_trail_ids[$level - 1];
          $parameters->setRoot($menu_root)->setMinDepth(1);
          if ($depth > 0) {
            $max_depth = min($level - 1 + $depth - 1, $this->menuTree->maxDepth());
            $parameters->setMaxDepth($max_depth);
          }
        }
        else {
          return FALSE;
        }
      }
    }
    // Relative root.
    else {
      // Check whether it is even possible to show the nav as configured
      // (whether the current menu item has the required relative level)
      $at_count = count($parameters->activeTrail) - 1;
      if ($at_count > 0 && $relative_level < $at_count) {
        // Set the relative root.
        $menu_trail_ids = array_values($parameters->activeTrail);
        $menu_root = $menu_trail_ids[$relative_level];
        $parameters->setRoot($menu_root)->setMinDepth(1);

        if ($depth > 0) {
          $max_depth = min($depth, $this->menuTree->maxDepth());
          $parameters->setMaxDepth($max_depth);
        }
      }
      else {
        return FALSE;
      }
    }

    return $parameters;
  }

  /**
   * Build the menu tree for the specified menu.
   *
   * @param string $menu_name
   *   The menu name.
   * @param \Drupal\Core\Menu\MenuTreeParameters $parameters
   *   The menu tree parameters.
   *
   * @return array
   *   A menu render array.
   */
  protected function buildMenuTree($menu_name, MenuTreeParameters $parameters) {
    $tree = $this->menuTree->load($menu_name, $parameters);
    $manipulators = [
      ['callable' => 'menu.default_tree_manipulators:checkAccess'],
      ['callable' => 'menu.default_tree_manipulators:generateIndexAndSort'],
    ];
    $tree = $this->menuTree->transform($tree, $manipulators);
    $menu_tree = $this->menuTree->build($tree);
    return $menu_tree;
  }

  /**
   * Build the nav render array.
   */
  protected function buildNavDisplay($menu_tree, $parameters, $title_options) {
    // Add the menu title only if there is a menu tree to display.
    $build = [];
    if (isset($menu_tree['#items']) && !empty($menu_tree['#items'])) {
      // Build the nav render array.
      $build = [
        '#theme' => 'oho_nav',
        '#nav' => $menu_tree,
      ];

      // Build the nav title.
      $nav_title = $this->getNavTitle($parameters, $title_options);
      if (!empty($nav_title)) {
        $build = array_merge($build, $nav_title);
      }
    }
    else {
      $build = $menu_tree;
    }
    return $build;
  }

  /**
   * Get the nav title render array.
   */
  protected function getNavTitle($parameters, $title_options) {
    // Do not display a title.
    if (empty($title_options) || !isset($title_options['nav_title_type'])) {
      return [];
    }

    $build = [];
    switch ($title_options['nav_title_type']) {
      // Get the root menu link.
      case 'root':
        $menu_link = $this->getMenuLinkByPluginId($parameters->root);
        $build['#nav_title']['items'][] = $this->generateNavTitle($menu_link);
        break;

      // Get the active trail menu link at the specified level.
      case 'level':
        $nav_title_level = isset($title_options['nav_title_level']) ? $title_options['nav_title_level'] : 1;
        $menu_trail_ids = $parameters->activeTrail;
        $menu_trail_ids = array_reverse(array_values($menu_trail_ids));
        if (count($menu_trail_ids) > $nav_title_level) {
          $menu_link_id = $menu_trail_ids[$nav_title_level];
          $menu_link = $this->getMenuLinkByPluginId($menu_link_id);
          $build['#nav_title']['items'][] = $this->generateNavTitle($menu_link);
        }
        break;

      // Get the active trail menu links.
      case 'active_trail':
        $menu_trail_ids = $parameters->activeTrail;
        $menu_trail_ids = array_reverse(array_values($menu_trail_ids));
        $build = [];
        foreach ($menu_trail_ids as $menu_link_id) {
          if (!empty($menu_link_id)) {
            $menu_link = $this->getMenuLinkByPluginId($menu_link_id);
            $build['#nav_title']['items'][] = $this->generateNavTitle($menu_link);
          }
        }
        break;
    }

    return $build;
  }

  /**
   * Generate the nav title array.
   */
  protected function generateNavTitle($menu_link) {
    $build = [
      'title' => $menu_link->getTitle(),
      'url' => $menu_link->getUrlObject(),
    ];
    return $build;
  }

  /**
   * Get a menu link from the plugin id.
   */
  private function getMenuLinkByPluginId($pluginId) {
    list($entityType, $entityUuid) = explode(':', $pluginId);
    $menu_link_content = current($this->menuLinkContentStorage->loadByProperties(['uuid' => $entityUuid]));
    return $menu_link_content;
  }

}
