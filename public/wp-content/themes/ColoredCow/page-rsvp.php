<?php

/**
 * Template Name: RSVP
 */

   	get_header('rsvp');
?>
<body>
	<div class="container">
	<br>
        <div class="card-title text-center thank-you-text">Looking forward to see you at the event.</div>
	<hr>
        <div class="guest-details text-center">
            <div><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;Himanshu Dhiman
            </div>
            <div><i class="fa fa-envelope-open-o" aria-hidden="true"></i>&nbsp;&nbsp;himanshu@coloredcow.in</div>
            <div><i class="fa fa-mobile" aria-hidden="true"></i>&nbsp;&nbsp;+91-9808014227</div>
            <hr>
            <a href="<?php echo home_url(); ?>" class="btn btn-success btn-lg ">Confirm Your Presence</a>
        </div>
    </div>
</body>
<br>
<hr>
<?php 
    get_footer(); 
?>