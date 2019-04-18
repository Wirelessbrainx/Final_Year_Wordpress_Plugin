/* 
 * Created by Aaron Manning, 2018
 */

// convert to native js object
rdJson = JSON.parse(rdJson);
// console.log(rdJson);

// allow $ to be used in Worpdress
var $ = jQuery;

// cache debugging
var d = new Date();
console.log(d.toLocaleString());

// Build page structure from JSON
function buildFromJson() {

  // set active category
  currentCategory = $('select.rd-category-select').children('option:selected').attr('rd-categoryId');
  console.log(currentCategory);

  var overall = null;
  var primary;
  var secondary;

  // todo this needs a full merge implementation
  if (mergePct == 0) {
    overall = rdJson.nodes[0].author_data.rating;
    // if (overall == null) {
    //   overall = rdJson.nodes[0].user_data.rating;
    // }
  }
  else {
    overall = rdJson.nodes[0].user_data.rating;
    // if (overall == null) {
    //   overall = rdJson.nodes[0].author_data.rating;
    // }
  }

  // == catches null and undefined
  if (overall == null) {
    $('div.rd-overall-score span').text('Score: No Data').css('color', 'red');
  }
  else {
    $('div.rd-overall-score span').text('Score: ' +overall + '%').css('color', getColour(overall));
  }

  var nodeArea = $('div.rd-node-area');

  var insertQueue = [];

  // loop through json nodes and add them to a queue
  rdJson.nodes.forEach(node => {
    // console.log(node);

    var data = {};
    data.rating = null;
    data.weight = null;

    // todo this needs a full merge implementation
    if (mergePct == 0) {

      primary = node.author_data;
      secondary = node.user_data;
      // console.log('author data');
    }
    else {

      primary = node.user_data;
      secondary = node.author_data;
      // console.log('user data');
    }

    // rating
    data.rating = primary.rating;
    // if (data.rating == null) {
    //   data.rating = secondary.rating;
    //   console.log(data.rating);
    // }
    if (data.rating == null) {
      data.rating = -1;
    }

    // weighting
    data.weight = primary.weighting.find(function (obj) {
      return obj[currentCategory] !== undefined;
    });
    if (data.weight == null) {
      data.weight = secondary.weighting.find(function (obj) {
        return obj[currentCategory] !== undefined;
    });
    }
    if (data.weight == null) {
      data.weight = -1; // todo add no data state
    }
    else data.weight = data.weight[currentCategory];

    // console.log(data.rating);
    // console.log(data.weight);

    var insert = `    
    <node class="rd-node" id="`+node.id+`" rd-weight="`+data.weight+`">
        <div class="rd-node-content" style="display: none; color: `+getColour(data.rating)+`;">
            <div class="rd-node-title">`+node.name+`</div>
            <div class="rd-node-rating-area">
                <span class="rd-node-rating">`+(data.rating === -1 ? 'No Data' : data.rating + ('%'))+`</span>
                <div class="slider">
                    <div class="ui-slider-handle rd-slider-handle"></div>
                </div>
            </div>
        </div>
    </node>`;

    var regex = new RegExp("(?:\/)?([0-9]*)\/" + node.id + "\/");

    var target = nodeArea;

    var path = node.path.match(regex);
    if (path !== null) {
      path = path[1];
      target = target.find('node#'+path);
    }
   
    // console.log(path);
    // console.log(target);

    var e = {};
    e.weight = data.weight;
    e.id = node.id;
    e.targetId = path === null ? -1 : parseInt(path);
    e.nodeContents = insert;
    insertQueue.push(e);
  });

  // sort the node queue based on tree depth and weighting
  insertQueue.sort(
    function(a, b){
      if (a.targetId == b.targetId) {
        // console.log('equal');
        return a.weight - b.weight
      }
      else if (a.targetId > b.targetId) {
        // console.log('greater');
        return 1;
      }
      else return -1;
    });

  // build the queue elements into the page
  insertQueue.forEach(element => {
    // console.log(element);
    var insertTarget = nodeArea;
    if (element.targetId !== -1) {
      insertTarget = nodeArea.find('node#'+element.targetId);
    }
    
    // if the element already exists, replace it
    var test = nodeArea.find('node#'+element.id);
    if (test.length > 0) {
      // console.log('same');
      test.replaceWith(element.nodeContents);
    }
    else insertTarget.append(element.nodeContents);
  });
}

