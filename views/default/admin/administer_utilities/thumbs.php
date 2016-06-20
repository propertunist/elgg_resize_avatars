<?php
/**
 * resize all avatar thumbnails - ADMIN PANEL
 */

elgg_require_js('resize_avatars/resize_avatars');

// get icon sizes

$icons = elgg_get_config("icon_sizes");
//error_log('START: icons - master square = ' . $icons['master']['square']);
//error_log('START: icons - master width = ' . $icons['master']['w']);
// count users in system

$options = array(
  'type' => 'user',
  'count' => true,
  'limit' => 0,
);
$count_all_users = elgg_get_entities_from_metadata($options);
$options['metadata_name_value_pairs'] = array(name => "icontime", value => "0", "operand" => ">");
$count_users_with_images = elgg_get_entities_from_metadata($options);
$count_users_string = elgg_echo('resize_avatars:count_users', array($count_all_users, $count_users_with_images));

// count groups in system
unset ($options['metadata_name_value_pairs']);
$options['type'] = 'group';
$count_all_groups = elgg_get_entities_from_metadata($options);
$options['metadata_name_value_pairs'] = array(name => "icontime", value => "0", "operand" => ">");
$count_groups_with_images = elgg_get_entities_from_metadata($options);
$count_groups_string = elgg_echo('resize_avatars:count_groups', array($count_all_groups, $count_groups_with_images));

// build page

echo '<br/>';
echo elgg_echo('resize_avatars:thumbnail_tool_blurb');

// create panel for changing icon sizes

$title = elgg_echo('resize_avatars:change_sizes_title');
$body = '<p>' . elgg_echo('resize_avatars:change_sizes_desc') . '</p>';

$height_label = elgg_echo('resize_avatars:sizes:height');
$width_label = elgg_echo('resize_avatars:sizes:width');
$square_label = elgg_echo('resize_avatars:sizes:square');
$upscale_label = elgg_echo('resize_avatars:sizes:upscale');

$sizes_topbar_label = elgg_echo('resize_avatars:sizes:topbar');
$sizes_topbar_w_input = elgg_view('input/text', array(
	'name' => 'topbar_w',
        'value' => $icons['topbar']['w'],
));
$sizes_topbar_h_input = elgg_view('input/text', array(
	'name' => 'topbar_h',
        'value' => $icons['topbar']['h'],
));
$sizes_topbar_square_input = elgg_view('input/checkbox', array(
        'name' => 'topbar_square',
        'value' => $icons['topbar']['square'],
        'checked' => $icons['topbar']['square'],
));
$sizes_topbar_upscale_input = elgg_view('input/checkbox', array(
        'name' => 'topbar_upscale',
        'value' => $icons['topbar']['upscale'],
        'checked' => $icons['topbar']['upscale'],
));

$sizes_tiny_label = elgg_echo('resize_avatars:sizes:tiny');
$sizes_tiny_w_input = elgg_view('input/text', array(
	'name' => 'tiny_w',
        'value' => $icons['tiny']['w'],
));
$sizes_tiny_h_input = elgg_view('input/text', array(
	'name' => 'tiny_h',
        'value' => $icons['tiny']['h'],
));
$sizes_tiny_square_input = elgg_view('input/checkbox', array(
        'name' => 'tiny_square',
        'value' => $icons['tiny']['square'],
        'checked' => $icons['tiny']['square'],
));
$sizes_tiny_upscale_input = elgg_view('input/checkbox', array(
        'name' => 'tiny_upscale',
        'value' => $icons['tiny']['upscale'],
        'checked' => $icons['tiny']['upscale'],
));

$sizes_small_label = elgg_echo('resize_avatars:sizes:small');
$sizes_small_w_input = elgg_view('input/text', array(
	'name' => 'small_w',
        'value' => $icons['small']['w'],
));
$sizes_small_h_input = elgg_view('input/text', array(
	'name' => 'small_h',
        'value' => $icons['small']['h'],
));
$sizes_small_square_input = elgg_view('input/checkbox', array(
        'name' => 'small_square',
        'value' => $icons['small']['square'],
        'checked' => $icons['small']['square'],
));
$sizes_small_upscale_input = elgg_view('input/checkbox', array(
        'name' => 'small_upscale',
        'value' => $icons['small']['upscale'],
        'checked' => $icons['small']['upscale'],
));

