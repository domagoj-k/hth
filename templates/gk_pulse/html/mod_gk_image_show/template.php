<?php

/**
* Gavick Image Show - Template style
* @package Joomla!
* @Copyright (C) 2009 Gavick.com
* @ All rights reserved
* @ Joomla! is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 1.0.0 $
**/

// access restriction
defined('_JEXEC') or die('Restricted access');

require(JModuleHelper::getLayoutPath('mod_gk_image_show', 'class'));			

////////////////////////////////////////////////////////////
//
// Generating module code
//
////////////////////////////////////////////////////////////

$newModuleObject = new GKImageShowTemplate( 
							$this->module_id, 
							$this->settings,
							$this->base_path, 
							$this->group_settings, 
							$this->slide_data 
						); 

$dataForJSEngine = $newModuleObject->returnJSData();

// create instances of basic Joomla! classes
$document =& JFactory::getDocument();
$uri =& JURI::getInstance();
// init $headData variable
$headData = false;
// add scripts with automatic mode to document header
if($this->useMoo == 2)
{
	// getting module head section datas
	unset($headData);
	$headData = $document->getHeadData();
	// generate keys of script section
	$headData_keys = array_keys($headData["scripts"]);
	// set variable for false
	$mootools_founded = false;
	// searching phrase mootools in scripts paths
	for($i = 0;$i < count($headData_keys); $i++)
	{
		if(preg_match('/mootools/i', $headData_keys[$i]))
		{
			// if founded set variable to true and break loop
			$mootools_founded = true;
			break;
		}
	}
	// if mootools file doesn't exists in document head section
	if(!$mootools_founded)
	{
		// add new script tag connected with mootools from module
		$headData["scripts"][$uri->root().'templates/gk_pulse/lib/scripts/mootools.js'] = "text/javascript";
		// if added mootools from module then this operation have sense
		$document->setHeadData($headData);
	}
}
//
if($this->useScript == 2)
{
	// getting module head section datas
	unset($headData);
	$headData = $document->getHeadData();
	// generate keys of script section
	$headData_keys = array_keys($headData["scripts"]);
	// set variable for false
	$engine_founded = false;
	// searching phrase mootools in scripts paths
	if(array_search($uri->root().'templates/gk_pulse/lib/scripts/gk_image_show.js', $headData_keys) > 0)
	{
		// if founded set variable to true
		$engine_founded = true;
	}
	// if mootools file doesn't exists in document head section
	if(!$engine_founded)
	{
		// add new script tag connected with mootools from module
		$headData["scripts"][$uri->root().'templates/gk_pulse/lib/scripts/gk_image_show.js'] = "text/javascript";
		// if added mootools from module then this operation have sense
		$document->setHeadData($headData);
	}
}

require(JModuleHelper::getLayoutPath('mod_gk_image_show', 'default'));

?>