<?php
/**
 * @package        mod_qlform
 * @copyright    Copyright (C) 2017 ql.de All rights reserved.
 * @author        Mareike Riegel mareike.riegel@ql.de
 * @license        GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
jimport('joomla.html.html');
jimport('joomla.form.formfield');

class JFormFieldCheckpluginsystemqldebug extends JFormField
{
    /**
     * The form field type.
     *
     * @var  string
     * @since 1.6
     */
    protected $type = 'checkpluginsystemqldebug'; //the form field type see the name is the same

    /**
     * Method to retrieve the lists that resides in your application using the API.
     *
     * @return array The field option objects.
     * @since 1.6
     */
    protected function getInput()
    {
        if (!$this->checkIfPluginExists('system', 'qldebug')) JFactory::getApplication()->enqueueMessage(JText::_('MOD_QLDEBUG_MSG_PLUGINNOTFOUNDORCONFIGURATED'), 'error');
    }

    protected function checkIfPluginExists($type, $strPlugin)
    {
        return is_object(JPluginHelper::getPlugin($type, $strPlugin));
    }
}