<?php

/**
 * Template Name: RSVP
 */

   	get_header('rsvp');
    $email=urldecode($_GET['email']);
    $guest_post_args=array(
            'post_type' => 'guest',
            'meta_key'=>'email',
            'meta_value'=>$email,
        );
    $guest_query = new WP_Query($guest_post_args);
    if ($guest_query->have_posts() ) :
        while($guest_query->have_posts() ) :
                $guest_query->the_post();
                $name=get_the_title();
                $guest_id=get_the_ID();
                $email=get_field('email');
                $phone=get_field('phone');
                update_post_meta( $guest_id, 'status', 'confirm' );
?>
<body class="main-body">
	<div class="container">
	<br>
        <div class="card-title text-center thank-you-text">Looking forward to see you at the event</div>
	<hr>
        <div class="guest-details text-center">
            <div><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo $name; ?>
            </div>
            <div><i class="fa fa-envelope-open-o" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo $email; ?></div>
            <div><i class="fa fa-mobile" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo $phone; ?></div>
            <hr>
            <a href="<?php echo home_url(); ?>" class="btn btn-success ">Visit Site</a>
        </div>
    </div>
</body>
<br>
<hr>
<?php
        endwhile;
    endif;
    get_footer(); 
?>