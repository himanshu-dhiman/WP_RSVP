<?php

/**
 * Template Name: RSVP
 */

   	get_header('rsvp');
?>
<body>
	<div class="container">
	<br>
	<div class="card-title text-center thank-you-text">You've Confirmed your presence, Thank You! Looking forward to see you at the event.</div>
	<hr>
        <div class="guest-details text-center">
            <div><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;Himanshu Dhiman
            </div>
            <div><i class="fa fa-envelope-open-o" aria-hidden="true"></i>&nbsp;&nbsp;himanshu@coloredcow.in</div>
            <div><i class="fa fa-mobile" aria-hidden="true"></i>&nbsp;&nbsp;+91-9808014227</div>
            <br>
            <a role="button" class="btn btn-lg btn-success" href="<?php echo home_url();?>">Confirm</a>
        </div>
    </div>
</body>
<br>
<hr>
<?php 
    get_footer(); 
?>