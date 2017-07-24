<?php

/**
 * Template Name: Landing
 */

   	get_header();

   	$currentdate=date('Y-m-d');
   	$posts = get_posts(array(
			'post_type'	=> 'event',
			'meta_key'	=> 'date',
			'orderby'	=> 'meta_value',
			'order'		=> 'ASC'
	));
	get_template_part('templates/content','requestmodal');
	foreach ($posts as $post) {
		$id=$post->ID;
		$content=$post->post_title;
		$value=get_post_meta($id);
		$date=$value['date'][0];
		$venue=$value['venue'][0];
		$theme=$value['theme'][0];
   		if($date>$currentdate){
			break;
		}
	}
?>
<body class="main-body">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-6 col-lg-6 about">
				<div class="soiree">Soiree</div>
					<br>
						<p class="soiree-description" >ColoredCow celebrates every first Saturday of the month with family and friends. This custom has been started to take a little time off from work and enjoy some moments in life. we believe in sharing moments and learning with each other. Come and join us over music, food, drinks and some moments full of laughter and joy.</p>
					<hr>
				<div class="request-text">Wanna join the party?</div>
				<br>
					<a role="button" class="btn btn-warning btn-lg btn-block request-button" data-toggle="modal" data-target="#request-modal" data-whatever="@mdo" data-id="<?php echo $id ?>">Request Invite
					</a>
			</div>
			<div class="col-sm-12 col-lg-6 col-md-6 latest-events">	
				<div class="event-name"><?php echo $content ?></div>
				<div class="theme"><?php echo $theme ?></div><br>
	        	<div class="date"><i class='fa fa-calendar'  aria-hidden='true'></i>&nbsp;<?php echo date('l, jS F, Y', strtotime($date));?></div><br> 
		        <div class="venue"><i class='fa fa-map-marker fa-lg' aria-hidden='true'></i>&nbsp;<?php echo $venue ?></div>
		    </div>
		</div>
		<hr>
		<div class="container carousel-section">
			<div class="carousel-head"><i class="fa fa-camera-retro fa-1x"></i>&nbsp;Event Gallery</div>
			<br>
			<div id="carousel-indicators" class="carousel slide"  data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#carousel-indicators" data-slide-to="0" class="active"></li>
					<li data-target="#carousel-indicators" data-slide-to="1"></li>
					<li data-target="#carousel-indicators" data-slide-to="2"></li>
					<li data-target="#carousel-indicators" data-slide-to="3"></li>
				</ol>
				<div class="carousel-inner" role="listbox">
					<div class="carousel-item active">
					  	<img class="d-block img-fluid images_carousel" src="<?php echo esc_url(get_template_directory_uri().'/rsvp_images/soiree1.jpg');?>" alt="First slide">
					  	<div class="carousel-caption d-none d-md-block">
							<p class="carousel-head">#SOIREE 1</p>  
					  	</div>
					</div>
					<div class="carousel-item">
					  	<img class="d-block img-fluid images_carousel" src="<?php echo esc_url(get_template_directory_uri().'/rsvp_images/soiree2.jpg');?>" alt="Second slide">
					  	<div class="carousel-caption d-none d-md-block">
							<p class="carousel-head">#SOIREE 2</p>  
					  	</div>
					</div>
					<div class="carousel-item">
					  	<img class="d-block img-fluid images_carousel" src="<?php echo esc_url(get_template_directory_uri().'/rsvp_images/soiree4.jpg');?>" alt="third slide">
					  	<div class="carousel-caption d-none d-md-block">
							<p class="carousel-head">#SOIREE 3</p>  
					  	</div>
					</div>
					<div class="carousel-item">
					  	<img class="d-block img-fluid images_carousel" src="<?php echo esc_url(get_template_directory_uri().'/rsvp_images/soiree5.jpg');?>" alt="fourth slide">
					  	<div class="carousel-caption d-none d-md-block">
							<p class="carousel-head">#SOIREE 4</p>  
					  	</div>
					</div>					
				</div>
					<a class="carousel-control-prev" href="#carousel-indicators" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carousel-indicators" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
			</div>
			<br>
		</div>	
	</div>
	<hr>
</body>
<?php 
    get_footer(); 
?>