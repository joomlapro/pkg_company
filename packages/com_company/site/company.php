<?php
/**
 * @package     Company
 * @subpackage  com_company
 * @copyright   Copyright (C) 2013 AtomTech, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

// Include dependancies.
require_once JPATH_COMPONENT . '/helpers/route.php';

// Execute the task.
$controller = JControllerLegacy::getInstance('Company');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
