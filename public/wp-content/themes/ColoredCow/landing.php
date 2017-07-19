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
					<hr>
				<h3 class="request-text">Wanna join the party?</h3>
					<button type="button" class="btn btn-outline-warning btn-lg btn-block" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Request Invite
					</button>
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

		<div class="modal fade" id="exampleModal" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">&nbsp;&nbsp;New Request</h3>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form id="request_form">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="col-lg-12">
                     	        	<label for="recipient-name" class="form-control-label">
                                    	<div>Your Name:</div>
                        	        </label>
                                    <input type="text" class="form-control" placeholder="Full Name" name="request_name" id="request_name" maxlength="30" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12">
                                	<label for="recipient-name" class="form-control-label">
                                    	<div>Your Email:</div>
                                	</label>
                                    <input type="email" class="form-control" placeholder="someone@example.com" name="request_emailid" id="request_emailid" maxlength="30" required>
                                </div>
                            </div>
                            <div class="form-group">
                    	        <div class="col-lg-12">
	                    	        <label for="recipient-number" class="form-control-label">
	                                    <div>Mobile Number:</div>
	                                </label>
                                    <input type="number" class="form-control"  placeholder="10 digit mobile no." name="phonenumber" id="phonenumber" max="9999999999" required>
                                </div>
                            </div>  
                            <div class="form-group">
                                <div class="col-lg-12">
                                	<label for="recipient-name" class="form-control-label">
                                    	<div>Gender:</div>
                                	</label>
                                	<label class="custom-control custom-radio">
                                    	<input name="request_gender" value="Male" type="radio" class="custom-control-input" required>
                                    	<span class="custom-control-indicator"></span>
                                    	<span class="custom-control-description">Male</span>
                                	</label>
                                	<label class="custom-control custom-radio">
                                    	<input name="request_gender" value="Female" type="radio" class="custom-control-input" required>
                                    	<span class="custom-control-indicator"></span>
                                    	<span class="custom-control-description">Female</span>
                                	</label>
                                </div>
                            </div>
	                    </div>
	                    <div class="modal-footer">
	                        <button type="button" class="btn btn-primary"  id="submit_request">Request</button>
	                    </div>
                    </form> 
                </div>
            </div>
        </div>
	</div>
	<hr>
</body>
<?php 
    get_footer(); 
?>