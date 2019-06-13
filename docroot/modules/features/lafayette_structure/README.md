# Louisiana Structure
Louisiana Structure provides the site structure config.

### Components
Louisiana Structure's components are not all enabled by default. You can
install the optional components as you would any other Drupal modules.

#### Louisiana Global Fields (`lafayette_global_fields`)
Provides the config and functionality for all global fields.

#### Louisiana Components (`lafayette_components`)
Provides the config and functionality for all global components.

#### Louisiana Wrapper (`lafayette_wrapper`)
Provides the config and functionality for the wrapper.

#### Louisiana Home (`lafayette_home`)
Provides the config and functionality for the Home content type.

#### Louisiana Landing Page (`lafayette_landing_page`)
Provides the config and functionality for the Landing Page content type.

#### Louisiana General Page (`lafayette_page`)
Provides the config and functionality for the General Page content type.

#### Louisiana Program (`lafayette_program`)
Provides the config and functionality for the Program content type.

#### Louisiana Profile (`lafayette_profile`)
Provides the config and functionality for the Profile content type.

#### Louisiana Story (`lafayette_story`)
Provides the config and functionality for the Story content type.

#### Louisiana News (`lafayette_news`)
Provides the config and functionality for the News content type.

#### Louisiana In the News (`lafayette_in_the_news`)
Provides the config and functionality for the In the News content type.

#### Louisiana Event (`lafayette_event`)
Provides the config and functionality for the Event content type.

#### Louisiana Webform (`lafayette_webform`)
Provides the config and functionality for the Webform content type.

## Configuration
The module's configuration form is located at:
/admin/config/content/lafayette_structure.

The base form is empty. Individual features may provide their own
form alters to add form elements (such as for listing page urls).

These settings are made available across all entities. In a
“template_preprocess_node” function, the settings may be accessed,
for example, like this:

lafayette_structure_get_config_value('news_listing_url')

In entity templates, the settings may be accessed as something like this:

{{ structure_settings.news_listing_url }}
