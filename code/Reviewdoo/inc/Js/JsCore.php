<?php

/* 
 * Created by Aaron Manning, 2018
 */

namespace Inc\Js;

class JsCore {

    public function register(){

        // 'admin_enqueue_scripts' for Admin pages and 'login_enqueue_scripts' for the login page.
        add_action( 'wp_enqueue_scripts', array( $this, 'setup' ), 10); 
        add_filter('comments_template', array( $this, 'no_comments_on_page'),PHP_INT_MAX );
    }

    // replace default WP comment system
    function no_comments_on_page( $file )
    {
        $file = dirname( __FILE__ ) . '/empty-file.php';
        $file = plugins_url( "Reviewdoo/inc/Pages/comments-template.php");
        $file = dirname( __FILE__ ) . '/comments-template.php';
        return $file;
    }

    public function setup(){

        $name = 'rdJsCore';
        $url = plugins_url( 'Reviewdoo/javascript/rdJsCore.js');
        $dependencies = array(
            'jquery',
            'jquery-ui-core',
            'jquery-ui-sortable',
            'jquery-ui-slider',
            'jquery-ui-selectmenu',
            'jquery-touch-punch',
            'jquery-effects-core',
            'jquery-effects-bounce',
            'jquery-effects-slide',
            'jquery-ui-autocomplete',
            'jquery-ui-widget'
        );
        $version = null;
        $load_in_footer = true;

        // register the script with WP
        wp_register_script( $name, $url, $dependencies, $version, $load_in_footer );

        // load the script
        wp_enqueue_script( $name );

        // css
        wp_register_style( 'jquery-ui-css', 'http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', false, NULL, 'all', true );
        wp_enqueue_style( 'jquery-ui-css' );
        wp_enqueue_style( 'dashicons' );
        wp_enqueue_style('rdJsCoreStyle', plugins_url( 'Reviewdoo/css/rdJsCore.css'), 'dashicons');
    } 
}
