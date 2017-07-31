/*! ColoredCow 2017-07-24 */
jQuery(document).ready(function($) {
	var event_id;
	$("#submit_request").on("click",function(){
		var requestForm=$('#request_form');                    
		if(!requestForm[0].checkValidity()){
			requestForm[0].reportValidity();
			return; 
		} else {  
			ajax_request_form();
			$('#request_form').trigger('reset');
			$('#request_modal').hide();
		}
	});

	$(".request-button").on("click",function(){
		event_id=$(this).data('id');
	});

	function ajax_request_form(){
		var request_form ="action=add_requested_guests&event_id="+event_id+"&"+$('#request_form').serialize();
		$.ajax({
			type: 'POST',
			url:PARAMS.ajaxurl,
			data:request_form,
			success:function(e){
				alert("Request Submitted");
			}
		});
	}

	$(".event-guest").on("click",function(){
		var attendance_event_id=$(this).data('id');
		$.ajax({
			type: 'POST',
			url:PARAMS.ajaxurl,
			data:{
				action:'show_guest_tables',
				attendance_event_id:attendance_event_id
			},
			success:function(e){
				$("#all-events-table").hide();
				$("#all-guests-table").hide();
				$("#invited-guests-table").show()
				$(".invited-guest-table tbody").html(e);
				guest_request_table(attendance_event_id);
			}
		});
	});


	$(".show-all-guests").on("click",function(){
		$.ajax({
			type: 'POST',
			url:PARAMS.ajaxurl,
			data:{action:'show_approved_guests'},
			success:function(e){
				$("#all-events-table").hide();
				$("#guest-request-table").hide();
				$("#invited-guests-table").hide();
				$("#all-guests-table").show();
				$(".all-guests-table tbody").html(e);
			}
		});
	});

	$(document).on("click", ".approve-guest", function(){
		var approve_guest_id=$(this).data('guestid');
		var event_id=$(this).data('eventid');
		$.ajax({
			type: 'POST',
			url:PARAMS.ajaxurl,
			data:{
				action:'approve_guests',
				approve_guest_id:approve_guest_id
			},
			success:function(e){
				ajax_updated_tables(event_id);
			}
		});
	});


	$(document).on("click", ".reject-guest", function(){
		var reject_guest_id=$(this).data('guestid');
		var event_id=$(this).data('eventid');
		$.ajax({
			type: 'POST',
			url:PARAMS.ajaxurl,
			data:{
				action:'reject_guests',
				reject_guest_id:reject_guest_id
			},
			success:function(e){
				ajax_updated_tables(event_id);
			}
		});
	});

	function ajax_updated_tables(event_id){
		var attendance_event_id=event_id;
		$.ajax({
			type: 'POST',
			url:PARAMS.ajaxurl,
			data:{
				action:'show_guest_tables',
				attendance_event_id:attendance_event_id
			},
			success:function(e){
				$(".invited-guest-table tbody").html(e);
				guest_request_table(attendance_event_id);
			}
		});
	}

	function guest_request_table(attendance_event_id){
		$.ajax({
			type: 'POST',
			url:PARAMS.ajaxurl,
			data:{
				action:'show_guest_request_table',
				attendance_event_id:attendance_event_id
			},
			success:function(e){
				$("#guest-request-table").show();
				$(".guest-requests-table tbody").html(e);
			}
		});
	}

	$(document).on("click", ".invitation",function(){
		var event_id=$(this).data('id');
		$.ajax({
			type: 'POST',
			url:PARAMS.ajaxurl,
			data:{
				action:'send_invitation_mail',
				event_id:event_id
			},
			success:function(e){
				console.log(e);
			}
		});
	});

	$(".show-all-events").on("click",function(){
		$.ajax({
			type: 'POST',
			url:PARAMS.ajaxurl,
			data:{action:'show_all_events'},
			success:function(e){
				$("#all-guests-table").hide();
				$("#guest-request-table").hide();
				$("#invited-guests-table").hide();
				$("#all-events-table").show();
				$(".all-events-table tbody").html(e);
			}
		});
	});
});