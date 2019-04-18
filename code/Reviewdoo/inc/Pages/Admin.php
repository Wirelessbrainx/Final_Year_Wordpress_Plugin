<?php
/*
    @package Reviewdoo
 * @author Oliver Grimes <og55@kent.ac.uk>
 */

namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use\Inc\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController
{
    public $settings;
    public $callbacks;
    public $pages = array();
    public $subpages = array();
    

    public function register(){
        
        $this->settings = new SettingsApi();
        $this->callbacks = new AdminCallbacks();
        $this->setPages();
        $this->setSubPages();
        $this->setSettings();
        $this->setSections();
        $this->setFields();
        $this->settings->AddPages($this->pages)->withSubPages("Manage Review Taxonomies")->addSubPages($this->subpages)->register();
    }

    public function setPages() {
        $this->pages = array(
            array(
                'page_title' => 'Reviewdoo Plugin',
                'menu_title' => 'Reviewdoo',
                'capability' => 'manage_options',
                'menu_slug' => 'reviewdoo_plugin',
                'callback' => array($this->callbacks, 'adminDashboard'),
                'icon_url' => 'dashicons-store',
                'position' => 110
            )
        );
    }

    public function setSubpages() {
        $this->subpages = array(
            array(
                'parent_slug' => 'reviewdoo_plugin',
                'page_title' => 'Options',
                'menu_title' => 'Options',
                'capability' => 'manage_options',
                'menu_slug' => 'Reviewdoo_sub_menu_2',
                'callback' => array($this->callbacks, 'manageOptions')
            ),
            array(
                'parent_slug' => 'reviewdoo_plugin',
                'page_title' => 'Theme',
                'menu_title' => 'Theme',
                'capability' => 'manage_options',
                'menu_slug' => 'Reviewdoo_sub_menu_3',
                'callback' => array($this->callbacks, 'manageTheme')
            ),
            array(
                'parent_slug' => 'reviewdoo_plugin',
                'page_title' => 'Shortcodes',
                'menu_title' => 'Shortcodes',
                'capability' => 'manage_options',
                'menu_slug' => 'Reviewdoo_sub_menu_4',
                'callback' => array($this->callbacks, 'manageShortcodes')
            )
            
        );
    }

    public function setSettings() {
        $args = array(
            array(
                'option_group' => 'Reviewdoo_Manage_Review_Taxonomies',
                'option_name' => 'Label for Dropdown',
                'callback' => array($this->callbacks, 'reviewdooOptionsGroup')
            ),
            array(
                'option_group' => 'Reviewdoo_Manage_Review_Taxonomies',
                'option_name' => 'Label for Dropdown',
                'callback' => array($this->callbacks, 'reviewdooOptionsGroup')
            )
        );
        $this->settings->setSettings($args);
    }

    public function setSections() {
        $args = array(
            array(
                'id' => 'reviewdoo_admin_MRT',
                'title' => 'Manage Review Taxonomies',
                'callback' => array($this->callbacks, 'reviewdooAdminSection'),
                'page' => 'reviewdoo_plugin'
            )
        );
        $this->settings->setSections($args);
    }

    public function setFields() {
        $args = array(
            array(
                'id' => 'First Dropdown',
                'title' => 'First Dropdown', 
                'callback' => array($this->callbacks, 'reviewdooTextExample'),
                'page' => 'reviewdoo_plugin',
                'section' => 'reviewdoo_admin_MRT',
                'args' => array(
                    'label_for' => 'First Dropdown',
                    'class' => 'first_dropdown'
                )
            ),
            array(
                'id' => 'Second Dropdown',
                'title' => 'Second Dropdown', 
                'callback' => array($this->callbacks, 'reviewdooTextExample'),
                'page' => 'reviewdoo_plugin',
                'section' => 'reviewdoo_admin_MRT',
                'args' => array(
                    'label_for' => 'Second Dropdown',
                    'class' => 'second_dropdown'
                )
            ),
        );
        $this->settings->setFields($args);
    }

    
}