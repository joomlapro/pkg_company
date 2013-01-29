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
 * Company Component Controller
 *
 * @package     Company
 * @subpackage  com_company
 * @since       3.0
 */
class CompanyController extends JControllerLegacy
{
	/**
	 * Method to display a view.
	 *
	 * @param   boolean  $cachable   If true, the view output will be cached.
	 * @param   array    $urlparams  An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return  JController  This object to support chaining.
	 *
	 * @since   3.0
	 */
	public function display($cachable = false, $urlparams = false)
	{
		// Initialise variables.
		$cachable = true;
		$user = JFactory::getUser();

		// Set the default view name and format from the Request.
		// Note we are using c_id to avoid collisions with the router and the return page.
		$id    = $this->input->getInt('c_id');
		$vName = $this->input->get('view', 'categories');
		$this->input->set('view', $vName);

		if ($user->get('id') || ($this->input->getMethod() == 'POST' && $vName = 'categories'))
		{
			$cachable = false;
		}

		$safeurlparams = array(
			'id'               => 'INT',
			'limit'            => 'UINT',
			'limitstart'       => 'UINT',
			'filter_order'     => 'CMD',
			'filter_order_Dir' => 'CMD',
			'lang'             => 'CMD'
		);

		// Check for edit form.
		if ($vName == 'form' && !$this->checkEditId('com_company.edit.employee', $id))
		{
			// Somehow the person just went to the form - we don't allow that.
			return JError::raiseError(403, JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
		}

		return parent::display($cachable, $safeurlparams);
	}
}
