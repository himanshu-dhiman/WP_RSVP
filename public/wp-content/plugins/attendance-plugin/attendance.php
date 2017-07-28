<?php
	/*
	Plugin Name: Attendance
	Description: Plugin for displaying Guests Status according to Events
	Version: 1.0
	*/
	add_action( 'admin_menu','attendance_page' );
	add_action( 'admin_enqueue_scripts', 'cc_plugin_scripts' );
	add_action( 'admin_enqueue_scripts', 'cc_plugin_styles' );
	add_action( 'admin_enqueue_scripts', 'requested_guest_body' );
	add_action( 'admin_enqueue_scripts', 'invited_guest_body' );

	function attendance_page(){
		add_menu_page( 'Attendance', 'Attendance', 'manage_options', 'attendance', 'attendance' );
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

?>