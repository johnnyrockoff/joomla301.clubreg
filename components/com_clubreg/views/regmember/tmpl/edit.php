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

JHtml::_('behavior.framework',true);
JHtml::_('behavior.keepalive');

jimport('joomla.html.html.bootstrap');
JHtml::_('behavior.formvalidation');
JHTML::_('behavior.calendar');
JHtml::_('behavior.tooltip');
//JHtml::_('formbehavior.chosen', 'select');

global $clubreg_Itemid;
$in_type = "hidden";

if($this->tmpl == "html"){
	$this->pageTitle = JText::_('CLUBREG_EDIT_PROFILE');
	ClubregHelper::writePageHeader($this->pageTitle);
	$div_class = "tab-divs";
}else{	
	$div_class= "";
}
$playertype = $this->regmemberForm->getField("playertype")->value;
$session = JFactory::getSession();
$back_url = $session->get("com_clubreg.back_url");// save the back url
?>
<script type="text/javascript">
	var token = '<?php echo JSession::getFormToken() ;?>';	
</script>
<div class="clugreg-div">
	<form action="<?php echo JRoute::_($this->formbaction)?> " method="post" name="adminForm_" id="edit-form" class="form-validate">	
		
		<div class="row-fluid <?php echo $div_class?>">	
			<div class="row-fluid">
			<?php			
				$this->fieldSets = $this->regmemberForm->getFieldsets();	
				$current_sets = "playerDetails";				
				ClubRegHelper::writeFieldText($fieldSets[$current_sets]->description,'first-fikkeld-div');		
				$emergencyAlreadyShown = TRUE;	
			?>
			<?php foreach($this->regmemberForm->getFieldset($current_sets) as $field): ?>				
					<div class="control-group span5"> 				
						<div class="control-label">
							<?php echo $field->label; ?>
						</div>				
						<div class="controls">
							<?php echo $field->input; ?>
						</div>
					</div>				
			<?php endforeach; ?>
			</div>			
			<?php echo $this->loadTemplate($playertype); ?>	
			<?php if($this->loademergecy){?>	
				<div style="padding-left:10px;"><?php echo $this->loadTemplate("emergency"); ?></div>
			<?php } ?>				
			<?php if($this->loadotherdetails){?>	
				<div style="padding-left:10px;"><?php echo $this->loadTemplate("otherdetails"); ?></div>
			<?php } ?>						
		</div>			
		<hr  class='profile-hr'/>	
		<?php 
			foreach($this->regmemberForm->getFieldset('hiddenControls') as $field){
				echo $field->input;
			}
			?>
			<input type="<?php echo $in_type; ?>" name="Itemid" value="<?php echo $clubreg_Itemid; ?>" />			
			<input type="<?php echo $in_type; ?>" name="option" value="com_clubreg" />
			<input type="<?php echo $in_type; ?>" name="task" value="regmember.savemember" />
			<input type="<?php echo $in_type; ?>" name="pk" value="<?php echo $this->member_key; ?>" />
			<?php echo JHtml::_('form.token'); ?>	
		<div id='loading-div'></div>	
		<div class="form-actions " style="padding:10px;">		
			<button class="btn btn-primary" type="submit">
				<?php echo JText::_('JSUBMIT'); ?>
			</button>
			<?php if($this->tmpl == "html"){?>
			<button class="btn" onclick="return adminForm_back.submit();" type="button" id="back-to-profile">
				<?php echo JText::_('COM_CLUBREG_BACK_PROFILE'); ?>
			</button>
			
			<button class="btn" onclick="return adminForm_back_list.submit();" type="button" id="back-to-list">
				<?php echo JText::_('COM_CLUBREG_BACK_LIST'); ?>
			</button>
			<?php }else{ ?>				
				<button type="button" class="btn" id="toggle-children-div"><?php echo JText::_('JCANCEL'); ?></button>	
			<?php } ?>
		</div>
		
	</form>

	<?php if($this->tmpl == "html"){?>
	<form action="<?php echo JRoute::_($this->formbaction)?>" method="post" name="adminForm_back" id="adminForm_back">		
		<input type="<?php echo $in_type; ?>" name="layout" value="viewonly" />
		<input type="<?php echo $in_type; ?>" name="Itemid" value="<?php echo $clubreg_Itemid; ?>" />
		<input type="<?php echo $in_type; ?>" name="pk" value="<?php echo $this->member_key; ?>" />		
		<?php echo JHtml::_('form.token'); ?>	
	</form>
	
	
	<form action="<?php echo JRoute::_($this->formbackaction); ?>" method="post" name="adminForm_back_list" id="adminForm_back_list">			
			<?php if(count($back_url) > 0){
					foreach($back_url as $akey=>$avalue){ ?>
						<input type="<?php echo $in_type; ?>" name="<?php echo $akey?>" value="<?php echo $avalue; ?>" />	
				<?php }
			} ?>
			<input type="<?php echo $in_type; ?>" name="Itemid" value="<?php echo $clubreg_Itemid; ?>" />	
			<input type="<?php echo $in_type; ?>" name="option" value="com_clubreg" />
			<input type="<?php echo $in_type; ?>" name="layout" value="renderregmembers" />
		</form>	
	
	
	<?php } ?>
</div>
<?php 
if($this->tmpl == "html"){
$document = JFactory::getDocument();
ClubregHelper::writeTabAssets($document, "common",array("css","js"));
ClubregHelper::writeTabAssets($document, "clubreggroups",array("js"));
ClubregHelper::writeTabAssets($document, "edit",array("css","js"));

ClubregHelper::write_footer(); 
} ?>