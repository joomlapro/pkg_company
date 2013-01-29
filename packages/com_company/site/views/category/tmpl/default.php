<?php
/**
 * @package     Company
 * @subpackage  com_company
 * @copyright   Copyright (C) 2013 AtomTech, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

?>
<div class="company category<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading')): ?>
		<div class="page-header">
			<h1>
				<?php echo $this->escape($this->params->get('page_heading')); ?>
			</h1>
		</div>
	<?php endif; ?>

	<?php if ($this->params->get('show_category_title', 1)): ?>
		<div class="page-header">
			<h2>
				<?php echo JHtml::_('content.prepare', $this->category->title, '', 'com_company.category'); ?>
			</h2>
		</div>
	<?php endif; ?>

	<?php $groups = array_chunk($this->items, 4); ?>
	<?php foreach ($groups as $group): ?>
		<div class="row-fluid">
			<?php foreach ($this->items as $item): ?>
				<div class="span3">
					<div class="well">
						<h3><?php echo $this->escape($item->user_name); ?></h3>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endforeach; ?>

	<?php if ($this->params->get('show_pagination', 1)): ?>
		<div class="pagination">
			<?php if ($this->params->def('show_pagination_results', 1)): ?>
				<p class="counter">
					<?php echo $this->pagination->getPagesCounter(); ?>
				</p>
			<?php endif; ?>
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
	<?php endif; ?>
</div>
