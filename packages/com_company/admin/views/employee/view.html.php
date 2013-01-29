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
 * View to edit a employee.
 *
 * @package     Company
 * @subpackage  com_company
 * @since       3.0
 */
class CompanyViewEmployee extends JViewLegacy
{
	protected $form;

	protected $item;

	protected $state;

	/**
	 * Method to display the view.
	 *
	 * @param   string  $tpl  A template file to load. [optional]
	 *
	 * @return  mixed  A string if successful, otherwise a JError object.
	 *
	 * @since   3.0
	 */
	public function display($tpl = null)
	{
		// Initialiase variables.
		$this->form  = $this->get('Form');
		$this->item  = $this->get('Item');
		$this->state = $this->get('State');
		$this->canDo = CompanyHelper::getActions($this->state->get('filter.category_id'));

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();

		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   3.0
	 */
	protected function addToolbar()
	{
		JFactory::getApplication()->input->set('hidemainmenu', true);

		// Initialiase variables.
		$user       = JFactory::getUser();
		$userId     = $user->get('id');
		$isNew      = ($this->item->id == 0);
		$checkedOut = !($this->item->checked_out == 0 || $this->item->checked_out == $userId);

		// Since we don't track these assets at the item level, use the category id.
		$canDo      = CompanyHelper::getActions($this->item->catid, $this->item->id);

		JToolbarHelper::title($isNew ? JText::_('COM_COMPANY_MANAGER_EMPLOYEE_NEW') : JText::_('COM_COMPANY_MANAGER_EMPLOYEE_EDIT'), 'employee.png');

		// If not checked out, can save the item.
		if (!$checkedOut && ($canDo->get('core.edit') || (count($user->getAuthorisedCategories('com_company', 'core.create')))))
		{
			JToolbarHelper::apply('employee.apply');
			JToolbarHelper::save('employee.save');
		}

		if (!$checkedOut && (count($user->getAuthorisedCategories('com_company', 'core.create'))))
		{
			JToolbarHelper::save2new('employee.save2new');
		}

		// If an existing item, can save to a copy.
		if (!$isNew && (count($user->getAuthorisedCategories('com_company', 'core.create')) > 0))
		{
			JToolbarHelper::save2copy('employee.save2copy');
		}

		if (empty($this->item->id))
		{
			JToolbarHelper::cancel('employee.cancel');
		}
		else
		{
			JToolbarHelper::cancel('employee.cancel', 'JTOOLBAR_CLOSE');
		}

		JToolbarHelper::divider();
		JToolBarHelper::help('employee', $com = true);
	}
}
