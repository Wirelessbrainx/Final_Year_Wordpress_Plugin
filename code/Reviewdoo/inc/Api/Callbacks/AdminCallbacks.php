<?php

/*
    @package Reviewdoo
 * @author Oliver Grimes <og55@kent.ac.uk>
 */

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;


class AdminCallbacks extends BaseController
{
    public function adminDashboard(){
        return require_once("$this->plugin_path/templates/admin.php");
    }
    
    public function manageReviewTaxonomies(){
        return require_once("$this->plugin_path/templates/AdminReviewTaxonomy.php");
    }
    
    public function manageOptions(){
        return require_once("$this->plugin_path/templates/adminOptions.php");
    }
    
    public function manageShortcodes(){
        return require_once("$this->plugin_path/templates/adminShortcodes.php");
    }
    
    public function manageTheme(){
        return require_once("$this->plugin_path/templates/adminTheme.php");
    }
    
    public function reviewdooOptionsGroup($input) {
        return $input;
    }

    public function reviewdooAdminSection() {
        echo 'Check this beautiful section!';
    }

    public function reviewdooTextExample() {
        $value = esc_attr(get_option('first_dropdown'));
        echo '<select class="regular-text" name="first_dropdown" value="' . $value . '" placeholder="Please Select Something"><option></option></select>'; 
        //'<input type="text" class="regular-text" name="text_example" value="' . $value . '" placeholder="Write Something Here!">';
    }

    public function reviewdooFirstName() {
        $value = esc_attr(get_option('first_name'));
        echo '<input type="text" class="regular-text" name="first_name" value="' . $value . '" placeholder="Write your First Name">';
    }

}