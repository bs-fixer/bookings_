jQuery(document).ready(function(){
	var disabledDays;
	/* BOOKINGS FORM */
	jQuery('input[name="business_id"]').attr('readonly','readonly');
	jQuery('select[name="services"]').attr('readonly','readonly');
	jQuery('input[name="dob"]').attr('readonly','readonly');

	jQuery("select[name='ref_id']").on('change', function(){
		jQuery('.slot').remove();
		var business_id = jQuery('input[name="business_id"]').val();
		var emp_id = jQuery(this).children('option:selected').val();
		jQuery('select[name="services"]').removeAttr('readonly','readonly');

		jQuery.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});
		jQuery.ajax({
			url: "/ajax_getEmpWorkingDays",
			method: 'get',
			data: {
			   'business_id': business_id,
			   'emp_id': emp_id,
			},
			success: function(result){
				jQuery('input[name="dob"]').removeAttr('readonly','readonly');
				disabledDays = result;
				jQuery('#dob').datepicker('destroy');
				jQuery('#dob').datepicker({
					format: "yyyy-mm-dd",
					daysOfWeekDisabled: disabledDays,
					weekStart: 1,
				});
				//datepicker ends 
			}}); //success ends


			
		}); //ref_id change

		/* TO GET DATE TO SHOW SLOTS */
		jQuery('input[name="dob"]').on('change', function(){
			var business_id = jQuery('input[name="business_id"]').val();
			var ref_id      = jQuery("select[name='ref_id']").val();
			var get_date    = jQuery(this).val();
			// var day_name    = Date.getDay();
			// console.log('Day Name => '+day_name);
			// console.log(get_date);
			jQuery.ajax({
				url: '/ajax_getSlotsHtml',
				method:'get',
				data:{
					'business_id': business_id,
					'ref_id': ref_id,
					'ref_name': 'Employee',
					'date' : get_date
				},

				success:function(response){
					// console.log(response);
					jQuery('.bookings_slot').html(response);
				}
			});
		}); //dob on change
		

	});

	// jQuery('#dob').datepicker({
	// 	datesDisabled: ['2020-08-14', '2020-08-17'],
	// 	format: "yyyy-mm-dd",
	// 	daysOfWeekDisabled: [0,6],
	// 	weekStart: 1,
	// }); 
	/* END BOOKING FORM */


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

/* BOOKING FROM FRONTEND */
jQuery(document).ready(function(){
	$('#bookingByUser').on('submit',function(event){
		event.preventDefault();
		business_id = jQuery('input[name="business_id"]').val();
		name    = jQuery('input[name="name"]').val();
		contact = jQuery('input[name="contact"]').val();
		email   = jQuery('input[name="email"]').val();
		ref_id  = jQuery("select[name='ref_id']").val();
		services= jQuery("select[name='services']").val();
		dob     = jQuery("input[name='dob']").val();
		slot_index = jQuery('.slot_index:checked').val();
		
		jQuery.ajax({
			url: jQuery(this).attr('action'),
			type:"get",
			data:{
			  "_token": "{{ csrf_token() }}",
			  name:name,
			  email:email,
			  contact:contact,
			  ref_id:ref_id,
			  services:services,
			  dob:dob,
			  slot_index:slot_index
			},
			success:function(response){
			  jQuery('.bookingByUserAlert').removeAttr('hidden','hidden');
			} 
		}); //ajax ends
	});
});



