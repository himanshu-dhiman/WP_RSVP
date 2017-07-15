<?php

if ( ! function_exists( 'cc_scripts' ) ) {
    function cc_scripts() {
        wp_enqueue_script('cc-bootstrap-script','https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js');
<<<<<<< HEAD
        wp_enqueue_script('cc-custom-fontawesome','https://use.fontawesome.com/ffc2c94a85.js');
=======
        wp_enqueue_script('cc-fontawesome-icons','https://use.fontawesome.com/ffc2c94a85.js');
>>>>>>> e0cf29a4c300ffe387f52604c7d21b1ab3c420c2
        wp_enqueue_script('cc-jquery-script','https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
        wp_localize_script( 'main', 'PARAMS', array('ajaxurl' => admin_url('admin-ajax.php')) );

   }
    add_action('wp_enqueue_scripts','cc_scripts');
}

if ( ! function_exists( 'cc_styles' ) ) {
    function cc_styles() {  
        wp_enqueue_style('cc-bootstrap-css','https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css');
<<<<<<< HEAD
        wp_enqueue_style('cc-custom-font1','https://fonts.googleapis.com/css?family=Oswald');
        wp_enqueue_style('cc-custom-font2','https://fonts.googleapis.com/css?family=Marcellus SC');
        wp_enqueue_style('cc-custom-font3','https://fonts.googleapis.com/css?family=Roboto');
        wp_enqueue_style('style', get_template_directory_uri().'/style.css');

       

=======
        wp_enqueue_style('cc-font-oswald','https://fonts.googleapis.com/css?family=Oswald');
        wp_enqueue_style('cc-font-marcellus-sc','https://fonts.googleapis.com/css?family=Marcellus SC');
        wp_enqueue_style('cc-font-roboto','https://fonts.googleapis.com/css?family=Roboto');
        wp_enqueue_style('cc-font-open-sans','https://fonts.googleapis.com/css?family=Open Sans');
        wp_enqueue_style('style', get_template_directory_uri().'/style.css');
>>>>>>> e0cf29a4c300ffe387f52604c7d21b1ab3c420c2
   }
    add_action('wp_enqueue_scripts','cc_styles');
}

//add filter to remove margin above html
add_filter('show_admin_bar','__return_false');

<<<<<<< HEAD


=======
>>>>>>> e0cf29a4c300ffe387f52604c7d21b1ab3c420c2
?>