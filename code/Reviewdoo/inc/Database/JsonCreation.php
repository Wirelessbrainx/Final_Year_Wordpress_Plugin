<?php
/*@author Oliver Grimes <og55@kent.ac.uk>*/
namespace Inc\Database;
use Inc\TaxonomyTree\Node;

class JsonCreation{
     private $wpdb;
     public $arrayofnodes = array();
     public $userCatNodes = array();
     public $authorCatNodes = array();
     public $authorarrayofnodes = array();
    //private $rd_prefix = 'rd_';
    //public $wpdb = global $wpdb;
    
    public function __construct(){
        global $wpdb;
        $this->wpdb = $wpdb;
        
    }
    
    public function register(){
        //$this->createTaxoTree();
        $this->checkJsonBombExits();
    }
    
    public function checkJsonBombExits(){
        $sql = "SELECT * FROM rd_taxo_instances WHERE NOT EXISTS(SELECT rd_taxo_instance_data.taxo_instance_id FROM rd_taxo_instance_data WHERE rd_taxo_instances.instance_id = rd_taxo_instance_data.taxo_instance_id AND rd_taxo_instance_data.date < DATE_ADD(NOW(), INTERVAL 1 HOUR))";
        $results = $this->wpdb->get_results($sql);
        if (is_null($results)){
            return;
        }
        else{
            $this->JsonStructure($results);
        }
        /* Checks if the Data stored in the rd_taxo_instance_data is up to date      
         * Checks if Json already exist for that instance
         */
        
    }
    
    public function JsonStructure($results){
        $sql1 = "SELECT rd_taxos.name as taxo_name, rd_categories.category_id, rd_categories.name as cat_name
                FROM rd_categories 
                INNER JOIN rd_taxo_categories ON rd_categories.category_id=rd_taxo_categories.category_id
                INNER JOIN rd_taxos ON rd_taxo_categories.taxo_id = rd_taxos.taxo_id
                WHERE rd_taxos.taxo_id = %d";
       $sql2 = "SELECT  tn.node_id, tn.name as node_name, tn.path, tn.taxo_id, na.name as alias
                FROM    rd_taxo_nodes tn
                LEFT JOIN rd_node_aliases na on tn.node_id = na.node_id
                WHERE tn.taxo_id = %d";
        $sql3 = "";
        $jsonStart = array();
        $jsonMid = "";
        $jsonEnd = "";
        $postAuthor = "";
       
        foreach ($results as $result){
             $this->authorCatNodes = array();
            $this->userCatNodes = array();
            $postAuthor = get_post($result->wp_post_id)->post_author;
            
            $taxo = $this->wpdb->get_results($this->wpdb->prepare($sql1,$result->taxo_id));
            $data = '';
            
            $catBase = array();
            $taxoArray = array();
            $nodesArray = array();
            
            $taxoArray['id'] = (int)$result->taxo_id;
            $taxoArray['name'] = null;
            $taxoArray['instance_id'] = (int)$result->instance_id;
            foreach ($taxo as $t){
                 $catArray = array();
                 if($taxoArray['name'] === null){
                     $taxoArray['name'] = $t->taxo_name;
                     $data = $taxoArray;
                 }
                $catArray[(int)$t->category_id] = $t->cat_name;
                array_push($this->authorCatNodes, (int)$t->category_id);
                array_push($this->userCatNodes, (int)$t->category_id);
                array_push($catBase, $catArray);
            }

            $jsonStart['taxo'] = $data;
            $jsonStart['categories'] = $catBase;
            $jsonStart['merge_pct'] = 0;
            $jsonStart['nodes'] = array();
            $nodes = $this->wpdb->get_results($this->wpdb->prepare($sql2,$result->taxo_id));
            $nodesArray['id'] = null;
            $nodesArray['name'] = null;
            $nodesArray['path'] = null;
            $nodesArray['aliases'] = null;            
            $nodesArray['user_data'] = null;
            $nodesArray['author_data'] = null;
            $nodesArray['comments'] = null;
           
            foreach($this->userCatNodes as $cats => $catID){                        
                $this->userCatNodes[$cats] = $this->createUserTaxoTree($postAuthor,(int)$catID);                        
            }
                    
            foreach($this->authorCatNodes as $Acats => $AcatID){                        
                $this->authorCatNodes[$Acats] = $this->createAuthorTaxoTree($postAuthor,(int)$AcatID);                    
            }
                
            foreach($nodes as $n){
                $aliasBase = array();
                $aliasArray = array();
                $user_data = array();
                $author_data = array();
                
                if(in_array($n->node_name,$nodesArray)){
                    
                }
                else{
                    $nodesArray['id'] = (int)$n->node_id;
                    $nodesArray['name'] = $n-> node_name;
                    
                    
                    foreach($nodes as $na){
                            if($nodesArray['id'] == (int)$na->node_id && $na->alias != null){ 
                                $aliasArray['name'] = $na->alias;
                                array_push($aliasBase, $aliasArray);
                            }
                    }
                    $nodesArray['aliases'] = $aliasBase;  
                    $nodesArray['path'] = $n->path;
                                                            
                    $user_data['rating'] = null;
                    $user_data['weighting'] = array();
                    $cat = array();
                    foreach ($this->userCatNodes as $user_categories => $user_ratings){                        
                        for($i = 0; $i<count($user_ratings); $i++){
                        
                            if($n->node_id == $user_ratings[$i]->getNodeID()){
                                $user_data['rating'] = (int)$user_ratings[$i]->getRating();
                                $cat = array();
                                $cat[$user_categories+1] = (int)$user_ratings[$i]->getWeighting();
                                $weighting = $cat;
                                array_push($user_data['weighting'], $weighting);
                                 
                            }                            
                        }
                        
                          
                    }
                                                           
                   $nodesArray['user_data'] = $user_data;                  
                   $author_data['rating'] = null;
                   $author_data['weighting'] = array();
                    foreach ($this->authorCatNodes as $author_categories => $author_ratings){
                        
                        for($i = 0; $i<count($author_ratings)-1; $i++){
                            if($n->node_id == $author_ratings[$i]->getNodeID()){
                               if((int)$author_ratings[$i]->getRating() == 0){
                                    $author_data['rating'] = NULL;
                               }else{
                                    $author_data['rating'] = (int)$author_ratings[$i]->getRating();
                               }
                               $cat2 = array();
                                
                               $cat2[$author_ratings[$i]->getCatID()] = (int)$author_ratings[$i]->getWeighting();
                               $authWeighting = $cat2;
                               array_push($author_data['weighting'], $authWeighting);
                                
                            }
                        }
                    }
                    
                   $nodesArray['author_data'] = $author_data;                   
                    array_push($jsonStart['nodes'], $nodesArray);
                }
                 
        }
       
        $this->wpdb->insert('rd_taxo_instance_data',array('taxo_instance_id'=> $result->instance_id, 'json'=> json_encode($jsonStart), 'date'=> current_time('mysql', 1)),array('%d','%s','%s'));
        
    }

}

