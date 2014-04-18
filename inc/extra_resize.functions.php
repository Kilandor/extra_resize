<?php
/**
 * Extra Fields Resize Plugin
 *
 * @package extra_resize
 * @version 1.0.0
 * @author Jason Booth (Kilandor)
 * @copyright Copyright (c) 2014 Jason Booth (Kilandor)
 * @license BSD
 */

 // Table name globals
global $db_extra_resize, $db_x;
$db_extra_resize = (isset($db_extra_resize)) ? $db_extra_resize : $db_x . 'extra_resize';

$cfg['extra_resize_dir'] = (isset($cfg['extra_resize_dir'])) ? $cfg['extra_resize_dir'] : 'datas/extra_resize';

/*
 * Load the current extrafields data
 *
 * @return array Returns 4 sub arrays of data
 */
function extraresize_load_selectbox_info()
{
	global $cot_extrafields, $L;
	foreach($cot_extrafields as $location => $extrafields)
	{
		$extra_locations[] = $location;
		$extra_locations_titles[] = (empty($L['extra_resize_location_'.$location])) ? $location : $L['extra_resize_location_'.$location];
		foreach($extrafields as $extrafield)
		{
			$extra_names[$location][] = $extrafield['field_name'];
			$extra_names_titles[$location][] = (empty($L['extra_resize_name_'.$location.'_'.$extrafield['field_name']])) ? $extrafield['field_name'] : $L['extra_resize_name_'.$location.'_'.$extrafield['field_name']];
		}
	}
	
	return array($extra_locations, $extra_location_titles, $extra_names, $extra_names_titles);
}

/*
 * Load the current Extra Resize Data for cache
 *
 * @param bool $force Force reload of cache
 */
function extraresize_load_cache($force = false)
{
	global $db_extra_resize, $db, $extra_resize_info, $cache;
	
	$cache && $extra_resize_info = $cache->db->get('extra_resize_info', 'extra_resize');
	if(!$extra_resize_info || $force)
	{
		if($force)
			unset($extra_resize_info);
		
		$sql_resize = $db->query("SELECT * FROM ".$db_extra_resize);
		while($fa_resize = $sql_resize->fetch())
			$extra_resize_info[$fa_resize['extra_location']][$fa_resize['extra_name']][] = $fa_resize;
		
		$cache && $cache->db->store('extra_resize_info', $extra_resize_info, 'extra_resize');
	}
}