<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.
?>
<?php // The menu class is deprecated. Use nav instead. ?>
<ul class="menu">
<?php
foreach ($list as $i => &$item) :
	$title = $item->anchor_title ? 'title="'.$item->anchor_title.'" ' : '';
	if ($item->id == $active_id)
	{
		echo '<li class="level1 active current"><a class="level1 topdaddy active" href="'.$item->flink.'">'.$item->title;
	}
	else
	{
		echo '<li class="level1"><a class="level1 topdaddy" href="'.$item->flink.'">'.$item->title;
	}


echo '</a></li>';
endforeach;
?></ul>