var startNode = {};
var currentNodes = [];
var currentNode = null;
var currentCategory = null;
var clickTarget = null;
var editMode = false;
var editWeightMode = false;
var prevState = null;
var mergePct = null;
var userData = [];

// returns a colour based on value
function getColour(value) {
  var colour = "black";
  // var colour = "red";

  // if (value > 25) {
  //   colour = "orange";
  // }
  // else if (value > 45) {
  //   colour = "yellow";
  // }
  // else if (value > 65) {
  //   colour = "green";
  // }
  return colour;
}

// initial setup
function setUp() {

  mergePct = rdJson.merge_pct;

  buildCategories();
  buildFromJson();
  buildNodes();
  showNodes();
  setupSortable();
  initButtons();
  initComments();
  initSearch();
}

// an array of node names and ID's used for search
var data = rdJson.nodes.map(function(term) {
  return {"id": term.id, "name": term.name};
});

function searchFilter(request, response) {

  if (request.term === '') {
    response([]);
    return;
  }

  var i, l, obj, results = [];

  for (i = 0; i< data.length; i++) {
      obj = data[i];
      if (obj.name.toLowerCase().indexOf(request.term.toLowerCase())!==-1) {
        results.push(obj);
      }
  }
  response(results);
}

function initSearch() {

  $( "input#rd-search").autocomplete({
    source: searchFilter,
    focus: function( event, ui ) {
      return false;
    },
    select: function( event, ui ) {
      console.log('select');
      $( "input#rd-search" ).val( ui.item.name );
      showNodes(ui.item.id, true);
      return false;
    }
  }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
    return $( "<li>" ).append( "<span>" + item.name + '</span>').appendTo( ul );
};
}

function buildCategories() {
  rdJson.categories.forEach(category => {
    $('.rd-category-select').append('<option rd-categoryId="'+Object.keys(category)[0]+'" value="'+Object.values(category)[0]+'">'+Object.values(category)[0]+'</option>');
  });

  $('.rd-category-select').on('change', function(event) {
    fullRebuild();
  })
}

// rebuild the node structure from the json
function fullRebuild() {
  buildFromJson();
  buildNodes();
  setupSortable();
  showNodes(currentNode.id);
  if (editMode) {
    editToggle(true);
  }
}

function setupSortable() {
  $("node").each(function( index ) {
    var node = $(this);
    node.sortable({
      delay: 1000,
      start: function( event, ui ) {
        console.log('sortable activate');
        clickTarget = null;
        startNode.obj = ui.item;
        startNode.index = ui.item.index();
      },
      stop: function( event, ui ) {
        console.log('sortable change');
        var node = ui.item;
        var stopIndex = ui.item.index();

        // todo find a way to get the start and end node, this seems impossible with jQuery
        userData.push({"id": startNode.obj.attr('id'), "weight": node.attr('rd-weight')});
        userData.push({"id": node.attr('id'), "weight": startNode.obj.attr('rd-weight')});

        // todo
        // until the above is solved it's not possible to submit user weight scores

        // console.log(node);
        // console.log(this);
        // var count = node.parent().children('node').each(function(index){
        //   // console.log(this);
        //   var sibling = $(this);
        //   var weight = sibling.attr('rd-weight');
        //   // console.log(weight);

        // });
        // console.log(count.length);
      }
    });

    // disable sortable for now, jquery workaround
    node.sortable('disable');
  });
}

