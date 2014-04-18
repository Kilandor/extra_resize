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

defined('COT_CODE') or die('Wrong URL');

require_once cot_incfile('extra_resize', 'plug');

@mkdir($cfg['extra_resize_dir'], $cfg['dir_perms']);