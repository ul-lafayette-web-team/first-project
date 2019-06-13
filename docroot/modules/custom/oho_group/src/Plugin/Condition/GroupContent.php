<?php

namespace Drupal\oho_group\Plugin\Condition;

use Drupal\Core\Condition\ConditionPluginBase;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeBundleInfoInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Plugin\ContextAwarePluginInterface;
use Drupal\oho_group\GroupService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'Group Content' condition.
 *
 * @Condition(
 *   id = "group_content",
 *   label = @Translation("Group Content"),
 *   context = {
 *     "node" = @ContextDefinition("entity:node", label = @Translation("Node")),
 *   }
 * )
 */
class GroupContent extends ConditionPluginBase implements ContextAwarePluginInterface, ContainerFactoryPluginInterface {

  /**
   * The entity storage.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $entityStorage;

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
   * Creates a new GroupContent instance.
   *
   * @param array $configuration
   *   The plugin configuration, i.e. an array with configuration values keyed
   *   by configuration option name. The special key 'context' may be used to
   *   initialize the defined contexts by setting it to an array of context
   *   values keyed by context names.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Entity\EntityStorageInterface $entity_storage
   *   The entity storage.
   * @param \Drupal\Core\Entity\EntityTypeBundleInfoInterface $entity_type_bundle_info
   *   The entity type bundle info.
   * @param \Drupal\oho_group\GroupService $group_service
   *   The group service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityStorageInterface $entity_storage, EntityTypeBundleInfoInterface $entity_type_bundle_info, GroupService $group_service) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);

    $this->entityStorage = $entity_storage;
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
      $container->get('entity_type.manager')->getStorage('group_type'),
      $container->get('entity_type.bundle.info'),
      $container->get('oho_group.group_service')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return ['group_types' => []] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    // Get the group type options.
    $bundles_info = $this->entityTypeBundleInfo->getBundleInfo('group');
    $group_type_options = [];
    foreach ($bundles_info as $bundle => $info) {
      $group_type_options[$bundle] = $info['label'];
    }

    // Show a series of checkboxes for group type selection.
    $form['group_types'] = [
      '#title' => $this->t('Group types'),
      '#type' => 'checkboxes',
      '#description' => $this->t('This condition will evaluate true for content in at least one group of the selected types.'),
      '#options' => $group_type_options,
      '#default_value' => $this->configuration['group_types'],
    ];

    return parent::buildConfigurationForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    $this->configuration['group_types'] = array_filter($form_state->getValue('group_types'));
    parent::submitConfigurationForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function summary() {
    $group_types = $this->configuration['group_types'];

    // Format a pretty string if multiple group types were selected.
    if (count($group_types) > 1) {
      $last = array_pop($group_types);
      $group_types = implode(', ', $group_types);
      return $this->t('The group type is @group_types or @last', ['@group_types' => $group_types, '@last' => $last]);
    }

    // If just one was selected, return a simpler string.
    return $this->t('The group type is @group_type', ['@group_type' => reset($group_types)]);
  }

  /**
   * {@inheritdoc}
   */
  public function evaluate() {
    // Get the current node's groups.
    $node = $this->getContextValue('node');

    // If there is a node and it is not new.
    $groups = [];
    if (!empty($node) && !empty($node->id())) {
      $groups = $this->groupService->getEntityGroups($node, $this->configuration['group_types']);
    }

    if (!$this->isNegated()) {
      return !empty($groups);
    }
    else {
      return empty($groups);
    }
  }

}
