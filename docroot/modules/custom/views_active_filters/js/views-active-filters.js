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