// generates node content based on it's child nodes
function buildNodes() {
  $( "node" ).has("node").each(function( index ) {
    var parent = $(this);
    var child = parent.children("node");

    child.children("div.rd-node-content").each(function( index ) {
      var node = $(this);
      var childName = node.children("div.rd-node-title").text();
      var childRating = node.find("span.rd-node-rating").text();
      var childId = node.parent('node').attr('id');

      var newChild = '<div style="color: '+getColour(childRating.replace('%',''))+'" rd-child-id="'+childId+'" class="rd-node-child"><span>'+childName+' | </span><span class="rd-child-rating">' + childRating + (childRating === -1 ? '%' : '') +'</span></div>';
      parent.children("div.rd-node-content").append(newChild);
      parent.children("div.rd-node-content").addClass('rd-parent');
    });
  });
  setupSliders();
}

// focuses the taxonomy view on a node
// todo add pagination logic
function showNodes(id, keepSearch) {

  if (!keepSearch) {
    $( "input#rd-search" ).val('');
  }

  // show root node
  if (id === undefined) {
    id = rdJson.nodes[0].id;
  }

  // if trying to reach a leaf node
  var testNode = $('node#'+id);
  if (testNode.find('node').length == 0) {
    id = testNode.parent('node').attr('id');
  }

  currentNode = {};
  currentNode.id = id;
  currentNode.obj = $( "node#"+id);

  $( "node" ).removeClass("grabbable");

  // hide all node text
  $( "node div.rd-node-content" ).each(function( index ) {
    var node = $(this);
    node.hide();
  });

  // remove current node focus area
  $( "node.rd-focus" ).toggleClass("rd-focus");

  // set new focus
  $( "node#"+id).toggleClass("rd-focus");

  $( "node#"+id).children().toggleClass("grabbable");

  // show relevant nodes
  $( "node#"+id+" > node" ).each(function( index ) {
    // console.log(this);

    var node = $(this);
    node.children("div.rd-node-content").show('fast');
    addNodeHandler(node);

  });
  if (editMode) {
    toggleSortable(id, true);
  }

  // update breadcrumbs
  breadcrumb(id);
}

// adds click handlers to nodes
function addNodeHandler(node) {

  var target = node.has("> node").children("div.rd-node-content");
  target.unbind("mousedown").mousedown(function(event) {

    clickTarget = target;
  });
  target.unbind("mouseup").mouseup(function(event) {

    if (target === clickTarget) {

      showNodes(node.attr("id"));
      clickTarget = null;
    }
  });
}

// builds breadcrumbs based on location in the tree
function breadcrumb(nodeId) {

  // clear breadcrumb
  $( "div.rd-breadcrumb" ).empty();

  // if we are at the root node
  if (nodeId == rdJson.nodes[0].id) {
    addBreadcrumb(nodeId);
  }

  $($("node #"+nodeId).children('node').parentsUntil("div.rd-node-area").get().reverse()).each(function (nextNode) {
    var node =  $(this);
    var nodeId = node.attr('id');
    var nodeTitle = node.children('div.rd-node-content').children('.rd-node-title').text();

    addBreadcrumb(nodeId, nodeTitle);

    $( "div.rd-breadcrumb rd-bc span" ).last().mouseup(function(event) {
      showNodes(nodeId);
    });
  });

}

// adds a breadcrumb to the page
function addBreadcrumb(nodeId, nodeTitle) {

  var bClass = 'rd-breadcrumb';
  var title = nodeTitle;

  if (nodeId == rdJson.nodes[0].id) {
    bClass += '-root';
    title = rdJson.nodes[0].name;
  }

  //strange visual bug here if id is set to 3, workaround is to use data-id
  var breadcrumb = '<rd-bc data-id="'+nodeId+'" class="'+bClass+'"><span>'+title+' / </span></rd-bc>';
  $( "div.rd-breadcrumb" ).append(breadcrumb);
}

