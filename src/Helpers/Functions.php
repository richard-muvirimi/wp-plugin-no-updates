<?php

/**
 * Plugin helper functions
 *
 * @package NoUpdates
 * @subpackage NoUpdates/Helpers
 *
 * @author Richard Muvirimi <rich4rdmuvirimi@gmail.com>
 * @since 1.0.0
 * @version 1.0.0
 */

namespace Rich4rdMuvirimi\NoUpdates\Helpers;

/**
 * Class to handle plugin helper functions
 *
 * @package NoUpdates
 * @subpackage NoUpdates/Helpers
 *
 * @author Richard Muvirimi <rich4rdmuvirimi@gmail.com>
 * @since 1.0.0
 * @version 1.0.0
 */
class Functions
{

    /**
     * Get unique plugin slug
     *
     * @param string $suffix
     *
     * @return string
     * @since 1.0.3
     * @version 1.0.6
     *
     * @author Richard Muvirimi <rich4rdmuvirimi@gmail.com>
     */
    public static function get_plugin_slug(string $suffix = ''): string
    {
        return NO_UPDATES_SLUG . $suffix;
    }

}
