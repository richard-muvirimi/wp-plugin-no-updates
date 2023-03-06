<?php

namespace Rich4rdMuvirimi\NoUpdates\Views;

use Rich4rdMuvirimi\NoUpdates\Helpers\Functions;

if (!defined('WPINC')) {
    die(); // Exit if accessed directly.
}

/**
 * Provide a admin area view for the plugin
 * This file is used to mark up the admin-facing aspects of the plugin.
 *
 * @package NoUpdates
 * @subpackage NoUpdates/Views
 *
 * @link http://richard.co.zw
 * @since 1.1.0
 * @version 1.1.0
 */
?>

<div class="<?php esc_attr_e(Functions::get_plugin_slug()); ?> notice notice-info is-dismissible">
    <div>
        <div class="<?php esc_attr_e(Functions::get_plugin_slug()); ?>-prompt">
            <?php printf(__('Please consider enabling usage collection for %s. This helps us improve our product and provide better features to you in the future.', Functions::get_plugin_slug()), __('No Updates', Functions::get_plugin_slug())); ?>
        </div>
        <div class="<?php esc_attr_e(Functions::get_plugin_slug()); ?>-button">
            <a class="button btn-yield" href="#"
               data-nonce="<?php esc_attr_e(wp_create_nonce(Functions::get_plugin_slug('-analytics-enable'))); ?>"
               data-action="<?php esc_attr_e('analytics-enable'); ?>">
                <?php _e('Enable', Functions::get_plugin_slug()); ?>
            </a>
            <a class="button btn-remind" href="#"
               data-nonce="<?php esc_attr_e(wp_create_nonce(Functions::get_plugin_slug('-analytics-remind'))); ?>"
               data-action="<?php esc_attr_e('analytics-remind'); ?>">
                <span><?php _e('Remind me later', Functions::get_plugin_slug()); ?></span>
            </a>
            <a class="button btn-cancel" href="#"
               data-nonce="<?php esc_attr_e(wp_create_nonce(Functions::get_plugin_slug('-analytics-cancel'))); ?>"
               data-action="<?php esc_attr_e('analytics-cancel'); ?>">
                <span><?php _e('Never', Functions::get_plugin_slug()); ?></span>
            </a>
        </div>
    </div>
</div>