$sizes_medium_label = elgg_echo('resize_avatars:sizes:medium');
$sizes_medium_w_input = elgg_view('input/text', array(
	'name' => 'medium_w',
        'value' => $icons['medium']['w'],
));
$sizes_medium_h_input = elgg_view('input/text', array(
	'name' => 'medium_h',
        'value' => $icons['medium']['h'],
));
$sizes_medium_square_input = elgg_view('input/checkbox', array(
        'name' => 'medium_square',
        'value' => $icons['medium']['square'],
        'checked' => $icons['medium']['square'],
));
$sizes_medium_upscale_input = elgg_view('input/checkbox', array(
        'name' => 'medium_upscale',
        'value' => $icons['medium']['upscale'],
        'checked' => $icons['medium']['upscale'],
));

$sizes_large_label = elgg_echo('resize_avatars:sizes:large');
$sizes_large_w_input = elgg_view('input/text', array(
	'name' => 'large_w',
        'value' => $icons['large']['w'],
));
$sizes_large_h_input = elgg_view('input/text', array(
	'name' => 'large_h',
        'value' => $icons['large']['h'],
));
$sizes_large_square_input = elgg_view('input/checkbox', array(
        'name' => 'large_square',
        'value' => $icons['large']['square'],
        'checked' => $icons['large']['square'],
));
$sizes_large_upscale_input = elgg_view('input/checkbox', array(
        'name' => 'large_upscale',
        'value' => $icons['large']['upscale'],
        'checked' => $icons['large']['upscale'],
));

$sizes_master_label = elgg_echo('resize_avatars:sizes:master');
$sizes_master_w_input = elgg_view('input/text', array(
	'name' => 'master_w',
        'value' => $icons['master']['w'],
        'disabled' => 'disabled'
));
$sizes_master_h_input = elgg_view('input/text', array(
	'name' => 'master_h',
        'value' => $icons['master']['h'],
        'disabled' => 'disabled'
));
$sizes_master_square_input = elgg_view('input/checkbox', array(
        'name' => 'master_square',
        'value' => $icons['master']['square'],
        'checked' => $icons['master']['square'],
        'disabled' => 'disabled'
));
$sizes_master_upscale_input = elgg_view('input/checkbox', array(
        'name' => 'master_upscale',
        'value' => $icons['master']['upscale'],
        'checked' => $icons['master']['upscale'],
        'disabled' => 'disabled'
));
$submit = elgg_view('input/submit', array(
	'value' => elgg_echo('resize_avatars:submit:size'),
	'id' => 'resize_avatars-save_icon_data'
));
/*
$submit = elgg_view('output/url', array(
	'text' => elgg_echo('resize_avatars:submit:size'),
	'href' => 'action/admin/save_icon_data',
	'is_action' => true,
	'is_trusted' => true,
	'class' => 'elgg-button elgg-button-submit',
	'id' => 'resize_avatars-save_icon_data',
));
*/

