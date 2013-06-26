<?php
/*------------------------------------------------------------------------
# com_clubreg - Manage Club Member Registrations
# ------------------------------------------------------------------------
# author    Omokhoa Agbagbara
# copyright Copyright (C) 2012 applications.deltastateonline.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://applications.deltastateonline.com
# Technical Support:  email - joomla@deltastateonline.com
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

define('CLUB_MEMBERS_TABLE','#__clubreg_teammembers'); // Club Officials who are linked
define('CLUB_GROUPS_TABLE','#__clubreg_groups'); // club groups.
define('CLUB_MEMBERSGROUPS_TABLE','#__clubreg_teammembers_groups'); // Club Officials grouping table
define('CLUB_MEMBERSDETAILS_TABLE','#__clubreg_teammembers_details'); // key value pair table for Club Officials
define('CLUB_TEMPLATE_TABLE','#__clubreg_templates');  // the template table

define('CLUB_TEMPLATE_CONFIG_TABLE','#__simple_configs'); // configuration table
define('CLUB_CONFIG_TABLE','#__clubreg_configs'); // configuration table

define('DESIGNED_BY','deltastateonline.com');
define('OUR_WEBSITE','applications.deltastateonline.com');


define('CLUB_EOIMEMBERS_TABLE','#__clubreg_eoimembers'); // eoi members
define('CLUB_REGISTEREDMEMBERS_TABLE','#__clubreg_registeredmembers'); // registered members 

define('CLUB_AUDIT_TABLE','#__clubreg_details_audit'); // audit details  

define('CLUB_PAYMENTS_SETUP_TABLE','#__clubreg_payments_setup'); // payments setup details
define('CLUB_PAYMENTS_TABLE','#__clubreg_payments'); // payments details
define('CLUB_NOTES_TABLE','#__clubreg_notes'); // notes details

define('CLUB_TAG_TABLE','#__clubreg_tags'); // tag table
define('CLUB_TAGPLAYER_TABLE','#__clubreg_tags_players'); // player tag link

define('CLUB_SAVEDCOMMS_TABLE','#__clubreg_saved_comms'); // communication table
define('CLUB_CONTACT_TABLE','#__clubreg_contact_details'); // contact  table
define('CLUB_STATS_TABLE','#__clubreg_stats_details'); // Stats  table


define('GROUP','Division'); 
define('GROUPS','Divisions'); 

define('SUBGROUP','Sub-Division'); 
define('SUBGROUPS','Sub-Divisions'); 

define('SEASON','Season'); 
define('CURRENCY','$');
define('FACTOR',100);

define('TAGS','Keywords');
define('TAG','Keyword');

define('PLAYERS','Players');
define('PLAYER','Swimmers');

define('EMERGENCY','Emergency Contact');
define('GIVENNAME','Firstname');
define('NEXTOFKIN','Next of Kin');
define('STATS','Stats');
define('TOPMOST','TOPMOST');

/** 
 * 
 * config shorts
 */

define('CLUB_MEMBER_WHICH','club_official_details'); // the tag to extract config details
define('CLUB_PLAYER_LEVEL','club_player_level'); // the tag to extract config details
define('CLUB_GUARDIAN_WHICH','club_guardian_details');
define('CLUB_PLAYER_DETAILS','club_player_details');
define('CLUB_PLAYER_STATS','club_stats');
define('CLUB_GROUPTYPE','club_grouptype');

define('CLUB_JUNIORCOUNT',4);

define('CLUBREG_ADMINPATH',JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_clubreg'.DIRECTORY_SEPARATOR);

define('CLUBREG_COMPONENTS','components/com_clubreg/');
define('CLUBREG_ASSETS',CLUBREG_COMPONENTS.'assets');
define('CLUBREG_CONFIGS',CLUBREG_COMPONENTS.'helpers'.DIRECTORY_SEPARATOR.'configs'.DIRECTORY_SEPARATOR);

global $clubreg_params;
$clubreg_params["setting"]["control_width"]= array("label"=>"Inline Style");
$clubreg_params["setting"]["control_class"]= array("label"=>"CSS Style");
$clubreg_params["setting"]["default_value"]= array("label"=>"Default Value");
$clubreg_params["setting"]["control_type"]= array("label"=>"Input Type");
$clubreg_params["setting"]["sort_list_by"]= array("label"=>"Order List By");
$clubreg_params["setting"]["config_type"]= array("label"=>"Setting Type");
$clubreg_params["setting"]["is_email"]= array("label"=>"Email Validation");
$clubreg_params["setting"]["taxrate"]= array("label"=>"Tax Rate");
$clubreg_params["setting"]["assign_to"]= array("label"=>"Applies To");
$clubreg_params["payment"]["assign_to"]= array("label"=>"Applies To");

include_once("debugger.php");