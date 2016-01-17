//profile-contactlist-button

jQuery(document).ready(function() {
	
	jQuery('#contactlistFormDiv').fadeOut();
	
	var isOn = 0;
	
	jQuery(document).on('click','a.profile-contactlist-button',function(event){	
		
		jQuery('#contactlistFormDiv').fadeToggle();
		jQuery('#profile-contactlist').fadeToggle();
		jQuery("a.profile-contactlist-button").fadeToggle();
		ClubRegObject.editContacts(contactEditRequestConfig,jQuery(this));					
	});	
	
	
	jQuery(document).on('click','#toggle-contactlist-div',function(event){		
		
		jQuery('#contactlistFormDiv').fadeToggle();
		jQuery('#profile-contactlist').fadeToggle();
		jQuery("a.profile-contactlist-button").fadeToggle();
	
	});	
	
	jQuery(document).on('submit','#contactlist-form',function(event){		
		
		event.preventDefault();		
		contactSaveRequestConfig.rData = jQuery(this).serialize();
		ClubRegObject.saveContactlist(contactSaveRequestConfig);
		
	});

	ClubRegObject.listContacts(contactListRequestConfig);
	

});


function contactSaveRequestDef(){	
	
	self = this;
	self.rUrl  =  "index.php";
	self.rMethod  = "post";
	self.rData  = {}	;	
};

contactSaveRequestDef.prototype.useResults  = function(response){	
	
	 s_or_f = 1;
	render_msg(response.msg);
	
	if(response.isNew){
		
	}else{
		
	}
	
	
}

/**
 * Config for editing contact
 */
function contactEditRequestDef(){	
	
	self = this;
	self.rUrl  =  "index.php?option=com_clubreg&view=contactlist&layout=edit&tmpl=component&format=raw";
	self.rMethod  = "post";
	self.rData  = {}	;	
};
contactEditRequestDef.prototype.useResults  = function(response){	
	jQuery("#contactlistFormDiv").html(response);
	
//	jQuery('#contactlistFormDiv').fadeToggle();
//	jQuery('#profile-contactlist').fadeToggle();
//	
//	jQuery("a.profile-contactlist-button").fadeToggle();
}

/**
 * Config Request for listing contacts
 */
function contactListRequestDef(){	
	
	self = this;
	self.rUrl  =  "index.php?option=com_clubreg&view=contactlist&layout=list&tmpl=component&format=raw";
	self.rMethod  = "post";
	self.rData  = {}	;	
};
contactListRequestDef.prototype.useResults  = function(response){	
	jQuery("#profile-contactlist").removeClass('loading1');
	jQuery("#profile-contactlist").html(response);
}

/**
 * Config for button click request
 */
var contactEditRequestConfig = new contactEditRequestDef();
var contactSaveRequestConfig = new contactSaveRequestDef();
var contactListRequestConfig = new contactListRequestDef();


ClubregObjectDefinition.prototype.listContacts= function(requestConfig){	
	self = this;	
	requestConfig.rData = JSON.decode(jQuery("#profile-contactlist").attr('rel'));	
	self.loadAjaxRequestHTML(requestConfig);  
}


ClubregObjectDefinition.prototype.editContacts= function(requestConfig,linkControl){	
	self = this;	
	requestConfig.rData = JSON.decode(linkControl.attr('rel'));	
	self.loadAjaxRequestHTML(requestConfig);  

}

ClubregObjectDefinition.prototype.saveContactlist= function(requestConfig){
	
	self = this;	
	self.loadAjaxRequest(requestConfig);  

}