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

  var w_size = $( window ).width();
 
  if (w_size > 480){
    $('.frame').waitForImages(function() {
      
 
        var $frame  = $('#slider');
        var $slidee = $frame.children('ul').eq(0);
        var $wrap   = $frame.parent();

        // Call Sly on frame
        $frame.sly({
   
          horizontal: 1,
          itemNav: 'basic',
          scrollSource: $frame,
          scrollHijack: 10,
          scrollBy: 1,
          smart: false,
          activateOn: 'click',
          mouseDragging: 1,
          touchDragging: 1,
          releaseSwing: 1,
          startAt: 0,
          scrollBar: $wrap.find('.scrollbar'),
          speed: 300,
          elasticBounds: 1,
          dragHandle: 1,
          dynamicHandle: 0,
          clickBar: 1,
    
       
        });

        $(window).resize(function(e) {
            $frame.sly('reload');
        });

         
    });
  }


 
});

 
 
  




 
//------------  ---------------------//
(function($) {
 
   //Masonry and infinite scroll

  // Main content container
  var $container = $('.fluid-category');

  // Masonry + ImagesLoaded
  $container.waitForImages(function(){
    $container.masonry({
      // selector for entry content
      itemSelector: '.item',

      columnWidth: function( containerWidth ) {
        return containerWidth / 2;
      }
    });
  });



 
  //-----------------LOAD MORE PHOTOS -------------------------------------------//

  function loadPhotos() {
 
      var last_count = $( ".single-cat-photo" ).length;
      var category = $(".category-title h1").data("id");
      var is_loading = false;
       if (is_loading == false){
            is_loading = true;
 
            $('#loader').show();

            var data = {
                action: 'get_photos',
                last_count: last_count,
                category: category
            };
            jQuery.post(ajaxurl, data, function(response) {
                // now we have the response, so hide the loader
                
               //$('a#load-more-photos').show();
                // append: add the new statments to the existing data
                if(response != 0){

                  
                  $('.fluid-category').append(response);
                  $container.waitForImages(function() {
                    $('#loader').hide();
                    $container.masonry('reload'); 
                  });                  
 
                  is_loading = false;
                }
                else{
                  $('#loader').hide();
                  is_loading = false;
                }
            });
        }    
  }
 
  //$('a#load-more-photos').click(loadPhotos);

 



  //-----------------LOAD MORE VIDEO -------------------------------------------//

  function loadVideos() {
 
      var last_count = $( ".item" ).length;
      
 
      var is_loading = false;
       if (is_loading == false) {
            is_loading = true;
            
            $('#loader').show();

            var data = {
                action: 'get_videos',
                last_count: last_count
            };
            jQuery.post(ajaxurl, data, function(response) {
 
                
                // append: add the new statments to the existing data
                if(response != 0){
                  
                  $('.fluid-category').append(response);
                  $container.waitForImages(function() {
                    $('#loader').hide();
                    $container.masonry('reload'); 
                  }); 
 
                  is_loading = false;
 

                }
                else{
                  $('#loader').hide();
                  is_loading = false;
                }
            });
        } 
  }
 
 
 
 var timeout = 0;
 $(window).scroll(function(){
    var loc = window.location.pathname;
    var dir = loc.substring(0, loc.lastIndexOf('/'));
    var video = (dir.indexOf("video") > -1);
    clearTimeout(timeout);
    timeout = setTimeout(function() {
      if  ($(window).scrollTop() == $(document).height() - $(window).height()){
         if(video)
          loadVideos();
         else
          loadPhotos();
      }
    }, 500);
  });

 
 
 

})(jQuery);
 

