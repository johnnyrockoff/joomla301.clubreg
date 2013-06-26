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
class ClubregControllerAjax extends JControllerLegacy
{
	
	public function __construct($config = array())
	{		
		require_once JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'clubreg.php';
		require_once JPATH_COMPONENT.DS.'helpers'.DS.'clubreg.uniquekeys.php';
		parent::__construct($config);
		$this->registerTask('deletenote', 'deletenote');		
		$this->registerTask('locknote', 'locknote');
		$this->registerTask('savenote', 'savenote');
		
		$this->registerTask('savepayment', 'savepayment');
		$this->registerTask('saveemergency', 'saveemergency');
		$this->registerTask('saveother', 'saveother');
		
		$this->registerTask('assignguardian', 'assignguardian');
		$this->uKeyObject = new ClubRegUniqueKeysHelper(10);
		
	}	

	public function deletenote(){
		
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();
		$key_data = new stdClass();
		
		$return_array = array();
		$return_array["proceed"] = FALSE;
		
		$key_data->full_key = $app->input->post->getString('note_key', NULL);			
		$this->uKeyObject->deconstructKey($key_data);
		
		if($key_data->pk_id > 0 && strlen($key_data->string_key) > 0){
			unset($current_model);
			$current_model = JModelLegacy::getInstance('note', 'ClubregModel', array('ignore_request' => true));		
			$current_model->setState('com_clubreg.note.note_id',$key_data->pk_id);
			$current_model->setState('com_clubreg.note.note_key',$key_data->string_key);
			
			$return_array["proceed"] = $current_model->changeStatus(99);
			
			if($return_array["proceed"]){
					
			}else{
				$return_array["msg"] =  $current_model->getError();
			}
		}

		echo json_encode($return_array);
		$app->close();
		
	}
	public function locknote(){
	
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();
		$key_data = new stdClass();
		
		$return_array = array();
		$return_array["proceed"] = FALSE;
		$key_data->full_key = $app->input->post->getString('note_key', NULL);			
		$this->uKeyObject->deconstructKey($key_data);
		
		if($key_data->pk_id > 0 && strlen($key_data->string_key) > 0){
			unset($current_model);
			$current_model = JModelLegacy::getInstance('note', 'ClubregModel', array('ignore_request' => true));
			$current_model->setState('com_clubreg.note.note_id',$key_data->pk_id);
			$current_model->setState('com_clubreg.note.note_key',$key_data->string_key);
			
			$return_array["proceed"] = $current_model->changeStatus(1);			
			
			if($return_array["proceed"]){
					
			}else{
				$return_array["msg"] =  $current_model->getError();			
			}			
		}
	
		echo json_encode($return_array);
		$app->close();
	
	}
	public function savenote(){

		
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();
		
		$proceed = TRUE;
		$data = $this->input->post->get('jform', array(), 'array');
		$key_data = new stdClass();
		
		unset($current_model);
		$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => true));
		$key_data->full_key = $data['member_key'];
		$current_model->processKey($key_data);
		$data["primary_id"] = $key_data->member_id;		
		$data["note_key"] =  $this->uKeyObject->getUniqueKey();
		$data["created_by"] = $user->get('id');
		if(!isset($data["note_status"])){
			$data["note_status"] = '0';
		}
		
		unset($current_model);
		$current_model = JModelLegacy::getInstance('note', 'ClubregModel', array('ignore_request' => true));
		$proceed = $current_model->save($data);
		
		echo json_encode(array("proceed"=>$proceed));
		
		$app->close();
		
	}
	
	public function savepayment(){
		
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));		
		
	
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();
		
		$proceed = FALSE;
		$data = $this->input->post->get('jform', array(), 'array');		
		
		unset($current_model);
		$key_data = new stdClass();
		$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => true));
		$key_data->full_key = $data['member_key'];
		$current_model->processKey($key_data);
		$data["member_id"] = $key_data->member_id;		
		$data["created_by"] = $user->get('id');		
		
		unset($current_model);unset($key_data);
		$key_data = new stdClass();
		$current_model = JModelLegacy::getInstance('payment', 'ClubregModel', array('ignore_request' => true));
		$key_data->full_key = $data['payment_key'];
		$this->uKeyObject->deconstructKey($key_data);	
		
		$isNew = FALSE;
		$data["payment_key"] = $key_data->string_key;
		$data["payment_id"] = $key_data->pk_id;
		
		if($key_data->pk_id > 0 && strlen($key_data->string_key) == 0){
			$data["payment_key"] =  $this->uKeyObject->getUniqueKey();
		}else if($key_data->pk_id == 0){
			$data["payment_key"] =  $this->uKeyObject->getUniqueKey();
			$data["payment_id"] = NULL;
			$isNew = TRUE;						
		}
		
		$data["payment_amount"] *= FACTOR; 
		$current_model->setState('com_clubreg.payment.isnew',$isNew);		
		$proceed = $current_model->save($data);
		
		$return_array = array();
		$return_array["proceed"] = $proceed;
		$return_array["isNew"] = $isNew;
		
		if($proceed){
			$return_array["payment_id"] =$current_model->get("payment_id");
		}else{
			$return_array["msg"] =  $current_model->getError();
			
		}
		
		
		unset($current_model);unset($key_data);
		echo json_encode($return_array);
		
		$app->close();
		
	}
	function saveemergency(){
		
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		
		
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();
		
		$proceed = FALSE;
		$data = $this->input->post->get('jform', array(), 'array');
		
		unset($current_model);
		$key_data = new stdClass();
		$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => true));
		$key_data->full_key = $data['member_key'];	
		
		$this->uKeyObject->deconstructKey($key_data);
		
		
		unset($current_model);		
		$current_model = JModelLegacy::getInstance('emergency', 'ClubregModel', array('ignore_request' => true));
		$current_model->setState('com_clubreg.emergency.member_id',$key_data->pk_id);
		$proceed = $current_model->save($data);
				
		$return_array = array();
		$return_array["proceed"] = $proceed;	

		if($proceed){
			
		}else{
			$return_array["msg"] =  $current_model->getError();				
		}		
		unset($current_model);unset($key_data);
		echo json_encode($return_array);
		
		$app->close();
		
	}	
	
	function saveother(){
	
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
	
	
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();
		
		$return_array = array();
		$return_array["proceed"] = FALSE;
		
		$data = $this->input->post->get('jform', array(), 'array');		
		$extraDetails = $this->input->post->get('extraDetails', array(), 'array');
		$monthyears = $this->input->post->get('monthyear', array(), 'array');		
	
		unset($current_model);
		$key_data = new stdClass();
		$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => true));
		$key_data->full_key = $data['member_key'];
	
		$this->uKeyObject->deconstructKey($key_data);	
	
		unset($current_model);
		$current_model = JModelLegacy::getInstance('other', 'ClubregModel', array('ignore_request' => true));
		$current_model->setState('com_clubreg.other.member_id',$key_data->pk_id);
		$return_array["proceed"] =  $current_model->save($extraDetails,$monthyears);		
	
		if($return_array["proceed"]){
				
		}else{
			$return_array["msg"] =  $current_model->getError();	
		}
	
	
		unset($current_model);unset($key_data);
		echo json_encode($return_array);
	
		$app->close();
	
	}
	
	function assignguardian(){
		
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		
		
		$return_array = array();
		$return_array["proceed"] = FALSE;
		
		$app    = JFactory::getApplication();
		$user		= JFactory::getUser();		
		
		$member_key_data->full_key = $this->input->post->get('member_key', NULL, 'string');
		$this->uKeyObject->deconstructKey($member_key_data);
		
		$parent_key_data->full_key = $this->input->post->get('parent_key', NULL, 'string');
		$this->uKeyObject->deconstructKey($parent_key_data);
		
		
		$current_model = JModelLegacy::getInstance('regmember', 'ClubregModel', array('ignore_request' => true));
		$current_model->setState('com_clubreg.regmember.member_id',$member_key_data->pk_id);
		
		$return_array["proceed"] = $current_model->changeProperty("parent_id",intval($parent_key_data->pk_id));
		
		if($return_array["proceed"]){
		
		}else{
			$return_array["msg"] =  $current_model->getError();
		}
		unset($current_model);unset($key_data);
		echo json_encode($return_array);
		
		$app->close();
		
	}
	
	
}