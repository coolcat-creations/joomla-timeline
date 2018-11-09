<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JHtml::_('behavior.caption');

$dispatcher = JEventDispatcher::getInstance();

$this->category->text = $this->category->description;
$dispatcher->trigger('onContentPrepare', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$this->category->description = $this->category->text;

$results = $dispatcher->trigger('onContentAfterTitle', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayTitle = trim(implode("\n", $results));

$results = $dispatcher->trigger('onContentBeforeDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$beforeDisplayContent = trim(implode("\n", $results));

$results = $dispatcher->trigger('onContentAfterDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayContent = trim(implode("\n", $results));
?>

<div class="timeline<?php echo $this->pageclass_sfx; ?>">

	<?php if ($this->params->get('show_page_heading')) : ?>
		<div class="page-header">
			<h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
		</div>
	<?php endif; ?>

	<?php if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) : ?>
		<h2> <?php echo $this->escape($this->params->get('page_subheading')); ?>
			<?php if ($this->params->get('show_category_title')) : ?>
				<span class="subheading-category"><?php echo $this->category->title; ?></span>
			<?php endif; ?>
		</h2>
	<?php endif; ?>
	<?php echo $afterDisplayTitle; ?>

	<?php if ($this->params->get('show_cat_tags', 1) && !empty($this->category->tags->itemTags)) : ?>
		<?php $this->category->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
		<?php echo $this->category->tagLayout->render($this->category->tags->itemTags); ?>
	<?php endif; ?>

	<?php if ($beforeDisplayContent || $afterDisplayContent || $this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
		<div class="category-desc clearfix">
			<?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
				<img src="<?php echo $this->category->getParams()->get('image'); ?>"
				     alt="<?php echo htmlspecialchars($this->category->getParams()->get('image_alt'), ENT_COMPAT, 'UTF-8'); ?>"/>
			<?php endif; ?>
			<?php echo $beforeDisplayContent; ?>
			<?php if ($this->params->get('show_description') && $this->category->description) : ?>
				<?php echo JHtml::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
			<?php endif; ?>
			<?php echo $afterDisplayContent; ?>
		</div>
	<?php endif; ?>

	<?php if (empty($this->lead_items)) : ?>
		<?php if ($this->params->get('show_no_articles', 1)) : ?>
			<p><?php echo JText::_('COM_CONTENT_NO_ARTICLES'); ?></p>
		<?php endif; ?>
	<?php endif; ?>

	<?php if (!empty($this->lead_items)) : ?>

	<div class="gantt">
		<div class="gantt__row gantt__row--months">
			<div class="gantt__row-first"></div>

			<?php /*Display the Months of a year */
			for ($m = 1; $m <= 12; $m++) {
				$month = date('F', mktime(0, 0, 0, $m, 1, date('Y'))); ?>

				<span><?php echo JText::_($month . '_SHORT'); ?></span>

			<?php }	?>

		</div>

		<div class="gantt__row gantt__row--lines">

			<?php /* Get the current month and highlight it */
			$currentmonth = date('m');
			for ($monthcolumn = 0; $monthcolumn < 12; $monthcolumn++) { ?>
				<span <?php if ($monthcolumn == $currentmonth) : echo 'class="marker"'; endif; ?>></span>
			<?php } ?>

		</div>


		<?php foreach ($this->lead_items as &$item) :

			$this->item = &$item;
			$entries = json_decode($this->item->jcfields[1]->rawvalue);
			?>

			<div class="gantt__row <?php /* add a class if no entry is added */ if (empty($entries)) : echo 'gantt__row--empty'; endif; ?>">

				<div class="gantt__row-first">
					<?php echo $this->item->title ?>
				</div>

				<ul class="gantt__row-bars">
						<?php /* show the entries */ foreach ($entries as $entry) : ?>
							<li style="grid-column: <?php echo $entry->from; ?>/<?php echo $entry->to; ?>; background-color: <?php echo $entry->color; ?>;"
							    class="<?php echo $entry->class; ?>"><?php echo $entry->text; ?></li>
						<?php endforeach; ?>
				</ul>

			</div>

		<?php endforeach; ?>
	</div>

<?php endif; ?>

</div>
