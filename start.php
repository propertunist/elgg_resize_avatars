<?php
/**
 * resize avatar images
 *
 */

elgg_register_event_handler('init', 'system', 'resize_avatars_init');

function resize_avatars_init()
{
    $elgg_path = elgg_get_site_url();
    $base_dir = elgg_get_plugins_path() . 'resize_avatars/lib';
    elgg_register_library('resize_avatars', "$base_dir/resize.php");
    elgg_load_library('resize_avatars');

    $base_dir = elgg_get_plugins_path() . 'resize_avatars/actions';

    elgg_register_action("admin/resize_all_avatar_thumbnails", $base_dir . "/admin/resize_all_avatar_thumbnails.php", 'admin');
    elgg_register_action("admin/resize_avatar_thumbnail", $base_dir . "/admin/resize_avatar_thumbnail.php", 'admin');

    elgg_register_action("admin/save_icon_data", $base_dir . "/admin/save_icon_data.php", 'admin');

    // Add admin menu item
    elgg_register_admin_menu_item('administer', 'thumbs', 'administer_utilities');

    // extend css
    elgg_extend_view('admin.css', 'resize_avatars/admin');
}
