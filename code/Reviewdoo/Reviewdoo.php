<?php
   /*
   Plugin Name: Reviewdoo 
   Plugin URI: http://my-awesomeness-emporium.com
   description: A plugin that allows A website creator to define a taxonomy that will allow views of the website review 
   Version: 1.2
   Author: Oliver Grimes, Aaron Manning
   Author URI: 
   License: GPL2
   */
    
    defined('ABSPATH') or die('Where are you going?');
    
    if(file_exists(dirname(__FILE__).'/vendor/autoload.php')){
        require_once dirname(__FILE__).'/vendor/autoload.php';
    }
    
    use Inc\Base\Activate;
    use Inc\Base\Deactivate;
    
    function activate_reviewdoo_plugin(){
        Activate::activate();
    }
    register_activation_hook(__FILE__, 'activate_reviewdoo_plugin');
    
    function deactivate_reviewdoo_plugin(){
       Deactivate::deactivate();
    }
    register_deactivation_hook(__FILE__, 'deactivate_reviewdoo_plugin');
    
    if(class_exists('Inc\\Init')){
        Inc\Init::register_services();
    }