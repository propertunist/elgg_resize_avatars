<?php
/**
 * Batch Thumbnail Re-Sizing for profile/group profiles
 *
 * Called through ajax, but registered as an Elgg action.
 *
 */
error_log('batch: enter');
elgg_load_library('resize_avatars');

set_time_limit(0);

$total_profiles_processed = 0;
$error_invalid_profile_info = 0;
$error_recreate_failed = 0;
$total_profile_images_successfully_processed = 0;

// Make sure that images for disabled image entities also get re-sized
$access_status = access_get_show_hidden_status();
access_show_hidden_entities(true);
$options = array(
	'types' => array('user', 'group'),
        'metadata_name_value_pairs' => array(name => "icontime", value => "0", "operand" => ">"),
	'limit' => false,
        'count' => true
);
$count = elgg_get_entities_from_metadata($options);
error_log('batch total count = ' . $count);
$options['count'] = false;

$batch = new ElggBatch('elgg_get_entities_from_metadata', $options);

foreach($batch as $profile) 
{
  //  error_log('batch: loop begin');
    $total_profiles_processed++;

    if (!$profile || ((!($profile instanceof ElggUser)) && (!($profile instanceof ElggGroup))) || !$profile->canEdit()) 
    {
        $error_invalid_profile_info++;
        error_log('resize_avatar: entity data could not be used.');
    }
    elseif (!$profile->icontime)
    {
        $error_invalid_profile_info++;
        error_log('resize_avatar: entity - icontime not set.');
    }
    elseif ($result = resize_avatar_thumbs($profile, TRUE))
    {
        $total_profile_images_successfully_processed++;
    }
    else
    {
        $error_recreate_failed++;
    }
}

$return_str = "<b>" . elgg_echo('resize_avatars:resize_thumbnails:results') . "</b><br/><br/>";
$return_str .= "<ul>";
$return_str .= "<li>" . elgg_echo('resize_avatars:resize_thumbnails:total_profiles_processed') . $total_profiles_processed . "</li>";
$return_str .= "<li>" . elgg_echo('resize_avatars:resize_thumbnails:total_avatars_successfully_processed') . $total_profile_images_successfully_processed . "</li>";
$return_str .= "<li>" . elgg_echo('resize_avatars:resize_thumbnails:error_invalid_image_info') . $error_invalid_profile_info . "</li>";
$return_str .= "<li>" . elgg_echo('resize_avatars:resize_thumbnails:error_recreate_failed') . $error_recreate_failed . "</li>";
$return_str .= "</ul>";
$return_str .= "<br>";

access_show_hidden_entities($access_status);
//system_message($return_str);
error_log('batch complete');
echo json_encode(array(
      'result_str' => $return_str
  ));
//return $return_str;
exit;