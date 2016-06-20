<?php
/**
 * Elgg user/group profile thumbnail resizing functions
 *
 * - uses the resizing process from elgg core 1.8.20
 */

function resize_avatar_thumbs($entity, $batch = FALSE)
{
    $icon_sizes = elgg_get_config('icon_sizes');
    
    $entity_guid = $entity->getGUID();
    if ($entity instanceof ElggUser)
    {
        $type = 'profile';
        $owner_guid = $entity->guid;
        $master = 'master';
    }
    elseif ($entity instanceof ElggGroup)
    {
        $type = 'groups';
        $owner_guid = $entity->owner_guid;
        $master = '';
    }
    else
    {
        register_error(elgg_echo('resize_avatars:thumbnail_tool:create_failed'));
        forward(REFERER);
    }
  //  error_log('type = ' . $type);
    // Try and get the icon
    $filehandler = new ElggFile();
    $filehandler->owner_guid = $owner_guid;
    $filehandler->setFilename("{$type}/{$entity_guid}{$master}.jpg");

    try 
    {
     //   error_log('filename = ' . $filehandler->getFilenameOnFilestore());
        if ($filehandler->open("read")) 
        {
        //    error_log('file read');
            
            if ($contents = $filehandler->read($filehandler->size())) 
            {
               // error_log('filesize read');
                // get the images and save their file handlers into an array
                // so we can do clean up if one fails.
                $files = array();
                foreach ($icon_sizes as $name => $size_info) 
                {
                    $resized = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(), $size_info['w'], $size_info['h'], $size_info['square'], $x1 = 0, $y1 = 0, $x2 = 0, $y2 = 0, $size_info['upscale']);
                   
                    if ($resized) 
                    {
                        $file = new ElggFile();
                        $file->owner_guid = $owner_guid;
                        $file->setFilename("{$type}/{$entity_guid}{$name}.jpg");
                        $file->open('write');
                        $file->write($resized);
                        $file->close();
                        $files[] = $file;
                    }
                    else 
                    {
                        // cleanup on fail
                        foreach ($files as $file) 
                        {
                            $file->delete();
                        }
                                
                        if (!$batch)
                        {
                            register_error(elgg_echo('resize_avatars:thumbnail_tool:create_failed'));
                            forward(REFERER);
                        }
                                
                        return false;
                    }
                }

                $entity->icontime = time();
                if (!$batch)
                {
                    system_message(elgg_echo('resize_avatars:thumbnail_tool:created', array($entity->name)));
                    $url = $entity->getIconURL('medium');
                    if (elgg_is_xhr()) 
                    {
                        echo json_encode(array(
                            'guid' => $entity_guid,
                            'title' => $name,
                            'thumbnail_src' => $url
                        ));
                    }
                    forward(REFERER);
                }
                return true;
            }
	}
    }
    catch (InvalidParameterException $e) 
    {
        error_log("Unable to get profile image for user/group with GUID $entity_guid", 'ERROR');
        if (!$batch)
        {
            register_error(elgg_echo('resize_avatars:thumbnail_tool:create_failed'));
            forward(REFERER);
        }
        return false;
    }
}