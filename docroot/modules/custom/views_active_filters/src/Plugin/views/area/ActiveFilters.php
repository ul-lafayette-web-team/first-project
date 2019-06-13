<?php

namespace Drupal\views_active_filters\Plugin\views\area;

use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\views\area\AreaPluginBase;

/**
 * Views area handler to display active filters.
 *
 * @ingroup views_area_handlers
 *
 * @ViewsArea("views_active_filters")
 */
class ActiveFilters extends AreaPluginBase {

  /**
   * {@inheritdoc}
   */
  protected function defineOptions() {
    $options = parent::defineOptions();

    $options['heading'] = [
      'default' => $this->t('Currently selected filters'),
    ];

    $options['grouped'] = [
      'default' => TRUE,
    ];

    $options['removable'] = [
      'default' => TRUE,
    ];

    $options['reset_button'] = [
      'default' => $this->t('Clear All'),
    ];

    $options['show_alls'] = [
      'default' => FALSE,
    ];

    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);

    $form['heading'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Heading Text'),
      '#default_value' => $this->options['heading'],
    ];

    $form['grouped'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Group active filters by type'),
      '#default_value' => $this->options['grouped'],
    ];

    $form['removable'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Make active filters removable by click'),
      '#default_value' => $this->options['removable'],
    ];

    $form['reset_button'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Reset button label'),
      '#description' => $this->t('Clears all active filters. Leave blank to not display a reset button.'),
      '#default_value' => $this->options['reset_button'],
    ];

