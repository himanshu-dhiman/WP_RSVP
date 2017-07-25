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
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12">
					<button class="btn btn-block btn-primary show-all-guests" type="button">See All Guests</button>
  			</div>
			&nbsp;&nbsp;<b>OR</b>&nbsp;&nbsp;
			<div class="col-lg-4 col-md-4 col-sm-12">
				<div class="dropdown">
  					<button class="btn btn-block btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select Event</button>
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
		</div>
		<br><br>
		<div class="tables"></div>
	</div>
</body>