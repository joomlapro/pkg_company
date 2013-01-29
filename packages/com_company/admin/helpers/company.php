<?php
/**
 * @package     Company
 * @subpackage  com_company
 * @copyright   Copyright (C) 2013 AtomTech, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

/**
 * Company helper.
 *
 * @package     Company
 * @subpackage  com_company
 * @since       3.0
 */
class CompanyHelper
{
	/**
	 * Configure the Linkbar.
	 *
	 * @param   string  $vName  The name of the active view.
	 *
	 * @return  void
	 *
	 * @since   3.0
	 */
	public static function addSubmenu($vName = 'cpanel')
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_COMPANY_SUBMENU_CPANEL'),
			'index.php?option=com_company&view=cpanel',
			$vName == 'cpanel'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_COMPANY_SUBMENU_EMPLOYEES'),
			'index.php?option=com_company&view=employees',
			$vName == 'employees'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_COMPANY_SUBMENU_CATEGORIES'),
			'index.php?option=com_categories&extension=com_company',
			$vName == 'categories'
		);

		if ($vName == 'categories')
		{
			JToolbarHelper::title(
				JText::sprintf('COM_CATEGORIES_CATEGORIES_TITLE', JText::_('com_company')),
				'company-categories');
		}
	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @param   int  $categoryId  The category ID.
	 *
	 * @return  JObject  A JObject containing the allowed actions.
	 *
	 * @since   3.0
	 */
	public static function getActions($categoryId = 0)
	{
		$user   = JFactory::getUser();
		$result = new JObject;

		if (empty($categoryId))
		{
			$assetName = 'com_company';
			$level = 'component';
		}
		else
		{
			$assetName = 'com_company.category.' . (int) $categoryId;
			$level = 'category';
		}

		$actions = JAccess::getActions('com_company', $level);

		foreach ($actions as $action)
		{
			$result->set($action->name, $user->authorise($action->name, $assetName));
		}

		return $result;
	}
}
