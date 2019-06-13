<?php

/**
 * @file
 * Enables modules and site configuration for a standard site installation.
 */

use Drupal\Core\Form\FormStateInterface;

/**
 * Implements hook_form_FORM_ID_alter().
 */
function oho_profile_form_install_configure_form_alter(&$form, FormStateInterface $form_state) {
  // Configure the account information defaults.
  $form['admin_account']['account']['name']['#default_value'] = 'ohoadmin';

  // Configure the date/time settings.
  $form['regional_settings']['site_default_country']['#default_value'] = 'US';
  $form['regional_settings']['date_default_timezone']['#default_value'] = 'America/New_York';

  // Configure the update notifications settings.
  $form['update_notifications']['enable_update_status_emails']['#default_value'] = 0;
}
