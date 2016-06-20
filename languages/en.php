<?php 
	$english = array(
            'admin:resize_avatars' => 'resize avatars & group profile images',
            'resize_avatars:change_sizes_title' => 'change thumbnail dimensions',
            'resize_avatars:change_sizes_desc' => 'here you can change the dimensions of newly created thumbnails for users, groups and any other entities that use the main icon size array in elgg. once you have saved the new sizes, you can then use the resizing tools further down the page to resize existing thumbnails to fit your changed dimensions.<br/><br/><b>all sizes are measured in pixels.</b><br/>',
            'resize_avatars:sizes:width' => 'width',
            'resize_avatars:sizes:height' => 'height',
            'resize_avatars:sizes:topbar' => 'topbar',
            'resize_avatars:sizes:tiny' => 'tiny',
            'resize_avatars:sizes:small' => 'small',
            'resize_avatars:sizes:medium' => 'medium',
            'resize_avatars:sizes:large' => 'large',
            'resize_avatars:sizes:master' => 'master (locked)',
            'resize_avatars:sizes:square' => 'square?',
            'resize_avatars:sizes:upscale' => 'upscale?',
            'resize_avatars:thumbnail_tool_blurb' => '<b>Here you can trigger a batch process to resize all of the user uploaded avatar images and group profile images.<br/><br/>'
            . '<i>Without running this batch process, all of the older avatar/profile images will still be stored at their old dimensions.</i><br/><br/>'
            . 'You may experience problems with thumbnail creation if your image library is not configured properly or if there is not enough memory for the GD library to load and resize a photo. If problems occur with thumbnail creation and you have know your configuration is ok, you can re-process the thumbnails here.',
            'resize_avatars:single_id_help' => 'Find the unique identifier of the avatar image (the \'GUID\', which is the number near the end of the url when viewing an avatar or group profile image) and enter it below, then press the button to make new thumbnail images for that user/group profile.',
            'resize_avatars:settings:im_id' => 'Avatar/Group GUID',
            'resize_avatars:settings:resize_thumbnails_label' => 'Re-create all user avatar & group profile thumbnails',
            'resize_avatars:settings:resize_thumbnails_instructions' => 'The thumbnails for all currently available avatar/group images are re-created using the currently defined thumbnail sizes. WARNING: depending on the number of avatar/group images on your site this may take a LONG time!<br/><b>Please make a backup of the site\'s database and data directory in any case before starting!</b><hr>',
            'resize_avatars:settings:resize_thumbnails_start' => 'Start re-creation of all avatar & group profile thumbnails',
            'resize_avatars:submit:size' => 'save icon options',
            'resize_avatars:submit:single' => 'regenerate icons for this now!',
            'resize_avatars:count_users' => '%s user profiles found; %s of them have avatar images which will be resized.',
            'resize_avatars:count_groups' => '%s group profiles found; %s of them have profile images which will be resized.',
            'resize_avatars:resize_thumbnails:results' => 'Results of re-creation of thumbnails:',
            'resize_avatars:resize_thumbnails:total_profiles_processed' => 'Total number of profiles processed: ',
            'resize_avatars:resize_thumbnails:error_invalid_image_info' => 'Number of processed images with invalid image data: ',
            'resize_avatars:resize_thumbnails:error_recreate_failed' => 'Number of processed images where re-creation of thumbnails failed: ',
            'resize_avatars:resize_thumbnails:total_avatars_successfully_processed' => 'Number of profile images successfully resized: ',
            'admin:thumbs' => 'Profile thumbnails',
            'admin:administer_utilities:thumbs' => 'resize profile thumbnails',
            'resize_avatars:fix_single' => 'resize profile thumbnails for a single user or group',
            'resize_avatars:icon_save_fail' => 'error: icon options could not be saved',
            'resize_avatars:icon_save_success' => 'icon options have been saved',
            'resize_avatars:thumbnail_tool:create_failed' => 'Could not create new thumbnails for this user/group',
            'resize_avatars:thumbnail_tool:created' => 'new thumbnails created for profile with profile: %s',
            'resize_avatars:thumbnail_tool:unknown_guid' => 'could not locate a user or group with a GUID that matches your input: %s.'
	);
	
	add_translation("en", $english);