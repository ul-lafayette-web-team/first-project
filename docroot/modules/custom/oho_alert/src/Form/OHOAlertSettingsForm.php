<?php

namespace Drupal\oho_alert\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure alert settings.
 */
class OHOAlertSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'oho_alert_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['oho_alert.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('oho_alert.settings');

    $form['enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Alert Message'),
      '#description' => $this->t('Checking this box will cause the alert message to display at the top of all pages on the site.'),
      '#default_value' => $config->get('enabled'),
    ];

    $message = $config->get('message');
    $form['message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Alert Message'),
      '#default_value' => $message['value'],
      '#format' => $message['format'],
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('oho_alert.settings');

    $form_state->cleanValues();
    foreach ($form_state->getValues() as $key => $value) {
      $config->set($key, $value);
    }

    $config->save();

    parent::submitForm($form, $form_state);
  }

}
