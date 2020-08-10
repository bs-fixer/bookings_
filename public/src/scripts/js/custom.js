jQuery(document).ready(function(){
	jQuery('#dob').datepicker({
		datesDisabled: ['2020-08-14', '2020-08-17'],
		format: "yyyy-mm-dd",
		daysOfWeekDisabled: [0,6]
	}); 
});

// jQuery(document).ready(function(){
// 	// for default days and hours repeater
// 	jQuery('#default_add').on('click', function(){
// 		var default_add = '<div class="default-parent-keeper">'+
// 		'<button type="button" class="btn btn-danger default_remove">-</button>'+
// 		'<input class="col-md-5 repeater_input" type="time" placeholder="From" name="working_hours[default][from][]">'+
// 		'<input class="col-md-5 repeater_input" type="time" placeholder="To" name="working_hours[default][to][]"></div>';
// 		jQuery('.default-parent').append(default_add);
// 	});

// 	jQuery(".default-parent").on("click", ".default_remove", function(){
// 		jQuery(this).parent().remove(); 
// 	  	jQuery("#default_add").show();
// 	});
// 	// for default days and hours repeater ends

// 	// for checkbox
// 	jQuery('.working_hours_check').on('change',function() {
// 		var days_status = jQuery(this).is(':checked');
// 		var day_name = jQuery(this).val();
// 		if( days_status ){
// 			jQuery(this).parent().next().css("opacity","1.0").css('pointer-events','auto');
// 		}
// 		else{
// 			jQuery(this).parent().next().css("opacity","0.3").css('pointer-events','none');
// 		}
// 	});
// 	jQuery('.working_hours_check').trigger('change');

// 	// for dynamic days and hours repeater
// 	jQuery('.addWorkingHours').on('click', function(){
// 		var day_name = jQuery(this).parents('.dayName').data('day');
// 		var days_status = jQuery('.working_hours_check').is(':checked');
// 		var content = '<div class="'+day_name+'-parent-keeper workingHoursFields">'+
// 		'<button type="button" class="btn btn-danger removeWorkingDays">-</button>'+
// 		'<input class="col-md-5 repeater_input" type="time" placeholder="From" name="working_hours['+day_name+'][from][]">'+
// 		'<input class="col-md-5 repeater_input" type="time" placeholder="To" name="working_hours['+day_name+'][to][]"></div>';
// 		jQuery('.'+day_name+'-parent').append(content);
// 		if( days_status ){
// 			jQuery('.'+day_name+'-parent-keeper').find('input').removeAttr('disabled');
// 		}
// 		else{
// 			jQuery('.'+day_name+'-parent-keeper').find('input , button').attr('disabled', 'disabled');	
// 		}
// 	});

// 	jQuery(document).on('click', '.removeWorkingDays', function(){
// 		jQuery(this).parent().remove();
// 		jQuery('.addWorkingHours').show();
// 	});
// 	// for dynamic days and hours repeater ends

// });


// for generalized repeater 
jQuery(document).ready(function(){
	
	jQuery(document).on('click','.removeBtn',function(){
		jQuery(this).parent().remove();
		jQuery('.addBtn').show();
	});

	jQuery('.addBtn').on('click',function(){
		var content = jQuery(this).parent('.repeater-wrap').find('.repeater-fields').last().clone().removeClass('repeater-to-clone');
		jQuery(this).parent('.repeater-wrap').find('.repeater-container').append(content);
		var inputs = content.find('input');
		jQuery(inputs).each(function(){
			var name = jQuery(this).data(name);
			jQuery(this).attr('name' , name['name']);
		})
	});

	jQuery(".repeater-container").each(function(){
		var length = jQuery(this).find('.repeater-fields:not(.repeater-to-clone)').length;
		console.log(length);
		if( length == 0 ){
			jQuery('.addBtn').trigger('click');
		}
	});


});
// ends here
jQuery(document).ready( function () {
    jQuery('#myTable').DataTable();
} );

jQuery(document).ready( function () {
    jQuery('.myTable').DataTable();
} );



