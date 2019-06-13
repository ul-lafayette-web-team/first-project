(function ($) {
  Drupal.behaviors.ohoAlertBehavior = {
    attach: function (context, settings) {
      $('#alert-wrapper').once('ohoAlert').load('/oho-alert/alert-message', function(message) {
        if (message) {
          $('body').addClass('has-alert');
          $('#alert-wrapper').html(message).trigger('alertMessageLoaded');
          Drupal.attachBehaviors(document.getElementById('alert-wrapper'));
        }
      });
    }
  };
})(jQuery);