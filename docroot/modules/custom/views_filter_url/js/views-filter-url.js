/**
 * @file
 * Provde JavaScript to auto-populate the hostname and path on AJAX loads.
 */

(function($, Drupal) {

  // Get the current url on load.
  var url = window.location.origin + window.location.pathname;

  Drupal.behaviors.views_filter_url = {
    attach: function(context, settings) {

      // Replace the parameters in the text field with the url and parameters.
      $('[data-views-filter-url]', context).each(function() {
        var $this = $(this),
            parameters = $this.val();
        $this.val(url + parameters);
      });

    }
  }

})(jQuery, Drupal)
