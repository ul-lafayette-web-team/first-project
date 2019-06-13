<?php

namespace Drupal\oho_group\Theme;

use Drupal\Core\Theme\ThemeNegotiatorInterface;
use Drupal\Core\Routing\RouteMatchInterface;

/**
 * Apply the admin theme to groups pages.
 */
class ThemeNegotiator implements ThemeNegotiatorInterface {

  /**
   * {@inheritdoc}
   */
  public function applies(RouteMatchInterface $route_match) {
    // Routes to match.
    $routes = [
      'entity.group.canonical',
      'view.group_nodes.page_1',
      'view.group_members.page_1',
      'view.group_listing.node_group_listing_page',
      'view.group_listing.user_group_listing_page',
    ];

    return (in_array($route_match->getRouteName(), $routes));
  }

  /**
   * {@inheritdoc}
   */
  public function determineActiveTheme(RouteMatchInterface $route_match) {
    return 'seven';
  }

}
