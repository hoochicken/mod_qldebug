<?php
/**
 * @package		mod_qldebug
 * @copyright	Copyright (C) 2022 ql.de All rights reserved.
 * @author 		Mareike Riegel mareike.riegel@ql.de
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

/* @var \Joomla\Registry\Registry $params */

// no direct access
defined('_JEXEC') or die;
?>
    <div class="qldebugInner qldebug<?php echo ucwords($type); ?>">
        <?php if (2 != $params->get('output', 1)): ?>
            <div id="qldebugButton" class="qldebugInner">
                <button id="qldebugHide" class="btn"
                        onclick="document.getElementById('qldebugShow').style.display='block';document.getElementById('qldebugHide').style.display='none';document.getElementById('qldebugInnerContainer').style.display='none';"><?php echo JText::_('MOD_QLDEBUG_JSHIDE'); ?></button>
                <button id="qldebugShow" class="btn" style="display:none;"
                        onclick="document.getElementById('qldebugShow').style.display='none';document.getElementById('qldebugHide').style.display='block';document.getElementById('qldebugInnerContainer').style.display='block';"><?php echo JText::_('MOD_QLDEBUG_JSSHOW'); ?></button>
            </div>
        <?php endif; ?>
        <div id="qldebugInnerContainer" class="qldebugInner <?php if (2 != $params->get('output', 1)) echo 'bare'; ?>">
            <?php
            if (!empty(trim(strip_tags($params->get('message'))))) echo '<div class="message">' . $params->get('message') . '</div>';
            if (1 == $params->get('quicklinks', 0)) require $obj_plugin->getLayoutPath('_quicklinks');
            foreach ($obj_plugin->arrQldebug as $v):
                if (preg_match('/misc/', $v)) require $obj_plugin->getLayoutPath('_misc');
                elseif ('table' == $v) require $obj_plugin->getLayoutPath('_table');
                elseif ('server' == $v) {
                    if (0 < count($obj_plugin->$v)) require $obj_plugin->getLayoutPath('_default');
                } else require $obj_plugin->getLayoutPath('_default');
            endforeach;
            ?>
        </div>
    </div>
<?php if (1 == $params->get('exit') && 'admin' != JFactory::getApplication()->isClient('administrator')) exit; ?>