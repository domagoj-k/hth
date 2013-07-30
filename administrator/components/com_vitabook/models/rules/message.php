<?php
/**
 * @version     2.1.3
 * @package     com_vitabook
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @author      JoomVita - http://www.joomvita.com
 */
 
defined('JPATH_PLATFORM') or die;
 
/**
 * Form Rule class for the Joomla Platform.
 *
 * @package     Joomla.Platform
 * @subpackage  Form
 * @since       11.1
 */
class JFormRuleMessage extends JFormRule
{

    /**
     * Method to test message for maximum number of chars.
     *
     * @param   JXMLElement  &$element  The JXMLElement object representing the <field /> tag for the form field object.
     * @param   mixed        $value     The form field value to validate.
     * @param   string       $group     The field name group control value. This acts as as an array container for the field.
     *                                   For example if the field has name="foo" and the group value is set to "bar" then the
     *                                   full field name would end up being "bar[foo]".
     * @param   JRegistry    &$input    An optional JRegistry object with the entire data set to validate against the entire form.
     * @param   object       &$form     The form object for which the field is being tested.
     *
     * @return  boolean  True if the value is valid, false otherwise.
     *
     * @since   11.1
     * @throws  JException on invalid rule.
     */
    public function test(&$element, $value, $group = null, &$input = null, &$form = null)
    {
        if($max_chars = JComponentHelper::getParams('com_vitabook')->get('editor_maxchars'))
        {
            $value = strip_tags($value);
            if(strlen($value) > $max_chars)
            {
                return false;
            }
        }

        return true;
    }
}
