<?php
/**
 * Translations loader for Force Reinstall
 *
 * @package NoUpdates
 * @subpackage NoUpdates/Locale
 *
 * @author Richard Muvirimi <rich4rdmuvirimi@gmail.com>
 * @since 1.0.0
 * @version 1.0.0
 */

namespace Rich4rdMuvirimi\NoUpdates\Locale;

/**
 * Class to handle plugin translations
 *
 * @package NoUpdates
 * @subpackage NoUpdates/Locale
 *
 * @author Richard Muvirimi <rich4rdmuvirimi@gmail.com>
 * @since 1.0.0
 * @version 1.0.0
 */
class I18n
{


    /**
     * Load the plugin translation files
     *
     * @return void
     * @version 1.0.0
     * @since 1.0.0
     */
    public function load_plugin_textdomain()
    {
        load_plugin_textdomain(NO_UPDATES_SLUG, false, plugin_dir_path(NO_UPDATES_FILE) . 'languages');
    }
}
