<?php 
	/*
	Plugin Name: Attendance
	Description: Plugin for displaying Guests Status according to Events
	Version: 1.0
	*/
	add_action('admin_menu','attendance_page');
	add_action('admin_enqueue_scripts','cc_plugin_scripts');
	add_action('admin_enqueue_scripts','cc_plugin_styles');
	add_action('admin_enqueue_scripts','requested_guest_body');
	add_action('admin_enqueue_scripts','requested_guest_header');
	add_action('admin_enqueue_scripts','requested_guest_footer');
	add_action('admin_enqueue_scripts','invited_guest_body');
	add_action('admin_enqueue_scripts','invited_guest_header');
	add_action('admin_enqueue_scripts','invited_guest_footer');

	function attendance_page()
	{
		add_menu_page('Attendance','Attendance','manage_options','attendance','attendance');
	}

	function attendance()
	{
		require_once('show-guest-details.php');
	}
	
	function cc_plugin_scripts($hook){
		if($hook != 'toplevel_page_attendance') {
			return;
		}
		wp_enqueue_script('cc-bootstrap4-script', get_template_directory_uri().'/dist/lib/js/bootstrap4.min.js', array('jquery'), '1.0.0', true);
		wp_enqueue_script('cc-bootstrap-tether','https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js');
		wp_enqueue_script('cc-fontawesome-icons','https://use.fontawesome.com/ffc2c94a85.js');
		wp_enqueue_script('main', get_template_directory_uri().'/main.js', array('jquery'), '1.0.0', true);
		wp_localize_script( 'main', 'PARAMS', array('ajaxurl' => admin_url('admin-ajax.php')) );
	}
	
	function cc_plugin_styles($hook){
		if($hook != 'toplevel_page_attendance'){
			return;
		} 
		wp_enqueue_style('cc-bootstrap4-style', get_template_directory_uri().'/dist/lib/css/bootstrap4.min.css');
		wp_enqueue_style('cc-fonts','https://fonts.googleapis.com/css?family=Oswald|Marcellus+SC|Roboto|Open+Sans');
		wp_enqueue_style('style', get_template_directory_uri().'/style.css');
	}
	 
	function show_guest_tables(){
		if(isset($_POST['attendance_event_id'])){
			$event_id=$_POST['attendance_event_id'];
			$invited_guest_table=invited_guest_body($event_id);
			$guest_requests_table=requested_guest_body($event_id);
			echo $invited_guest_table;
			echo $guest_requests_table;
		}
		wp_die();
	}
	add_action('wp_ajax_show_guest_tables','show_guest_tables');
	add_action('wp_ajax_nopriv_show_guest_tables','show_guest_tables');

	function show_approved_guests(){
		{
			$all_guest_post_args=array(
				'post_type' => 'guest',
				'category_name' => 'approved'
				);
			$all_guest_query = new WP_Query($all_guest_post_args);
			$table_allguests_header='';
			$table_allguests_body='';
			$table_allguests_footer='';
			$table_allguests_header.='<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12">
											<div class="table-headings">Your Guest List</div><br>
												<table class="table">
													<thead>
														<tr>
															<th>Name</th>
															<th>Email</th>
															<th>Phone No.</th>
															<th>Gender</th>
															<th>Category</th>
															</tr>
														</thead>
													<tbody>';
			echo $table_allguests_header;
			if ($all_guest_query->have_posts()){    
				while($all_guest_query->have_posts()){
				$all_guest_query->the_post();
				$phone=get_field('phone');
				$name=get_the_title();
				$email=get_field('email');
				$cat=get_the_category()[0]->cat_name;
				$gender=get_field('gender');
				$table_allguests_body.='<tr class="table-success">
											<td class="capitalize">'.$name.'</td>
											<td>'.$email.'</td>
											<td>'.$phone.'</td>
											<td class="capitalize">'.$gender.'</td>
											<td class="capitalize">'.$cat.'</td>
										</tr>';
				}
				echo $table_allguests_body;
			}
			$table_allguests_footer.='</tbody>
								</table>
							</div>
						</div>';
			echo $table_allguests_footer;
		}
		wp_die();
	}
	add_action('wp_ajax_show_approved_guests','show_approved_guests');
	add_action('wp_ajax_nopriv_show_approved_guests','show_approved_guests');            

	function approve_guests(){
		if(isset($_POST['approve_guest_id'])){
			$guest_id=$_POST['approve_guest_id'];
			update_post_meta($guest_id,'status','confirm');
			wp_set_post_categories($guest_id,array(2));
		}
		wp_die();
	}
	add_action('wp_ajax_approve_guests','approve_guests');
	add_action('wp_ajax_nopriv_approve_guests','approve_guests');          


	function reject_guests(){
		if(isset($_POST['reject_guest_id'])){
			$guest_id=$_POST['reject_guest_id'];
			var_dump($guest_id);
			wp_set_post_categories($guest_id,array(3));
		}
		wp_die();
	}
	add_action('wp_ajax_reject_guests','reject_guests');
	add_action('wp_ajax_nopriv_reject_guests','reject_guests');

	function invited_guest_header()
	{
		$table_invitee_header='';
		$table_invitee_header.='<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12">
										<div class="table-headings">Invited Guests</div><br>
											<table class="table">
												<thead>
													<tr>
														<th>Name</th>
														<th>Email</th>
														<th>Phone No.</th>
														<th>Gender</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>';
		return $table_invitee_header;
	}


	function invited_guest_body($event_id)
	{
		$invited_guest_post_args=array(
					'post_type' => 'guest',
					'meta_key'=>'event_id',
					'meta_value'=>$event_id,
					'category_name'=>'approved'
				);
		$invited_guest_query = new WP_Query($invited_guest_post_args);
		if ($invited_guest_query->have_posts()){    
			$table_invitee_body=invited_guest_header();
			while($invited_guest_query->have_posts()){
				$invited_guest_query->the_post();
				$phone=get_field('phone');
				$name=get_the_title();
				$email=get_field('email');
				$status=get_field('status');
				$gender=get_field('gender');
				$table_invitee_body.=  '<tr class="table-success">
											<td class="capitalize">'.$name.'</td>
											<td>'.$email.'</td>
											<td>'.$phone.'</td>
											<td class="capitalize">'.$gender.'</td>
											<td class="capitalize"><span class="label label-primary">'.$status.'</span></td>
										</tr>';
			}
			$table_invitee_body.=invited_guest_footer();
			return $table_invitee_body;
		}			
	}

	function invited_guest_footer()
	{
		$table_invitee_footer='';
		$table_invitee_footer.='</tbody>
							</table>
						</div>
					</div>';
		return $table_invitee_footer;
	}

	function requested_guest_header()
	{
		$table_requested_header='';
		$table_requested_header.='<br><br><hr>
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12">
											<div class="table-headings">Guest Requests</div><br>
												<table class="table">
													<thead>
														<tr>
															<th>Name</th>
															<th>Email</th>
															<th>Status</th>
															<th>Action</th>
														</tr>
													</thead>
												<tbody>';
		return $table_requested_header;
	}

	function requested_guest_body($event_id)
	{
		$requested_guest_post_args=array(
				'post_type' => 'guest',
				'meta_key'=>'event_id',
				'meta_value'=>$event_id,
				'category_name'=>'waiting',
				);
		$requested_guest_query = new WP_Query($requested_guest_post_args);
		if ($requested_guest_query->have_posts()){
			$table_requested_body=requested_guest_header();
			while($requested_guest_query->have_posts()){
				$requested_guest_query->the_post();
				$name=get_the_title();
				$guest_id=get_the_ID();
				$email=get_field('email');
				$cat=get_the_category();
				$table_requested_body.=	'<tr class="table-success">
											<td class="capitalize">'.$name.'</td>
											<td>'.$email.'</td>
											<td class="capitalize">'.$cat.'</td>
											<td><button type="button" name="add" data-id="'.$guest_id.'" class="btn btn-success approve-guest" value="'.$event_id.'">Approve</button>&nbsp;&nbsp;<button type="button" name="reject" data-id="'.$guest_id.'" class="btn btn-danger reject-guest" value="'.$event_id.'">Reject</button></td>
										</tr>';
			}
			$table_requested_body.=requested_guest_footer();
			return $table_requested_body;
		}			
	}

	function requested_guest_footer()
	{
		$table_requested_footer='';
		$table_requested_footer.='</tbody>
								</table>
							</div>
						</div>';	
		return $table_requested_footer;
	}

?>