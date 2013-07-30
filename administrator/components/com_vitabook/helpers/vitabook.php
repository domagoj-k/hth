<?php
/**
 * @version     2.1.3
 * @package     com_vitabook
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      JoomVita - http://www.joomvita.com
 */

// No direct access
defined('_JEXEC') or die;

//Import filesystem libraries.
jimport('joomla.filesystem.file');

/**
 * Vitabook helper.
 */
abstract class VitabookHelper
{
    /**
     * Configure the Linkbar.
     * For Joomla > 3.0
     */
    public static function addSubmenu($vName = '')
    {
        $user = JFactory::getUser();
        $params = JComponentHelper::getParams('com_vitabook');        
        $avatar = $params->get('vbAvatar');

        JHtmlSidebar::addEntry(
            JText::_('COM_VITABOOK_MESSAGES_TITLE'),
            'index.php?option=com_vitabook&view=messages',
            $vName == 'messages'
        );

        if($user->authorise('core.admin', 'com_vitabook'))
        {
            JHtmlSidebar::addEntry(
                JText::_('COM_VITABOOK_IMPORT_TITLE'),
                'index.php?option=com_vitabook&view=import',
                $vName == 'import'
            );
        }

        //-- If VitaBook avatar system is used we need to add a submenu item for avatar management
        if($avatar == 1 && ($user->authorise('core.edit', 'com_vitabook') || $user->authorise('core.delete', 'com_vitabook')))
        {
            JHtmlSidebar::addEntry(
                JText::_('COM_VITABOOK_AVATARS_TITLE'),
                'index.php?option=com_vitabook&view=avatars',
                $vName == 'avatars'
            );
        }
    }

    /**
     * Configure the Linkbar.
     * For Joomla 2.5
     */
    public static function addSubmenuLegacy($vName = '')
    {
        $user = JFactory::getUser();
        $params = JComponentHelper::getParams('com_vitabook');        
        $avatar = $params->get('vbAvatar');

        JSubMenuHelper::addEntry(JText::_('COM_VITABOOK_MESSAGES_TITLE'), 'index.php?option=com_vitabook&view=messages', $vName == 'messages');

        if($user->authorise('core.admin', 'com_vitabook'))
        {
            JSubMenuHelper::addEntry(JText::_('COM_VITABOOK_IMPORT_TITLE'), 'index.php?option=com_vitabook&view=import', $vName == 'import');
        }

        //-- If VitaBook avatar system is used we need to add a submenu item for avatar management
        if($avatar == 1 && ($user->authorise('core.edit', 'com_vitabook') || $user->authorise('core.delete', 'com_vitabook')))
        {
            JSubMenuHelper::addEntry(JText::_('COM_VITABOOK_AVATARS_TITLE'), 'index.php?option=com_vitabook&view=avatars', $vName == 'avatars');
        }
    }

   /**
    * Legacy method, was renamed to userActions() for readability purposes
    */
    public static function getActions()
    {
        return VitabookHelper::userActions();
    }

