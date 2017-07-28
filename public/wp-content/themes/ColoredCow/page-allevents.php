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
            $currentdate=date('Y-m-d');
          	$args=array(
                'post_type' => 'event',
                'meta_key'  => 'date',
                'orderby'   => 'meta_value',
                'order'     => 'ASC'
            );
            $event_query = new WP_Query($args);
            get_template_part('templates/content','requestmodal');
            if ( $event_query->have_posts() ) :
                while( $event_query->have_posts() ) :
                    $event_query->the_post();
                    $date=get_field('date');
                    if($date>$currentdate) :
                        $content=get_the_title();
                        $id=get_the_ID();
                        $venue=get_field('venue');
                        $theme=get_field('theme');        
        ?>
                        <div class="row">
                            <div class="col-sm-12 col-lg-8 col-md-8 all-events">
                                <div class="all-events-name"><?php echo $content ?></div>
                                <div class="all-themes"><?php echo $theme?></div><br>
                                <div class="all-events-date"><i class='fa fa-calendar'  aria-hidden='true'></i>&nbsp;<?php echo date('l, jS F, Y', strtotime($date));?>
                                </div>
                                <br> 
                                <div class="all-events-venue"><i class='fa fa-map-marker fa-lg' aria-hidden='true'></i>&nbsp;<?php echo $venue ?>
                                </div>
                                <br>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 event-button">
                                <a role="button" class="btn btn-warning btn-lg btn-block request-button" data-toggle="modal" data-target="#request-modal" data-whatever="@mdo" data-id="<?php echo $id ?>">Request Invite
                                </a>
                            </div>
                        </div>
                        <hr>
        <?php 
                    endif;
                endwhile;
            endif;    
        ?>
    </div>
</body>
<?php 
    get_footer(); 
?>