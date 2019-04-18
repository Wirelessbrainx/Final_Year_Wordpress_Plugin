/*
 * @author Oliver Grimes <og55@kent.ac.uk>
 */

(function ($) {
    $('#editTaxoName').on('click', (function(){
             $('#taxoName').val('');
             $('#root_node_name').val('');
             $('#p_taxo_name').val('');
             $('#p_root').val('');
             
             $('#taxoName').val($('#rd_taxonomy').val());
             $('#p_taxo_name').val($('#rd_taxonomy').val());
             $('#root_node_name').val($('.root').html());
             $('#p_root').val($('.root').html());
             console.log($('#p_root').val());
             console.log($('#p_taxo_name').val());
         }));
         
    $('#addtaxoName').on('click', (function(){
        $('#taxoName').val('');
        $('#root_node_name').val('');
        
    }));
    
    $('#editCat').on('click', function(){
        $('#catName').val('');
        $('#p_cat').val('');
        $('#cat_taxo').val('');
        $('#catName').val($('#rd_category').val());
        if($('#catName').val() === "No Category"){
            $('#addCategory').modal('toggle');
        }
        $('#p_cat').val($('#rd_category').val());
        
        $('#cat_taxo').val($('#rd_taxonomy').val());
        
    });
    $('#addCat').on('click', function(){
        $('#catName').val('');
        $('#cat_taxo').val('');
        $('#cat_taxo').val($('#rd_taxonomy').val());
    });
    
    $(document).on('click', '#editOldNode',  function(e){
        
        $('#nodeName').val('');
        $('#p_node_name').val('');
        $('#Weighting').val(0);
        var parent = $(this).parent().children('a').contents().text();
        $('#p_node_name').val(parent);        
        $('#nodeName').val(parent);
        $('#nodeCategory').val($('#rd_category').val());
        $('#nodeTaxonomy').val($('#rd_taxonomy').val());
        var data  = {
            'action': 'getNodeWeighting',
            'node_name': ""+$('#nodeName').val()+"",
            'category': ""+$('#rd_category').val()+""
        };
        jQuery.post(ajax_object.ajax_url,data,function(responce){
            $('#Weighting').val(responce);
            //console.log(responce);
        });
    });
         
    $(document).on('click','#addNewNode', function(e){
        
        
        $('#nodeName').val('');
        $('#p_node_name').val('');
        $('#Weighting').val(0);
        var parent = $(this).parent().children('a').contents().text();
        
        $('#p_node_name').val(parent);
        console.log($('#p_node_name').val());
        $('#nodeCategory').val($('#rd_category').val());
        $('#nodeTaxonomy').val($('#rd_taxonomy').val());

        
        
    });
    
    $(document).on('click','#deleteNode', function(e){
        var parent = $(this).parent().children('a').contents().text();
        var data ={
            'action' : 'DeleteNode',
            'node_name' : ""+parent+""
            
        }
        jQuery.post(ajax_object.ajax_url,data,function(responce){
            console.log(responce);
            window.location.reload();
            
        });
    });
    
    $('#deleteTaxonomy').on('click', function(){
        var data = {
            'action': 'DeleteTaxo',
            'taxo_name': $('#rd_taxonomy').val()
        };
         jQuery.post(ajax_object.ajax_url,data,function(responce){
                console.log(responce);
                window.location.reload();
            
        });
    });
    
    $('#deleteCategory').on('click', function(){
        if($('#rd_category').val() === "No Category"){
            
        }
        else{
            var data = {
                'action': 'DeleteCategory',
                'cat_name': $('#rd_category').val()
            };
             jQuery.post(ajax_object.ajax_url,data,function(responce){
                console.log(responce);
                window.location.reload();
            
        });
        }
    });
    
    $('#taxo_template').on('click', function(){
        var data = {
                'action': 'AddTemplateTaxonomy'
            };
            jQuery.post(ajax_object.ajax_url,data,function(){
               
                window.location.reload();
            
        });
    });
})(jQuery);