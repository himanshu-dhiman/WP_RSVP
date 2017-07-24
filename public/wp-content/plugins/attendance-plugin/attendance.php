<?php 
    /*
    Plugin Name: Attendance
    Description: Plugin for displaying Guests Status according to Events
    Version: 1.0
    */

add_action('admin_menu','hello_world');
add_action('admin_enqueue_scripts','cc_plugin_scripts');
add_action('admin_enqueue_scripts','cc_plugin_styles');

function hello_world()
{
	add_menu_page('Attendance','Attendance','manage_options','attendance','attendance');
}

function attendance()
{
	require_once('show-guest-details.php');
}
function cc_plugin_scripts($hook) {
		if($hook != 'toplevel_page_attendance') {
                return;
        }
        wp_enqueue_script('cc-bootstrap4-script', get_template_directory_uri().'/dist/lib/js/bootstrap4.min.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('cc-bootstrap-tether','https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js');
        wp_enqueue_script('cc-fontawesome-icons','https://use.fontawesome.com/ffc2c94a85.js');
   }
 function cc_plugin_styles($hook) {
 		if($hook != 'toplevel_page_attendance') {
                return;
        } 
        wp_enqueue_style('cc-bootstrap4-style', get_template_directory_uri().'/dist/lib/css/bootstrap4.min.css');
        wp_enqueue_style('cc-fonts','https://fonts.googleapis.com/css?family=Oswald|Marcellus+SC|Roboto|Open+Sans');
        wp_enqueue_style('style', get_template_directory_uri().'/style.css');
   }
 
?>