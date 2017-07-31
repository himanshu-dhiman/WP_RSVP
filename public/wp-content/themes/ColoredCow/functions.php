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
        if( ! isset($_POST['request_name'])):
            return;
        else :
            $request_name=$_POST['request_name'];
            $request_email=$_POST['request_emailid'];
            $request_phone=$_POST['phonenumber'];
            $request_gender=$_POST['request_gender'];
            $request_event_id=$_POST['event_id'];        
            $this_post = array(
                'post_title'    => $request_name,
                'post_status'   => 'publish',
                'post_type'     => 'guest',
                'post_category' => array(4),
            );
            $post_id = wp_insert_post( $this_post );
            if( !$post_id ){
                wp_send_json_error();
            }
            add_post_meta($post_id, 'email', $request_email);
            add_post_meta($post_id, 'phone', $request_phone);
            add_post_meta($post_id, 'gender', $request_gender);
            add_post_meta($post_id, 'event_id', $request_event_id);
            send_registered_mail_request($post_id);
        endif;

    }
    add_action('wp_ajax_add_requested_guests','add_requested_guests');
    add_action('wp_ajax_nopriv_add_requested_guests','add_requested_guests');

    function send_registered_mail_request($post_id){
        require_once(__DIR__.'/vendor/mandrill/mandrill/src/Mandrill.php');
        $guest_id=$post_id;
        var_dump($guest_id);
        $guest_post_args=array(
            'post_type' => 'guest',
            'p'=>$guest_id
        );
        $guests_query= new WP_Query($guest_post_args);
            if($guests_query->have_posts() ) :
                while ( $guests_query->have_posts() ) :
                    $guests_query->the_post();
                    $mandrill = new Mandrill('Lx5txGX1JDBaRLxHvy2rVA');
                    $guest_name=get_the_title();
                    $guest_email=get_field('email');
                    $recipients[] = array(
                        'email' => $guest_email,
                        'name' => $guest_name,
                        'type' => 'to'
                    );
                endwhile;
            endif;
            var_dump($recipients);
        $template_name = 'Registered';
        $template_content = '';
        $message = array(
            'subject' => 'Request Registred',
            'from_email' => 'himanshu@coloredcow.com',
            'from_name' => 'Himanshu Dhiman',
            'to' => $recipients,
            'preserve_recipients' => false,
            'bcc_address' => 'hkd26dhi@gmail.com',
            'merge' => true,
            'merge_language' => 'mailchimp',
            'inline_css' => true,
            'global_merge_vars' => array(
                array(
                    'name' => 'event_name',
                    'content' => 'ColoredCow-Soiree'
                ),
            ),
            'merge_vars' => array(
                array(
                    'rcpt' => 'recipient.email@example.com',
                    'vars' => array(
                        array(
                            'name' => 'merge2',
                            'content' => 'merge2 content'
                        )
                    )
                )
            ),
            'tags' => array('password-resets'),
            'metadata' => array('website' => 'www.coloredcow.com')
        );
        $async = false;
        $ip_pool = 'Main Pool';
        $result = $mandrill->messages->sendTemplate($template_name,$template_content,$message, $async, $ip_pool);
        wp_die();
    }

    add_action('','send_registered_mail_request');
?>