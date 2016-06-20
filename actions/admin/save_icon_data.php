<?php
/**
 * save elgg's icon sizes
 *
 * Called through ajax, but registered as an Elgg action.
 *
 */

$sizes = array('topbar','tiny','small','medium','large','master');

$master_h = (int) get_input('master_h');
$master_w = (int) get_input('master_w');
$master_square = (int) get_input('master_square');
$master_upscale = (int) get_input('master_upscale');

$large_h = (int) get_input('large_h');
$large_w = (int) get_input('large_w');
$large_square = (int) get_input('large_square');
$large_upscale = (int) get_input('large_upscale');

$medium_h = (int) get_input('medium_h');
$medium_w = (int) get_input('medium_w');
$medium_square = (int) get_input('medium_square');
$medium_upscale = (int) get_input('medium_upscale');

$small_h = (int) get_input('small_h');
$small_w = (int) get_input('small_w');
$small_square = (int) get_input('small_square');
$small_upscale = (int) get_input('small_upscale');

$tiny_h = (int) get_input('tiny_h');
$tiny_w = (int) get_input('tiny_w');
$tiny_square = (int) get_input('tiny_square');
$tiny_upscale = (int) get_input('tiny_upscale');

$topbar_h = (int) get_input('topbar_h');
$topbar_w = (int) get_input('topbar_w');
$topbar_square = (int) get_input('topbar_square');
$topbar_upscale = (int) get_input('topbar_upscale');

//error_log('action start: icon size - medium square = ' . $medium_square);

if ((!$master_h)||(!(is_numeric($master_h)))||($master_h <= 1))
{
    $master_h = 550;
}
if ((!$master_w)||(!(is_numeric($master_w)))||($master_w <= 1))
{
    $master_w = 550;
}
if ((!$master_square == 1)&&(!$master_square == 0))
{
    $master_square = null;
}

if ((!$master_upscale == 1)&&(!$master_upscale == 0))
{
    $master_upscale = null;
}

if ((!$large_h)||(!(is_numeric($large_h)))||($large_h <= 1))
{
    $large_h = 200;
}
if ((!$large_w)||(!(is_numeric($large_w)))||($large_w <= 1))
{
    $large_w = 200;
}
if ((!$large_square == 1)&&(!$large_square == 0))
{
    $large_square = null;
}

if ((!$large_upscale == 1)&&(!$large_upscale == 0))
{
    $large_upscale = null;
}

if ((!$medium_h)||(!(is_numeric($medium_h)))||($medium_h <= 1))
{
    $medium_h = 100;
}
if ((!$medium_w)||(!(is_numeric($medium_w)))||($medium_w <= 1))
{
    $medium_w = 100;
}
if ((!$medium_square == 1)&&(!$medium_square == 0))
{
    $medium_square = 1;
}

if ((!$medium_upscale == 1)&&(!$medium_upscale == 0))
{
    $medium_upscale = 1;
}

if ((!$small_h)||(!(is_numeric($small_h)))||($small_h <= 1))
{
    $small_h = 40;
}
if ((!$small_w)||(!(is_numeric($small_w)))||($small_w <= 1))
{
    $small_w = 40;
}
if ((!$small_square == 1)&&(!$small_square == 0))
{
    $small_square = 1;
}

if ((!$small_upscale == 1)&&(!$small_upscale == 0))
{
    $small_upscale = 1;
}

if ((!$tiny_h)||(!(is_numeric($tiny_h)))||($tiny_h <= 1))
{
    $tiny_h = 25;
}
if ((!$tiny_w)||(!(is_numeric($tiny_w)))||($tiny_w <= 1))
{
    $tiny_w = 25;
}
if ((!$tiny_square == 1)&&(!$tiny_square == 0))
{
    $tiny_square = 1;
}

if ((!$tiny_upscale == 1)&&(!$tiny_upscale == 0))
{
    $tiny_upscale = 1;
}

if ((!$topbar_h)||(!(is_numeric($topbar_h)))||($topbar_h <= 1))
{
    $topbar_h = 16;
}
if ((!$topbar_w)||(!(is_numeric($topbar_w)))||($topbar_w <= 1))
{
    $topbar_w = 16;
}
if ((!$topbar_square == 1)&&(!$topbar_square == 0))
{
    $topbar_square = 1;
}

if ((!$topbar_upscale == 1)&&(!$topbar_upscale == 0))
{
    $topbar_upscale = 1;
}

$icons = array();
$icons['topbar'] = array('w' => $topbar_w,
                        'h' => $topbar_h,
                        'square' => $topbar_square,
                        'upscale' => $topbar_upscale);
$icons['tiny'] = array('w' => $tiny_w,
                        'h' => $tiny_h,
                        'square' => $tiny_square,
                        'upscale' => $tiny_upscale);
$icons['small'] = array('w' => $small_w,
                        'h' => $small_h,
                        'square' => $small_square,
                        'upscale' => $small_upscale);
$icons['medium'] = array('w' => $medium_w,
                         'h' => $medium_h,
                         'square' => $medium_square,
                         'upscale' => $medium_upscale);
$icons['large'] = array('w' => $large_w,
                        'h' => $large_h,
                        'square' => $large_square,
                        'upscale' => $large_upscale);
$icons['master'] = array('w' => $master_w,
                         'h' => $master_h,
                         'square' => $master_square,
                         'upscale' => $master_upscale);

foreach ($sizes as $icon_size)
{
    if ($icons[$icon_size]['square'] == 0)
        $icons[$icon_size]['square'] = null;
    if ($icons[$icon_size]['upscale'] == 0)
        $icons[$icon_size]['upscale'] = null;
}

error_log('action end: icon size - medium square = ' . $medium_square);
elgg_save_config("icon_sizes", $icons);


return;
