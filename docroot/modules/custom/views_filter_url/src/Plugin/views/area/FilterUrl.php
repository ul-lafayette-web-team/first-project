<?php

namespace Drupal\views_filter_url\Plugin\views\area;

use Drupal\views\Plugin\views\area\AreaPluginBase;

/**
 * Views area handler to display the filter URL to logged in users.
 *
 * @ingroup views_area_handlers
 *
 * @ViewsArea("views_filter_url")
 */
class FilterUrl extends AreaPluginBase {

  /**
   * {@inheritdoc}
   */
  public function render($empty = FALSE) {
    // Check if the user has permission to view the filter url.
    if (!$this->view->getUser()->hasPermission('view filter url')) {
      return [];
    }

    $parameters = '';

    // AJAX, so get the filters and generate the paramaters accordingly.
    if ($this->view->ajaxEnabled()) {
      // Get the current filters.
      $filters = [];
      foreach ($this->view->exposed_raw_input as $filter => $value) {
        if (!empty($value) && 'All' !== $value) {
          // Checkboxes, radios, multiple selects, etc.
          if (is_array($value)) {
            foreach ($value as $v) {
              $filters[] = "{$filter}[$v]=$v";
            }
          }
          // Single fields.
          else {
            $filters[] = "{$filter}={$value}";
          }
        }
      }

      $parameters = !empty($filters) ? '?' . implode('&', $filters) : '';
    }
    // No AJAX, we can just get the request uri.
    else {
      $parameters = $this->view->getRequest()->getRequestUri();
    }

    // If the url should not be shown when empty and the parameters are empty.
    if (!$this->options['empty'] && empty($parameters)) {
      return [];
    }

    // Build out the render array.
    $build = [
      'view_filter_url' => [
        '#type' => 'container',
        '#attributes' => [
          'class' => 'views-filter-url',
        ],
        'filter_url' => [
          '#type' => 'textfield',
          '#title' => $this->t('Filter URL:'),
          '#value' => $parameters,
          '#size' => 64,
          '#maxlength' => 256,
          '#attributes' => [
            'class' => [
              'views-filter-url__input',
            ],
            'data-views-filter-url' => $this->view->id(),
            'readonly' => 'readonly',
          ],
        ],
      ],
      '#attached' => [
        'library' => [
          'views_filter_url/styles',
        ],
      ],
    ];

    // AJAX, so add the JavaScript to update the text input.
    if ($this->view->ajaxEnabled()) {
      $build['#attached']['library'][] = 'views_filter_url/scripts';
    }

    return $build;
  }

}
