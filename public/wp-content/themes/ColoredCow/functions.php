<?php

if ( ! function_exists( 'cc_scripts' ) ) {
    function cc_scripts() {
        wp_enqueue_script('cc-bootstrap4-script', get_template_directory_uri().'/dist/lib/js/bootstrap4.min.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('cc-bootstrap-tether','https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js');
        wp_enqueue_script('cc-fontawesome-icons','https://use.fontawesome.com/ffc2c94a85.js');
        wp_enqueue_script('main', get_template_directory_uri().'/main.js', array('jquery', 'cc-bootstrap'), '1.0.0', true);
    }
    add_action('wp_enqueue_scripts','cc_scripts');
}

if ( ! function_exists( 'cc_styles' ) ) {
    function cc_styles() { 
        wp_enqueue_style('cc-bootstrap4-style', get_template_directory_uri().'/dist/lib/css/bootstrap4.min.css');
        wp_enqueue_style('cc-fonts','https://fonts.googleapis.com/css?family=Oswald|Marcellus+SC|Roboto|Open+Sans');
        wp_enqueue_style('style', get_template_directory_uri().'/style.css');
   }
    add_action('wp_enqueue_scripts','cc_styles');
}
    //add filter to remove margin above html
    add_filter('show_admin_bar','__return_false');
?>