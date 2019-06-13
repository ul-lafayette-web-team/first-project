<?php

namespace Drupal\oho_alert;

use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * Manages the alert message.
 */
class OHOAlertService {

  /**
   * The alert config.
   *
   * @var \Drupal\Core\Config\ImmutableConfig
   */
  protected $config;

  /**
   * Config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * Constructs an OHOAlertService object.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory service.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->config = $config_factory->get('oho_alert.settings');
    $this->configFactory = $config_factory;
  }

  /**
   * Return TRUE if the alert is enabled, FALSE otherwise.
   *
   * @return bool
   *   TRUE if the alert is currently enabled.
   */
  public function alertEnabled() {
    return $this->config->get('enabled');
  }

  /**
   * Enable the alert.
   */
  public function enableAlert() {
    $this->configFactory
      ->getEditable('oho_alert.settings')
      ->set('enabled', TRUE)
      ->save();
  }

  /**
   * Disable the alert.
   */
  public function disableAlert() {
    $this->configFactory
      ->getEditable('oho_alert.settings')
      ->set('enabled', FALSE)
      ->save();
  }

  /**
   * Get the alert message.
   *
   * @return string
   *   The current alert message.
   */
  public function getAlertMessage() {
    return $this->config->get('message');
  }

  /**
   * Update the alert message.
   *
   * @param string $message
   *   A message string.
   */
  public function updateAlert(string $message) {
    // Get the message config and update the message.
    $message_settings = getAlertMessage();
    $message_settings['value'] = $message;
    $this->configFactory
      ->getEditable('oho_alert.settings')
      ->set('message', $message_settings)
      ->save();
  }

}
