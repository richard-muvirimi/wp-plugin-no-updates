<?php

namespace Rich4rdMuvirimi\NoUpdates\Views;

/**
 * Display text field option
 *
 * @package NoUpdates
 * @subpackage NoUpdates/Views
 *
 * @link http://richard.co.zw
 * @author Richard Muvirimi <tygalive@gmail.com>
 * @since 1.1.0
 * @version 1.1.0
 *
 * @var array $args
 */

?>

<!--suppress HtmlFormInputWithoutLabel -->
<input id="<?php esc_attr_e($args['label_for']) ?>"
       name="<?php esc_attr_e($args['label_for']) ?>"
       data-custom="<?php esc_attr_e($args['value']); ?>"
       type="<?php esc_attr_e($args['type']); ?>"
       placeholder="<?php esc_attr_e($args['placeholder'] ?? ""); ?>"
    <?php checked($args['value'], "on") ?> />

<div>
    <small class="description">
        <?php _e($args['description']); ?>
    </small>
</div>
