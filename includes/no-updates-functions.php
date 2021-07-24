<?php

/**
 * Plugin misc functions
 * @since 1.0.1
 */

/**
 * Get plugin slug
 *
 * @since 1.0.1
 * @return void
 */
function no_updates_name()
{
    return "no-updates";
}

/**
 * Get a url targetting self
 *
 * @param array $arguments
 * @since 1.0.1
 * @return void
 */
function no_updates_target_self($arguments)
{
    $arguments = array_merge(
        array(
            "action" => no_updates_name(),
            no_updates_name() . "-nonce" => wp_create_nonce(no_updates_name())
        ),
        filter_input_array(INPUT_GET) ?: array(),
        $arguments
    );

    return admin_url(get_current_screen()->base . ".php") . "?" . http_build_query($arguments);
}