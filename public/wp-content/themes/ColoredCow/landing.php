<?php

/**
 * Template Name: Landing
 */

   	get_header();
?>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-6 col-lg-6 about">
				<h5 class="soiree">Soiree</h5>
					<br>
						<p class="soiree-description" >ColoredCow celebrates every first Saturday of the month with family and friends. This custom has been started to take a little time off from work and enjoy some moments in life. we believe in sharing moments and learning with each other. Come and join us over music, food, drinks and some moments full of laughter and joy.</p>
			</div>
			<div class="col-sm-12 col-lg-6 col-md-6 latest-events">
				<span class="theme">Theme</span><br> <br>
		        <span class="icon"><i class='fa fa-calendar'  aria-hidden='true'></i>&nbsp;Date</span><br><br> 
		        <span class="icon"><i class='fa fa-map-marker fa-lg' aria-hidden='true'></i>&nbsp;Venue</span>
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