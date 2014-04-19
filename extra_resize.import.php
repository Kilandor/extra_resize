<?PHP
/**
 * Extra Fields Resize Plugin
 *
 * @package extra_resize
 * @version 1.0.1
 * @author Jason Booth (Kilandor)
 * @copyright Copyright (c) 2014 Jason Booth (Kilandor)
 * @license BSD
 */
/* ====================
[BEGIN_COT_EXT]
Hooks=extrafields.import.file.done
[END_COT_EXT]
==================== */

if (!defined('COT_CODE')) { die('Wrong URL.'); }

$cache = $GLOBALS['cache'];

require_once cot_incfile('extra_resize', 'plug');

extraresize_load_cache();
$extra_resize_info = $GLOBALS['extra_resize_info'];

$gd_supported = array('jpg', 'jpeg', 'png', 'gif');
if(in_array($ext, $gd_supported) && !empty($extra_resize_info[$extrafield['field_location']][$extrafield['field_name']]))
{
	foreach($extra_resize_info[$extrafield['field_location']][$extrafield['field_name']] as $resize_info)
	{
		if($cfg['extra_resize_dir'].'/'.$resize_info['extra_thname'].'/'.$oldvalue)
			@unlink($cfg['extra_resize_dir'].'/'.$resize_info['extra_thname'].'/'.$oldvalue);
		
		cot_imageresize($file['tmp'], $cfg['extra_resize_dir'].'/'.$resize_info['extra_thname'].'/'.$fname,
			$resize_info['extra_x'], $resize_info['extra_y'], $resize_info['extra_crop'], $resize_info['extra_colorbg'],
			$resize_info['extra_jpg_quality'], true);
	}
	
}