(function ($) {
  'use strict';

  /**
   * Behaviors for field group validation.
   */
  Drupal.behaviors.ohouGlobalFieldGroupValidation = {
    attach: function (context, settings) {
      /* Validation for Details field groups */
      $('.field-group-details :input', context).each(function (i) {
        var $field_group_input = $(this);
        this.addEventListener('invalid', function (e) {
          // Open any hidden parents first.
          $(e.target).parents('details:not([open])').each(function () {
            $(this).attr('open', '');
          });
        }, false);
        if ($field_group_input.hasClass('error')) {
          $field_group_input.parents('details:not([open])').each(function () {
            $(this).attr('open', '');
          });
        }
      });
    }
  };

})(jQuery);
