/*! ColoredCow 2017-07-24 */
jQuery(document).ready(function($) {
    var event_id;
    $("#submit_request").on("click",function(){
        var requestForm=$('#request_form');                    
        if(!requestForm[0].checkValidity()){
            requestForm[0].reportValidity();
            return; 
        }
        else{  
                ajax_request_form();
                $('#request_form').trigger('reset');
                $('#request_modal').hide();
            }
    });

    $(".request-button").on("click",function(){
        event_id=$(this).data('id');
        console.log(event_id);
    });

    // Ajax for request form
    function ajax_request_form(){
        console.log(event_id);
        var request_form ="action=add_requested_guests&event_id="+event_id+"&"+$('#request_form').serialize();
        console.log(request_form);
        $.ajax({
            type: 'POST',
            url:PARAMS.ajaxurl,
            data:request_form,
            success:function(e){
            	alert("Success");
            }
        });
    }

    $(".dropdown-item").on("click",function(){
        var attendance_event_id=$(this).data('id');
        console.log(attendance_event_id);
        event_data="action=show_guest_tables&attendance_event_id="+attendance_event_id;
        console.log(event_data);
        $.ajax({
            type: 'POST',
            url:PARAMS.ajaxurl,
            data:event_data,
            success:function(e){
                $(".tables").html(e);
            }
        });
    });


    $(".show-all-guests").on("click",function(){
        event_data="action=show_approved_guests";
        console.log(event_data);
        $.ajax({
            type: 'POST',
            url:PARAMS.ajaxurl,
            data:event_data,
            success:function(e){
                $(".tables").html(e);
            }
        });
    });

    $(document).on("click", ".approve-guest", function(){
        var approve_guest_id=$(this).data('id');
        var event_id=$(this).val();
        console.log(event_id);
        console.log(approve_guest_id);
        guest_data="action=approve_guests&approve_guest_id="+approve_guest_id;
        $.ajax({
            type: 'POST',
            url:PARAMS.ajaxurl,
            data:guest_data,
            success:function(e){
                ajax_updated_tables(event_id);
            }
        });
    });


    $(document).on("click", ".reject-guest", function(){
        var reject_guest_id=$(this).data('id');
        var event_id=$(this).val();
        console.log(event_id);
        console.log(reject_guest_id);
        guest_data="action=reject_guests&reject_guest_id="+reject_guest_id;
        $.ajax({
            type: 'POST',
            url:PARAMS.ajaxurl,
            data:guest_data,
            success:function(e){
                console.log(event_id);
                ajax_updated_tables(event_id);
            }
        });
    });

    function ajax_updated_tables(event_id){
        var attendance_event_id=event_id;
        console.log(attendance_event_id);
        event_data="action=show_guest_tables&attendance_event_id="+attendance_event_id;
        console.log(event_data);
        $.ajax({
            type: 'POST',
            url:PARAMS.ajaxurl,
            data:event_data,
            success:function(e){
                $(".tables").html(e);
            }
        });
    }
});