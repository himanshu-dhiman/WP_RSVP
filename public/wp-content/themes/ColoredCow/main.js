/*! ColoredCow 2017-07-24 */
jQuery(document).ready(function($) {
var event_id;
$("#submit_request").on("click",function(){
    var requestForm=$('#request_form');
                        
    if(!requestForm[0].checkValidity()){
        requestForm[0].reportValidity();
        return; 
    }else{  
            ajax_request_form();
            $('#request_form').trigger('reset');
            $('#request_modal').modal('toggle');
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

});