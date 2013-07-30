<?php

	/*--------------------------------------------------------------
	# Pulse - October 2009 (for Joomla 1.5)
	# Copyright (C) 2007-2009 Gavick.com. All Rights Reserved.
	# License: Copyrighted Commercial Software
	# Website: http://www.gavick.com
	# Support: support@gavick.com  
	---------------------------------------------------------------*/
		
	// no direct access
	defined('_JEXEC') or die('Restricted access');
	
?>

	<?php if($this->countModules('footer_menu')) : ?>
	<div id="footer_menu">
		<jdoc:include type="modules" name="footer_menu" style="raw" />
	</div>
	<?php endif; ?>
	<!-- Copyright Information -->	
	<div id="informations"><?php echo $footer_content; ?></div>