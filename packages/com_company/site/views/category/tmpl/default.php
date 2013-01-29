<?php
/**
 * @package     Company
 * @subpackage  com_company
 * @copyright   Copyright (C) 2013 AtomTech, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

// Load Stylesheet.
JHtml::stylesheet('com_company/frontend.css', false, true, false);
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

	<?php if ($this->items): ?>

	<div class="employees">
		<?php $groups = array_chunk($this->items, 4); ?>
			<?php foreach ($groups as $group): ?>
				<div class="row-fluid">
					<?php foreach ($group as $item): ?>
						<div class="span3">
							<div class="well">
								<div class="image">
									<?php echo JHtml::_('image', 'com_company/team-member.jpg', $item->user_name, null, true); ?>
								</div>
								<h3><?php echo $this->escape($item->user_name); ?></h3>
								<span><?php echo $this->escape($item->category_title); ?></span>
								<?php if ($this->params->get('show_biography', 1)): ?>
									<hr />
									<p>
										<?php echo JHtml::_('string.truncate', $item->biography, $this->params->get('biography_limit', 200), true, false); ?>
									</p>
								<?php endif; ?>
								<hr />
								<ul class="social">
									<?php if ($item->twitter): ?>
										<li><a href="<?php echo htmlspecialchars($item->twitter); ?>"><i class="icon-twitter"></i></a></li>
									<?php endif; ?>
									<li><a href="#"><i class="icon-facebook"></i></a></li>
									<li><a href="#"><i class="icon-linkedin"></i></a></li>
									<li><a href="#"><i class="icon-google-plus"></i></a></li>
									<li><a href="#"><i class="icon-envelope"></i></a></li>
								</ul>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<p><?php echo JText::_('COM_COMPANY_NO_RESULTS'); ?></p>
		<?php endif; ?>
	</div>

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
