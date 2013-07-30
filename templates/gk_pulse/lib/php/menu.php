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
	// Getting document handler
	$document = &JFactory::getDocument();
	// Loading module renderer
	$renderer = $document->loadRenderer( 'module' );
	// Setting rendering as RAW
	$options = array( 'style' => "raw" );
	// Getting mod_mainmenu module
	$module	 = JModuleHelper::getModule( 'mod_mainmenu' );
	// initializing empty variable 
	$main_navigation = false;
	// Getting menu name from params
	$menu_name = $this->params->get("menuname", "mainmenu"); 
	// Getting menu type from params
	$mtype = $this->params->get("menutype", "moomenu");
	// If menu setted as moomenu or suckerfish
	if($mtype == "moomenu" or $mtype == "suckerfish")
	{ 	
		// render module with showing submenus
		$module->params	= "menutype=$menu_name\nshowAllChildren=1";
	}
	else // if menu is not setted as moomenu or suckerish menu
	{
		// render module without showing submenus
		$module->params	= "menutype=$menu_name\nshowAllChildren=0";
	}
	// saving results of rendering module in variable
	$main_navigation = $renderer->render( $module, $options );

?>