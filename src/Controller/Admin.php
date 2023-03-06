<?php
/**
 * File for the Admin controller
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
use Rich4rdMuvirimi\NoUpdates\Helpers\Template;

/**
 * Admin side controller
 *
 * @package NoUpdates
 * @subpackage NoUpdates/Controller
 *
 * @author Richard Muvirimi <rich4rdmuvirimi@gmail.com>
 * @since 1.0.0
 * @version 1.0.1
 */
class Admin extends BaseController
{

    /**
     * Register the stylesheets for the admin area.
     *
     * @return void
     * @since    1.0.0
     */
    public function enqueue_styles(): void
    {
        wp_register_style(Functions::get_plugin_slug("-rate"), Template::get_style_url('admin-rating.css'), array(), NO_UPDATES_VERSION);

        wp_register_style(Functions::get_plugin_slug("-about"), Template::get_style_url('admin-about.css'), array(), NO_UPDATES_VERSION);

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @return void
     * @since    1.0.0
     */
    public function enqueue_scripts(): void
    {

        wp_register_script(Functions::get_plugin_slug("-rate"), Template::get_script_url('admin-rating.js'), array('jquery'), NO_UPDATES_VERSION);
        wp_localize_script(Functions::get_plugin_slug("-rate"), "no_updates", array(
            "ajax_url" => admin_url('admin-ajax.php'),
            "name" => Functions::get_plugin_slug()
        ));
    }

    /**
     * Show rating request
     *
     * @return void
     * @version 1.0.1
     * @since 1.0.0
     *
     * @author Richard Muvirimi <rich4rdmuvirimi@gmail.com>
     */
    public function showAdminNotices(): void
    {
        /**
         * Request Rating
         */
        if (boolval(get_transient(Functions::get_plugin_slug("-rate"))) === false) {
            wp_enqueue_script(Functions::get_plugin_slug("-rate"));
            wp_enqueue_style(Functions::get_plugin_slug("-rate"));

            echo Template::get_template(Functions::get_plugin_slug('-admin-notice-rating'), array(), 'admin-notice-rating.php');

            Logger::logEvent("request_plugin_rating");
        }

        if (get_option(Functions::get_plugin_slug("-analytics"), "off") !== "on" && boolval(get_transient(Functions::get_plugin_slug('-analytics'))) === false) {
            wp_enqueue_script(Functions::get_plugin_slug("-rate"));
            wp_enqueue_style(Functions::get_plugin_slug("-rate"));

            echo Template::get_template(Functions::get_plugin_slug('-admin-notice-analytics'), array(), 'admin-notice-analytics.php');

            Logger::logEvent("request_plugin_analytics");
        }
    }

    /**
     * Register plugin options
     *
     * @return void
     * @author Richard Muvirimi <rich4rdmuvirimi@gmail.com>
     * @since 1.1.0
     * @version 1.1.0
     */
    public function registerOptions(): void
    {

        register_setting(
            Functions::get_plugin_slug("-about"),
            Functions::get_plugin_slug("-analytics"),
            array("sanitize_callback" => "sanitize_text_field")
        );

        add_settings_section(
            Functions::get_plugin_slug("-settings"),
            __("Settings", Functions::get_plugin_slug()),
            array($this, "renderSectionHeader"),
            Functions::get_plugin_slug("-about")
        );

        add_settings_field(
            Functions::get_plugin_slug("-analytics"),
            __('Collect Anonymous Usage Data', Functions::get_plugin_slug()),
            array($this, 'renderInputField'),
            Functions::get_plugin_slug("-about"),
            Functions::get_plugin_slug("-settings"),
            array(
                'label_for' => Functions::get_plugin_slug("-analytics"),
                'class' => Functions::get_plugin_slug( '-row'),
                "value" => get_option(Functions::get_plugin_slug("-analytics"), "off"),
                'description' => Template::get_template(Functions::get_plugin_slug("-about-analytics-disclaimer"), [], "about-analytics-disclaimer.php"),
                "type" => "checkbox",
            )
        );
    }

    /**
     * Display the settings header
     *
     * @return void
     * @since 1.1.0
     * @version 1.1.0
     *
     * @author Richard Muvirimi <rich4rdmuvirimi@gmail.com>
     */
    public function renderSectionHeader(): void
    {
        echo Template::get_template(Functions::get_plugin_slug("-about-section-header"), [], "about-section-header.php");
    }

    /**
     * Display input field
     *
     * @param array $args
     *
     * @return void
     * @since 1.0.0
     * @version 1.0.0
     *
     * @author Richard Muvirimi <rich4rdmuvirimi@gmail.com>
     */
    public function renderInputField(array $args): void
    {
        echo Template::get_template(Functions::get_plugin_slug("-about-input-field"), $args, "about-input-field.php");
    }

    /**
     * On create the about menu
     *
     * @since 1.0.0
     */
    public function on_admin_menu()
    {
        add_menu_page(
            __('No Updates', Functions::get_plugin_slug()),
            __('No Updates', Functions::get_plugin_slug()),
            'manage_options',
            Functions::get_plugin_slug(),
            [$this, 'renderAboutPage'],
            Template::get_image_url('logo.svg')
        );

    }

    /**
     * Render the about page
     *
     * @return void
     * @since 1.1.0
     * @version 1.1.0
     *
     * @author Richard Muvirimi <rich4rdmuvirimi@gmail.com>
     */
    public function renderAboutPage(): void
    {

        Logger::logEvent("view_about_page");

        wp_enqueue_style(Functions::get_plugin_slug("-about"));

        $plugin = get_plugin_data(
            NO_UPDATES_FILE
        );

        echo Template::get_template(Functions::get_plugin_slug("admin-about"), compact("plugin"), "admin-about.php");
    }

    /**
     * Force an update on requested item
     *
     * @param string $target
     * @return void
     *@since 1.0.0
     * @version 1.0.1
     */
    public function suppressUpdates(string $target): void
    {
        /**
         * Modify Site transient
         */
        foreach (array("plugins", "themes") as $target) {

            $updates =  get_site_transient('update_' . $target);

            //clear updates
            $updates->response = array();

            //stall update checking
            $updates->last_checked = time();

            //save
            set_site_transient('update_' . $target, $updates);
        }
    }

}
