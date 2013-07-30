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

<?php if($register_button && ((!isset($_GET['task']) || !isset($_GET['option'])) || ((isset($_GET['task']) && $_GET['task'] != 'register') || (isset($_GET['option']) && $_GET['option'] != 'com_user'))) && $userID == 0) : ?>	
<div id="popup_register" class="gk_popup">
	<div class="gk_popup_wrap">
        <div id="close_button_register" class="gk_popup_close"></div>
        <div class="gkp_tl"></div>
        <div class="gkp_t"></div>
        <div class="gkp_tr"></div>
        <div class="gkp_ml"></div>
        <div class="gkp_m">
        	<div class="popup_padding">
				<script type="text/javascript" src="<?php echo $url->root(); ?>media/system/js/validate.js"></script>
				<script type="text/javascript">Window.onDomReady(function(){document.formvalidator.setHandler('passverify', function (value) { return ($('password').value == value); }	);});</script>
				<form action="<?php echo JRoute::_( 'index.php?option=com_user' ); ?>" method="post" id="josForm" name="josForm" class="form-validate">
				
				<table cellpadding="0" cellspacing="0" border="0" width="100%" class="contentpane">
				<tr>
					<td width="30%" height="40">
						<label id="namemsg" for="name">
							<?php echo JText::_( 'NAME' ); ?>:
						</label>
					</td>
				  	<td>
				  		<input type="text" name="name" id="name" size="40" value="" class="inputbox required" maxlength="50" /> *
				  	</td>
				</tr>
				<tr>
					<td height="40">
						<label id="usernamemsg" for="username">
							<?php echo JText::_( 'USERNAME' ); ?>:
						</label>
					</td>
					<td>
						<input type="text" id="username" name="username" size="40" value="" class="inputbox required validate-username" maxlength="25" /> *
					</td>
				</tr>
				<tr>
					<td height="40">
						<label id="emailmsg" for="email">
							<?php echo JText::_( 'EMAIL' ); ?>:
						</label>
					</td>
					<td>
						<input type="text" id="email" name="email" size="40" value="" class="inputbox required validate-email" maxlength="100" /> *
					</td>
				</tr>
				<tr>
					<td height="40">
						<label id="pwmsg" for="password">
							<?php echo JText::_( 'PASSWORD' ); ?>:
						</label>
					</td>
				  	<td>
				  		<input class="inputbox required validate-password" type="password" id="password" name="password" size="40" value="" /> *
				  	</td>
				</tr>
				<tr>
					<td height="40">
						<label id="pw2msg" for="password2">
							<?php echo JText::_( 'VERIFY_PASSWORD' ); ?>:
						</label>
					</td>
					<td>
						<input class="inputbox required validate-passverify" type="password" id="password2" name="password2" size="40" value="" /> *
					</td>
				</tr>
				<tr>
					<td colspan="2" height="40">
						<p class="information_td"><?php echo JText::_( 'REGISTER_REQUIRED' ); ?></p>
					</td>
				</tr>
				</table>
					<p class="form_buttons"><span class="btn"><button class="button validate" type="submit"><?php echo JText::_('REGISTER'); ?></button></span></p>
					<input type="hidden" name="task" value="register_save" />
					<input type="hidden" name="id" value="0" />
					<input type="hidden" name="gid" value="0" />
					<?php echo JHTML::_( 'form.token' ); ?>
				</form>
			</div>
        </div>
        <div class="gkp_mr"></div>
        <div class="gkp_bl"></div>
        <div class="gkp_b"></div>
        <div class="gkp_br"></div>
  	</div>
</div>		
<?php endif; ?>		