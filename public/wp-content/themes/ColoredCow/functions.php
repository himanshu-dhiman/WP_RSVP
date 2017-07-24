<?php

if ( ! function_exists( 'cc_scripts' ) ) {
    function cc_scripts() {
        wp_enqueue_script('cc-bootstrap4-script', get_template_directory_uri().'/dist/lib/js/bootstrap4.min.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('cc-bootstrap-tether','https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js');
        wp_enqueue_script('cc-fontawesome-icons','https://use.fontawesome.com/ffc2c94a85.js');
        wp_enqueue_script('main', get_template_directory_uri().'/main.js', array('jquery'), '1.0.0', true);
        wp_localize_script( 'main', 'PARAMS', array('ajaxurl' => admin_url('admin-ajax.php')) );
    }
    add_action('wp_enqueue_scripts','cc_scripts');
}

if ( ! function_exists( 'cc_styles' ) ) {
    function cc_styles() { 
        wp_enqueue_style('cc-bootstrap4-style', get_template_directory_uri().'/dist/lib/css/bootstrap4.min.css');
        wp_enqueue_style('cc-fonts','https://fonts.googleapis.com/css?family=Oswald|Marcellus+SC|Roboto|Open+Sans');
        wp_enqueue_style('style', get_template_directory_uri().'/style.css');
    }
    add_action('wp_enqueue_scripts','cc_styles');
}
    add_filter('show_admin_bar','__return_false');

function add_requested_guests(){
    if(isset($_POST['request_name'])){
        $request_name=$_POST['request_name'];
        $request_email=$_POST['request_emailid'];
        $request_phone=$_POST['phonenumber'];
        $request_gender=$_POST['request_gender'];
        $request_event_id=$_POST['event_id'];        
        $this_post = array(
          'post_title'    => $request_name,
          'post_status'   => 'publish',
          'post_type'     => 'guest'
         );
        $post_id = wp_insert_post( $this_post );
            if( !$post_id ){
                wp_send_json_error();
            }
        add_post_meta($post_id, 'email', $request_email);
        add_post_meta($post_id, 'phone', $request_phone);
        add_post_meta($post_id, 'status', 'waiting for approval');
        add_post_meta($post_id, 'gender', $request_gender);
        add_post_meta($post_id, 'event_id', $request_event_id);
    }
}
add_action('wp_ajax_add_requested_guests','add_requested_guests');
add_action('wp_ajax_nopriv_add_requested_guests','add_requested_guests');
?>