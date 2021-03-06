<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2013 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://applications.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/

defined('_JEXEC') or die;

/**
 * Build the route for the com_clubreg component
 *
 * @param	array	An array of URL arguments
 *
 * @return	array	The URL arguments to use to assemble the subsequent URL.
 */


function ClubregBuildRoute(&$query)
{
	global $clubreg_Itemid;
	$segments = array();

	// get a menu item based on Itemid or currently active
	$app	= JFactory::getApplication();
	$menu	= $app->getMenu();
	$params	= JComponentHelper::getParams('com_clubreg');
	$advanced = $params->get('sef_advanced_link', 0);	

	if (empty($query['Itemid'])) {
		$menuItem = $menu->getActive();
	} else {
		$menuItem = $menu->getItem($query['Itemid']);
		$clubreg_Itemid = $query['Itemid'];
	}	
	
	
	$mView	= (empty($query['view'])) ?$menuItem->query['view']:$query['view'];
	$mLayout	= (empty($query['layout'])) ?$menuItem->query['layout']:$query['layout'];
	$mId	= (empty($query['id'])) ?$menuItem->query['id']:$query['id'];
	$mresetpage = (empty($query['resetpage'])) ? $menuItem->query['resetpage']:$query['resetpage'];
	$mPlayertype = (empty($query['playertype'])) ?$menuItem->query['playertype']:$query['playertype'];
	
	$mFormat	= (empty($query['format'])) ?$menuItem->query['format']:$query['format'];
	$mTmpl	= (empty($query['tmpl'])) ?$menuItem->query['tmpl']:$query['tmpl'];	
	$mTmplId	= (empty($query['template_id'])) ?$menuItem->query['template_id']:$query['template_id'];	
	$mCommId	= (empty($query['comm_id'])) ?$menuItem->query['comm_id']:$query['comm_id'];
	
	if(isset($mView)){
		$segments[] = "view:".$mView;
		unset($query['view']);
	}
	if(isset($mId)){		
		$segments[] = "id:".$mId;
		unset($query['id']);
	}
	
	if(isset($mLayout)){		
		$segments[] = "layout:".$mLayout;
		unset($query['layout']);
	}
	
	if(isset($mresetpage)){
		$segments[] = "resetpage:reset";
		unset($query['resetpage']);
	}
	
	if(isset($mPlayertype)){
		$segments[] = "playertype:".$mPlayertype;
		unset($query['playertype']);
	}
	
	if(isset($mFormat)){
		$segments[] = "format:".$mFormat;
		unset($query['format']);
	}
	
	if(isset($mTmpl)){
		$segments[] = "tmpl:".$mTmpl;
		unset($query['tmpl']);
	}
	if(isset($mTmplId)){
		$segments[] = "template_id:".$mTmplId;
		unset($query['template_id']);
	}
	
	if(isset($mCommId)){
		$segments[] = "comm_id:".$mCommId;
		unset($query['comm_id']);
	}
	return $segments;
}
/**
 * Parse the segments of a URL.
 *
 * @param	array	The segments of the URL to parse.
 *
 * @return	array	The URL attributes to be used by the application.
 */
function ClubregParseRoute($segments)
{
	$vars = array();

	//Get the active menu item.
	$app	= JFactory::getApplication();
	$menu	= $app->getMenu();
	$item	= $menu->getActive();
	$params = JComponentHelper::getParams('com_clubreg');
	$advanced = $params->get('sef_advanced_link', 0);

	// Count route segments
	$count = count($segments);
	
	foreach($segments as $a_seg){
		$entities  = explode(":",$a_seg);
		if(count($entities) == 2 ){
			//list($key,$value) = explode(":",$a_seg);
			$vars[$entities[0]]	= $entities[1];
		}
		
	}
	
	return $vars;
}
