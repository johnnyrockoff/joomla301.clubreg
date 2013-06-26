window.addEvent('domready', function () {	
	
	
	if($('profileEoi')){
				
		$('profileEoi').addClass('well well-large');	
		
		var json_data = JSON.decode($('profileEoi').get('rel'));
		
		var durl = "index.php";	
		
		var params = "option=com_clubreg&view=ajax&layout=eoi&tmpl=component";
		
		if(json_data["Itemid"]){
			params = params + "&Itemid="+json_data["Itemid"];
		}
		var a = new Request.HTML({ 
			url : durl, 
			method: 'get',	
			update: $('profileEoi'),
			onSuccess: function(responseText){ $('profileEoi').removeClass('loading1');	}
			}).send(params);
		
	}
	
	if($('profileActivity')){
			
		$('profileActivity').addClass('well well-large');		
		
		var json_data = JSON.decode($('profileActivity').get('rel'));
		
		var durl = "index.php";	
		var params = "option=com_clubreg&view=ajax&layout=activity&tmpl=component";		
		if(json_data["Itemid"]){
			params = params + "&Itemid="+json_data["Itemid"];
		}
		var req = new Request.HTML({
			method: 'get',
			url: durl,			
			//onRequest: function() { alert('Request made. Please wait...'); },
			update: $('profileActivity'),
			onComplete: function(response) { $('profileActivity').removeClass('loading1'); 	}
		}).send(params);
		
		
		var container = $('profileActivity');
		
		container.addEvent("click:relay($(this))", function(event){	
			//event.stop();				
			var var_class = $(this).get('class');
			
			if(var_class.test('activity-item')){			
				renderActivity($(this));
			}
		});
		
	}
});

function renderActivity(dObject){
	
	var json_data = JSON.decode(dObject.get('rel'));		
	var params = "option=com_clubreg&view=ajax&layout=anactivity&tmpl=component&format=raw";		
	var durl = "index.php?"+params;	
	
	var a = new Request.HTML({
		url : durl, 
		method: 'post',	
		data : json_data,
		update: dObject,
		onRequest : function(){dObject.empty();dObject.addClass('loading-small');},
		onSuccess: function(responseText){ dObject.removeClass('loading-small'); dObject.removeClass('activity-item');}
		}).send();	
	
}