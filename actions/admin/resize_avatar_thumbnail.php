<?php
/**
 * Avatar/group profile Thumbnail Creation Test
 *
 * Called through ajax, but registered as an Elgg action.
 *
 */

elgg_load_library('resize_avatars');

$guid = get_input('guid');
$entity = get_entity($guid);

if (!$entity || (!($entity instanceof ElggUser))&&(!($entity instanceof ElggGroup))) {
	register_error(elgg_echo('resize_avatars:thumbnail_tool:unknown_guid', array($guid)));
	forward(REFERER);
}

$result = resize_avatar_thumbs($entity);

return;