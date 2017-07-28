<?php
$event_post_args=array(
	    'post_type' => 'event',
	    'meta_key'  => 'date',
	    'orderby'   => 'meta_value',
	    'order'     => 'ASC'
	);
	$event_query = new WP_Query($event_post_args);
	?>
<body class="attendance-body">
	<div class="container">
		<br>
		<div class="guest-details-heading">Guest Details</div>
		<div class="guest-details-description">Here, you can see the Guest details of the guests you've approved or the Guest Attendance lists for each Event at once.</div><hr>
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12">
				<div class="dropdown">
  					<button class="btn btn-block btn-lg btn-primary dropdown-toggle" type="button" data-toggle="dropdown">See Guest List for Event</button>
  					<div class="dropdown-menu" aria-labelledby="dropdown-menu-button">
  						<?php 
  							if ($event_query->have_posts()){
				                while($event_query->have_posts()){
				                $event_query->the_post();
				                $event_id=get_the_ID();
				        ?>
    					<a class="dropdown-item" href="#" data-id="<?php echo $event_id; ?>"><?php echo get_the_title(); ?></a>
  						<? 
  						}
  						} 
  						?>
  					</div>
				</div>
			</div>
			&nbsp;&nbsp;<b>OR</b>&nbsp;&nbsp;
			<div class="col-lg-4 col-md-4 col-sm-12">
					<button class="btn btn-block btn-lg btn-primary show-all-guests" type="button">Your Guest List</button>
  			</div>
				
		</div>
		<br><br>
		<div id="tables">
			<div id="all-guests-table">
				<?php
					require('views/all-guest-table-header.php');	
					require('views/guest-table-footer.php');
				?>
			</div>
			<div id="invited-guests-table">	
				<?php
					require('views/invited-guest-table-header.php');
					require('views/guest-table-footer.php');
				?>
			</div>
			<div id="guest-request-table">
				<?php
					require('views/guest-request-table-header.php');
					require('views/guest-table-footer.php');
				?>
			</div>
		</div>
	</div>
</body>