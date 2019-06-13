<?php

namespace Drupal\oho_alert\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 * Provides content for the oho alert.
 */
class OHOAlertController {

  /**
   * Content for the oho alert.
   *
   * @return array
   *   Renderable array of AJAX alert message.
   */
  public static function alertMessage() {
    $output = '';
    if (\Drupal::service('oho_alert.alert_service')->alertEnabled()) {
      $message_settings = \Drupal::service('oho_alert.alert_service')->getAlertMessage();
      $message = check_markup($message_settings['value'], $message_settings['format']);
      $oho_alert_message = [
        '#theme' => 'oho_alert_message',
        '#message' => $message,
      ];
      $output = render($oho_alert_message);
    }
    return new Response($output);
  }

}
