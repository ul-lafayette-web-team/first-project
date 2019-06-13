<?php

namespace Drupal\oho_accessibility\Plugin\Filter;

use Drupal\Component\Utility\Html;
use Drupal\filter\FilterProcessResult;
use Drupal\filter\Plugin\FilterBase;

/**
 * Provides a filter to make links more accessible.
 *
 * @Filter(
 *   id = "filter_accessible_link",
 *   title = @Translation("Format links to be more accessible"),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_MARKUP_LANGUAGE,
 * )
 */
class FilterAccessibleLink extends FilterBase {

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode) {
    $result = new FilterProcessResult($text);

    if (stristr($text, 'target') !== FALSE) {
      $dom = Html::load($text);
      $xpath = new \DOMXPath($dom);
      foreach ($xpath->query('//a[@target]') as $node) {
        // Read the target attribute's value.
        $target = Html::escape($node->getAttribute('target'));

        // If the link is set to open in a new window.
        if ($target == '_blank') {
          // Add a label to indicate that this link opens in a new window.
          $target_aria_label = $this->t('opens in new window');
          if ($node->hasAttribute('aria-label')) {
            // Append the target label.
            $aria_label = Html::escape($node->getAttribute('aria-label'));
            $target_aria_label = "$aria_label ($target_aria_label)";
            $node->setAttribute('aria-label', $target_aria_label);
          }
          else {
            // Add the target label.
            $node->setAttribute('aria-label', $target_aria_label);
          }
        }
      }

      $result->setProcessedText(Html::serialize($dom));
    }

    return $result;
  }

}
