<?php
/**
 * @version     3.0.0
 * @package     com_secretary
 *
 * @author       Fjodor Schaefer (schefa.com)
 * @copyright    Copyright (C) 2015-2017 Fjodor Schaefer. All rights reserved.
 * @license      GNU General Public License version 2 or later.
 */
 
// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');
JFormHelper::addFieldPath(JPATH_SITE . '/administrator/components/com_secretary/models/fields');

class SecretaryViewDashboard extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $state;
	
	/**
	 * Method to display the View
	 *
	 * {@inheritDoc}
	 * @see \Joomla\CMS\MVC\View\HtmlView::display()
	 */
	public function display($tpl = null)
	{
		
		$this->pagination	= $this->get('Pagination');
		$this->activities	= $this->get('Items');
		$this->state		= $this->get('State');
		$this->canDo		= \Secretary\Helpers\Access::getActions();
		
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			throw new Exception(implode("\n", $errors));
		}
		
		parent::display($tpl);
	}
	
}