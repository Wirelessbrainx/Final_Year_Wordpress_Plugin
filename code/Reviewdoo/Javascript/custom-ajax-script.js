/*
 *  @author Oliver Grimes <og55@kent.ac.uk>
 */
(function ($) {
    $(document).ready(function($){
        var data = {
		'action': 'getCategories',
		'taxo_name': ""+$('#rd_taxonomy').val()+""
	};
	// We can also pass the url value separately from ajaxurl for front end AJAX implementations
	jQuery.post(ajax_object.ajax_url, data, function(response) {
            $('#rd_category').append(response);
		console.log('This is the ajax responce' + response);
	});
         var tax = {
		'action': 'displayTaxonomy',
		'taxo_name': ""+$('#rd_taxonomy').val()+""
	};
	// We can also pass the url value separately from ajaxurl for front end AJAX implementations
	jQuery.post(ajax_object.ajax_url, tax, function(response) {
             $('.rd_admin_container form').html('');
            $('.rd_admin_container #taxonomy').append(response);
		console.log(response);
                createTaxo();
	});
        
         $('#rd_taxonomy').on('change', (function(){
             $('#rd_category').empty();
        var data = {
		'action': 'getCategories',
		'taxo_name': ""+$('#rd_taxonomy').val()+""
	};
	// We can also pass the url value separately from ajaxurl for front end AJAX implementations
	jQuery.post(ajax_object.ajax_url, data, function(response) {
            $('#rd_category').append(response);
		console.log('This is the ajax responce' + response);
	});
        var tax = {
		'action': 'displayTaxonomy',
		'taxo_name': ""+$('#rd_taxonomy').val()+""
	};
        jQuery.post(ajax_object.ajax_url, tax, function(response) {
            $('.rd_admin_container form').empty();
            $('.rd_admin_container form').append(response);
		console.log(response);
                createTaxo();
	});
    }));
    function createTaxo(){
        $('.rd_admin_container ul:first-child li a').addClass('root');
       $('.rd_admin_container ul').each(function () {
        $this = $(this);
        $this.find("li").has("ul").addClass("hasSubmenu");
       
        
    });
// Find the last li in each level
    $('.rd_admin_container li:last-child').each(function () {
        $this = $(this);
        //$this.closest('ul').css("border-left", "1px solid gray");
        // Check if LI has children
        if ($this.children('ul ').length === 0) {
            // Add border-left in every UL where the last LI has not children
            $this.closest('ul').last().css("border-left", "1px solid gray");
            
        } else {
            // Add border in child LI, except in the last one
            
            $this.closest('ul').children("li").not(':last').css("border-left", "1px solid gray");
            
            // Add the class "addBorderBefore" to create the pseudo-element :defore in the last li
            $this.closest('ul').children("li").last().children("a").addClass("addBorderBefore");
            // Add margin in the first level of the list
            $this.closest('ul').css("margin-top", "25px");
            // Add margin in other levels of the list
            $this.closest('ul').find("li").children("ul").css("margin-top", "20px");
            
        }
        ;
    });
// Add bold in li and levels above
    $('.rd_admin_container ul li').each(function () {
        $this = $(this);
        $this.prepend("<i id='editOldNode' class='edit fa fa-edit' alt='edit' data-toggle='modal' data-target='#editTaxonomy'></i>");
        $this.prepend("<i id='addNewNode' class='add fa fa-plus' alt='Add' data-toggle='modal' data-target='#editTaxonomy'></i>");
        $this.prepend("<i id='deleteNode' class='delete fa fa-trash' alt='Delete'></i>");
        $this.mouseenter(function () {
            $(this).children("a").css({"font-weight": "bold", "color": "#336b9b"});
        });
        $this.mouseleave(function () {
            $(this).children("a").css({"font-weight": "normal", "color": "#428bca"});
        });
    });
// Add button to expand and condense - Using FontAwesome
    $('.rd_admin_container ul li.hasSubmenu').each(function () {
        $this = $(this);
        $this.prepend("<a href='#'><i class='fa fa-minus-circle'></i><i style='display:none;' class='fa fa-plus-circle'></i></a>");
        
        $this.children("a").not(":last").removeClass().addClass("toogle");
    });
// Actions to expand and consense
    $('.rd_admin_container ul li.hasSubmenu a.toogle').click(function () {
        $this = $(this);
        $this.closest("li").children("ul").toggle("slow");
        $this.children("i").toggle();
        return false;
    });
    }
   });
    
})(jQuery);