$body .=<<<HTML
        <table cellspacing=0 cellpadding=0 border=0 id="icon_table">
            <tr>
                <td width="20%">

                </td>
                <td width="25%">
                    $height_label
                </td>
                <td width="25%">
                    $width_label
                </td>
                <td width="15%">
                    $square_label
                </td>
                <td width="15%">
                    $upscale_label
                </td>
            </tr>
            <tr>
                <td>
                    <label>$sizes_topbar_label</label>
                </td>
                <td>
                     $sizes_topbar_h_input
                </td>
                <td>
                     $sizes_topbar_w_input
                </td>
                <td>
                     $sizes_topbar_square_input
                </td>
                <td>
                     $sizes_topbar_upscale_input
                </td>
            </tr>
            <tr>
                <td>
                    <label>$sizes_tiny_label</label>
                </td>
                <td>
                     $sizes_tiny_h_input
                </td>
                <td>
                    $sizes_tiny_w_input
                </td>
                <td>
                     $sizes_tiny_square_input
                </td>
                <td>
                     $sizes_tiny_upscale_input
                </td>
            </tr>
            <tr>
                <td>
                    <label>$sizes_small_label</label>
                </td>
                <td>
                    $sizes_small_h_input
                </td>
                <td>
                     $sizes_small_w_input
                </td>
                <td>
                     $sizes_small_square_input
                </td>
                <td>
                     $sizes_small_upscale_input
                </td>
            </tr>
            <tr>
                <td>
                    <label>$sizes_medium_label</label>
                </td>
                <td>
                     $sizes_medium_h_input
                </td>
                <td>
                    $sizes_medium_w_input
                </td>
                <td>
                     $sizes_medium_square_input
                </td>
                <td>
                     $sizes_medium_upscale_input
                </td>
            </tr>
            <tr>
                <td>
                    <label>$sizes_large_label</label>
                </td>
                <td>
                    $sizes_large_h_input
                </td>
                <td>
                    $sizes_large_w_input
                </td>
                <td>
                     $sizes_large_square_input
                </td>
                <td>
                     $sizes_large_upscale_input
                </td>
            </tr>
            <tr>
                <td>
                    <label>$sizes_master_label</label>
                </td>
                <td>
                     $sizes_master_h_input
                </td>
                <td>
                     $sizes_master_w_input
                </td>
                <td>
                     $sizes_master_square_input
                </td>
                <td>
                     $sizes_master_upscale_input
                </td>
            </tr>
	</table>
	<p class="center_p">
		$submit
	</p>
HTML;

echo '<div id="resize_avatars_panel">';
echo elgg_view_module('inline', $title, $body);

// create panel for processing a single thumb
$title = elgg_echo('resize_avatars:fix_single');
$body = '<p>' . elgg_echo('resize_avatars:single_id_help') . '</p>';
$im_id = elgg_echo('resize_avatars:settings:im_id');
$input = elgg_view('input/text', array(
	'name' => 'guid'
));
$submit = elgg_view('input/submit', array(
	'value' => elgg_echo('resize_avatars:submit:single'),
	'id' => 'resize_avatars-im-test'
));

$body .=<<<HTML
	<p>
		<label>$im_id $input</label>
	</p>
	<p class="center_p">
		$submit
		<div id="resize_avatars-im-results"></div>
	</p>
HTML;

echo elgg_view_module('inline', $title, $body);

// create panel for processing all thumbs
$title = elgg_echo('resize_avatars:settings:resize_thumbnails_label');
$body = elgg_echo('resize_avatars:settings:resize_thumbnails_instructions');
$body .= '<p><b>'. $count_users_string . '<br/>' . $count_groups_string . '</b></p>';
/*
$submit = elgg_view('output/url', array(
	'text' => elgg_echo('resize_avatars:settings:resize_thumbnails_start'),
	'href' => 'action/admin/resize_all_avatar_thumbnails',
	'is_action' => true,
	'is_trusted' => true,
	'class' => 'elgg-button elgg-button-submit',
	'id' => 'resize_avatars-resize-thumbnails',
));*/

$submit = elgg_view('input/submit', array(
	'value' => elgg_echo('resize_avatars:settings:resize_thumbnails_start'),
	'id' => 'resize_avatars-resize-thumbnails'
));
/*
$body .= elgg_view('graphics/ajax_loader', array(
	'id' => 'resize_avatars-resize-thumbnails-ajax-spinner',
	'class' => 'elgg-content-thin',
));*/
$body .=<<<HTML
	<p class="center_p">
		$submit
		<div id="resize_avatars-batch-results" class="mtm"></div>
	</p>
HTML;

echo elgg_view_module('inline', $title, $body);
?>


<?php
echo '</div>';