    $form['show_alls'] = [
      '#type' => 'checkbox',
      '#title' => $this->t("Display 'All' active filters values"),
      '#default_value' => $this->options['show_alls'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function render($empty = FALSE) {

    // Setup initial variables.
    $grouped = (bool) $this->options['grouped'];
    $removable = (bool) $this->options['removable'];
    $reset_button = $this->options['reset_button'];
    $show_alls = (bool) $this->options['show_alls'];
    $active_filters = $this->view->exposed_raw_input;
    $filters = [];
    $items = [];

    // No active items, stop early.
    if (empty($active_filters)) {
      return $items;
    }

    // Generate the items.
    foreach ($active_filters as $name => $value) {

      // If the key is a string, then it's the field name; otherwise it is a
      // tid and we need to get the field name from the exposed input array.
      if (is_string($name)) {
        $exposed_name = $name;
      }
      else {
        $exposed_input = $this->view->getExposedInput();
        foreach ($exposed_input as $exposed_key => $exposed_value) {
          if ((is_array($exposed_value) && in_array($name, $exposed_value)) || $name === $exposed_value) {
            $exposed_name = $exposed_key;
            break;
          }
        }
      }

      // From the exposed name, find the type of filter and system name.
      foreach ($this->view->filter as $filter_key => $filter) {
        if ($exposed_name === $filter->options['expose']['identifier']) {
          $type = $this->view->filter[$filter_key]->getPluginId();
          $system_name = $filter_key;
        }
      }

      // Check separately for a boolean, as boolean false is a valid value
      // but would stop the active filter markup from being generated.
      if ('boolean' === $type || !empty($value)) {
        // Make sure values are an array, so we can loop over them.
        $value = is_array($value) ? $value : [$value];
        // Create the lis in this group.
        foreach ($value as $item_value) {
          // We can check on 'All' here, because this value is static in  Views.
          if ($show_alls || 'All' !== $item_value) {
            $items[] = $this->createLi([
              'markup' => $this->createLabel($type, $exposed_name, $item_value),
              'name' => $exposed_name,
              'value' => $item_value,
              'required' => (int) $this->view->filter[$system_name]->options['expose']['required'],
              'removable' => $removable ? $this->isRemovable($type, $item_value) : (int) $removable,
              'class' => [
                'vaf__item',
                "vaf__item--$exposed_name",
              ],
            ]);
          }
        }
        // Grouped, so add a label li at the front,
        // then create the group ul, and reset items.
        if ($grouped) {
          array_unshift($items, $this->createLi([
            'markup' => $this->view->filter[$system_name]->options['expose']['label'],
            'name' => $exposed_name,
            'value' => '',
            'required' => 1,
            'removable' => 0,
            'class' => [
              'vaf__item',
              'vaf__item--label',
            ],
          ]));
          $filters[] = $this->createUL($items, $exposed_name);
          $items = [];
        }
      }
    }

    // Not grouped, so we need to create the ul.
    if (!$grouped) {
      $filters[] = $this->createUL($items, $this->view->id());
    }

    // Generate and return the render array.
    $render = [
      '#theme' => 'views_active_filters',
      '#attached' => [
        'library' => [
          'views_active_filters/views-active-filters',
        ],
      ],
      '#view' => $this->view,
      '#grouped' => $grouped,
      '#removable' => $removable,
      '#active_filters' => $active_filters,
      '#heading' => [
        '#type' => 'html_tag',
        '#tag' => 'h2',
        '#value' => $this->options['heading'],
        '#attributes' => [
          'class' => 'vaf__heading',
        ],
      ],
      '#filters' => $filters,
      '#attributes' => [
        'class' => [
          'vaf',
        ],
        'data-vaf' => $this->view->current_display,
      ],
    ];

    if ($reset_button) {
      $render['#reset_button'] = [
        '#type' => 'html_tag',
        '#tag' => 'button',
        '#value' => $this->options['reset_button'],
        '#attributes' => [
          'class' => [
            'vaf__clear',
          ],
          'data-vaf-clear' => $this->view->current_display,
        ],
      ];
    }

    return $render;
  }

  /**
   * Create the ul render array.
   *
   * @param array $items
   *   Array of li render arrays.
   * @param string $group
   *   The filter group name of the ul.
   *
   * @return array
   *   Drupal ul render array.
   */
  protected function createUl(array $items, string $group) {
    return [
      '#theme' => 'item_list',
      '#list_type' => 'ul',
      '#attributes' => [
        'class' => [
          'vaf__group',
          "vaf__group--$group",
        ],
      ],
      '#items' => $items,
    ];
  }

  /**
   * Create the li render array.
   *
   * @param array $li
   *   An array of data needed for render.
   *
   * @return array
   *   Drupal li render array.
   */
  protected function createLi(array $li) {
    $element = [
      '#markup' => $li['markup'],
      '#wrapper_attributes' => [
        'class' => $li['class'],
        'data-vaf-name' => $li['name'],
        'data-vaf-value' => $li['value'],
        'data-vaf-required' => $li['required'],
        'data-vaf-removable' => $li['removable'],
      ],
    ];
    if ($li['removable']) {
      $element['#wrapper_attributes']['aria-role'] = 'button';
      $element['#wrapper_attributes']['aria-label'] = $this->t("Remove filter {$li['markup']}");
      $element['#wrapper_attributes']['tabindex'] = 0;
    }
    return $element;
  }

  /**
   * Create the label for an li.
   *
   * @param string $type
   *   The field type the of the filter.
   * @param string $name
   *   The field name of the filter.
   * @param string $value
   *   The current value of the filter.
   *
   * @return string
   *   Active filter label.
   */
  protected function createLabel(string $type, string $name, string $value) {
    switch ($type) {

      case 'boolean':
        return $value ? $this->t('True') : $this->t('False');

      case 'combine':
        return $value;

      case 'datetime':
        return $value;

      case 'list_field':
      case 'numeric':
      case 'taxonomy_index_tid':
        return $this->view->exposed_widgets[$name]['#options'][$value];

      case 'string':
        return $value;
    }
  }

  /**
   * Check if a filter can be removable.
   *
   * @param string $type
   *   The filter type.
   * @param string $value
   *   The filter value.
   *
   * @return int
   *   Boolean as 1 or 0.
   */
  protected function isRemovable(string $type, string $value) {
    if ('boolean' === $type || ('taxonomy_index_tid' === $type && 'All' === $value)) {
      return 0;
    }
    return 1;
  }

}
