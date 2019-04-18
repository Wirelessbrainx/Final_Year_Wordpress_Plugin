<?php
/* @author Oliver Grimes <og55@kent.ac.uk>
 */
namespace Inc\Database;

class DBCreation{
    
    private $wpdb;
    //private $rd_prefix = 'rd_';
    //public $wpdb = global $wpdb;
    
    public function __construct(){
        global $wpdb;
        $this->wpdb = $wpdb;
        
    }
    
    public function register(){
        add_action('createTables',array($this, 'rdCreateTables'));
        add_action('removeTables',array($this, 'rdRemoveTables'));
        
    }

    public function rdCreateTables(){
        $this->wpdb->show_errors(); 
       $charset_collate = $this->wpdb->get_charset_collate();
       //Works!
       $rd_createTables = "CREATE TABLE rd_taxos(
            taxo_id mediumint(9) NOT NULL AUTO_INCREMENT,
            name varchar(100) NOT NULL,
            PRIMARY KEY (taxo_id)
            )$charset_collate;";
       //Works!
         
       
         $rd_createTables1 = "CREATE TABLE rd_taxo_instances(
            instance_id mediumint(9) NOT NULL AUTO_INCREMENT,
            taxo_id mediumint(9) NOT NULL ,
            wp_post_id bigint(20) UNSIGNED NOT NULL ,
            PRIMARY KEY (instance_id),
            FOREIGN KEY (taxo_id) REFERENCES rd_taxos(taxo_id) ON DELETE CASCADE,
            FOREIGN KEY (wp_post_id) REFERENCES wp_posts(ID)
            )$charset_collate;";
         
         $rd_createTables0 = "CREATE TABLE rd_taxo_instance_data(
            taxo_instance_id mediumint(9) NOT NULL,
            json TEXT NOT NULL,
            date DATETIME DEFAULT NOW() NOT NULL,
            PRIMARY KEY (taxo_instance_id),
            FOREIGN KEY (taxo_instance_id) REFERENCES rd_taxo_instances(instance_id) ON DELETE CASCADE
            )$charset_collate;"; 
         
         
         //Works!
        $rd_createTables2 =  "CREATE TABLE rd_categories(
            category_id mediumint(9) NOT NULL AUTO_INCREMENT,
            name text NOT NULL,
            PRIMARY KEY (category_id)
            )$charset_collate;";
        //Works!
        $rd_createTables3 = "CREATE TABLE rd_taxo_categories(
            taxo_id mediumint(9) NOT NULL ,
            category_id mediumint(9) NOT NULL,
            PRIMARY KEY (taxo_id, category_id),
            FOREIGN KEY (taxo_id) REFERENCES  rd_taxos(taxo_id) ON DELETE CASCADE,
            FOREIGN KEY (category_id) REFERENCES rd_categories(category_id) ON DELETE CASCADE
            )$charset_collate;";
        //Works!
        $rd_createTables4 ="CREATE TABLE rd_taxo_nodes(
            node_id mediumint(9) NOT NULL AUTO_INCREMENT,
            name varchar(100) NOT NULL,
            path varchar(255) NOT NULL,
            taxo_id mediumint(9) NOT NULL,
            PRIMARY KEY (node_id),
            FOREIGN KEY (taxo_id) REFERENCES rd_taxos(taxo_id) ON DELETE CASCADE
            )$charset_collate;";
        //Works!
         $rd_createTables5 = "CREATE TABLE rd_node_aliases(
            node_id mediumint(9) NOT NULL,
            name varchar(100) NOT NULL,
            PRIMARY KEY (node_id, name),          
            FOREIGN KEY (node_id) REFERENCES rd_taxo_nodes(node_id) ON DELETE CASCADE
            )$charset_collate;";
        //Works!
        $rd_createTables6 = "CREATE TABLE rd_instance_ratings(
            instance_id mediumint(9) NOT NULL,
            node_id mediumint(9) NOT NULL,
            rating tinyint NOT NULL,
            user_ip varchar(16) NOT NULL,
            date datetime DEFAULT NOW() NOT NULL,
            PRIMARY KEY (instance_id, node_id, user_ip),
            FOREIGN KEY (instance_id) REFERENCES rd_taxo_instances(instance_id) ON DELETE CASCADE,
            FOREIGN KEY (node_id) REFERENCES rd_taxo_nodes(node_id) ON DELETE CASCADE
            )$charset_collate;";
        //Works!
        $rd_createTables7 = "CREATE TABLE rd_node_weightings(
            taxo_id mediumint(9) NOT NULL,
            node_id mediumint(9) NOT NULL,
            user_ip varchar(16) NOT NULL,
            date datetime DEFAULT NOW() NOT NULL,
            weighting tinyint NOT NULL,
            category_id mediumint(9),
            PRIMARY KEY (taxo_id, node_id, user_ip, category_id),
            FOREIGN KEY (taxo_id) REFERENCES rd_taxos(taxo_id) ON DELETE CASCADE,
            FOREIGN KEY (node_id) REFERENCES rd_taxo_nodes(node_id) ON DELETE CASCADE,
            FOREIGN KEY (category_id) REFERENCES rd_categories(category_id)ON DELETE CASCADE
            )$charset_collate;";
       
       require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($rd_createTables);
        dbDelta($rd_createTables1);
        dbDelta($rd_createTables0);
        dbDelta($rd_createTables2);
        dbDelta($rd_createTables3);
        dbDelta($rd_createTables4);
        dbDelta($rd_createTables5);
        dbDelta($rd_createTables6);
        dbDelta($rd_createTables7);
        
   }
   
    
    public function rdRemoveTables(){   
        
        $this->wpdb->query("DROP TABLE IF EXISTS rd_node_weightings");
        $this->wpdb->query("DROP TABLE IF EXISTS rd_instance_ratings");
        $this->wpdb->query("DROP TABLE IF EXISTS rd_node_aliases");
        $this->wpdb->query("DROP TABLE IF EXISTS rd_taxo_nodes");
        $this->wpdb->query("DROP TABLE IF EXISTS rd_taxo_categories");
        $this->wpdb->query("DROP TABLE IF EXISTS rd_categories");
        $this->wpdb->query("DROP TABLE IF EXISTS rd_taxo_instance_data");
        $this->wpdb->query("DROP TABLE IF EXISTS rd_taxo_instances");
        $this->wpdb->query("DROP TABLE IF EXISTS rd_taxos"); 
    }
   
}
