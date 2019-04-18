<?php

/*
    @package Reviewdoo
 * @author Oliver Grimes <og55@kent.ac.uk>
 */

namespace Inc\Base;
use Inc\Database\DBCreation;

class Activate
{
    
    
    public static function activate() {
        
        flush_rewrite_rules();
        do_action('createTables');
        do_action('addData');
        do_action('addUserData');
        
    }
    
}