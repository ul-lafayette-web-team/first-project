<?php

namespace Drupal\oho_group\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Entity\EntityTypeBundleInfoInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Entity\EntityDisplayRepositoryInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\oho_group\GroupService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a block to display the groups associated with the current node.
 *
 * @Block(
 *   id = "group_view_block",
 *   admin_label = @Translation("Group View Block"),
 *   context = {
 *     "node" = @ContextDefinition("entity:node", label = @Translation("Node")),
 *   }
 * )
 */
class GroupViewBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The entity display repository.
   *
   * @var \Drupal\Core\Entity\EntityDisplayRepositoryInterface
   */
  protected $entityDisplayRepository;

  /**
   * The entity type bundle info.
   *
   * @var \Drupal\Core\Entity\EntityTypeBundleInfoInterface
   */
  protected $entityTypeBundleInfo;

  /**
   * The group service.
   *
   * @var \Drupal\oho_group\GroupService
   */
  protected $groupService;

  /**
   * Constructs a new GroupViewBlock.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin ID for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   * @param \Drupal\Core\Entity\EntityDisplayRepositoryInterface $entity_display_repository
   *   The entity display repository.
   * @param \Drupal\Core\Entity\EntityTypeBundleInfoInterface $entity_type_bundle_info
   *   The entity type bundle info.
   * @param \Drupal\oho_group\GroupService $group_service
   *   The group service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeManagerInterface $entity_type_manager, EntityDisplayRepositoryInterface $entity_display_repository, EntityTypeBundleInfoInterface $entity_type_bundle_info, GroupService $group_service) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);

    $this->entityTypeManager = $entity_type_manager;
    $this->entityDisplayRepository = $entity_display_repository;
    $this->entityTypeBundleInfo = $entity_type_bundle_info;
    $this->groupService = $group_service;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager'),
      $container->get('entity_display.repository'),
      $container->get('entity_type.bundle.info'),
      $container->get('oho_group.group_service')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'group_type' => '',
      'view_mode' => 'default',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    // Get the group type options.
    $bundles_info = $this->entityTypeBundleInfo->getBundleInfo('group');
    $group_type_options = [];
    foreach ($bundles_info as $bundle => $info) {
      $group_type_options[$bundle] = $info['label'];
    }

    // Show a select input for group type selection.
    $form['group_type'] = [
      '#type' => 'select',
      '#options' => $group_type_options,
      '#title' => $this->t('Group type'),
      '#default_value' => $this->configuration['group_type'],
      '#required' => TRUE,
    ];

    // Show a select input for view mode selection.
    $form['view_mode'] = [
      '#type' => 'select',
      '#options' => $this->entityDisplayRepository->getViewModeOptions('group'),
      '#title' => $this->t('View mode'),
      '#default_value' => $this->configuration['view_mode'],
      '#required' => TRUE,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['group_type'] = $form_state->getValue('group_type');
    $this->configuration['view_mode'] = $form_state->getValue('view_mode');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Get the current node's groups.
    $node = $this->getContextValue('node');
    $groups = $this->groupService->getEntityGroups($node, [$this->configuration['group_type']]);

    $build = NULL;
    if (!empty($groups)) {
      // Display the groups with the specified view mode.
      $view_builder = $this->entityTypeManager->getViewBuilder('group');
      $build = $view_builder->viewMultiple($groups, $this->configuration['view_mode']);

      CacheableMetadata::createFromObject($groups)
        ->applyTo($build);
    }

    return $build;
  }

}
