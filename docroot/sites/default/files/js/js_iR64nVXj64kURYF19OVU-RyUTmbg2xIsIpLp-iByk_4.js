/**
 * @file better_exposed_filters.js
 *
 * Provides some client-side functionality for the Better Exposed Filters module
 */
(function ($, Drupal, drupalSettings) {
  Drupal.behaviors.betterExposedFilters = {
    attach: function(context, settings) {
      // Add highlight class to checked checkboxes for better theming
      $('.bef-tree input[type=checkbox], .bef-checkboxes input[type=checkbox]')
        // Highlight newly selected checkboxes
        .change(function() {
          _bef_highlight(this, context);
        })
        .filter(':checked').closest('.form-item', context).addClass('highlight')
      ;
    }
  };

  /*
   * Helper functions
   */

  /**
   * Adds/Removes the highlight class from the form-item div as appropriate
   */
  function _bef_highlight(elem, context) {
    $elem = $(elem, context);
    $elem.attr('checked')
      ? $elem.closest('.form-item', context).addClass('highlight')
      : $elem.closest('.form-item', context).removeClass('highlight');
  }

}) (jQuery, Drupal, drupalSettings);
;
/**
 * @file auto_submit.js
 *
 * Provides a "form auto-submit" feature for the Better Exposed Filters module.
 */

(function ($, Drupal) {

  /**
   * To make a form auto submit, all you have to do is 3 things:
   *
   * Use the "better_exposed_filters/auto_submit" js library.
   *
   * On gadgets you want to auto-submit when changed, add the
   * data-bef-auto-submit attribute. With FAPI, add:
   * @code
   *  '#attributes' => array('data-bef-auto-submit' => ''),
   * @endcode
   *
   * If you want to have auto-submit for every form element, add the
   * data-bef-auto-submit-full-form to the form. With FAPI, add:
   * @code
   *   '#attributes' => array('data-bef-auto-submit-full-form' => ''),
   * @endcode
   *
   * If you want to exclude a field from the bef-auto-submit-full-form auto
   * submission, add an attribute of data-bef-auto-submit-exclude to the form
   * element. With FAPI, add:
   * @code
   *   '#attributes' => array('data-bef-auto-submit-exclude' => ''),
   * @endcode
   *
   * Finally, you have to identify which button you want clicked for autosubmit.
   * The behavior of this button will be honored if it's ajaxy or not:
   * @code
   *  '#attributes' => array('data-bef-auto-submit-click' => ''),
   * @endcode
   *
   * Currently only 'select', 'radio', 'checkbox' and 'textfield' types are
   * supported. We probably could use additional support for HTML5 input types.
   */
  Drupal.behaviors.betterExposedFiltersAutoSubmit = {
    attach: function(context) {
      // e.keyCode: key
      var ignoredKeyCodes = [
        16, // shift
        17, // ctrl
        18, // alt
        20, // caps lock
        33, // page up
        34, // page down
        35, // end
        36, // home
        37, // left arrow
        38, // up arrow
        39, // right arrow
        40, // down arrow
        9, // tab
        13, // enter
        27  // esc
      ];

      // When exposed as a block, the form #attributes are moved from the form
      // to the block element, thus the second selector.
      // @see \Drupal\block\BlockViewBuilder::preRender
      var selectors = 'form[data-bef-auto-submit-full-form], [data-bef-auto-submit-full-form] form, [data-bef-auto-submit]';

      function triggerSubmit ($target) {
        $target.closest('form').find('[data-bef-auto-submit-click]').click();
      }

      // The change event bubbles so we only need to bind it to the outer form
      // in case of a full form, or a single element when specified explicitly.
      $(selectors, context).addBack(selectors).once('bef-auto-submit').on('change keyup keypress', function (e) {
        var $target = $(e.target);

        // Don't submit on changes to excluded elements or a submit element.
        if ($target.is('[data-bef-auto-submit-exclude], :submit')) {
          return true;
        }
        // Use debounce to prevent excessive submits on text field changes.
        // Navigation key presses are ignored.
        else if ($target.is(':text:not(.hasDatepicker), textarea') && $.inArray(e.keyCode, ignoredKeyCodes) === -1) {
          Drupal.debounce(triggerSubmit, 500)($target);
        }
        // Only trigger submit if a change was the trigger (no keyup).
        else if (e.type === 'change') {
          triggerSubmit($target);
        }
      });
    }
  }

}(jQuery, Drupal));
;
/**
 * @file
 * JavaScript for removable active filters.
 */

(function($, Drupal) {

  Drupal.behaviors.views_active_filters = {
    attach: function(context, settings) {

      if ($('[data-vaf]', context).length ) {
        $('[data-vaf]', context).once('views_active_filters').each(function() {
          new VAF(context);
        });
      }

    }
  }


  /**
   * Object to handle views_active_filters interactions.
   *
   * @param jQuery object context
   *    A views_active_filter jQuery object to attach interactions.
   */
  function VAF(context) {

    var self = this;
    this.context = context;

    // Remove click handler
    $('[data-vaf-removable="1"][data-vaf-required="0"]', self.context).click(function() {
      self.removeFilter($(this));
      self.submitForm();
    });

    // Remove all click handler
    $('[data-vaf-clear]', self.context).click(function() {
      $('[data-vaf-removable="1"][data-vaf-required="0"]', self.context).each(function() {
        self.removeFilter($(this));
      });
      self.submitForm();
    });

    /**
     * Remove an active filter.
     *
     * Includes logic for different filter types, and submits
     * the view form after the filter is removed.
     *
     * @param jQuery object $active_filter
     *    An active filter element.
     */
    this.removeFilter = function($active_filter) {
      var filter = $active_filter.attr('data-vaf-name'),
          value = $active_filter.attr('data-vaf-value'),
          $filter = $(`[name^="${filter}"]`, self.context),
          filterType = self.getFilterType($filter);
      switch (filterType) {
        case 'checkbox':
        case 'radio':
          self.resetCheckbox($filter, value);
          break;
        case 'text':
          $filter.val('');
          break;
        case 'select':
          $filter.val('All');
          break;
        case 'selectmultiple':
          self.resetMultiple($filter, value);
          break;
      }
    };

    /**
     * Get the filter type.
     *
     * @param jQuery object $element
     *    The element to get the filter type of
     * @return string
     */
    this.getFilterType = function($element) {
      var element = $element.prop('nodeName');
      switch (element) {
        case 'INPUT':
          return $element.attr('type').toLowerCase();
        case 'SELECT':
          return 'multiple' === $element.attr('multiple') ? 'selectmultiple' : 'select';
      }
    };

    /**
     * Reset a checkbox element.
     *
     * @param jQuery object $element
     *    The checkbox elements check for reset
     * @param string value
     *    The checkbox value to reset
     */
    this.resetCheckbox = function($element, value) {
      $element.each(function() {
        var $this = $(this);
        if (value === $this.val()) {
          $this.prop('checked', false);
        }
      });
    }

    /**
     * Reset a select element.
     *
     * @param jQuery object $element
     *    The select element to reset
     * @param string value
     *    The option value to reset
     */
    this.resetMultiple = function($element, value) {
      $('option', $element).each(function() {
        var $this = $(this);
        if (value === $this.val()) {
          $this.prop('selected', false);
        }
      });
    }

    /**
     * Submit the views form.
     */
    this.submitForm = function() {
      $('[id^="edit-submit"]', self.context).trigger('click');
    }
  }

})(jQuery, Drupal)
;
