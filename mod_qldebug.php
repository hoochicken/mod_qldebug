<?php
/**
 * @package		mod_qldebug
 * @copyright	Copyright (C) 2022 ql.de All rights reserved.
 * @author 		Mareike Riegel mareike.riegel@ql.de
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

require_once JPATH_BASE.'/plugins/system/qldebug/qldebug.php';
$type='system';
$strPlg='qldebug';
JPluginHelper::importPlugin($type,$strPlg);
$dispatcher = JEventDispatcher::getInstance();

$obj_plugin=new plgSystemQldebug($dispatcher,(array)JPluginHelper::getPlugin($type,$strPlg));
$obj_plugin->forceParams($params);
$obj=$obj_plugin->onAfterDispatch();
if(false==$obj)return;

$type='module';
require JModuleHelper::getLayoutPath('mod_qldebug', $params->get('layout', 'default'));