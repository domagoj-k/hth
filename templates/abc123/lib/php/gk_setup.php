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
	// Adding MooTools 1.11 to template
	//JHTML::_('behavior.mootools');
	JHtml::_('behavior.framework');
	
	/*--------------------------------------------------------------
	#
	# Generating basic template variables
	#
	--------------------------------------------------------------*/	
	
	// setting variable for template base url
	$template_baseurl = $this->baseurl . '/templates/' . $this->template;	
	// getting information about basic template color
	$template_color = $this->params->get("template_color", 1);
	// getting theme
	$theme_color = $this->params->get('theme_color','dark');
	// getting information about login button
	$login_button = ($this->params->get("login_button", 1)  == 1) ? true : false;
	// getting information about stylearea
	$stylearea = ($this->params->get("stylearea", 1)  == 1) ? true : false;
	// getting information about register button
	$register_button = ($this->params->get("register_button", 1)  == 1) ? true : false;
	// getting information about logo
	$logo_as_image = ($this->params->get("logo_as_image", 1) == 1) ? true : false;
	// getting footer content
	$footer_content = $this->params->get("footer_content", "Template Design &copy; <a href=\"http://www.nrg-design.ru\" target=\"_blank\">Joomla Templates</a> | nrg-design.ru.  All rights reserved.");
	// getting menu
	$menu = & JSite::getMenu();
	// getting information about menu type
	$menu_type = $this->params->get("menutype", "standard");
	// getting information about frontpage
	$frontpage_i = ($this->params->get("frontpage", 1) == 1) ? false : ($menu->getActive() == $menu->getDefault());		
	// getting column position
	$column_position = $this->params->get("column_position", "right");
	// creating JURI instance	
	$url = clone(JURI::getInstance());		
	// getting User object and user ID 
	$user =& JFactory::getUser();
	// getting User ID
	$userID = $user->get('id');
	
	/*--------------------------------------------------------------
	#
	# Calculating dimensions
	#
	--------------------------------------------------------------*/

	$column_width = $this->params->get("column_width", 300);
	$mainbody_width = 980;
	
	//
	$bgsetup = '';
	//
	if(($this->countModules('left') && $column_position == 'left')){
		$bgsetup = ' style="background:transparent url(\'./templates/'.$this->template.'/images/style1/bg_l.png\') repeat-y '.($column_width-1000).'px 0;"';
	}
	//
	if(($this->countModules('right') && $column_position == 'right')){
		$bgsetup = ' style="background:transparent url(\'./templates/'.$this->template.'/images/style1/bg_r.png\') repeat-y '.(-($column_width+20)).'px 0;"';
	}
	
	/*--------------------------------------------------------------
	#
	# Generating user positions classes
	#
	--------------------------------------------------------------*/

	// empty variables for classes
	$user_position_1 = 'null';
	$user_position_2 = 'null';
	$user_position_3 = 'null';	
	$user_position_4 = 'null';	
	
	/**
	    $user_position_1
	**/

	// 33%
	if($this->countModules('user1 and user2 and user3'))
	{
		$user_position_1 = 'us_width-33 us_width';		
	}
	else if($this->countModules('user1 and user2') || $this->countModules('user1 and user3') || $this->countModules('user2 and user3'))
	{
		$user_position_1 = 'us_width-50 us_width';
	}	
	else
	{
		$user_position_1 = 'us_width-100';	
	}

	/**
	    $user_position_2
	**/	
	
	// 33%
	if($this->countModules('user4 and user5 and user6'))
	{
		$user_position_2 = 'us_width-33 us_width';		
	}
	else if($this->countModules('user4 and user5') || $this->countModules('user4 and user6') || $this->countModules('user5 and user6'))
	{
		$user_position_2 = 'us_width-50 us_width';
	}	
	else
	{
		$user_position_2 = 'us_width-100';	
	}
	
	/**
	    $user_position_3
	**/
	
	$sum_modules = 0;
	if($this->countModules('user7') > 0) $sum_modules += 1;
	if($this->countModules('user8') > 0) $sum_modules += 1;
	if($this->countModules('user9') > 0) $sum_modules += 1;
	if($this->countModules('user10') > 0) $sum_modules += 1;
	if($this->countModules('user11') > 0) $sum_modules += 1;
	
	if($sum_modules == 5) // 20%
	{
		$user_position_3 = 'us_width-20 us_width';
	}
	else if($sum_modules == 4) // 25%
	{
		$user_position_3 = 'us_width-25 us_width';
	}
	else if($sum_modules == 3) // 33%
	{
		$user_position_3 = 'us_width-33 us_width';	
	}
	else if($sum_modules == 2) // 50%
	{
		$user_position_3 = 'us_width-50 us_width';
	}
	else // 100%
	{
		$user_position_3 = 'us_width-100';	
	}
	
	/**
	    $user_position_4
	**/
	
	$sum_modules = 0;
	if($this->countModules('user12') > 0) $sum_modules += 1;
	if($this->countModules('user13') > 0) $sum_modules += 1;
	if($this->countModules('user14') > 0) $sum_modules += 1;
	if($this->countModules('user15') > 0) $sum_modules += 1;
	if($this->countModules('user16') > 0) $sum_modules += 1;
	if($this->countModules('user17') > 0) $sum_modules += 1;
	
    if($sum_modules == 6) // 16%
	{
		$user_position_4 = 'us_width-16 us_width';
	}
	else if($sum_modules == 5) // 20%
	{
		$user_position_4 = 'us_width-20 us_width';
	}
	else if($sum_modules == 4) // 25%
	{
		$user_position_4 = 'us_width-25 us_width';
	}
	else if($sum_modules == 3) // 33%
	{
		$user_position_4 = 'us_width-33 us_width';	
	}
	else if($sum_modules == 2) // 50%
	{
		$user_position_4 = 'us_width-50 us_width';
	}
	else // 100%
	{
		$user_position_4 = 'us_width-100';	
	}

?>
