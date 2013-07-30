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
<table width="100%" cellspacing="1" cellpadding="0" border="0">
<tbody>
<tr>
<td nowrap="nowrap">

<?php
foreach ($list as $i => &$item) :
	$title = $item->anchor_title ? 'title="'.$item->anchor_title.'" ' : '';
	if ($item->id == $active_id)
	{
		$tagid = 'id="active_menu"';
	}
	else
	{
		$tagid = '';
	}
	echo '<a '.$tagid.' class="mainlevel" href="'.$item->flink.'">'.$item->title;

echo '</a>';
endforeach;
?></td></tr></tbody></table>
