<?php
/**
 * File for the plugin Specific func]\tions
 *
 * All plugin specific functions are handled in one place
 *
 * @package NoUpdates
 * @subpackage NoUpdates/Controller
 *
 * @author Richard Muvirimi <rich4rdmuvirimi@gmail.com>
 * @since 1.0.0
 * @version 1.0.0
 */

namespace Rich4rdMuvirimi\NoUpdates\Controller;

use Rich4rdMuvirimi\NoUpdates\Helpers\Functions;
use Rich4rdMuvirimi\NoUpdates\Helpers\Logger;

/**
 * Plugin controller
 *
 * @package NoUpdates
 * @subpackage NoUpdates/Controller
 *
 * @author Richard Muvirimi <rich4rdmuvirimi@gmail.com>
 * @since 1.0.0
 * @version 1.0.0
 */
class Plugin extends BaseController
{


    /**
     * On plugin activation
     *
     * @return void
     * @version 1.0.0
     * @since 1.0.0
     */
    public static function on_activation(): void
    {

        if (boolval(get_transient(Functions::get_plugin_slug('-rate'))) === false) {
            set_transient(Functions::get_plugin_slug('-rate'), true, YEAR_IN_SECONDS / 4);
        }

        Logger::logEvent("activate_plugin");

    }

    /**
     * On plugin deactivation
     *
     * @return void
     * @version 1.0.0
     * @since 1.0.0
     */
    public static function on_deactivation(): void
    {

        foreach (array("plugins", "themes") as $target) {

            $updates =  get_site_transient('update_' . $target);

            //set last updated a day ago
            $updates->last_checked = time() - DAY_IN_SECONDS;

            //save
            set_site_transient('update_' . $target, $updates);
        }

        Logger::logEvent("deactivate_plugin");
    }

    /**
     * On plugin uninstall
     *
     * @return void
     * @version 1.0.0
     * @since 1.0.0
     */
    public static function on_uninstall(): void
    {
        Logger::logEvent("uninstall_plugin");
    }
}
