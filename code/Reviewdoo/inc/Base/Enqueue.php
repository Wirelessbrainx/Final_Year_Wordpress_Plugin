<?php

/*
    @package Reviewdoo
 * @author Oliver Grimes <og55@kent.ac.uk>
 */

namespace Inc\Base;

use Inc\Base\BaseController;

class Enqueue extends BaseController{
    
    public function register()
    {
        add_action('admin_enqueue_scripts', array($this,'enqueue'));
    }
    
    function enqueue()
    {
        wp_enqueue_script( 'bootstrap-js', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), true);
        wp_enqueue_script('custom-script', $this->plugin_url.'Javascript/custom-javascript-script.js', __FILE__, '1.0.0', true );
        wp_enqueue_script( 'ajax-script', $this->plugin_url.'Javascript/custom-ajax-script.js', __FILE__ );
        wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));
        wp_enqueue_style('custom-style', $this->plugin_url.'css/custom-css-script.css', __FILE__);
        wp_register_style( 'Font_Awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
        wp_enqueue_style( 'bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
        wp_enqueue_style('Font_Awesome');
        
        
    }
}
