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
global $clubreg_Itemid;
?>
<script type="text/javascript">
	$$('.profile-attach-all').each(function(el) {
	    el.slide('hide');
	});
</script>
<?php 
if(count($this->attachments)>0){	
	$all_document_type = $all_document_list = array();
	
	
	foreach($this->attachments as $an_attachment){ 
		
		
		
		$fkey = $this->uKeyObject->constructKey($an_attachment->attachment_id,$an_attachment->attachment_key);
		$rel_string = json_encode(array('Itemid'=>$clubreg_Itemid,'attachment_key'=>$fkey));
		$all_attachment_type[$an_attachment->attachment_type] = $an_attachment->attachment_type_name;
		ob_start();
	?>
	<div class="row-fluid" id='attachment_div<?php echo $an_attachment->attachment_id?>'>
		<div class="pull-left"><a href="index.php?option=com_clubreg&Itemid=<?php echo $clubreg_Itemid  ?>&view=attachment&layout=view&tmpl=component&format=raw&attachment_key=<?php echo $fkey; ?>" target='_blank'><?php echo $an_attachment->attachment_fname;?></a></div>			
		<div class="pull-right" style="padding-left:5px"><a href="javascript:void(0);" class='profile-attach-delete' rel=<?php echo $rel_string; ?> ><img src="<?php echo CLUBREG_ASSETS; ?>/images/delete.png" /></a></div>
		<?php if($an_attachment->attachment_status == 1 ) {?>
		<div class="pull-right" style="padding-left:5px"><a href="javascript:void(0);" class='profile-attach-private' rel=<?php echo $rel_string; ?> ><img src="<?php echo CLUBREG_ASSETS; ?>/images/private.png" /></a></div>
		<?php  } ?>	
		<div class="pull-right" style="padding-right: 10px;font-size:0.8em"><p class="text-info small"><?php echo $an_attachment->created;?></p></div>
		<div class="pull-right profile-bold" style="padding-right: 10px;font-size:0.9em"><?php echo $an_attachment->name; ?></div>
			
		<div class="clearfix"></div>
		<div style="font-size:0.9em"><?php echo nl2br($an_attachment->attachment_notes); ?></div>	
		<div class="clearfix"></div>		
	</div>
<?php 
		$all_document_list[$an_attachment->attachment_type][] = ob_get_contents() ;
		ob_end_clean(); 
	}	
	
	foreach($all_attachment_type as $att_type => $att_name){
		$rel_string = json_encode(array('content_key'=>$att_type));
		$howmany = count($all_document_list[$att_type]);
		
		$hide_all_class = "";
		if($howmany >= ATTACHMENT_LIMIT){
			$hide_all_class = "profile-attach-all";
		}
		
		?>
		<div class="attach-new-div">
		<div class="attach-sub-head-div" ><?php echo $att_name ;?><a class="label label-info pull-right profile-attach-content-btn"  rel=<?php echo $rel_string; ?>><?php echo $howmany." ".JText::_(COM_CLUBREG_PROFILE_ATTACHMENTS); ?></a></div>
		<div class="<?php echo $hide_all_class; ?> attach-reg-well row-striped" id="profile-attach-<?php echo $att_type; ?>" >
			<?php 	echo implode("\n",$all_document_list[$att_type]); 	?>
		</div>		
		
		<div class="clearfix"></div>
		</div>
	<?php 
	}
}else{ 	echo ClubRegUnAuthHelper::noResults('COM_CLUBREG_PROFILE_ATTACHMENTS'); }