    public function createUserTaxoTree($author_id = null, $category_id = null){
        $sql = "SELECT rd_instance_ratings.node_id, rd_taxo_nodes.name as node_name, rd_taxo_nodes.path, ROUND(AVG(rd_instance_ratings.rating)) as avgRating, ROUND(AVG(rd_node_weightings.weighting)) as avgWeighting,rd_categories.category_id
                FROM rd_instance_ratings 
                INNER JOIN rd_node_weightings on rd_instance_ratings.node_id = rd_node_weightings.node_id
                INNER JOIN rd_taxo_nodes ON rd_instance_ratings.node_id = rd_taxo_nodes.node_id
                INNER JOIN rd_categories ON rd_node_weightings.category_id = rd_categories.category_id
                WHERE NOT rd_instance_ratings.user_ip = $author_id AND rd_categories.category_id = $category_id
                GROUP BY rd_instance_ratings.node_id HAVING COUNT(rd_instance_ratings.node_id) 
                ORDER BY length(rd_taxo_nodes.path) asc";
        
        $result = $this->wpdb->get_results($sql);
        
        $this->arrayofnodes = array();
        $root = null;
        foreach($result as $node){
            if(empty($this->arrayofnodes)){
                $root = new Node($node->node_id, $node->node_name, $node->avgWeighting, $node->avgRating, $node->category_id);
                array_push($this->arrayofnodes, $root);
            }
            elseif(!empty ($this->arrayofnodes)){$root = array_values($this->arrayofnodes)[0];}
            
            $nodePath = preg_split("/\//", $node->path);
            array_pop($nodePath);            
            
            foreach($nodePath as $np){
                $nextnode = $np.next($this->arrayofnodes);              
                foreach ($root->getChildren() as $child){
                    if($child->getNodeID() == $nextnode){
                        $root = $child;                        
                    }
                }
                if($root->isChild()){
                    $parent = null;
                    $check = false;
                    foreach($root->getAncestorsAndSelf() as $parents){         
                        if($parents->getNodeID() == $np){
                            $check = True;
                            
                            
                        }
                    }
                    if(!$check){
                        $root->addChild($child = new Node($np));
                        array_push($this->arrayofnodes, $child);
                        $root = $child;
                    }
                }
                elseif($root->getNodeID() != $np){
                    $root->addChild($child = new Node($np));
                    array_push($this->arrayofnodes, $child);
                    $root = $child;
                }
            }
            foreach($this->arrayofnodes as $leaf){
            $root = array_values($this->arrayofnodes)[0];
                foreach($leaf->getChildren() as $children){
                    
                    if($node->node_id == $children->getNodeID() && $root->getNodeID() != $children->getNodeID()){
                        $children->setValue($node->node_name);
                        $children->setWeighting($node->avgWeighting);
                        $children->setRating($node->avgRating);
                        $children->setCatId($node->category_id);
                
                }
        
            }
        }
        }
        //var_dump(array_reverse($this->arrayofnodes, True));
        return $this->getNodeNeighbourAverages();
    }
    
