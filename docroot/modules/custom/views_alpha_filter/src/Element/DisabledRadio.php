<?php

namespace Drupal\views_alpha_filter\Element;

use Drupal\Core\Render\Element;
use Drupal\Core\Render\Element\Radio;

/**
 * Provides a form element for a single radio button which supports disabling.
 *
 * @see \Drupal\Core\Render\Element\Radios
 *
 * @FormElement("disabled_radio")
 */
class DisabledRadio extends Radio {

  /**
   * {@inheritdoc}
   */
  public static function preRenderRadio($element) {
    $element['#attributes']['type'] = 'radio';
    Element::setAttributes($element, ['id', 'name', '#return_value' => 'value']);

    // To avoid auto-casting during '==' we convert $element['#value'] and
    // $element['#return_value'] to strings. It will prevent wrong true-checking
    // for both cases: 0 == 'string' and 'string' == 0, this will occur because
    // all numeric array values will be integers and all submitted values will
    // be strings. Array values are never valid for radios and are skipped. To
    // account for FALSE and empty string values in the #return_value, we will
    // consider any #value that evaluates to empty to be the same as any
    // #return_value that evaluates to empty.
    if (isset($element['#return_value']) &&
      $element['#value'] !== FALSE &&
      !is_array($element['#value']) &&
      ((empty($element['#value']) && empty($element['#return_value'])) || (string) $element['#value'] === (string) $element['#return_value'])) {
      $element['#attributes']['checked'] = 'checked';
    }
    // Add the disabled attribute.
    $element['#attributes']['disabled'] = $element['#disabled'];
    static::setAttributes($element, ['form-radio']);

    return $element;
  }

}
