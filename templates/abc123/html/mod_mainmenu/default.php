<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

//
if ( ! defined('modMainMenuXMLCallbackDefined') )
{
	//
	function modMainMenuXMLCallback(&$node, $args)
	{
		//
		$user	= &JFactory::getUser();
		$menu	= &JSite::getMenu();
		$active	= $menu->getActive();
		$path	= isset($active) ? array_reverse($active->tree) : null;
		//
		if (($args['end']) && ($node->attributes('level') >= $args['end']))
		{
			//
			$children = &$node->children();
			//
			foreach ($node->children() as $child)
			{
				//
				if ($child->name() == 'ul') 
				{
					//
					$node->removeChild($child);
				}
			}
		}
		//
		if ($node->name() == 'ul') 
		{
			//
			foreach ($node->children() as $child)
			{
				//
				if ($child->attributes('access') > $user->get('aid', 0)) 
				{
					//
					$node->removeChild($child);
				}
			}
		}
		//
		if($node->attributes('level') == 1) 
		{	
			//
			if ($node->attributes('class')) 
			{
				//
				$node->addAttribute('class', $node->attributes('class').' level1');
			} 
			else //
			{
				//
				$node->addAttribute('class', 'level1');
			}
		}
		//
		if($node->name() == 'li')
		{
			//
			$children = $node->children();
			//
			if ($node->attributes('level') == 1) 
			{
			
				if(isset($children[1]) && $children[1]->name() == 'ul')
				{
					//
					if($node->attributes('class'))
					{
						//
						$node->addAttribute('class', $node->attributes('class').' topli');
					}
					else //
					{
						//
						$node->addAttribute('class', ' topli');
					}
				}
				//
				if ($children[0]->name() == 'a') 
				{
					//
					if($node->attributes('class'))
					{
						//
						$children[0]->addAttribute('class', $node->attributes('class').' topdaddy');
					}
					else //
					{
						//
						$children[0]->addAttribute('class', 'topdaddy');
					}
				}
			} 	
		}
		//
		if (isset($path) && in_array($node->attributes('id'), $path))
		{
			//
			if ($node->attributes('class')) 
			{
				//
				$node->addAttribute('class', $node->attributes('class').' active');
				$childs = $node->children();
				if(isset($childs[0])) $childs[0]->addAttribute('class', $childs[0]->attributes('class').' active');
			} 
			else //
			{
				//
				$node->addAttribute('class', 'active');
				$childs = $node->children();
				if(isset($childs[0])) $childs[0]->addAttribute('class', $childs[0]->attributes('class').' active');
			}
		}
		else //
		{
			//
			if (isset($args['children']) && !$args['children'])
			{
				//
				$children = $node->children();
				//
				foreach ($node->children() as $child)
				{
					//
					if ($child->name() == 'ul') {
						//
						$node->removeChild($child);
					}
				}
			}
		}
		//
		if (isset($path) && $node->attributes('id') == $path[0]) 
		{
			//
			$node->addAttribute('class', $node->attributes('class').' current');
			$node->removeAttribute('id');
		} 
		else //
		{
			//
			$node->removeAttribute('id');
		}
		//
		$node->removeAttribute('level');
		//
		$node->removeAttribute('access');
	}
	//
	define('modMainMenuXMLCallbackDefined', true);
}
//
modMainMenuHelper::render($params, 'modMainMenuXMLCallback');