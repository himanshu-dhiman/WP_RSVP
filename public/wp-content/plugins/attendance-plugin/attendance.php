<?php
	/*
	Plugin Name: Invites Management
	Description: Plugin for displaying Guests Status according to Events
	Version: 1.0
	*/
	add_action( 'admin_menu','attendance_page' );
	add_action( 'admin_enqueue_scripts', 'cc_plugin_scripts' );
	add_action( 'admin_enqueue_scripts', 'cc_plugin_styles' );
	add_action( 'admin_enqueue_scripts', 'requested_guest_body' );
	add_action( 'admin_enqueue_scripts', 'invited_guest_body' );
	add_action( 'wp_ajax_request_approved_mail', 'request_approved_mail' );

	function attendance_page(){
		add_menu_page( 'Invites Management', 'Invites Management', 'manage_options', 'attendance', 'attendance' );
	}

	function attendance(){
		require_once('show-guest-details.php');
	}
	
	function cc_plugin_scripts($hook){
		if( $hook != 'toplevel_page_attendance' ) {
			return;
		}
		wp_enqueue_script( 'cc-bootstrap4-script', get_template_directory_uri().'/dist/lib/js/bootstrap4.min.js', array( 'jquery'), '1.0.0', true);
		wp_enqueue_script( 'cc-bootstrap-tether', 'https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js');
		wp_enqueue_script( 'cc-fontawesome-icons', 'https://use.fontawesome.com/ffc2c94a85.js');
		wp_enqueue_script( 'main', get_template_directory_uri().'/main.js', array( 'jquery'), '1.0.0', true);
		wp_localize_script( 'main', 'PARAMS', array( 'ajaxurl' => admin_url('admin-ajax.php') ) );
	}
	
	function cc_plugin_styles($hook){
		if( $hook != 'toplevel_page_attendance' ) {
			return;
		}
		wp_enqueue_style( 'cc-bootstrap4-style', get_template_directory_uri().'/dist/lib/css/bootstrap4.min.css');
		wp_enqueue_style( 'cc-fonts','https://fonts.googleapis.com/css?family=Oswald|Marcellus+SC|Roboto|Open+Sans');
		wp_enqueue_style( 'style', get_template_directory_uri().'/style.css');
	}
	 
	function show_guest_tables(){
		if( ! isset( $_POST['attendance_event_id'] ) ) :
			wp_die();
 		else :
			$event_id=$_POST['attendance_event_id'];
			$invited_guests_table=invited_guest_body($event_id);
			echo $invited_guests_table;
			wp_die();
		endif;
	}
	add_action( 'wp_ajax_show_guest_tables', 'show_guest_tables' );

	function show_guest_request_table(){
		if( ! isset( $_POST['attendance_event_id'] ) ) :
			wp_die();
 		else :
			$event_id=$_POST['attendance_event_id'];
			$requested_guests_table=requested_guest_body($event_id);
			echo $requested_guests_table;
			wp_die();
		endif;
	}
	add_action( 'wp_ajax_show_guest_request_table', 'show_guest_request_table' );


	function show_approved_guests(){
		$all_guest_post_args=array(
			'post_type' => 'guest',
			'category_name' => 'approved',
			'posts_per_page' => -1
		);
		$all_guest_table_body='';
		$all_guest_query = new WP_Query($all_guest_post_args);
		if ( $all_guest_query->have_posts() ) :
			while( $all_guest_query->have_posts() ) :
				$all_guest_query->the_post();
				$name=get_the_title();
				$email=get_field('email');
				$cat=get_the_category()[0]->cat_name;
				$gender=get_field('gender');
				$all_guest_table_body.='<tr class="table-success">';
				$all_guest_table_body.='<td class="capitalize">'.$name.'</td>';
				$all_guest_table_body.='<td>'.$email.'</td>';
				$all_guest_table_body.='<td class="capitalize">'.$gender.'</td>';
				$all_guest_table_body.='<td>---</td>';
				$all_guest_table_body.='<td class="capitalize">'.$cat.'</td>';
				$all_guest_table_body.='</tr>';
			endwhile;
			echo $all_guest_table_body;
		else :
			echo "Sorry,no records found for your request";
		endif;
		wp_die();
	}
	add_action('wp_ajax_show_approved_guests','show_approved_guests');           

	function approve_guests(){
		if( ! isset ( $_POST['approve_guest_id'] ) ):
			wp_die();
		else :
			$guest_id=$_POST['approve_guest_id'];
			update_post_meta( $guest_id, 'status', 'confirm' );
			wp_set_post_categories( $guest_id, array(2) );
			request_approved_mail($guest_id);
		endif;
		wp_die();
	}
	add_action( 'wp_ajax_approve_guests', 'approve_guests' );     

	function reject_guests(){
		if( ! isset($_POST['reject_guest_id'] ) ) :
			wp_die();
		else :
			$guest_id=$_POST['reject_guest_id'];
			wp_set_post_categories( $guest_id, array(3) );
		endif;
		wp_die();
	}
	add_action( 'wp_ajax_reject_guests', 'reject_guests' );

	function invited_guest_body($event_id){
		$invited_guest_post_args=array(
			'post_type' => 'guest',
			'meta_key'=>'event_id',
			'meta_value'=>$event_id,
			'category_name'=>'approved',
			'posts_per_page' => -1
		);
		$invited_guest_table_body='';
		$invited_guest_query = new WP_Query($invited_guest_post_args);
		if ($invited_guest_query->have_posts() ) :    
			while($invited_guest_query->have_posts() ):
				$invited_guest_query->the_post();
				$name=get_the_title();
				$email=get_field('email');
				$status=get_field('status');
				$gender=get_field('gender');
				$cat=get_the_category()[0]->cat_name;
				$invited_guest_table_body.='<tr class="table-success">';
				$invited_guest_table_body.='<td class="capitalize">'.$name.'</td>';
				$invited_guest_table_body.='<td>'.$email.'</td>';
				$invited_guest_table_body.='<td class="capitalize">'.$gender.'</td>'; 
				if( 'confirm'==$status ) :
					$invited_guest_table_body.='<td class="capitalize confirm-status"><span class="badge badge-success">'.$status.'</span></td>';
				else :
					$invited_guest_table_body.='<td class="capitalize pending-status"><span class="badge badge-danger">'.$status.'</span></td>';	
				endif;
				$invited_guest_table_body.='<td class="capitalize">'.$cat.'</td>';			
				$invited_guest_table_body.='</tr>';
			endwhile;
			return $invited_guest_table_body;
		else :
			return "Sorry, No data found for your Request";
		endif;			
	}

	function requested_guest_body($event_id){
		$requested_guest_post_args=array(
			'post_type' => 'guest',
			'meta_key'=>'event_id',
			'meta_value'=>$event_id,
			'category_name'=>'waiting,rejected',
			'posts_per_page' => -1
		);
		$guest_request_table_body='';
		$requested_guest_query = new WP_Query($requested_guest_post_args);
		if ($requested_guest_query->have_posts() ) :
			while($requested_guest_query->have_posts() ) :
				$requested_guest_query->the_post();
				$name=get_the_title();
				$guest_id=get_the_ID();
				$email=get_field('email');
				$cat=get_the_category()[0]->cat_name;
				$guest_request_table_body.='<tr class="table-success">';
				$guest_request_table_body.='<td class="capitalize">'.$name.'</td>';
				$guest_request_table_body.='<td>'.$email.'</td>';
				$guest_request_table_body.='<td class="capitalize">'.$cat.'</td>';
				$guest_request_table_body.='<td><button type="button" name="add" data-guestid="'.$guest_id.'" class="btn btn-success approve-guest" data-eventid="'.$event_id.'">Approve</button>&nbsp;&nbsp';
				if('Rejected'==$cat) :
				$guest_request_table_body.='<button type="button" name="reject" data-guestid="'.$guest_id.'" class="btn btn-danger reject-guest disabled" data-eventid="'.$event_id.'">Reject</button></td>';
				else :	
				$guest_request_table_body.='<button type="button" name="reject" data-guestid="'.$guest_id.'" class="btn btn-danger reject-guest" data-eventid="'.$event_id.'">Reject</button></td>';
				endif;
				$guest_request_table_body.='</tr>';
			endwhile;
			return $guest_request_table_body;
		else :
			return("Sorry, No data found for your Request");
		endif;
	}

	function send_invitation_mail() {
		require_once(__DIR__.'/vendor/mandrill/mandrill/src/Mandrill.php');
		$event_id=$_POST['event_id'];
		$approved_guest_post_args=array(
			'post_type' => 'guest',
			'category_name'=>'approved',
			'posts_per_page' => -1
		);
		$event_post_args=array(
			'post_type' => 'event',
			'ID'=>$event_id,
			'posts_per_page' => -1
		);
		$event_query = new WP_Query($event_post_args);
		$guests_query= new WP_Query($approved_guest_post_args);
		if( $event_query->have_posts() ) :
			if($guests_query->have_posts() ) :
				while( $event_query->have_posts() ) :
					$event_query->the_post();
					$event_name=get_the_title();
					$event_theme=get_field('theme');
					$event_date=get_field('date');
					$event_venue=get_field('venue');
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
				endwhile;
			endif;
		endif;
		var_dump($recipients);
		$template_name = 'Invitation';
		$template_content = '';
		$message = array(
			'subject' => 'Invitation for '.$event_name,
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
					'content' => $event_name
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
		var_dump($result);
		wp_die();
	}
	add_action( 'wp_ajax_send_invitation_mail', 'send_invitation_mail' );

	function request_approved_mail($guest_id){
        require_once(__DIR__.'/vendor/mandrill/mandrill/src/Mandrill.php');
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
        $template_name = 'Approved';
        $template_content = '';
        $message = array(
            'subject' => 'Request Accepted',
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
        var_dump($result);
        wp_die();
    }
?>