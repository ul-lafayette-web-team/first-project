<?php

namespace Drupal\views_alpha_filter\Element;

use Drupal\Component\Utility\Html as HtmlUtility;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element\Radios;

/**
 * Provides a form element for a set of radio buttons which can be disabled.
 *
 * Properties:
 * - #options: An associative array, where the keys are the returned values for
 *   each radio button, and the values are an associative array of labels and
 *   a disabled flag.
 *
 * Usage example:
 * @code
 * $form['settings']['active'] = array(
 *   '#type' => 'radios',
 *   '#title' => $this->t('Poll status'),
 *   '#default_value' => 0,
 *   '#options' => array(
 *     0 => array(
 *       'label' => $this->t('Active'),
 *       'disabled' => FALSE,
 *     ),
 *     1 => array(
 *       'label' => $this->t('Inactive'),
 *       'disabled' => TRUE,
 *     ),
 *   ),
 * );
 * @endcode
 *
 * @see \Drupal\Core\Render\Element\Checkboxes
 * @see \Drupal\Core\Render\Element\Radio
 * @see \Drupal\Core\Render\Element\Radios
 * @see \Drupal\Core\Render\Element\Select
 *
 * @FormElement("disabled_radios")
 */
class DisabledRadios extends Radios {

  /**
   * {@inheritdoc}
   */
  public static function processRadios(&$element, FormStateInterface $form_state, &$complete_form) {
    if (count($element['#options']) > 0) {
      $weight = 0;
      foreach ($element['#options'] as $key => &$choice) {
        // Maintain order of options as defined in #options, in case the element
        // defines custom option sub-elements, but does not define all option
        // sub-elements.
        $weight += 0.001;

        $element += [$key => []];
        // Generate the parents as the autogenerator does but append the value,
        // so we will have a unique id for each radio button.
        $parents_for_id = array_merge($element['#parents'], [$key]);
        $element[$key] += [
          '#type' => 'disabled_radio',
          '#title' => $choice['label'],
          // The key is sanitized in Drupal\Core\Template\Attribute during
          // output from the theme function.
          '#return_value' => $key,
          // Use default or FALSE. A value of FALSE means that the radio button
          // is not 'checked'.
          '#default_value' => isset($element['#default_value']) ? $element['#default_value'] : FALSE,
          '#attributes' => $element['#attributes'],
          '#parents' => $element['#parents'],
          '#id' => HtmlUtility::getUniqueId('edit-' . implode('-', $parents_for_id)),
          '#ajax' => isset($element['#ajax']) ? $element['#ajax'] : NULL,
          // Errors should only be shown on the parent radios element.
          '#error_no_message' => TRUE,
          '#weight' => $weight,
          // Add the disabled option to the render array.
          '#disabled' => $choice['disabled'],
        ];
      }
    }
    return $element;
  }

}
