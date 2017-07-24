<?php

/**
 * Template Name: All-Events
 */

    get_header();
    get_template_part('templates/content','requestmodal');
?>
<body class="main-body">
    <div class="container">
        <?php
          	$posts = get_posts(array(
                      	'post_type'	 => 'event',
                        'meta_key'   => 'date',
                        'orderby'    => 'meta_value',
                      	'order'      => 'ASC'
                    ));
                    $currentdate=date('Y-m-d');

            foreach ($posts as $post) {
        	$id=$post->ID;
        	$content=$post->post_title;
        	$value=get_post_meta($id);
        	$date=$value['date'][0];
        	$venue=$value['venue'][0];
        	$theme=$value['theme'][0];
            if($date>$currentdate){
            ?>
                <div class="row">
                    <div class="col-sm-12 col-lg-8 col-md-8 all-events">
                        <div class="all-events-name"><?php echo $content ?></div>
                        <div class="all-themes"><?php echo $theme?></div><br>
                        <div class="all-events-date"><i class='fa fa-calendar'  aria-hidden='true'></i>&nbsp;<?php echo date('l, jS F, Y', strtotime($date));?></div><br> 
                    <div class="all-events-venue"><i class='fa fa-map-marker fa-lg' aria-hidden='true'></i>&nbsp;<?php echo $venue ?></div>
                    <br>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 event-button">
                    <a role="button" class="btn btn-warning btn-lg btn-block request-button" data-toggle="modal" data-target="#request-modal" data-whatever="@mdo" data-id="<?php echo $id ?>">Request Invite
                    </a>
                </div>
            </div>
            <hr>
            <?php 
            }
        }
        ?>
    </div>
</body>
<?php 
    get_footer(); 
?>