<?php

/*
 *  @package Reviewdoo
 * @author Oliver Grimes <og55@kent.ac.uk>
 */
namespace Inc\Base;
use Inc\Database\DBCreation;

class Deactivate
{
    public static function deactivate() {
       
        flush_rewrite_rules();
         do_action('removeTables');
    }
}