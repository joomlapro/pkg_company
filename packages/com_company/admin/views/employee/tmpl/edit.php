<?php
/**
 * @package     Company
 * @subpackage  com_company
 * @copyright   Copyright (C) 2013 AtomTech, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

// Load the tooltip behavior script.
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
?>
<script type="text/javascript">
	Joomla.submitbutton = function (task) {
		if (task == 'employee.cancel' || document.formvalidator.isValid(document.id('employee-form'))) {
			<?php echo $this->form->getField('biography')->save(); ?>
			Joomla.submitform(task, document.getElementById('employee-form'));
		} else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
		}
	}
</script>
<form action="<?php echo JRoute::_('index.php?option=com_company&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="employee-form" class="form-validate">
	<div class="row-fluid">
		<!-- Begin Employees -->
		<div class="span10 form-horizontal">
			<fieldset>
				<ul class="nav nav-tabs">
					<li class="active"><a href="#details" data-toggle="tab"><?php echo empty($this->item->id) ? JText::_('COM_COMPANY_NEW_EMPLOYEE') : JText::sprintf('COM_COMPANY_EDIT_EMPLOYEE', $this->item->id); ?></a></li>
					<li><a href="#publishing" data-toggle="tab"><?php echo JText::_('JGLOBAL_FIELDSET_PUBLISHING'); ?></a></li>
					<?php $fieldSets = $this->form->getFieldsets('params');
					foreach ($fieldSets as $name => $fieldSet): ?>
						<li><a href="#params-<?php echo $name; ?>" data-toggle="tab"><?php echo JText::_($fieldSet->label); ?></a></li>
					<?php endforeach; ?>
					<?php $fieldSets = $this->form->getFieldsets('metadata');
					foreach ($fieldSets as $name => $fieldSet): ?>
						<li><a href="#metadata-<?php echo $name; ?>" data-toggle="tab"><?php echo JText::_($fieldSet->label); ?></a></li>
					<?php endforeach; ?>
					<?php if ($this->canDo->get('core.admin')): ?>
						<li><a href="#permissions" data-toggle="tab"><?php echo JText::_('COM_COMPANY_FIELDSET_RULES');?></a></li>
					<?php endif; ?>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="details">
						<div class="row-fluid">
							<div class="span6">
								<div class="control-group">
									<div class="control-label"><?php echo $this->form->getLabel('user_id'); ?></div>
									<div class="controls"><?php echo $this->form->getInput('user_id'); ?></div>
								</div>
								<div class="control-group">
									<div class="control-label"><?php echo $this->form->getLabel('catid'); ?></div>
									<div class="controls"><?php echo $this->form->getInput('catid'); ?></div>
								</div>
								<div class="control-group">
									<div class="control-label"><?php echo $this->form->getLabel('ordering'); ?></div>
									<div class="controls"><?php echo $this->form->getInput('ordering'); ?></div>
								</div>
								<div class="control-group">
									<div class="control-label"><?php echo $this->form->getLabel('email'); ?></div>
									<div class="controls"><?php echo $this->form->getInput('email'); ?></div>
								</div>
								<div class="control-group">
									<div class="control-label"><?php echo $this->form->getLabel('image'); ?></div>
									<div class="controls"><?php echo $this->form->getInput('image'); ?></div>
								</div>
							</div>
							<div class="span6">
								<div class="control-group">
									<div class="control-label"><?php echo $this->form->getLabel('twitter'); ?></div>
									<div class="controls"><?php echo $this->form->getInput('twitter'); ?></div>
								</div>
								<div class="control-group">
									<div class="control-label"><?php echo $this->form->getLabel('facebook'); ?></div>
									<div class="controls"><?php echo $this->form->getInput('facebook'); ?></div>
								</div>
								<div class="control-group">
									<div class="control-label"><?php echo $this->form->getLabel('skype'); ?></div>
									<div class="controls"><?php echo $this->form->getInput('skype'); ?></div>
								</div>
								<div class="control-group">
									<div class="control-label"><?php echo $this->form->getLabel('linkedin'); ?></div>
									<div class="controls"><?php echo $this->form->getInput('linkedin'); ?></div>
								</div>
								<div class="control-group">
									<div class="control-label"><?php echo $this->form->getLabel('googleplus'); ?></div>
									<div class="controls"><?php echo $this->form->getInput('googleplus'); ?></div>
								</div>
							</div>
						</div>
						<div class="control-group">
							<div class="control-label"><?php echo $this->form->getLabel('biography'); ?></div>
							<div class="controls"><?php echo $this->form->getInput('biography'); ?></div>
						</div>
					</div>
					<div class="tab-pane" id="publishing">
						<div class="row-fluid">
							<div class="span6">
								<?php if ($this->item->id): ?>
									<div class="control-group">
										<div class="control-label"><?php echo $this->form->getLabel('id'); ?></div>
										<div class="controls"><?php echo $this->form->getInput('id'); ?></div>
									</div>
								<?php endif; ?>
								<div class="control-group">
									<div class="control-label"><?php echo $this->form->getLabel('created_by'); ?></div>
									<div class="controls"><?php echo $this->form->getInput('created_by'); ?></div>
								</div>
								<div class="control-group">
									<div class="control-label"><?php echo $this->form->getLabel('created_by_alias'); ?></div>
									<div class="controls"><?php echo $this->form->getInput('created_by_alias'); ?></div>
								</div>
								<div class="control-group">
									<div class="control-label"><?php echo $this->form->getLabel('created'); ?></div>
									<div class="controls"><?php echo $this->form->getInput('created'); ?></div>
								</div>
								<div class="control-group">
									<div class="control-label"><?php echo $this->form->getLabel('publish_up'); ?></div>
									<div class="controls"><?php echo $this->form->getInput('publish_up'); ?></div>
								</div>
								<div class="control-group">
									<div class="control-label"><?php echo $this->form->getLabel('publish_down'); ?></div>
									<div class="controls"><?php echo $this->form->getInput('publish_down'); ?></div>
								</div>
							</div>
							<div class="span6">
								<div class="control-group">
									<div class="control-label"><?php echo $this->form->getLabel('version'); ?></div>
									<div class="controls"><?php echo $this->form->getInput('version'); ?></div>
								</div>
								<div class="control-group">
									<div class="control-label"><?php echo $this->form->getLabel('modified_by'); ?></div>
									<div class="controls"><?php echo $this->form->getInput('modified_by'); ?></div>
								</div>
								<div class="control-group">
									<div class="control-label"><?php echo $this->form->getLabel('modified'); ?></div>
									<div class="controls"><?php echo $this->form->getInput('modified'); ?></div>
								</div>
								<?php if ($this->item->hits): ?>
									<div class="control-group">
										<div class="control-label"><?php echo $this->form->getLabel('hits'); ?></div>
										<div class="controls"><?php echo $this->form->getInput('hits'); ?></div>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<?php echo $this->loadTemplate('params'); ?>
					<?php echo $this->loadTemplate('metadata'); ?>
					<?php if ($this->canDo->get('core.admin')): ?>
						<div class="tab-pane" id="permissions">
							<fieldset>
								<?php echo $this->form->getInput('rules'); ?>
							</fieldset>
						</div>
					<?php endif; ?>
				</div>
			</fieldset>
			<div>
				<input type="hidden" name="task" value="" />
				<?php echo JHtml::_('form.token'); ?>
			</div>
		</div>
		<!-- End Employees -->
		<!-- Begin Sidebar -->
		<div class="span2">
			<h4><?php echo JText::_('JDETAILS'); ?></h4>
			<hr />
			<fieldset class="form-vertical">
				<div class="control-group">
					<div class="controls"><?php echo $this->item->user_name; ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('state'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('state'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('access'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('access'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('language'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('language'); ?></div>
				</div>
			</fieldset>
		</div>
		<!-- End Sidebar -->
	</div>
</form>