$( "#rd-comment-dropdown" ).click(function() {
  var hiddenComments = $( ".rd-comment.rd-hidden" );
  hiddenComments.toggle("fast");
});

function editToggle(enable) {
  if (enable) {
    editMode = true;
  
    $('button.rd-edit').hide();
    $('.rd-comment').hide('fast');
  
    $('.rd-node-rating').hide('fast');
    $('button.rd-cancel').show();
    $('#commentform').show('fast');
  }
  else {
    editMode = false;
  
    if (editWeightMode) {
      editWeightMode = false;
    }
  
    $('button.rd-cancel').hide();
    $('#commentform').hide('fast');
    $('button.rd-edit').show();
    $('.rd-node-rating').show('fast');
    $('.rd-comment').not('.rd-hidden').show('fast');
  }

  $( "node" ).each(function( index ) {
    // $( "node#"+currentNode+" > node" ).each(function( index ) {
      var node = $(this);
      var children = node.children("div.rd-node-content");
      children.toggleClass('edit');
      // addNodeHandler(node);
    });

  // toggle drag and drop
  toggleSortable(currentNode.id, enable);
}

function initButtons() {
  $( "button.rd-edit" ).click(function() {
    editToggle(true);
  });


  $( "button.rd-cancel" ).click(function() {
    editToggle(false);    
  });

}


function toggleSortable(nodeId, enable) {
  $('node').sortable('disable');
  if (enable) {
    $( "node#"+nodeId ).sortable('enable');
  }
}

// initialises comment parsing system
function initComments() {

  var terms = rdJson.nodes.map(function(term) {
    return {"id": term.id, "name": term.name.toLowerCase()};
  });

  var words = [];
  var foundTopics = [];

  $('#comment').bind('keyup', function(e) {
    var text = $('#comment').val().toLowerCase();

    var topicContainer = $('ul.rd-topics');

    terms.forEach(term =>  {
      var index = text.indexOf(term.name);
      var index2 = foundTopics.map(function(t) { return t.name; }).indexOf(term.name);
      if (index > -1 && index2 == -1) {
        foundTopics.push(term);

        var newLi = '<li>'+term.name+'</li>';
        topicContainer.append(newLi);
        topicContainer.children('li').last().click(function(event) {
          if (currentNode.id !== term.id) {
            showNodes(term.id);
          }
        });

        if (currentNode.id !== term.id) {
          showNodes(term.id);
        }

      }
    });
    var topics = topicContainer.children('li');

    if (topics.length != 0) {
      $('.rd-topic-area h5').show('fast');
    }
  });
}

function setupSliders() {
  $( ".rd-merge-slider" ).slider({
    from: 0,
    to: 100,
    step: 100,
    slide: function( event, ui ) {
      mergePct = ui.value;
      fullRebuild();
    }
  });

  $( ".slider" ).each(function( index ) {
      var slider = $( this );
      var handle = slider.find('.rd-slider-handle');

      slider.slider({
        from: 0,
        to: 100,
        smooth: true,
        step: 1,
        round: 0,
        create: function() {
          var setupVal = $(this).prev().text();

          if (!isNaN(setupVal)) {
            $(this).slider('value', setupVal);
            handle.text( slider.slider( "value" ) );
          }
        },
        slide: function( event, ui ) {
          // stop the click event from navigating to the child node
          event.stopPropagation();
          clickTarget = null;

          handle.text( ui.value );
          $(this).prev().text(ui.value + '%');

          var id = $(this).closest('node').attr('id');

          // update parent nodes
          $('div[rd-child-id='+id+'] span.rd-child-rating').text(ui.value + '%');
        },
        change: function( event, ui ) {
          // stop the click event from navigating to the child node
          clickTarget = null;
          event.stopPropagation();
        }
      });

  });
}

// initial setup
// script is output in footer so document.ready not required
setUp();