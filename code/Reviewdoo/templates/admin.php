<!--
    @author Oliver Grimes <og55@kent.ac.uk>
-->
<?php 
    use Inc\Database\DatabaseAPI;
    $databaseQuery = new DatabaseAPI();
    //print_r($_POST);
    
        //echo $databaseQuery->getTaxos();
        
    
?>
<div class="wrap">
    <h1>Reviewdoo</h1>
    <?php settings_errors(); ?>
    <div class='rd_admin_nav'>
        <ul>
            
            <li><a href="">Options</a></li>
            <li><a href="">Theme</a></li>
            <li><a href="">ShortCodes</a></li>
        </ul>
    </div>
    <div class='rd_admin_content'>
        <form id="newTaxo" method="post">
        
            <label>Taxonomy Name</label><select id='rd_taxonomy' class="form-control" name="rd_taxonomy"><?php echo $databaseQuery->getTaxos();?></select><i id='editTaxoName' class='edit fa fa-edit' data-toggle='modal' data-target='#addTaxonomy'></i>
            <i id="addtaxoName"class='add fa fa-plus' data-toggle='modal' data-target='#addTaxonomy'></i><i id='deleteTaxonomy' class='delete fa fa-trash' alt='Delete'></i>
            <label id="view">View</label><select id='rd_category' class="form-control" name='rd_category'></select><i id='editCat' class='edit fa fa-edit' data-toggle='modal' data-target='#addCategory'></i>
             <i id="addCat" class='add fa fa-plus' data-toggle='modal' data-target='#addCategory'></i><i id='deleteCategory' class='delete fa fa-trash' alt='Delete'></i>
             <button type="button" id="taxo_template" class="btn btn-default" style="display: inline;">Taxonomy Template</button>
        </form>
        
       
    </div>
    <div class="rd_admin_container">
        <form id='taxonomy' action="post">
        
        
        </form>
</div>
    
<div id="editTaxonomy" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Taxonomy</h4>
      </div>
      <div class="modal-body">
          <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
              <input type="hidden" name="action" value="edit_Node">
              <input type="hidden" name="custom_nonce" value="">
          <label>Node Name</label>
          <input type="hidden" name="CategoryID" id="nodeCategory">
          <input type="hidden" name="TaxonomyID" id="nodeTaxonomy">
          <input type="hidden" name="p_node_Name" id="p_node_name">
          <input type="text" name="node_name" id="nodeName"></input>
          <label>Weighting</label>
          
          <input type="range" name="node_Weighting" id="Weighting"></input>
      </div>
      <div class="modal-footer">
          <button id="savenode" type="submit" value="submit" class="btn btn-default" data-dismiss="">Save</button>
          </form>
      </div>
    </div>

  </div>
</div>
    
<div id="addTaxonomy" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Taxonomy</h4>
      </div>
      <div class="modal-body">
          <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
              <input type="hidden" name="action" value="taxonomy_save">
              <input type="hidden" name="custom_nonce" value="">
          <label>Taxonomy Name</label>
          <input type="hidden" name="pName" id="p_taxo_name">
          <input type="text" name="taxo_name" id="taxoName"></input>
          <label>Root Node Name</label>
          <input type="hidden" name="pRoot" id="p_root">
          <input type="text" name="root_node_name" id="root_node_name"></input>
      </div>
      <div class="modal-footer">
          <button id="saveTaxo" type="submit" value="submit" class="btn btn-default" data-dismiss="">Save</button>
          </form>
      </div>
    </div>

  </div>
</div>
         <div id="addCategory" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Categories</h4>
      </div>
      <div class="modal-body">
          <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
              <input type="hidden" name="action" value="Category_save">
              <input type="hidden" name="custom_nonce" value="">
          <label>Category Name</label>
          <input type="hidden" name="pCat" id="p_cat"></input>
          <input type="text" name="cat_name" id="catName"></input>
          <input type="hidden" name="taxo" id="cat_taxo"></input>
         
      </div>
      <div class="modal-footer">
          <button id="saveTaxo" type="submit" value="submit" class="btn btn-default" data-dismiss="">Save</button>
          </form>
      </div>
    </div>

  </div>
</div>
</div>



