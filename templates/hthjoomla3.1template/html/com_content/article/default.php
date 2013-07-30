<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

// Create shortcuts to some parameters.
$params  = $this->item->params;
$images  = json_decode($this->item->images);
$urls    = json_decode($this->item->urls);
$canEdit = $params->get('access-edit');
$user    = JFactory::getUser();
$info    = $params->get('info_block_position', 0);
JHtml::_('behavior.caption');

?>


<?php if ($this->params->get('show_page_heading') && $params->get('show_title')) : ?>
	<div class="componentheading<?php echo $this->pageclass_sfx?>">
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</div>
<?php endif; ?>


<?php if ($canEdit || $params->get('show_title') || $params->get('show_print_icon') || $params->get('show_email_icon'))
{
?>
<table class="contentpaneopen<?php echo $this->pageclass_sfx?>">
<tr>
  <?php if ($params->get('show_title'))
  { ?>
  <td class="contentheading<?php echo $this->pageclass_sfx?>" width="100%">
    <?php if ($params->get('link_titles') && !empty($this->item->readmore_link))
    { ?>
    <a href="<?php echo $this->item->readmore_link; ?>" class="contentpagetitle<?php echo $this->pageclass_sfx?>">
      <?php echo $this->escape($this->item->title); ?></a>
    <?php
  	}
  	else
  		{ echo $this->escape($this->item->title);}
  	?>
  </td>
	<?php } ?>


	<?php if (!$this->print)
  { ?>
    <?php if ( $params->get('show_print_icon') )
    { ?>
    <td align="right" width="100%" class="buttonheading">
    <?php echo JHtml::_('icon.print_popup', $this->item, $params,null,true); ?>
    </td>
    <?php } ?>

    <?php if ($params->get('show_email_icon'))
    { ?>
    <td align="right" width="100%" class="buttonheading">
    <?php echo JHtml::_('icon.email', $this->item, $params,null,true); ?>
    </td>
    <?php } ?>
    <?php if ($canEdit)
    { ?>
    <td align="right" width="100%" class="buttonheading">
      <?php echo JHtml::_('icon.edit', $this->item, $params,null,true); ?>
    </td>
    <?php }
    else
      { ?>
    <td align="right" width="100%" class="buttonheading">
    <?php echo JHtml::_('icon.print_screen', $this->item, $params,null,true); ?>
    </td>
  <?php }?>
</tr>
</table>
<?php } ?>


<?php } ?>


<?php  if (!$params->get('show_intro')) :
  echo $this->item->event->afterDisplayTitle;
endif; ?>
<?php echo $this->item->event->beforeDisplayContent; ?>
<table class="contentpaneopen<?php echo $this->pageclass_sfx?>">
<?php if (($params->get('show_section') && $this->item->sectionid) || ($params->get('show_category') && $this->item->catid)) : ?>
<tr>
  <td>
    <?php if ($params->get('show_category')) : ?>
    <span>
      <?php if ($params->get('link_category') && $this->item->catslug) : ?>
        <?php $title = $this->escape($this->item->category_title);
          $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)) . '">' . $title . '</a>';?>
      <?php endif; ?>
      <?php echo $this->escape($this->item->category_title); ?>
      <?php if ($params->get('link_category') && $this->item->catslug) : ?>
        <?php echo '</a>'; ?>
      <?php endif; ?>
    </span>
    <?php endif; ?>
  </td>
</tr>
<?php endif; ?>

<?php if ((($params->get('show_author')) && !empty($this->item->author )) || $params->get('show_create_date')) : ?>
<tr>
  <td valign="top">
    <span class="small spacer">
      <?php if ($params->get('show_create_date')) : ?><span class="info_date"><?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_LC3'))); ?>
    </span><?php endif; ?><?php if ((($params->get('show_author')) && !empty($this->item->author )) && $params->get('show_create_date')) : ?> | <?php endif; ?><?php if (($params->get('show_author')) && !empty($this->item->author )) : ?><span class="info_author"><?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', JHtml::_('link', JRoute::_($cntlink), $author)); ?></span><?php endif; ?>
    </span>
  </td>
</tr>
<?php endif; ?>

<?php if ($params->get('show_url') && $this->item->urls) : ?>
<tr>
  <td valign="top">
    <a href="http://<?php echo $this->item->urls ; ?>" target="_blank">
      <?php echo $this->escape($this->item->urls); ?></a>
  </td>
</tr>
<?php endif; ?>

<tr>
<td valign="top">
<?php if (isset ($this->item->toc)) : ?>
  <?php echo $this->item->toc; ?>
<?php endif; ?>
<?php echo $this->item->text; ?>
</td>
</tr>

<?php if ( intval($this->item->modified) !=0 && $params->get('show_modify_date')) : ?>
<tr>
  <td class="modifydate">
    <?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC3'))); ?>
  </td>
</tr>
<?php endif; ?>
</table>
<span class="article_separator">&nbsp;</span>
<?php echo $this->item->event->afterDisplayContent; ?>