   /**
    * Method to determine the actions of a user can undertake within the component
    * @return array The actions a user can do
    */
    public static function userActions()
    {
        $user   = JFactory::getUser();
        $result = new JObject;

        $actions = array('core.admin', 'core.manage', 'vitabook.create.new', 'vitabook.create.reply', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete', 'vitabook.insert.image', 'vitabook.upload', 'vitabook.insert.video');

        // if user is guest and ip is blocked
        if($user->get('guest') && !VitabookHelper::checkIpBlock()){
            return $result;
        }
        
        foreach ($actions as $action){
            $result->set($action, $user->authorise($action, 'com_vitabook'));
        }
        
        return $result;
    }

   /**
    * Method to determine the actions of a user can do with a message
    * @return array The actions a user can do with this message
    */
    public static function messageActions($canDo,$message)
    {
        $params = JComponentHelper::getParams('com_vitabook');
        
        $actions = new stdClass();
        // edit
        // Check general edit permissions first
        if($canDo->get('core.edit')){
            $actions->edit = true;
        }
        // Fallback on edit.own
        elseif($canDo->get('core.edit.own')) {
            $actions->edit = VitabookHelper::messageEdit($message->jid,$message->date);
        }
        else {
            $actions->edit = false;
        }

       // (un)publish
        if($canDo->get('core.edit.state')){
            $actions->state = true;
        }
        else{
            $actions->state = false;
        }

       // delete
        if($canDo->get('core.delete')){
            $actions->delete = true;
        }
        else{
            $actions->delete = false;
        }
       // reply
        if($canDo->get('vitabook.create.reply') && $message->level < $params->get('max_level')){
            $actions->reply = VitabookHelper::messageReply($message->date);
        }
        else{
            $actions->reply = false;
        }
       
       // ipblock
        if($canDo->get('core.manage')){
            $actions->manage = true;
        } else {
            $actions->manage = false;
        }
        
        return $actions;
    }

   /**
    * Method to determine if a user can edit its own message
    * @return true or false
    */
    public static function messageEdit($ownerId, $messageDate)
    {
        $user = JFactory::getUser();

        if($user->get('id') == $ownerId && !$user->get('guest'))
        {
            // Keep maximum time for edit.own in mind. 0 is always edit own
            // Convert minutes to seconds
            $params = JComponentHelper::getParams('com_vitabook');
            $maxTime = $params->get('max_edit_time') * 60;

            if($maxTime != 0 && (time() - strtotime($messageDate)) < $maxTime) {
                return true;
            } elseif($maxTime == 0) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

   /**
    * Method to determine if replies to message are allowed
    * @return true or false
    */
    public static function messageReply($messageDate)
    {
        // Keep maximum time for replies in mind. When 0, replies are always allowed
        // Convert days to seconds
        $params = JComponentHelper::getParams('com_vitabook');
        $maxTime = $params->get('max_reply_time') * 24 * 60 * 60;
        if($maxTime != 0 && (time() - strtotime($messageDate)) < $maxTime) 
        {
            return true;
        } elseif($maxTime == 0) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Method to format the date displayed
     * @input message object
     * @output string Date
     */
    public static function formatDate(&$message)
    {
        // Get date format from parameters, LC2 is the standard
        $date_format = JComponentHelper::getParams('com_vitabook')->get('vb_date_format','DATE_FORMAT_LC2');
        if($date_format == 'relative'):
            $date = JHtml::_('date.relative',$message->date);
        else:
            $date = JHTML::_('date', $message->date, $date_format);
        endif;
   
        return $date;
    }

   /*
    * Check for sufficient memory for resizing image
    * Input is JImage object
    */
    public static function checkMemory($image)
    {
        if((function_exists('memory_get_usage')) && (ini_get('memory_limit')))
        {
            $imageInfo = getimagesize($image->getPath());
            $jpgpic = false;

            switch (JImage::getImageFileProperties($image->getPath())->mime)
            {
                case 'image/gif':
                    $channel  = 1;
                    break;
                case 'image/png':
                    $channel  = 3;
                    break;
                case 'image/x-png':
                    $channel  = 3;
                    break;
                case 'image/jpeg':
                    $channel  = $imageInfo['channels'];
                    break;
                case 'image/pjpeg':
                    $channel  = $imageInfo['channels'];
                    break;
            }

            $MB = 1048576;
            $K64 = 65536;
            $corrfactor = 1.8;

            $memoryNeeded = round(($imageInfo[0]
                                * $imageInfo[1]
                                * $imageInfo['bits']
                                * $channel / 8
                                + $K64)
                                * $corrfactor);

            $memoryNeeded = memory_get_usage() + $memoryNeeded;
            // Get memory limit
            $memory_limit = @ini_get('memory_limit');
            if(!empty($memory_limit) && $memory_limit != 0) {
                $memory_limit = substr($memory_limit, 0, -1) * 1024 * 1024;
            }

            if($memory_limit != 0 && $memoryNeeded > $memory_limit) {
                return false;
            }
        }
        return true;
    }

    /**
     * Method to check if the ip address of the user is blocked
     * @input string ip-address
     * @output false when listed, true if not 
     */    
    public static function checkIpBlock($ip = 'default')
    {
        if($ip == 'default'){
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        
        // Get blocked ips
        $ips = JComponentHelper::getParams('com_vitabook')->get('ipblock','');
        $blocked_ips = array_map('trim', explode(',', $ips));
        
        // if blocklist is empty
        if(!$ips || $ips == '' || empty($ips)) {
            return true;
        }
        
        foreach($blocked_ips as $blocked_ip)
        {
            $ip_regexp = str_replace('x', '..?.?', preg_quote($blocked_ip));

            if(preg_match('@'.$ip_regexp.'@', $ip)) {
                return false;
            }
        }
        return true;
    }

    /*
     * Get parameters from component in object class
     */
    public function getParams($option = 'com_vitabook')
    {
        // get existing values
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('params');
        $query->from('#__extensions');
        $query->where($db->quoteName('name') . ' = ' . $db->quote($option));
        $db->setQuery($query);
        $params = $db->loadResult();

        return $params = json_decode($params);
    }
    
    /*
     * Set parameters from component as json object
     */
    public function setParams($params, $option = 'com_vitabook')
    {
        $params = json_encode($params);
        
        // Set new parameters
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->update($db->quoteName('#__extensions'));
        $query->set($db->quoteName('params') . ' = ' . $db->quote($params));
        $query->where($db->quoteName('name') . ' = ' . $db->quote($option));
        $db->setQuery($query);
        if(!$db->query()) {
            return false;
        }
        return true;
    }
    
	/**
	 * Build an array of activate states to be used by jgrid.state,
	 *
	 * @return  array  a list of possible states to display
	 *
	 * @since  3.0
	 */
	public static function activatedStates()
	{
		$states = array(
			0	=> array(
				'task'				=> 'activate',
				'text'				=> '',
				'active_title'		=> 'COM_VITABOOK_MESSAGES_ACTIVATE',
				'inactive_title'	=> '',
				'tip'				=> true,
				'active_class'		=> 'unpublish',
				'inactive_class'	=> 'unpublish'
			),
			1	=> array(
				'task'				=> 'deactivate',
				'text'				=> '',
				'active_title'		=> 'COM_VITABOOK_MESSAGES_DEACTIVATE',
				'inactive_title'	=> '',
				'tip'				=> true,
				'active_class'		=> 'publish',
				'inactive_class'	=> 'publish'
			)
		);
		return $states;
	}
}
