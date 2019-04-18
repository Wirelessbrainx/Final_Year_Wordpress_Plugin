<?php

/*
    @package Reviewdoo
 * @author Oliver Grimes <og55@kent.ac.uk>
 */


namespace Inc\Database;
use Inc\TaxonomyTree\Node;
use Inc\Database\JsonCreation;

class DatabaseAPI{
    private $wpdb;
    private $tree;
    //private $rd_prefix = 'rd_';
    //public $wpdb = global $wpdb;
    
    public function __construct(){
        global $wpdb;
        $this->wpdb = $wpdb;
        
    }
    
    public function register(){
        
        add_action('wp_ajax_AddTemplateTaxonomy',array($this,'addTemplateData'));
         add_action('wp_ajax_getCategories', array($this,'getCategories'));
         add_action('wp_ajax_displayTaxonomy', array($this,'displayTaxonomy'));
         add_action('addData',array($this,'addTemplateData'));
         add_action('addUserData',array($this, 'add_User_Data'));
         add_action('wp_ajax_getNodeWeighting',array($this,'getNodeWeighting'));
         add_action('admin_post_taxonomy_save', array($this,'taxonomy_save'));
         add_action('admin_post_Category_save', array($this,'categories_save'));
         
         add_action('admin_post_edit_Node', array($this,'EditNode'));
         
         add_action('wp_ajax_DeleteTaxo',array($this,'deleteTaxo'));
         add_action('wp_ajax_DeleteCategory',array($this,'deleteCategory'));
         add_action('wp_ajax_DeleteNode',array($this,'deleteNode'));
    }
    
    public function add_User_Data() {
        $getTaxo = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxos WHERE name = %s", 'example'));
        $get_catID1 = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_categories WHERE name = %s", 'No Category'));
        $get_catID2 = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_categories WHERE name = %s", 'Photography'));
        $get_catID3 = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_categories WHERE name = %s", 'Gaming'));
        $get_catID4 = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_categories WHERE name = %s", 'MultiMedia'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 1, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 100, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 2, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 30, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 3, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 50, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 4, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 80, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 5, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 100, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 6, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 20, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 7, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 5, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 8, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 100, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 9, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 30, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 10, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 50, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 11, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 80, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 12, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 100, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 13, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 20, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 14, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 5, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 15, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 100, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 16, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 30, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 17, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 50, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 18, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 80, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 19, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 100, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 20, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 20, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 21, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 5, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 22, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 100, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 23, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 30, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 24, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 50, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 25, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 80, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 26, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 100, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 1, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 10, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 2, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 70, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 3, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 20, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 4, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 85, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 5, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 15, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 6, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 20, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 7, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 5, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 8, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 40, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 9, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 35, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 10, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 70, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 11, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 80, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 12, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 10, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 13, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 60, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 14, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 55, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 15, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 80, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 16, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 90, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 17, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 30, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 18, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 1, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 19, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 20, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 20, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 75, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 21, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 5, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 22, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 20, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 23, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 14, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 24, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 80, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 25, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 30, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 26, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 40, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 1, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 40, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 2, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 90, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 3, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 100, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 4, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 40, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 5, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 20, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 6, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 60, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 7, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 50, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 8, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 10, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 9, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 70, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 10, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 90, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 11, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 30, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 12, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 15, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 13, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 25, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 14, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 65, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 15, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 90, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 16, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 30, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 17, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 50, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 18, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 80, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 19, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 55, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 20, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 2, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 21, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 0, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 22, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 10, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 23, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 40, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 24, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 80, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 25, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 10, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 26, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 90, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 1, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 45, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 2, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 30, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 3, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 80, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 4, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 40, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 5, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 10, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 6, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 30, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 7, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 40, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 8, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 10, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 9, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 60, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 10, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 90, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 11, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 40, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 12, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 10, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 13, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 50, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 14, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 55, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 15, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 35, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 16, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 60, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 17, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 50, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 18, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 80, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 19, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 90, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 20, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 20, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 21, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 85, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 22, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 10, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 23, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 70, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 24, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 80, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 25, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 15, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 26, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1),'weighting'=> 65, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        //$this->getJsonBomb(1, 'example');
    }
    
