jQuery(document).ready(function($){

  //------------FULL SCREEN SEARCH ---------------------//
  $('a#search-btn').on('click', function(event) {
        event.preventDefault();
        $('#search').addClass('open');
        $('#search > form > input[type="search"]').focus();
  });

  $('#search, #search button.close').on('click keyup', function(event) {
      if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
          $(this).removeClass('open');
      }
  });

  $('.slides-wrap').slick({
    variableWidth: true,
    accessibility: true,
    adaptiveHeight: true,
    arrows: true,
    infinite: false,
    slide: '.image-content',
    prevArrow: '<div class="button slick-prev"><i class="fa fa-chevron-left"></i></div>',
    nextArrow: '<div class="button slick-next"><i class="fa fa-chevron-right"></i></div>'
  });

  $('#home-logo').hover( function(){
    $('ul#menu-main-navigation').addClass('show');
  });


});

 
//------------WOOKMARK FILTERING AND INFINITE SCROLL ---------------------//
(function($) {
  // Instantiate wookmark after all images have been loaded
  var wookmark,
      container = '#container',
      $container = $(container),
      $window = $(window),
      $document = $(document);
 

  imagesLoaded('#container', function() {
    wookmark = new Wookmark('#container', {
      itemWidth: 310 // Optional, the width of a grid item
    });
  });

  //-----------------FILTERS -------------------------------------------//
  // Setup filter buttons when jQuery is available
  var $filters = $('#filters li');

  //-----------------URL FILTER -------------------------------------------//

  function getQueryVariable(variable)
  {
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
  }

  function loadFilter(){
    var urlFilter = getQueryVariable('filter');
    var filterType = urlFilter;
 
    var $item = $("li[data-filter='"+filterType+"']");
    var activeFilters = [];
    
   
    $item.toggleClass('active');
    $('a#load-more-photos').hide();

    // Collect active filter strings
    $filters.filter('.active').each(function() {
      activeFilters.push($item.data('filter'));
    });
 
    wookmark.filter(activeFilters, 'or');
 
  }

  var urlFilter = getQueryVariable('filter');
  if (urlFilter){$(window).on('load', loadFilter);}
  

   //-----------------END FILTER -------------------------------------------//




  /**
   * When a filter is clicked, toggle it's active state and refresh.
   */
  function onClickFilter(e) {
    wookmark.initItems();
    wookmark.layout(true);
    var $item = $(e.currentTarget),
        activeFilters = [],
        filterType = $item.data('filter');

    if (filterType === 'all') {
      $filters.removeClass('active');
       $('a#load-more-photos').show();
    } else {
      $item.toggleClass('active');
       $('a#load-more-photos').hide();

      // Collect active filter strings
      $filters.filter('.active').each(function() {
        activeFilters.push($(this).data('filter'));
      });
    }
    if(activeFilters == '') $('a#load-more-photos').show();
    
    wookmark.filter(activeFilters, 'or');
  }

  // Capture filter click events.
  $('#filters').on('click.wookmarks-filter', 'li', onClickFilter);





  //-----------------LOAD MORE PHOTOS -------------------------------------------//

  function loadPhotos() {

      var last_count = $( ".tiles-wrap li" ).length;
      var is_loading = false;
       if (is_loading == false) {
            is_loading = true;
            

            var data = {
                action: 'get_photos',
                last_count: last_count
            };
            jQuery.post(ajaxurl, data, function(response) {
                // now we have the response, so hide the loader
                //$('#loader').hide();
                // append: add the new statments to the existing data
                if(response != 0){
       
                  $container.append(response);
                  $items = $('li', $container);
                  $lastTen = $items.slice(last_count, last_count+10).css('opacity', 0);

                  wookmark.initItems();
                  wookmark.layout(true, function () {
                    // Fade in items after layout
                    setTimeout(function() {
                      $lastTen.css('opacity', 1);
                    }, 300);
                  });
                  wookmark = new Wookmark('#container', {
                    itemWidth: 310 // Optional, the width of a grid item
                  });
                  is_loading = false;
                  var new_count = $( ".tiles-wrap li" ).length;
                  if(new_count%10 != 0){
                    $('a#load-more-photos').hide();
                  }

                }
                else{
                  $('a#load-more-photos').hide();
                  is_loading = false;
                }
            });
        }    
  }
 
  $('a#load-more-photos').click(loadPhotos);


  //-----------------LOAD MORE VIDEO -------------------------------------------//

  function loadVideos() {
 
       var is_loading = false;
       var last_count = $( ".tiles-wrap li" ).length;
       if (is_loading == false) { 
            is_loading = true;
           

            var data = {
                action: 'get_videos',
                last_count: last_count
            };
            jQuery.post(ajaxurl, data, function(response) {
                // now we have the response, so hide the loader
                //$('#loader').hide();
                // append: add the new statments to the existing data
                if(response != 0){
                  $container.append(response);
                  $items = $('li', $container);
                  $lastTen = $items.slice(last_count, last_count+10).css('opacity', 0);
                  wookmark.initItems();
                  wookmark.layout(true, function () {
                    // Fade in items after layout
                    setTimeout(function() {
                      $lastTen.css('opacity', 1);
                    }, 300);
                  });
                  wookmark = new Wookmark('#container', {
                    itemWidth: 310 // Optional, the width of a grid item
                  });
                  
                  // set is_loading to false to accept new loading
                  is_loading = false;
                  var new_count = $( ".tiles-wrap li" ).length;
                  if(new_count%10 != 0){
                    $('a#load-more-videos').hide();
                  }
                }
                else{
                  $('a#load-more-videos').hide();
                  is_loading = false;
                }
            });
        }
 
  }
 
  $('a#load-more-videos').click(loadVideos);
   
 
 




 


})(jQuery);
