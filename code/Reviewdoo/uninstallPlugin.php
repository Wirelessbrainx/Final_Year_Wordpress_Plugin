<?php

/*
    @package Reviewdoo;
 */

if(!define('WP_UNINSTALL_PLUGIN')){ 
    die;
    
}
/* 
    Clear / Remove data inside the database;
 */
do_action('removeTables');

