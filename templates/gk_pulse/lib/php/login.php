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

<?php if(($login_button && $this->countModules('login'))) : ?>		
<div id="popup_login" class="gk_popup">
	<div class="gk_popup_wrap">
        <div id="close_button_login" class="gk_popup_close"></div>
        <div class="gkp_tl"></div>
        <div class="gkp_t"></div>
        <div class="gkp_tr"></div>
        <div class="gkp_ml"></div>
        <div class="gkp_m">
              <div class="popup_padding">
            		<jdoc:include type="modules" name="login" style="raw" />        
              </div>
        </div>
        <div class="gkp_mr"></div>
        <div class="gkp_bl"></div>
        <div class="gkp_b"></div>
        <div class="gkp_br"></div>
  	</div>
</div>
<?php endif; ?>	