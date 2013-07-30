<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<?php if($type == 'logout') : ?>

<form action="index.php" method="post" name="login" id="form-login">
      <div class="logout form_buttons">
      		<?php if ($params->get('greeting')) : ?>
	        <span><?php echo JText::sprintf( 'HINAME', $user->get('name') ); ?></span>
            <?php endif; ?>
            <span class="btn"><input type="submit" name="Submit" class="button" value="<?php echo JText::_( 'BUTTON_LOGOUT'); ?>" /></span>
      </div>
      <input type="hidden" name="option" value="com_user" />
      <input type="hidden" name="task" value="logout" />
      <input type="hidden" name="return" value="<?php echo $return; ?>" />
</form>
<?php else : ?>
<?php if(JPluginHelper::isEnabled('authentication', 'openid')) : ?>
<?php JHTML::_('script', 'openid.js'); ?>
<?php endif; ?>
<form action="<?php echo JRoute::_( 'index.php', true, $params->get('usesecure')); ?>" method="post" name="form-login" id="form-login" >
      <?php echo $params->get('pretext'); ?>
      <ul class="loginposition">
            <li id="form-login-login">
                  <label for="modlgn_username"><?php echo JText::_('Username') ?></label>
                  <input id="modlgn_username" type="text" name="username" class="inputbox" alt="username" size="15" />
            </li>
            <li id="form-login-pass">
                  <label for="modlgn_passwd"><?php echo JText::_('Password') ?></label>
                  <input id="modlgn_passwd" type="password" name="passwd" class="inputbox" size="15" alt="password" />
            </li>
            <li id="form-login-button" class="form_buttons">
                  <span class="btn"><input type="submit" name="Submit" class="button" value="<?php echo JText::_('LOGIN') ?>" /></span>
            </li>
      </ul>
	  <ul class="loginposition clearfix">      
            <li id="form-login-remember">
                  <?php if(JPluginHelper::isEnabled('system', 'remember')) : ?>
                  <input id="modlgn_remember" type="radio" name="remember" class="inputbox" value="yes" alt="Remember Me" />
                  <label for="modlgn_remember"><?php echo JText::_('Remember me') ?></label>
                  <?php endif; ?>
            </li>
            <li id="form-login-fpass">
                  <a href="<?php echo JRoute::_( 'index.php?option=com_user&view=reset' ); ?>">
                  <?php echo JText::_('FORGOT_YOUR_PASSWORD'); ?></a>
            </li>
            <li id="form-login-flogin">  <a href="<?php echo JRoute::_( 'index.php?option=com_user&view=remind' ); ?>">
                        <?php echo JText::_('FORGOT_YOUR_USERNAME'); ?></a></li>
            <?php
		$usersConfig = &JComponentHelper::getParams( 'com_users' );
		if ($usersConfig->get('allowUserRegistration')) : ?>
            <li id="form-login-register">
                  <a href="<?php echo JRoute::_( 'index.php?option=com_user&task=register' ); ?>">
                  <?php echo JText::_('REGISTER'); ?></a>
            </li>
            <?php endif; ?>
      </ul>
      <?php echo $params->get('posttext'); ?>
      <input type="hidden" name="option" value="com_user" />
      <input type="hidden" name="task" value="login" />
      <input type="hidden" name="return" value="<?php echo $return; ?>" />
      <?php echo JHTML::_( 'form.token' ); ?>
</form>
<?php endif; ?>
<div class="clearfix"></div>