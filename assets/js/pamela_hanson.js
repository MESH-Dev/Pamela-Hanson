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
 
  $('#home-logo').hover( function(){
    $('ul#menu-main-navigation').addClass('show');
  });

  $('.frame').waitForImages(function() {
    
      console.log('its ready');
      var $frame  = $('#slider');
      var $slidee = $frame.children('ul').eq(0);
      var $wrap   = $frame.parent();

      // Call Sly on frame
      $frame.sly({
        horizontal: 1,
        itemNav: 'basic',
        smart: 1,
        activateOn: 'click',
        mouseDragging: 1,
        touchDragging: 1,
        releaseSwing: 1,
        startAt: 1,
        scrollBar: $wrap.find('.scrollbar'),
        scrollBy: 1,
        speed: 300,
        elasticBounds: 1,
        easing: 'easeOutExpo',
        dragHandle: 1,
        dynamicHandle: 0,
        clickBar: 1,
     
      });

      $(window).resize(function(e) {
          $frame.sly('reload');
      });

       
  });

  



});

 

 



 
//------------  ---------------------//
(function($) {



 
 
  //-----------------LOAD MORE PHOTOS -------------------------------------------//

  function loadPhotos() {
      var container = '.fluid-category',
      $container = $(container);
      var last_count = $( ".single-cat-photo" ).length;
      var category = $(".category-title h1").data("id");
      var is_loading = false;
       if (is_loading == false) {
            is_loading = true;
            $('a#load-more-photos').hide();
            $('#loader').show();

            var data = {
                action: 'get_photos',
                last_count: last_count,
                category: category
            };
            jQuery.post(ajaxurl, data, function(response) {
                // now we have the response, so hide the loader
                $('#loader').hide();
                $('a#load-more-photos').show();
                // append: add the new statments to the existing data
                if(response != 0){
                  
                  $('.fluid-category').append(response);
                  //$items = $('li', $container);
                  //$lastTen = $items.slice(last_count, last_count+10).css('opacity', 0);
 
                  is_loading = false;
                  var new_count = $( ".single-cat-photo" ).length;
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
      var container = '.fluid-category',
      $container = $(container);
      var last_count = $( ".single-cat-photo" ).length;
 
      var is_loading = false;
       if (is_loading == false) {
            is_loading = true;
            $('a#load-more-videos').hide();
            $('#loader').show();

            var data = {
                action: 'get_videos',
                last_count: last_count
            };
            jQuery.post(ajaxurl, data, function(response) {
                // now we have the response, so hide the loader
                $('#loader').hide();
                $('a#load-more-videos').show();
                // append: add the new statments to the existing data
                if(response != 0){
                  
                  $('.fluid-category').append(response);
                  //$items = $('li', $container);
                  //$lastTen = $items.slice(last_count, last_count+10).css('opacity', 0);
 
                  is_loading = false;
                  var new_count = $( ".single-cat-photo" ).length;
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
