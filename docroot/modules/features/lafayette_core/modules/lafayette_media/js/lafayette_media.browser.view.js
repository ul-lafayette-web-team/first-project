/**
 * @file
 * Defines the behavior of the media entity browser view.
 */

(function ($) {

  "use strict";

  /**
   * Attaches the behavior of the media entity browser view.
   */
  Drupal.behaviors.ohouMediaBrowserView = {
    attach: function (context, settings) {
      $('.media-item', context).once().click(function () {
        var $row = $(this);
        var $input = $row.find('.media-item--media-select input');
        $input.prop('checked', !$input.prop('checked'));
        $row[$input.prop('checked') ? 'addClass' : 'removeClass']('checked');
      });
    }
  };

}(jQuery, Drupal));