    public function getNodeNeighbourAverages(){
        $averages = array_reverse($this->arrayofnodes, True);
        if(empty($this->arrayofnodes)){
            return $this->arrayofnodes;
        }
        $root = array_reverse($this->arrayofnodes)[0];
        $neighbors = array();
        foreach ($averages as $nodes){
            if($nodes == $root){
                break;
            }
            $neighbors = $nodes->getNeighborsAndSelf();           
            $avgRating = array();
            $avgWeighting = array();
            foreach ($neighbors as $nextNeighbors){
                array_push($avgRating, $nextNeighbors->getRating());
                array_push($avgWeighting, $nextNeighbors->getWeighting());
            }           
            $nodeParent = $nodes->getParent();
            array_push($avgRating,$nodeParent->getRating());
            array_push($avgWeighting, $nodeParent->getWeighting());
            $nodeParent->setRating(ceil( array_sum($avgRating) / count($avgRating) ));
            $nodeParent->setWeighting(ceil( array_sum($avgWeighting) / count($avgWeighting) ));
        }
        return $this->arrayofnodes;
    }
    
    public function createAuthorTaxoTree($author_id = null, $category_id = null){
        $sql = "SELECT rd_node_weightings.node_id,rd_taxo_nodes.name as node_name, rd_taxo_nodes.path, 
                ROUND(AVG(rd_instance_ratings.rating)) as avgRating,ROUND(AVG(rd_node_weightings.weighting)) as avgWeighting,rd_categories.category_id 
                FROM rd_taxo_nodes 
                LEFT JOIN rd_node_weightings on rd_taxo_nodes.node_id = rd_node_weightings.node_id
                LEFT JOIN rd_instance_ratings on rd_node_weightings.user_ip = rd_instance_ratings.user_ip 
                LEFT JOIN rd_categories on rd_node_weightings.category_id = rd_categories.category_id 
                WHERE rd_node_weightings.user_ip = $author_id AND rd_categories.category_id = $category_id 
                GROUP BY rd_taxo_nodes.node_id HAVING COUNT(rd_taxo_nodes.node_id) ORDER BY length(rd_taxo_nodes.path) asc";
        
        $result = $this->wpdb->get_results($sql);
        
        $this->authorarrayofnodes = array();
        $root = null;
        foreach($result as $node){
            
            if(empty($this->authorarrayofnodes)){
                $root = new Node($node->node_id, $node->node_name, $node->avgWeighting, $node->avgRating, $node->category_id);
                array_push($this->authorarrayofnodes, $root);
            }
            elseif(!empty ($this->authorarrayofnodes)){$root = array_values($this->authorarrayofnodes)[0];}
            
            $nodePath = preg_split("/\//", $node->path);
            array_pop($nodePath);
            
            foreach($nodePath as $np){
                $nextnode = $np.next($this->authorarrayofnodes);               
                foreach ($root->getChildren() as $child){
                    if($child->getNodeID() == $nextnode){
                        $root = $child;
                    }
                }
                if($root->isChild()){
                    $parent = null;
                    $check = false;
                    foreach($root->getAncestorsAndSelf() as $parents){
                          //var_dump($parents);   
                        if($parents->getNodeID() == $np){
                            $check = True;
                            
                            
                        }
                    }
                    if(!$check){
                        $root->addChild($child = new Node($np));
                        array_push($this->authorarrayofnodes, $child);
                        $root = $child;
                    }
                }
                elseif($root->getNodeID() != $np){
                    $root->addChild($child = new Node($np));
                    array_push($this->authorarrayofnodes, $child);
                    $root = $child;
                }
            }
            foreach($this->authorarrayofnodes as $leaf){
            $root = array_values($this->authorarrayofnodes)[0];
                foreach($leaf->getChildren() as $children){
                    
                    if($node->node_id == $children->getNodeID() && $root->getNodeID() != $children->getNodeID()){
                        $children->setValue($node->node_name);
                        $children->setWeighting($node->avgWeighting);
                        
                        $children->setRating($node->avgRating);
                        $children->setCatId($node->category_id);
                
                }
        
            }
        }
        }
        return $this->getAuthorNodeNeighbourAverages();
    }
    
    public function getAuthorNodeNeighbourAverages(){
        $averages = array_reverse($this->authorarrayofnodes, True);
        if(empty($this->authorarrayofnodes)){
            return $this->authorarrayofnodes;
        }
        $root = array_reverse($this->authorarrayofnodes)[0];
        $neighbors = array();
        foreach ($averages as $nodes){
            if($nodes == $root){
                break;
            }
            $neighbors = $nodes->getNeighborsAndSelf();
            
            $avgRating = array();
            $avgWeighting = array();
            foreach ($neighbors as $nextNeighbors){
                array_push($avgRating, $nextNeighbors->getRating());
                array_push($avgWeighting, $nextNeighbors->getWeighting());
            }

            $nodeParent = $nodes->getParent();
            array_push($avgRating,$nodeParent->getRating());
            array_push($avgWeighting, $nodeParent->getWeighting());
            $nodeParent->setRating(ceil( array_sum($avgRating) / count($avgRating) ));
            $nodeParent->setWeighting(ceil( array_sum($avgWeighting) / count($avgWeighting) ));
        }
        return $this->authorarrayofnodes;
    }
}

