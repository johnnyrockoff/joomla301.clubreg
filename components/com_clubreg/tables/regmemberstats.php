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

class ClubregTableRegmemberstats extends JTable{

	
	public function __construct(&$_db)
	{
		
		parent::__construct(CLUB_STATS_TABLE, array('member_id','stats_date','stats_detail'), $_db);		
		JTableObserverAudit::createObserver($this, array('typeAlias' => 'com_clubreg.regmemberstats'));
	}
}