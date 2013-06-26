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

jimport( 'joomla.application.component.view');

class ClubRegViewAjax extends JViewLegacy
{

	
	function display($tpl = null)
	{	
		
		$app		= JFactory::getApplication();
		$user		= JFactory::getUser();
		
		$renderer =  $this->getLayout();
		$proceed = FALSE;
		
		if(method_exists($this, $renderer)){			
			$proceed =  $this->$renderer();			
		}	
		
		if($proceed){
			parent::display($tpl);
		}else{
			ClubRegUnAuthHelper::unAuthorised();
		}
	}
/**
 * 
 * @return boolean
 */
	
	private function apayment(){
		
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
		
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();
		$Itemid			= $app->input->post->get('Itemid');
		
		$proceed = FALSE;
		if($user->get('id') > 0){
			
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
			require_once CLUBREG_CONFIGS.'config.payments.php';
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.rendertables.payments.php';
			$this->uKeyObject = new ClubRegUniqueKeysHelper();
			$key_data = new stdClass();
					
			$this->member_key = $key_data->full_key = $app->input->post->getString('member_key', null);				
			$this->uKeyObject->deconstructKey($key_data);
			$this->member_id = $key_data->pk_id;			
			unset($key_data);
			
			$key_data = new stdClass();
			$key_data->full_key = $app->input->post->getString('payment_key', null);			
			$this->uKeyObject->deconstructKey($key_data);		
			
			unset($current_model);
				
			$current_model = JModelLegacy::getInstance('payments', 'ClubregModel', array('ignore_request' => true));
			
			$current_model->setState('com_clubreg.payments.full_key',$key_data->full_key); // use the key in the model
			$current_model->setState('com_clubreg.payments.payment_key',$key_data->string_key); // use the key in the model
			$current_model->setState('com_clubreg.payments.payment_id',$key_data->pk_id); // use the key in the model
			
			$this->items = $current_model->getPayments($user->get('id'),$this->member_id);
			
			$current_model->setState('com_clubreg.payments.full_key',NULL); // use the key in the model
			$current_model->setState('com_clubreg.payments.payment_key',NULL); // use the key in the model
			$current_model->setState('com_clubreg.payments.payment_id',NULL); // use the key in the model
				
			unset($key_data);
			unset($current_model);
			
			$configObj = new ClubRegPaymentsConfig();
			$paymentsConfigs =  $configObj->getConfig("payments"); // return headings and filters
				
				
			$tmp_filters["filter_heading"] = $paymentsConfigs["filters"];
			$tmp_filters["group_where"] = $paymentsConfigs["group_where"];
			$tmp_filters["headings"] = $paymentsConfigs["headings"];
			$tmp_filters["otherconfigs"] = $paymentsConfigs["otherconfigs"];
			$this->entity_filters = $tmp_filters;
			
			unset($configObj);
			unset($tmp_filters);		
			
			$proceed = TRUE;
		}		
		return $proceed;		
	}
	private function aemergency(){
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
		
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();
		$Itemid			= $app->input->post->get('Itemid');
		
		$proceed = FALSE;
		if($user->get('id') > 0){
		
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
		
			$proceed = TRUE;
			$key_data = new stdClass();
				
			$key_data->full_key = $app->input->post->getString('member_key', null);
			$this->uKeyObject = new ClubRegUniqueKeysHelper();
			$this->uKeyObject->deconstructKey($key_data);
				
			unset($currentModel);
			$currentModel = JModelLegacy::getInstance('emergency', 'ClubregModel', array('ignore_request' => false));
			$currentModel->setState('com_clubreg.emergency.member_id',$key_data->pk_id); // use the key in the model
			$currentModel->setState('com_clubreg.emergency.member_key',$key_data->full_key); // use the key in the model
				
			$this->emergencyForm = $currentModel->getForm();
		}
		
		return $proceed;
	}
	private function aother(){
		
	JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
	
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();
		$Itemid			= $app->input->post->get('Itemid');
	
		$proceed = FALSE;
		if($user->get('id') > 0){
	
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
	
			$proceed = TRUE;
			$key_data = new stdClass();
				
			$key_data->full_key = $app->input->post->getString('member_key', null);
			$this->uKeyObject = new ClubRegUniqueKeysHelper();
			$this->uKeyObject->deconstructKey($key_data);
				
			unset($currentModel);
			$currentModel = JModelLegacy::getInstance('other', 'ClubregModel', array('ignore_request' => false));
			$currentModel->setState('com_clubreg.other.member_id',$key_data->pk_id); // use the key in the model
			$currentModel->setState('com_clubreg.other.member_key',$key_data->full_key); // use the key in the model
			
			require_once CLUBREG_ADMINPATH.'/helpers/clubregControls.php';
			require_once CLUBREG_ADMINPATH.'/helpers/clubregControlsReadonly.php';
			JForm::addFieldPath(CLUBREG_ADMINPATH.'/models/fields');
			$this->extradetails = ClubRegControlsHelper::configOptions(CLUB_PLAYER_DETAILS); // controls				
			
			$this->otherForm = $currentModel->getForm();
			$this->otherValues = $currentModel->get('otherValues');		
			
		}
	
		return $proceed;
	}
	function aguardian(){
		
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
		
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();
		$Itemid			= $app->input->post->get('Itemid');
		
		$proceed = FALSE;
		if($user->get('id') > 0){
		
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
		
			$proceed = TRUE;
			$key_data = new stdClass();
		
			$key_data->full_key = $app->input->post->getString('member_key', null);
			$this->uKeyObject = new ClubRegUniqueKeysHelper();
			$this->uKeyObject->deconstructKey($key_data);
			
			$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => true));
			$current_model->setState('com_clubreg.regmember.member_id',$key_data->pk_id);
			$this->member_data = $current_model->getParentDetails();
			
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.renderItem.php';
			require_once CLUBREG_CONFIGS.'config.profile.php';
			$configObj = new ClubRegProfileConfig();
			$this->profileConfigs =  $configObj->getConfig("childguardian"); // return headings which hold config details
			$this->itemRenderer = new ClubRegRenderItemHelper(); // used to render individual items			
		
