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
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.tooltip');
global $clubreg_Itemid;
$in_type = "hidden";?>
<style>
<!--
.form-horizontal .control-group {
    margin-bottom: 10px;
}
-->
</style>
<form action="index.php" method="post" name="ContactlistForm" id="contactlist-form" class="form-validate form-horizontal form-clubreg">
		<div class="fieldSetDiv"><?php echo JText::_('COM_CLUBREG_CONTACTLISTDETAILS');?></div>
		<div id="contactlistitems">
		<?php foreach($this->contactlistForm->getFieldset('contactlist') as $field){ ?>
			<div class="control-group">					
				<div class="control-label"><?php echo $field->label; ?></div>
				<div class="controls"><?php echo $field->input; ?></div>						
			</div>		
		<?php 		 				
		 }	
		 foreach($this->contactlistForm->getFieldset('hiddenControls') as $field){ 	
				echo $field->input; 				
		 }		
		 ?>
	<input type="<?php echo $in_type;?>" name="Itemid" value="<?php echo $clubreg_Itemid; ?>" />
	<input type="<?php echo $in_type;?>" name="option" value="com_clubreg" />
	<input type="<?php echo $in_type;?>" name="task" value="ajax.savecontactlist" />
	<?php echo JHtml::_('form.token'); ?>		
	<div class="clearfix" ></div>	
	</div>
		<div class="form-actions">			 
			<button type="submit" class="btn btn-primary validate"><span><?php echo JText::_('JSUBMIT'); ?></span></button>	
			<button type="button" class="btn" id="toggle-contactlist-div"><?php echo JText::_('JCANCEL'); ?></button>				
		</div>			
</form>