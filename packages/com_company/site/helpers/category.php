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
 * Company Component Category Tree
 *
 * @static
 * @package     Company
 * @subpackage  com_company
 * @since       3.0
 */
class CompanyCategories extends JCategories
{
	/**
	 * Class constructor
	 *
	 * @param   array  $options  Array of options
	 *
	 * @since   3.0
	 */
	public function __construct($options = array())
	{
		$options['table'] = '#__atomtech_company_employees';
		$options['extension'] = 'com_company';
		$options['statefield'] = 'state';
		$options['countItems'] = 1;
		// $options['allLanguages'] = true;

		parent::__construct($options);
	}
}