			unset($currentModel);
			
		}		
		return $proceed;		
	}
	private function listguardian(){
		
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
		
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();
		$Itemid			= $app->input->post->get('Itemid');
		
		$proceed = FALSE;
		if($user->get('id') > 0){
			
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
			
			$proceed = TRUE;
			$key_data = new stdClass();
			
			$this->member_key = $key_data->full_key = $app->input->post->getString('member_key', null);
			$this->uKeyObject = new ClubRegUniqueKeysHelper();
			$this->uKeyObject->deconstructKey($key_data);
			
			$search_value = $app->input->post->getString('search_value', null);
			
			$current_model = JModelLegacy::getInstance('regmembers', 'ClubregModel', array('ignore_request' => true));
			$current_model->setState('com_clubreg.regmembers.member_id',$key_data->pk_id);
			$current_model->setState('com_clubreg.regmembers.search_value',$search_value);
			$this->all_guardians = $current_model->getGuardians();
			
			
			
			$proceed = TRUE;
		}
		
		return $proceed;
		
	}
	private function anactivity(){
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
		
		$user		= JFactory::getUser();
		$app			= JFactory::getApplication();
		$Itemid			= $app->input->post->get('Itemid');
		
		$proceed = FALSE;
		if($user->get('id') > 0){
		
			require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
		
			$proceed = TRUE;
			$key_data = new stdClass();
		
			$this->item_key = $key_data->full_key = $app->input->post->getString('item_key', null);
			$this->uKeyObject = new ClubRegUniqueKeysHelper();
			$this->uKeyObject->deconstructKey($key_data);
		
			$this->which = $app->input->post->getString('which', null);
			
			
			switch($this->which){
				case "payments":
					$current_model = JModelLegacy::getInstance('payments', 'ClubregModel', array('ignore_request' => true));
					
					$current_model->setState('com_clubreg.payments.full_key',$key_data->full_key); // use the key in the model
					$current_model->setState('com_clubreg.payments.payment_key',$key_data->string_key); // use the key in the model
					$current_model->setState('com_clubreg.payments.payment_id',$key_data->pk_id); // use the key in the model
					
					$this->items = $current_model->getPayments($user->get('id'));
					
					
					require_once CLUBREG_CONFIGS.'config.payments.php';
					require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.rendertables.payments.php';
					
					$configObj = new ClubRegPaymentsConfig();
					$paymentsConfigs =  $configObj->getConfig("payments"); // return headings and filters
					
					
					$tmp_filters["filter_heading"] = $paymentsConfigs["filters"];
					$tmp_filters["group_where"] = $paymentsConfigs["group_where"];
					$tmp_filters["headings"] = $paymentsConfigs["headings"];
					$tmp_filters["otherconfigs"] = $paymentsConfigs["otherconfigs"];
					$this->entity_filters = $tmp_filters;
					
					unset($configObj);
					unset($tmp_filters);
					
				break;
				
				case "notes":
					
					$current_model = JModelLegacy::getInstance('note', 'ClubregModel', array('ignore_request' => true));
					$current_model->setState('com_clubreg.note.note_id',$key_data->pk_id);
					$current_model->setState('com_clubreg.note.note_key',$key_data->string_key);
					$this->itemForm =  $current_model->getForm();
					
				break;
				
			}
		
		
			$proceed = TRUE;
		}
		
		return $proceed;
		
	}
}