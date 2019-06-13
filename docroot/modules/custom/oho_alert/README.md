OHO Alert
---------

* Introduction
* Installation
* Configuration


INTRODUCTION
------------

The OHO Alert module provides a configuration page from which a
sitewide alert message can be edited and enabled/disabled.


INSTALLATION
------------

 * Install as you would normally install a contributed Drupal module.
   See: https://www.drupal.org/node/895232 for further information.


CONFIGURATION
-------------

 * Place "{{ alert_message }}" somewhere in your page.html.twig template,
   usually towards the top.
 * To edit and enable/disable the alert message, go to
   '/admin/config/content/oho_alert'.

USAGE
-------------

 * The alert message is loaded using ajax.
 * A custom javascript event, "alertMessageLoaded", is triggered after
   the alert message has been loaded.
 * You can add a listener for this event with code like this:

    $('#alert-wrapper').on('alertMessageLoaded', function() {
      // CODE
    });
