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
 * Company Component Route Helper
 *
 * @static
 * @package     Company
 * @subpackage  com_company
 * @since       3.0
 */
abstract class CompanyHelperRoute
{
	protected static $lookup;

	/**
	 * Method to get a route configuration for the employee view.
	 *
	 * @param   int  $id     The route of the employee.
	 * @param   int  $catid  The id of the category.
	 *
	 * @return  string
	 *
	 * @since   3.0
	 */
	public static function getEmployeeRoute($id, $catid)
	{
		// Initialiase variables.
		$needles = array(
			'employee' => array((int) $id)
		);

		// Create the link
		$link = 'index.php?option=com_company&view=employee&id=' . $id;

		if ($catid > 1)
		{
			$categories = JCategories::getInstance('Company');
			$category = $categories->get($catid);

			if ($category)
			{
				$needles['category'] = array_reverse($category->getPath());
				$needles['categories'] = $needles['category'];
				$link .= '&catid=' . $catid;
			}
		}

		if ($item = self::_findItem($needles))
		{
			$link .= '&Itemid=' . $item;
		}
		elseif ($item = self::_findItem())
		{
			$link .= '&Itemid=' . $item;
		}

		return $link;
	}

	/**
	 * Method to get a route configuration for the form view.
	 *
	 * @param   int     $id      The id of the employee.
	 * @param   string  $return  The return page variable.
	 *
	 * @return  string
	 *
	 * @since   3.0
	 */
	public static function getFormRoute($id, $return = null)
	{
		// Create the link.
		if ($id)
		{
			$link = 'index.php?option=com_company&task=employee.edit&c_id=' . $id;
		}
		else
		{
			$link = 'index.php?option=com_company&task=employee.add&c_id=0';
		}

		if ($return)
		{
			$link .= '&return=' . $return;
		}

		return $link;
	}

	/**
	 * Method to get a route configuration for the category view.
	 *
	 * @param   int  $catid  The id of the category.
	 *
	 * @return  string
	 *
	 * @since   3.0
	 */
	public static function getCategoryRoute($catid)
	{
		if ($catid instanceof JCategoryNode)
		{
			$id = $catid->id;
			$category = $catid;
		}
		else
		{
			$id = (int) $catid;
			$category = JCategories::getInstance('Company')->get($id);
		}

		if ($id < 1)
		{
			$link = '';
		}
		else
		{
			$needles = array(
				'category' => array($id)
			);

			if ($item = self::_findItem($needles))
			{
				$link = 'index.php?Itemid=' . $item;
			}
			else
			{
				// Create the link
				$link = 'index.php?option=com_company&view=category&id=' . $id;

				if ($category)
				{
					$catids = array_reverse($category->getPath());
					$needles = array(
						'category' => $catids,
						'categories' => $catids
					);

					if ($item = self::_findItem($needles))
					{
						$link .= '&Itemid=' . $item;
					}
					elseif ($item = self::_findItem())
					{
						$link .= '&Itemid=' . $item;
					}
				}
			}
		}

		return $link;
	}

	/**
	 * Method to find the item.
	 *
	 * @param   array  $needles  The needles to find.
	 *
	 * @return  null
	 *
	 * @since   3.0
	 */
	protected static function _findItem($needles = null)
	{
		// Initialiase variables.
		$app   = JFactory::getApplication();
		$menus = $app->getMenu('site');

		// Prepare the reverse lookup array.
		if (self::$lookup === null)
		{
			self::$lookup = array();

			$component = JComponentHelper::getComponent('com_company');
			$items     = $menus->getItems('component_id', $component->id);

			if ($items)
			{
				foreach ($items as $item)
				{
					if (isset($item->query) && isset($item->query['view']))
					{
						$view = $item->query['view'];

						if (!isset(self::$lookup[$view]))
						{
							self::$lookup[$view] = array();
						}

						if (isset($item->query['id']))
						{
							self::$lookup[$view][$item->query['id']] = $item->id;
						}
					}
				}
			}
		}

		if ($needles)
		{
			foreach ($needles as $view => $ids)
			{
				if (isset(self::$lookup[$view]))
				{
					foreach ($ids as $id)
					{
						if (isset(self::$lookup[$view][(int) $id]))
						{
							return self::$lookup[$view][(int) $id];
						}
					}
				}
			}
		}
		else
		{
			$active = $menus->getActive();

			if ($active)
			{
				return $active->id;
			}
		}

		return null;
	}
}
