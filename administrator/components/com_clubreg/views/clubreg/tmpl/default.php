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

?>
<style>
<!--
div.row-fluid{
line-height:24px;
}
-->
</style>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	
	<div id="j-main-container" class="span10">		
		<div class="well">
		<img src="<?php echo str_replace("administrator/", "", JURI::base()).CLUBREG_ASSETS; ?>/images/clublogo.png" width=256  class="pull-right"/>
		<h1>ClubReg Component for Joomla 3.0</h1>
		<h2>Thank you for choosing to install this component</h2>
		<div class="">
		# Author: Omokhoa Agbagbara<br />
		# Copyright: (C) 2013 applications.deltastateonline.com. All Rights Reserved.<br />
		# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL<br />
		# Website:- <a href="http://app.deltastateonline.com">http://app.deltastateonline.com</a><br />
		# Technical Support:  email - <a mailto="joomla@deltastateonline.com">joomla@deltastateonline.com</a><br />
		# Demo:  <a href="http://demo3.deltastateonline.com">http://demo3.deltastateonline.com</a><br />
		# Twitter: <a href="https://twitter.com/ejiroesiri">@ejiroesiri</a><br />
		# Video tutorials : <a href="http://screencast-o-matic.com/channels/c2XY0kipr" target="_blank">Video tutorials</a>
		
		</div>
		</div>
		<div class="row-fluid">
		<div class="span8 row-striped">		
			<div class="row-fluid">The Club Registration Component is an extension for Joomla 3.0. it can be used to manage almost any social/sporting club or group 
				which has team leaders(Coaches, Officials) , Team members (assistants) and club members (players, swimmers, driver, paying members etc).</div>
			<div class="row-fluid">The Team Leader and Team members are  made up of registered users of the joomla installation. These users have to be linked to this component for them to manage players within Clubreg</div>
			<div class="row-fluid">ClubReg uses a configurable list of form controls, to collect and render the details about <strong>Coaches , Assistants and Club Officials</strong>. These details can be updated by either the site administrator or the Club officials themselves</div>		
			<div class="row-fluid">ClubReg allows the club to take expression of interest from the public regarding joining the various groups or divisions within the club. These EOIs can then be converted into registered members or discarded.</div>
			<div class="row-fluid"><h3 class="alert alert-info">This Update. 3.0.16 - Attendance Feature</h3>
				<ol>
					<li>
						<p><b><a href="http://app.deltastateonline.com/index.php/2-site-frontpage/30-attendance-feature">Attendance Feature.</a></b> Ditch the use of paper to keep track of who attended training or a game.<p>
							This feature is simple to use. Select the date, and then select <div class="btn-group">	
			  				<a class="btn btn-mini btn-stats-btn" href="javascript:void(0);">Yes</a>
			  				<a class="btn btn-mini btn-stats-btn" href="javascript:void(0);">No</a>
			  			</div>. Thats is it.
			  			<div class="clearfix"></div>
					</li>
					<li>
						Add configuration setting which enables the listing of birthdays and most recent registrations with profile pictures, rather than the default listing.
						<ol>
							<li><a href="http://app.deltastateonline.com/index.php/2-site-frontpage/29-recent-registrations-2">Recent Registrations with Profile Pixs</a></li>
							<li><a href="http://app.deltastateonline.com/index.php/2-site-frontpage/20-recent-registrations">Recent Registrations with simple list.</a></li>
						</ol>
						<h3>Setup</h3>
						<ol>
							<li>Select the System Menu option on the admin menu bar.</li>
							<li>Select the Club Registions Manager, menu option from the side menu.</li>
							<li>Make a selection from the Render New Members item.</li>
							<li>Save then preview in extension.</li>						
						</ol>
						
					</li>
					<li>Styling change to the manage registered players page.</li>
					<li>Using more Jquery than mootools</li>
					
				<ol>			
			</div>	
			
			<div class="row-fluid"><h3 class="alert alert-info">Update. 3.0.15</h3>
				<ol>
					<li><p>Add a <b>Batch Update</b> function, which allows club officials to update multiple properties of more than one club member in a single operation.</p>
						<p>For example at the end of the year, if the club officials wanted to promote some club members from Under 7 to Unde 8 then the batch update function can be used. See site for demo</p>
					</li>
					
				<ol>			
			</div>	
			
			<div class="row-fluid"><h3 class="alert alert-info">Update. 3.0.13</h3>
				<ol>
					<li>Add a communication manager, which allows club officials to send communication {emails and sms} to club members.<br />
						<p>To use the sms function , you must signup to a bulk sms provider in your country, which supports the use of email to sms.<br />
						In most cases they would ask you to simply append a suffix to the the phone number.						
						</p>
						<p>So for example if you are in australia and you registered with a company called <a href="www.messagemedia.com.au" target="_blank">messagemedia.com.au</a>
							They would require that all sms to be sent have "@messagemedia.com.au" appended to them.
						</p>
						<p>Also the phone numbers have to be a valid phone number</p>
					</li>
					<li>Minor styling changes</li>
				<ol>			
			</div>			
			<div class="row-fluid"><h3 class="alert alert-info">Update. 3.0.12.</h3>
				<ol>
					<li>Add option to render eoi using tables as well as using bootstrap divs, because some joomla templates do not include bootstrap. This option can now be set on a per menu basis.</li>
				<ol>
			
			</div>
			<div class="row-fluid"><h3 class="alert alert-info">Key Features.</h3>
					<ul>
						<li>Accept Expression of interest for Junior or Senior Players</li>
						<li>Convert or Register EOIs to registered Players</li>
						<li><strong>Manage Registerd Players inlucding</strong>
						<ol>
							<li>Export a list of players</li>
							<li>Delete players</li>
							<li>Add New Players, Edit Player details</li>
							<li>Attach a guardian to a junior player</li>
							<li>Add notes to players, and mark these notes as private.</li>
							<li>Add Details about next of kin or emergency contacts</li>
							<li>Add extra configurable details</li>
							<li>Add simple payment details</li>
							<li>Add attachments to players and mark them as private.</li>
							<li>Add simple property details, to keep track of what items have been given to players</li>
						</ol>
						</li>
					</ul>			
			</div>
			<div class="row-fluid"><h3 class="alert alert-info">Getting Started.</h3>
					<ol>
						<li>Link System users to <?php echo JText::_('COM_CLUBREG3') ?> component.</li>
						<li>Grant Users permission to manage individual features.</li>
						<li>Add <?php echo JText::_('COM_CLUBREG_GROUPN_LABEL') ?> and <?php echo JText::_('COM_CLUBREG_SUBGROUPN_LABEL') ?> then  assign team members to groups</li>
						<li>Add <?php echo JText::_('COM_CLUBREG3') ?> menu option</li>
						<li>Customize your installation, using the Global Configuration menu.  Add or remove tabs, Change position of tab etc </li>
					
					</ol>
			</div>
		</div>
		</div>
</div>