    public function addTemplateData(){
        //Insert Taxo's
        $this->wpdb->insert('rd_taxos',array('name'=> 'example'),'%s');
        $getTaxo = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxos WHERE name = %s", 'example'));
        //Insert Categories
        $this->wpdb->insert('rd_categories',array('name'=> 'No Category'),'%s');
         $get_catID1 = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_categories WHERE name = %s", 'No Category'));
        $this->wpdb->insert('rd_taxo_categories',array('taxo_id'=> $getTaxo->taxo_id, 'category_id'=> $get_catID1->category_id),array('%d','%d'));
        $this->wpdb->insert('rd_categories',array('name'=> 'Photography'),'%s');
         $get_catID2 = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_categories WHERE name = %s", 'Photography'));
        $this->wpdb->insert('rd_taxo_categories',array('taxo_id'=> $getTaxo->taxo_id, 'category_id'=> $get_catID2->category_id),array('%d','%d'));
        $this->wpdb->insert('rd_categories',array('name'=> 'Gaming'),'%s');
         $get_catID3 = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_categories WHERE name = %s", 'Gaming'));
        $this->wpdb->insert('rd_taxo_categories',array('taxo_id'=> $getTaxo->taxo_id, 'category_id'=> $get_catID3->category_id),array('%d','%d'));
        $this->wpdb->insert('rd_categories',array('name'=> 'MultiMedia'),'%s');
         $get_catID4 = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_categories WHERE name = %s", 'MultiMedia'));
        $this->wpdb->insert('rd_taxo_categories',array('taxo_id'=> $getTaxo->taxo_id, 'category_id'=> $get_catID4->category_id),array('%d','%d'));
            
        //Insert Taxo Nodes
        $this->wpdb->insert('rd_taxo_nodes',array('name'=> "Phone", 'path'=> "1/", 'taxo_id'=>$getTaxo->taxo_id),array('%s','%s','%d'));
        $get_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Phone'));
        $this->wpdb->update('rd_taxo_nodes',array('path'=>$get_path->node_id."/"), array('name'=> 'Phone'), array('%s'), array('%s'));
        
        $this->wpdb->insert('rd_taxo_nodes',array('name'=> "Design", 'path'=> "1/2/", 'taxo_id'=>$getTaxo->taxo_id),array('%s','%s','%d'));
        $get_parent_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Phone'));
        $get_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Design'));
        $this->wpdb->update('rd_taxo_nodes',array('path'=>$get_parent_path->path."".$get_path->node_id."/"), array('name'=> 'Design'), array('%s'), array('%s'));
        
        $this->wpdb->insert('rd_taxo_nodes',array('name'=> "Colours", 'path'=> "1/2/3/", 'taxo_id'=>$getTaxo->taxo_id),array('%s','%s','%d'));
        $get_parent_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Design'));
        $get_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Colours'));
        $this->wpdb->update('rd_taxo_nodes',array('path'=>$get_parent_path->path."".$get_path->node_id."/"), array('name'=> 'Colours'), array('%s'), array('%s'));
        
        $this->wpdb->insert('rd_taxo_nodes',array('name'=> "Purple", 'path'=> "1/2/3/4/", 'taxo_id'=>$getTaxo->taxo_id),array('%s','%s','%d'));
        $get_parent_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Colours'));
        $get_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Purple'));
        $this->wpdb->update('rd_taxo_nodes',array('path'=>$get_parent_path->path."".$get_path->node_id."/"), array('name'=> 'Purple'), array('%s'), array('%s'));
        
        $this->wpdb->insert('rd_taxo_nodes',array('name'=> "Black", 'path'=> "1/2/3/5/", 'taxo_id'=>$getTaxo->taxo_id),array('%s','%s','%d'));
        $get_parent_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Colours'));
        $get_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Black'));
        $this->wpdb->update('rd_taxo_nodes',array('path'=>$get_parent_path->path."".$get_path->node_id."/"), array('name'=> 'Black'), array('%s'), array('%s'));
        
        $this->wpdb->insert('rd_taxo_nodes',array('name'=> "Gray", 'path'=> "1/2/3/6/", 'taxo_id'=>$getTaxo->taxo_id),array('%s','%s','%d'));
        $get_parent_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Colours'));
        $get_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Gray'));
        $this->wpdb->update('rd_taxo_nodes',array('path'=>$get_parent_path->path."".$get_path->node_id."/"), array('name'=> 'Gray'), array('%s'), array('%s'));
        
        $this->wpdb->insert('rd_taxo_nodes',array('name'=> "Blue", 'path'=> "1/2/3/7/", 'taxo_id'=>$getTaxo->taxo_id),array('%s','%s','%d'));
        $get_parent_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Colours'));
        $get_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Blue'));
        $this->wpdb->update('rd_taxo_nodes',array('path'=>$get_parent_path->path."".$get_path->node_id."/"), array('name'=> 'Blue'), array('%s'), array('%s'));
        
        $this->wpdb->insert('rd_taxo_nodes',array('name'=> "Dimensions", 'path'=> "1/2/8/", 'taxo_id'=>$getTaxo->taxo_id),array('%s','%s','%d'));
        $get_parent_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Design'));
        $get_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Dimensions'));
        $this->wpdb->update('rd_taxo_nodes',array('path'=>$get_parent_path->path."".$get_path->node_id."/"), array('name'=> 'Dimensions'), array('%s'), array('%s'));
        
        $this->wpdb->insert('rd_taxo_nodes',array('name'=> "Weight", 'path'=> "1/2/9/", 'taxo_id'=>$getTaxo->taxo_id),array('%s','%s','%d'));
        $get_parent_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Design'));
        $get_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Weight'));
        $this->wpdb->update('rd_taxo_nodes',array('path'=>$get_parent_path->path."".$get_path->node_id."/"), array('name'=> 'Weight'), array('%s'), array('%s'));
        
        $this->wpdb->insert('rd_taxo_nodes',array('name'=> "Display", 'path'=> "1/2/10/", 'taxo_id'=>$getTaxo->taxo_id),array('%s','%s','%d'));
        $get_parent_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Design'));
        $get_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Display'));
        $this->wpdb->update('rd_taxo_nodes',array('path'=>$get_parent_path->path."".$get_path->node_id."/"), array('name'=> 'Display'), array('%s'), array('%s'));
        
        $this->wpdb->insert('rd_taxo_nodes',array('name'=> "Camera", 'path'=> "1/11/", 'taxo_id'=>$getTaxo->taxo_id),array('%s','%s','%d'));
        $get_parent_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Phone'));
        $get_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Camera'));
        $this->wpdb->update('rd_taxo_nodes',array('path'=>$get_parent_path->path."".$get_path->node_id."/"), array('name'=> 'Camera'), array('%s'), array('%s'));
        
        $this->wpdb->insert('rd_taxo_nodes',array('name'=> "Front Camera", 'path'=> "1/11/12/", 'taxo_id'=>$getTaxo->taxo_id),array('%s','%s','%d'));
        $get_parent_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Camera'));
        $get_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Front Camera'));
        $this->wpdb->update('rd_taxo_nodes',array('path'=>$get_parent_path->path."".$get_path->node_id."/"), array('name'=> 'Front Camera'), array('%s'), array('%s'));
        
        $this->wpdb->insert('rd_taxo_nodes',array('name'=> "Front Camera Picture", 'path'=> "1/11/12/13/", 'taxo_id'=>$getTaxo->taxo_id),array('%s','%s','%d'));
        $get_parent_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Front Camera'));
        $get_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Front Camera Picture'));
        $this->wpdb->update('rd_taxo_nodes',array('path'=>$get_parent_path->path."".$get_path->node_id."/"), array('name'=> 'Front Camera Picture'), array('%s'), array('%s'));
        
        $this->wpdb->insert('rd_taxo_nodes',array('name'=> "Front Camera Video", 'path'=> "1/11/12/14/", 'taxo_id'=>$getTaxo->taxo_id),array('%s','%s','%d'));
        $get_parent_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Front Camera'));
        $get_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Front Camera Video'));
        $this->wpdb->update('rd_taxo_nodes',array('path'=>$get_parent_path->path."".$get_path->node_id."/"), array('name'=> 'Front Camera Video'), array('%s'), array('%s'));
        
        $this->wpdb->insert('rd_taxo_nodes',array('name'=> "Rear Camera", 'path'=> "1/11/15/", 'taxo_id'=>$getTaxo->taxo_id),array('%s','%s','%d'));
        $get_parent_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Camera'));
        $get_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Rear Camera'));
        $this->wpdb->update('rd_taxo_nodes',array('path'=>$get_parent_path->path."".$get_path->node_id."/"), array('name'=> 'Rear Camera'), array('%s'), array('%s'));
        
        $this->wpdb->insert('rd_taxo_nodes',array('name'=> "Rear Camera Picture", 'path'=> "1/11/15/16/", 'taxo_id'=>$getTaxo->taxo_id),array('%s','%s','%d'));
        $get_parent_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Rear Camera'));
        $get_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Rear Camera Picture'));
        $this->wpdb->update('rd_taxo_nodes',array('path'=>$get_parent_path->path."".$get_path->node_id."/"), array('name'=> 'Rear Camera Picture'), array('%s'), array('%s'));
        
        $this->wpdb->insert('rd_taxo_nodes',array('name'=> "Rear Camera Video", 'path'=> "1/11/15/17/", 'taxo_id'=>$getTaxo->taxo_id),array('%s','%s','%d'));
        $get_parent_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Rear Camera'));
        $get_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Rear Camera Video'));
        $this->wpdb->update('rd_taxo_nodes',array('path'=>$get_parent_path->path."".$get_path->node_id."/"), array('name'=> 'Rear Camera Video'), array('%s'), array('%s'));
        
        $this->wpdb->insert('rd_taxo_nodes',array('name'=> "Performance", 'path'=> "1/18/", 'taxo_id'=>$getTaxo->taxo_id),array('%s','%s','%d'));
        $get_parent_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Phone'));
        $get_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Performance'));
        $this->wpdb->update('rd_taxo_nodes',array('path'=>$get_parent_path->path."".$get_path->node_id."/"), array('name'=> 'Performance'), array('%s'), array('%s'));
        
        $this->wpdb->insert('rd_taxo_nodes',array('name'=> "Processor", 'path'=> "1/18/19/", 'taxo_id'=>$getTaxo->taxo_id),array('%s','%s','%d'));
        $get_parent_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Performance'));
        $get_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Processor'));
        $this->wpdb->update('rd_taxo_nodes',array('path'=>$get_parent_path->path."".$get_path->node_id."/"), array('name'=> 'Processor'), array('%s'), array('%s'));
        
        $this->wpdb->insert('rd_taxo_nodes',array('name'=> "Memory", 'path'=> "1/18/20/", 'taxo_id'=>$getTaxo->taxo_id),array('%s','%s','%d'));
        $get_parent_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Performance'));
        $get_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Memory'));
        $this->wpdb->update('rd_taxo_nodes',array('path'=>$get_parent_path->path."".$get_path->node_id."/"), array('name'=> 'Memory'), array('%s'), array('%s'));
        
        $this->wpdb->insert('rd_taxo_nodes',array('name'=> "Ram", 'path'=> "1/18/20/21/", 'taxo_id'=>$getTaxo->taxo_id),array('%s','%s','%d'));
        $get_parent_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Memory'));
        $get_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Ram'));
        $this->wpdb->update('rd_taxo_nodes',array('path'=>$get_parent_path->path."".$get_path->node_id."/"), array('name'=> 'Ram'), array('%s'), array('%s'));
        
        $this->wpdb->insert('rd_taxo_nodes',array('name'=> "Storage", 'path'=> "1/18/20/22/", 'taxo_id'=>$getTaxo->taxo_id),array('%s','%s','%d'));
         $get_parent_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Memory'));
        $get_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Storage'));
        $this->wpdb->update('rd_taxo_nodes',array('path'=>$get_parent_path->path."".$get_path->node_id."/"), array('name'=> 'Storage'), array('%s'), array('%s'));
        
        $this->wpdb->insert('rd_taxo_nodes',array('name'=> "Network & Connectivity", 'path'=> "1/18/23/", 'taxo_id'=>$getTaxo->taxo_id),array('%s','%s','%d'));
        $get_parent_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Performance'));
        $get_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Network & Connectivity'));
        $this->wpdb->update('rd_taxo_nodes',array('path'=>$get_parent_path->path."".$get_path->node_id."/"), array('name'=> 'Network & Connectivity'), array('%s'), array('%s'));
        
        $this->wpdb->insert('rd_taxo_nodes',array('name'=> "4G", 'path'=> "1/18/23/24/", 'taxo_id'=>$getTaxo->taxo_id),array('%s','%s','%d'));
        $get_parent_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Network & Connectivity'));
        $get_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", '4G'));
        $this->wpdb->update('rd_taxo_nodes',array('path'=>$get_parent_path->path."".$get_path->node_id."/"), array('name'=> '4G'), array('%s'), array('%s'));
        
        $this->wpdb->insert('rd_taxo_nodes',array('name'=> "WIFI", 'path'=> "1/18/23/25/", 'taxo_id'=>$getTaxo->taxo_id),array('%s','%s','%d'));
        $get_parent_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Network & Connectivity'));
        $get_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'WIFI'));
        $this->wpdb->update('rd_taxo_nodes',array('path'=>$get_parent_path->path."".$get_path->node_id."/"), array('name'=> 'WIFI'), array('%s'), array('%s'));
        
        $this->wpdb->insert('rd_taxo_nodes',array('name'=> "Bluetooth", 'path'=> "1/18/23/26/", 'taxo_id'=>$getTaxo->taxo_id),array('%s','%s','%d'));
        $get_parent_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Network & Connectivity'));
        $get_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", 'Bluetooth'));
        $this->wpdb->update('rd_taxo_nodes',array('path'=>$get_parent_path->path."".$get_path->node_id."/"), array('name'=> 'Bluetooth'), array('%s'), array('%s'));
             
        //Insert Instace node weightings
        
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 1, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 100, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 2, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 30, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 3, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 50, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 4, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 80, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 5, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 100, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 6, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 20, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 7, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 5, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 8, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 100, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 9, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 30, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 10, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 50, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 11, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 80, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 12, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 100, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 13, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 20, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 14, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 5, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 15, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 100, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 16, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 30, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 17, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 50, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 18, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 80, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 19, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 100, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 20, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 20, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 21, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 5, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 22, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 100, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 23, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 30, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 24, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 50, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 25, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 80, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 26, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 100, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 1, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 10, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 2, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 70, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 3, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 20, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 4, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 85, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 5, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 15, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 6, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 20, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 7, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 5, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 8, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 40, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 9, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 35, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 10, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 70, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 11, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 80, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 12, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 10, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 13, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 60, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 14, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 55, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 15, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 80, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 16, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 90, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 17, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 30, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 18, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 1, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 19, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 20, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 20, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 75, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 21, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 5, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 22, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 20, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 23, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 14, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 24, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 80, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 25, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 30, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 26, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 40, 'category_id'=>$get_catID2->category_id ),array('%d','%d','%s','%s','%d','%d'));
        
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 1, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 40, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 2, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 90, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 3, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 100, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 4, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 40, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 5, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 20, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 6, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 60, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 7, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 50, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 8, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 10, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 9, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 70, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 10, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 90, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 11, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 30, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 12, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 15, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 13, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 25, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 14, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 65, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 15, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 90, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 16, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 30, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 17, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 50, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 18, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 80, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 19, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 55, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 20, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 2, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 21, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 0, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 22, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 10, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 23, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 40, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 24, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 80, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 25, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 10, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 26, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 90, 'category_id'=>$get_catID3->category_id ),array('%d','%d','%s','%s','%d','%d'));
        
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 1, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 45, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 2, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 30, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 3, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 80, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 4, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 40, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 5, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 10, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 6, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 30, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 7, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 40, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 8, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 10, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 9, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 60, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 10, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 90, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 11, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 40, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 12, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 10, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 13, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 50, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 14, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 55, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 15, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 35, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 16, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 60, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 17, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 50, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 18, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 80, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 19, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 90, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 20, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 20, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 21, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 85, 'category_id'=>$get_catID1->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 22, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 10, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 23, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 70, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 24, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 80, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 25, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 15, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        $this->wpdb->insert('rd_node_weightings',array('taxo_id'=> $getTaxo->taxo_id,'node_id'=> 26, 'user_ip'=> '1', 'date'=> current_time('mysql', 1),'weighting'=> 65, 'category_id'=>$get_catID4->category_id ),array('%d','%d','%s','%s','%d','%d'));
        
        
       
        
        
        
    }
    

    public function getTaxos(){
        $options ='';
        $sql = "SELECT * FROM rd_taxos";
        $result = $this->wpdb->get_results($sql);
        foreach($result as $results){
            $options = $options. "<option id='$results->taxo_id' value='$results->name'>$results->name</options>";
        }
        return $options;
    }
    
    
    
    public function getCategories(){
        
        
        $data = $_POST['taxo_name'];
        
        $sql = "SELECT rd_categories.category_id, rd_categories.name 
                FROM rd_categories 
                LEFT JOIN rd_taxo_categories ON rd_categories.category_id=rd_taxo_categories.category_id
                LEFT JOIN rd_taxos ON rd_taxo_categories.taxo_id = rd_taxos.taxo_id
                WHERE rd_taxos.name = %s";
        $result = $this->wpdb->get_results($this->wpdb->prepare($sql,$data));
        foreach($result as $results){
            $views = $views. "<option id='$results->category_id' value='$results->name'>$results->name</options>";
        }
        echo $views;
        die();
        
    }
    
    public function categories_save(){
        $newCat = $_POST['cat_name'];
        $oldCat = $_POST['pCat'];
        $taxo_name = $_POST['taxo'];
        $sql = "SELECT * FROM rd_categories WHERE name = %s";
        $r = $this->wpdb->get_row($this->wpdb->prepare($sql,$oldCat));
        if($r){
            $this->wpdb->update( 'rd_categories', array('name'=> $newCat), array('name'=> $oldCat), array('%s'), array('%s') );
            
        }
        else{
            $this->wpdb->insert('rd_categories',array('name' => $newCat),array('%s'));
            $get_catID = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_categories WHERE name = %s", array($newCat)));
            $get_taxID = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxos WHERE name = %s", array($taxo_name)));
            $this->wpdb->insert('rd_taxo_categories', array('taxo_id' => $get_taxID->taxo_id, 'category_id'=> $get_catID->category_id), array('%d', '%d'));
            
        }
         wp_redirect(admin_url('admin.php?page=reviewdoo_plugin'));
        exit;
    }
    
    public function getNodeWeighting(){
        $data = $_POST['node_name'];
        $cats = $_POST['category'];
        $user_data = wp_get_current_user();
        $user_data = $user_data->ID;
        $sql = "SELECT rd_node_weightings.weighting 
                FROM rd_taxo_nodes 
                LEFT JOIN rd_node_weightings on rd_taxo_nodes.node_id = rd_node_weightings.node_id
                LEFT JOIN rd_categories on rd_node_weightings.category_id = rd_categories.category_id
                WHERE rd_taxo_nodes.name = '%s' 
                AND rd_node_weightings.user_ip = '%d' 
                AND rd_categories.name = '%s'";
        $result = $this->wpdb->get_row($this->wpdb->prepare($sql, array($data,$user_data,$cats)));
        
       echo $result->weighting;
        die();
    }
    
    public function EditNode(){
        $parent =$_POST['p_node_Name'];
        $childNode = $_POST['node_name'];
        $childWeighting = $_POST['node_Weighting'];
        $catergory_name = $_POST['CategoryID'];
        $taxonomy_name = $_POST['TaxonomyID'];
        $user_data = wp_get_current_user();
            $user_data = $user_data->ID;
        $sql = "SELECT * FROM rd_taxo_nodes WHERE name = %s";
        $r = $this->wpdb->get_row($this->wpdb->prepare($sql, $childNode));
        if($r){
            $this->wpdb->update('rd_taxo_nodes', array('name' => $childNode), array('name'=> $parent),array('%s'),array('%s'));
            
            $get_nodes = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", array($childNode)));
            $get_catID = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_categories WHERE name = %s", array($catergory_name)));
            $this->wpdb->update('rd_node_weightings', array('weighting' => $childWeighting ), array('node_id'=>$get_nodes->node_id,'category_id'=> $get_catID->category_id),array('%d'),array('%d','%d'));
        }
        else{
            $get_taxos = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxos WHERE name = %s", array($taxonomy_name)));
            $get_parent_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", array($parent)));
            $this->wpdb->insert('rd_taxo_nodes', array('name' => $childNode, 'path'=> $get_parent_path->path, 'taxo_id'=> $get_taxos->taxo_id), array('%s','%s', '%d'));
            $get_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", array($childNode)));
            $this->wpdb->update('rd_taxo_nodes',array('path'=>$get_parent_path->path."".$get_path->node_id."/"), array('name'=> $childNode), array('%s'), array('%s'));
            $get_catID = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_categories WHERE name = %s", array($catergory_name)));
            $this->wpdb->insert('rd_node_weightings', array('taxo_id' => $get_taxos->taxo_id, 'node_id'=> $get_path->node_id, 'user_ip'=>$user_data, 'date'=>current_time('mysql', 1), 'weighting'=>$childWeighting ,'category_id'=> $get_taxos->taxo_id),array('%d','%d', '%s', '%s', '%d', '%d'));
        }
        wp_redirect(admin_url('admin.php?page=reviewdoo_plugin'));
        exit;
    }
    
    
    public function taxonomy_save(){
        
        $newTaxo =  $_POST['taxo_name'];
        $oldTaxo = $_POST['pName'];
        $newRoot = $_POST['root_node_name'];
        $oldRoot = $_POST['pRoot'];
       
        $sql = "SELECT * FROM rd_taxos WHERE name = %s";
        $r = $this->wpdb->get_row($this->wpdb->prepare($sql,$oldTaxo));
        if($r){
            $this->wpdb->update( 'rd_taxos', array('name'=> $newTaxo), array('name'=> $oldTaxo), array('%s'), array('%s') );
            $this->wpdb->update('rd_taxo_nodes',array('name'=> $newRoot), array('name'=> $oldRoot), array('%s'), array('%s'));
        }
        else{
            $this->wpdb->insert('rd_taxos',array('name' => $newTaxo),array('%s'));
            $get_taxos = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxos WHERE name = %s", array($newTaxo)));
            $this->wpdb->insert('rd_taxo_nodes', array('name' => $newRoot, 'path'=> '1/', 'taxo_id'=> $get_taxos->taxo_id), array('%s','%s', '%d'));
            $get_path = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", array($newRoot)));
            $this->wpdb->update('rd_taxo_nodes',array('path'=> $get_path->node_id."/"), array('name'=> $newRoot), array('%s'), array('%s'));
            $this->wpdb->insert('rd_categories', array('name' => "No Category"), array('%s'));
            $get_catID = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_categories WHERE name = %s", array('No Category')));
            $this->wpdb->insert('rd_taxo_categories', array('taxo_id' => $get_taxos->taxo_id, 'category_id'=> $get_catID->category_id), array('%d', '%d'));
        }
       
        wp_redirect(admin_url('admin.php?page=reviewdoo_plugin'));
        exit;
        
    }
    
    public function deleteNode(){
        $node_name = $_POST['node_name'];
        $node_data = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_nodes WHERE name = %s", array($node_name)));
        $get_node_children = $this->wpdb->get_results("SELECT * FROM rd_taxo_nodes WHERE path like '".$node_data->path."%' AND taxo_id = $node_data->taxo_id");
            foreach($get_node_children as $child){
                
                $this->wpdb->delete('rd_taxo_nodes',array('name'=> $child->name),array('%s'));
            }
            echo 'delete';
        die();
    }
    
    public function deleteTaxo(){
        $taxo_name = $_POST['taxo_name'];
        $this->wpdb->delete('rd_taxos',array('name'=> $taxo_name),array('%s'));
            //echo $taxo_name;
        die();
    }
    
    public function deleteCategory(){
        $cat_name = $_POST['cat_name'];
        $this->wpdb->delete('rd_categories',array('name'=> $cat_name),array('%s'));
            //echo $cat_name;
        die();
    }
    
    public function displayTaxonomy(){
        $data = $_POST['taxo_name'];
        //$taxonomy = '<ul>';
        $sql = "SELECT rd_taxo_nodes.node_id, rd_taxo_nodes.node_id, rd_taxo_nodes.name, rd_taxo_nodes.path FROM `rd_taxo_nodes` INNER JOIN rd_taxos ON rd_taxo_nodes.taxo_id = rd_taxos.taxo_id WHERE rd_taxos.name = %s ORDER BY LENGTH(rd_taxo_nodes.path) ASC";
        
        $result = $this->wpdb->get_results($this->wpdb->prepare($sql,$data));
        $root = null;
        $arrayofNodes = array();
        foreach($result as $results){
            //var_dump($results);
            $nodePath = preg_split("/\//", $results->path);
            array_pop($nodePath);
            //var_dump($nodePath);
            if(empty($arrayofNodes)){
                
                $root = new Node($results->node_id, $results->name);
                array_push($arrayofNodes, $root);
                //echo 'got Here';
            }
            elseif(!empty($arrayofNodes)){$root = $arrayofNodes[0];}
            
            foreach($nodePath as $node){
                $nextnode = $node.next($arrayofNodes);
                //echo var_dump($nextnode);
                foreach ($root->getChildren() as $child){
                    if($child->getNodeID() == $nextnode){
                        $root = $child;
                        //var_dump($root);
                    }
                }
                if($root->isChild()){
                    $parent = null;
                    $check = false;
                    foreach($root->getAncestorsAndSelf() as $parents){
                          //var_dump($parents);   
                        if($parents->getNodeID() == $node){
                            $check = True;
                            
                            
                        }
                    }
                    if(!$check){
                        $root->addChild($child = new Node($node));
                        array_push($arrayofNodes, $child);
                        $root = $child;
                    }
                }
                elseif($root->getNodeID() != $node){
                    $root->addChild($child = new Node($node));
                    array_push($arrayofNodes, $child);
                    $root = $child;
                }
            }
             foreach($arrayofNodes as $leaf){
                $root = $arrayofNodes[0];
                foreach($leaf->getChildren() as $children){
                    
                    if($results->node_id == $children->getNodeID() && $root->getNodeID() != $children->getNodeID()){
                        $children->setValue($results->name);
                        
                }
        
            }
        }
            //$taxonomy = $taxonomy. "<li id='$results->name'><a href='#'>$results->name $results->path</a>";
        }
        $taxonomy = null;
        $lastDepth = 0;
        //var_dump($arrayofNodes);
        $node = $arrayofNodes[0];
        $this->tree = "";
            if($node->isRoot()){
                $taxonomy =  "<ul><li><a href='#'>".$node->getValue()."</a><ul>";
                $this->getChildren($node);
                $taxonomy = $taxonomy . $this->tree;  
        
            }
         echo $taxonomy;
         //echo var_dump($parent);
         die();
        
    }
    
    
    public function getChildren($childNode){
        
        foreach($childNode->getChildren() as $child){
            //var_dump($child);
             if($child->isLeaf()){
                $this->tree = $this->tree . "<li name='".$child->getValue()."'><a>".$child->getValue()."</a></li>";
            }
            else{
               $this->tree = $this->tree ."<li name='".$child->getValue()."'><a>".$child->getValue()."</a><ul>";
             $this->getChildren($child);
             $this->tree = $this->tree . "</ul>";
                
            }
        }
        //return $this->tree;
    }
    
    public function getJsonBomb($post_id,$taxo_name){
        // passes page id -> get the page id and check instance
        $sql = "SELECT * FROM rd_taxo_instances INNER JOIN rd_taxos on rd_taxo_instances.taxo_id = rd_taxos.taxo_id WHERE rd_taxo_instances.wp_post_id = %d AND rd_taxos.name = %s";
        $sql1 = "SELECT * FROM rd_taxo_instance_data INNER JOIN rd_taxo_instances ON rd_taxo_instances.instance_id = rd_taxo_instance_data.taxo_instance_id WHERE wp_post_id = %d";
        $instance = $this->wpdb->get_row($this->wpdb->prepare($sql1,array($post_id,$taxo_name)));
        $taxo_id = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxos WHERE name = %s",array($taxo_name)));
        if (is_null($instance)){
            $this->wpdb->insert('rd_taxo_instances',array('taxo_id'=> $taxo_id->taxo_id, 'wp_post_id'=>$post_id),array('%d','%d'));
            $instance_id = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM rd_taxo_instances WHERE taxo_id = %d AND wp_post_id= %d", array($taxo_id->taxo_id, $post_id)));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 1, 'rating'=> 50, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 2, 'rating'=> 10, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 3, 'rating'=> 70, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 4, 'rating'=> 50, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 5, 'rating'=> 10, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 6, 'rating'=> 30, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 7, 'rating'=> 40, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 8, 'rating'=> 20, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 9, 'rating'=> 50, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 10, 'rating'=> 20, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 11, 'rating'=> 30, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 12, 'rating'=> 20, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 13, 'rating'=> 10, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 14, 'rating'=> 50, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 15, 'rating'=> 10, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 16, 'rating'=> 30, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 17, 'rating'=> 20, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 18, 'rating'=> 40, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 19, 'rating'=> 10, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 20, 'rating'=> 20, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 21, 'rating'=> 30, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 22, 'rating'=> 40, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 23, 'rating'=> 50, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 24, 'rating'=> 10, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 25, 'rating'=> 20, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 26, 'rating'=> 30, 'user_ip'=> '80.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 1, 'rating'=> 70, 'user_ip'=> '90.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 2, 'rating'=> 80, 'user_ip'=> '90.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 3, 'rating'=> 30, 'user_ip'=> '90.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 4, 'rating'=> 30, 'user_ip'=> '90.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 5, 'rating'=> 80, 'user_ip'=> '90.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 6, 'rating'=> 40, 'user_ip'=> '90.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 7, 'rating'=> 40, 'user_ip'=> '90.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 8, 'rating'=> 20, 'user_ip'=> '90.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 9, 'rating'=> 50, 'user_ip'=> '90.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 10, 'rating'=> 20, 'user_ip'=> '90.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 11, 'rating'=> 30, 'user_ip'=> '90.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 12, 'rating'=> 20, 'user_ip'=> '90.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 13, 'rating'=> 10, 'user_ip'=> '90.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 14, 'rating'=> 50, 'user_ip'=> '90.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 15, 'rating'=> 10, 'user_ip'=> '90.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 16, 'rating'=> 30, 'user_ip'=> '90.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 17, 'rating'=> 20, 'user_ip'=> '90.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 18, 'rating'=> 40, 'user_ip'=> '90.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 19, 'rating'=> 90, 'user_ip'=> '90.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 20, 'rating'=> 50, 'user_ip'=> '90.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 21, 'rating'=> 70, 'user_ip'=> '90.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 22, 'rating'=> 20, 'user_ip'=> '90.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 23, 'rating'=> 30, 'user_ip'=> '90.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 24, 'rating'=> 80, 'user_ip'=> '90.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 25, 'rating'=> 70, 'user_ip'=> '90.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            $this->wpdb->insert('rd_instance_ratings',array('instance_id'=> $instance_id->instance_id, 'node_id'=> 26, 'rating'=> 80, 'user_ip'=> '90.194.235.40', 'date'=> current_time('mysql', 1)),array('%d','%d','%d','%s','%s'));
            
            
            $jsonCreator = new JsonCreation();
            
        }
        $jsonCreator->checkJsonBombExits();
        $result = $this->wpdb->get_row($this->wpdb->prepare($sql1,$post_id));
//        return json_encode("{'$result->taxo_instance_id' : $result->json}");
        
          return $result;
    }
}