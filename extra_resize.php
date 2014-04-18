<?PHP
/**
 * Extra Fields Resize Plugin
 *
 * @package extra_resize
 * @version 1.0.0
 * @author Jason Booth (Kilandor)
 * @copyright Copyright (c) 2014 Jason Booth (Kilandor)
 * @license BSD
 */
/* ====================
[BEGIN_COT_EXT]
Hooks=standalone
[END_COT_EXT]
==================== */

if (!defined('COT_CODE') && !defined('COT_SHOP')) { die('Wrong URL.'); }

cot_block($usr['isadmin']);
$a = cot_import('a', 'G', 'TXT');
$id = cot_import('id', 'G', 'INT');

require_once cot_incfile('extra_resize', 'plug');
require_once cot_incfile('extrafields');

extraresize_load_cache();

if(($a == 'add' || $a == 'edit') && $_POST)
{
	if($a == 'edit' && (empty($id) || $db->query("SELECT * FROM ".$db_extra_resize." WHERE extra_id = ?", $id)->rowCount() <= 0))
		cot_redirect(cot_url('plug', 'e=extra_resize', '', true));
	
	$fa_resize['extra_location'] = cot_import('extra_location', 'P', 'ALP');
	$fa_resize['extra_name'] = cot_import('extra_name', 'P', 'ALP');
	$fa_resize['extra_thname'] = cot_import('extra_thname', 'P', 'ALP');
	$fa_resize['extra_x'] = cot_import('extra_x', 'P', 'INT');
	$fa_resize['extra_y'] = cot_import('extra_y', 'P', 'INT');
	$fa_resize['extra_jpg_quality'] = cot_import('extra_jpg_quality', 'P', 'INT');
	$fa_resize['extra_colorbg'] = cot_import('extra_colorbg', 'P', 'ALP');
	$fa_resize['extra_crop'] = cot_import('extra_crop', 'P', 'ALP');
	
	if($a == 'add')
		$db->insert($db_extra_resize, $fa_resize);
	elseif($a == "edit")
		$db->update($db_extra_resize, $fa_resize, 'extra_id = '.(int)$id.' LIMIT 1');
	$id = (!empty($id)) ? $id : $db->lastInsertId();
	
	@mkdir($cfg['extra_resize_dir'].'/'.$fa_resize['extra_thname'], $cfg['dir_perms']);
	extraresize_load_cache(true);
	
	cot_redirect(cot_url('plug', 'e=extra_resize', '', true));
}
elseif($a == 'del' && !empty($id))
{
	if($db->query("SELECT * FROM ".$db_extra_resize." WHERE extra_id = ?", $id)->rowCount() > 0)
		$db->delete($db_extra_resize, 'extra_id = ?', $id);
	
	extraresize_load_cache(true);
	
	cot_redirect(cot_url('plug', 'e=extra_resize', '', true));
}

$t = new XTemplate(cot_tplfile('extra_resize', 'plug'));

list($extra_locations, $extra_location_titles, $extra_names, $extra_names_titles) = extraresize_load_selectbox_info();
if(!empty($extra_resize_info) && $a != 'edit')
{
	foreach($extra_resize_info as $extra_location=>$extra_name_info)
	{
		foreach($extra_name_info as $extra_name=>$name_info)
		{
			foreach($name_info as $extra_data)
			{
				$t->assign(array(
					'EXTRA_THNAME' => $extra_data['extra_thname'],
					'EXTRA_X' => $extra_data['extra_x'],
					'EXTRA_Y' => $extra_data['extra_y'],
					'EXTRA_JPG_QUALITY' => $extra_data['extra_jpg_quality'],
					'EXTRA_COLORBG' => $extra_data['extra_colorbg'],
					'EXTRA_CROP' => $extra_data['extra_crop'],
					'EXTRA_EDIT' => cot_url('plug', 'e=extra_resize&a=edit&id='.$extra_data['extra_id']),
					'EXTRA_DELETE' => cot_url('plug', 'e=extra_resize&a=del&id='.$extra_data['extra_id'])
				));
				$t->parse('MAIN.INFO.LOCATION.NAME.LOOP');
			}
			$t->assign(array(
				'EXTRA_NAME' => $extra_name
				));
			$t->parse('MAIN.INFO.LOCATION.NAME');
		}
		$t->assign(array(
			'EXTRA_LOCATION' => $extra_location
			));
		$t->parse('MAIN.INFO.LOCATION');
	}
	$t->parse('MAIN.INFO');
}
if($a == 'edit' && !empty($id))
{
	$sql_resize = $db->query("SELECT * FROM ".$db_extra_resize." WHERE extra_id = ?", $id);
	$fa_resize = $sql_resize->fetch();
}
$fa_resize['extra_name'] = (empty($fa_resize['extra_name'])) ? '---' : $fa_resize['extra_name'];

$t->assign(array(
	'EXTRA_INPUT_LOCATION' => cot_selectbox($fa_resize['extra_location'], 'extra_location', $extra_locations, $extra_locations_titles),
	'EXTRA_INPUT_NAME' => cot_selectbox($fa_resize['extra_name'], 'extra_name', $extra_names[$fa_resize['extra_location']], $extra_names_titles[$fa_resize['extra_location']]),
	'EXTRA_INPUT_NAME_JSON' => json_encode($extra_names),
	'EXTRA_INPUT_NAME_TITLES_JSON' => json_encode($extra_names_titles),
	'EXTRA_INPUT_THNAME' => cot_inputbox('text', 'extra_thname', $fa_resize['extra_thname'], array('size' => '12', 'maxlength' => '255')),
	'EXTRA_INPUT_X' => cot_inputbox('text', 'extra_x', $fa_resize['extra_x'], array('size' => '5', 'maxlength' => '255')),
	'EXTRA_INPUT_Y' => cot_inputbox('text', 'extra_y', $fa_resize['extra_y'], array('size' => '5', 'maxlength' => '255')),
	'EXTRA_INPUT_JPG_QUALITY' => cot_inputbox('text', 'extra_jpg_quality', $fa_resize['extra_jpg_quality'], array('size' => '3', 'maxlength' => '255')),
	'EXTRA_INPUT_COLORBG' => cot_inputbox('text', 'extra_colorbg', $fa_resize['extra_colorbg'], array('size' => '6', 'maxlength' => '6')),
	'EXTRA_INPUT_CROP' => cot_selectbox($fa_resize['extra_crop'], 'extra_crop', array('fit')),
	));

if(empty($a) || $a == 'add')
{
	$t->assign(array(
		'EXTRA_SEND' => cot_url('plug', 'e=extra_resize&a=add')
		));
	$t->parse('MAIN.ADD');
}
elseif($a ==  'edit')
{
	$t->assign(array(
		'EXTRA_SEND' => cot_url('plug', 'e=extra_resize&a=edit&id='.$id)
		));
	$t->parse('MAIN.EDIT');
}