OHO Accessibility
---------

* Introduction
* Installation
* Configuration


INTRODUCTION
------------

The OHO Accessibility module provides accessibility improvements for
text formats and link fields.

The module provides a test format filter called
'Format links to be more accessible', which automatically adds an
'aria-label' attribute with a description to any 'a' tag with a 'target'
attribute which opens a new window.

Additionally, there is a link field preprocess that provides the same
functionality as above to link fields with the 'target' attribute.


INSTALLATION
------------

 * Install as you would normally install a contributed Drupal module.
   See: https://www.drupal.org/node/895232 for further information.


CONFIGURATION
-------------

 * To add the text format filter, go to the '/admin/config/content/formats'
   page, edit one of the text formats, and check the
   'Format links to be more accessible' filter box.
