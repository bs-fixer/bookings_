
jQuery("#add").on("click", function(){
	console.log('hell0');
	if(jQuery(".parent-container").children().length <5){
  	jQuery(".parent-container").append(content);
  }
  if(jQuery(".parent-container").children().length == 5){
  	jQuery("#add").hide();
  }
});

jQuery(".parent-container").on("click", "#remove", function(){
	jQuery(this).parent().remove(); 
  	jQuery("#add").show();
});

