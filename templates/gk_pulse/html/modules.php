<?php

/*--------------------------------------------------------------
# Pulse - October 2009 (for Joomla 1.5)
# Copyright (C) 2007-2009 Gavick.com. All Rights Reserved.
# License: Copyrighted Commercial Software
# Website: http://www.gavick.com
# Support: support@gavick.com  
---------------------------------------------------------------*/

defined('_JEXEC') or die('Restricted access');

/**

	Version without interface
	
	Attributes:
 	- headerLevel
 	
**/

function modChrome_gavickpro($module, &$params, &$attribs)
{
	$headerLevel = isset($attribs['headerLevel']) ? (int) $attribs['headerLevel'] : 3;
	
	if (!empty ($module->content)) : ?>
		<div class="moduletable<?php echo $params->get('moduleclass_sfx'); ?>">
			<?php if ($module->showtitle) : ?>
				<h<?php echo $headerLevel; ?>><span><?php echo $module->title; ?></span></h<?php echo $headerLevel; ?>>
			<?php endif; ?>
   			<div class="moduletable_content">
				<?php echo $module->content; ?>
			</div>
		</div>
	<?php endif;
}

?>