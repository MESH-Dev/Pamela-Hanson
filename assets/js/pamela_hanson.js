jQuery(document).ready(function($){
 
 
 


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
      offset: 20, // Optional, the distance between grid items
      itemWidth: 210 // Optional, the width of a grid item
    });
  });

  // Setup filter buttons when jQuery is available
  var $filters = $('#filters li');

  /**
   * When a filter is clicked, toggle it's active state and refresh.
   */
  function onClickFilter(e) {
    var $item = $(e.currentTarget),
        activeFilters = [],
        filterType = $item.data('filter');

    if (filterType === 'all') {
      $filters.removeClass('active');
    } else {
      $item.toggleClass('active');

      // Collect active filter strings
      $filters.filter('.active').each(function() {
        activeFilters.push($(this).data('filter'));
      });
    }

    wookmark.filter(activeFilters, 'or');
  }

  // Capture filter click events.
  $('#filters').on('click.wookmark-filter', 'li', onClickFilter);


  /** ---------------------------------------------------------------------------------
   * When scrolled all the way to the bottom, add more tiles
   *
  function onScroll() {
    // Check if we're within 100 pixels of the bottom edge of the broser window.
    var winHeight = window.innerHeight ? window.innerHeight : $window.height(), // iphone fix
        closeToBottom = ($window.scrollTop() + winHeight > $document.height() - 100);

    if (closeToBottom) {
      // Get the first then items from the grid, clone them, and add them to the bottom of the grid
      var $items = $('li', $container),
          $firstTen = $items.slice(0, 10).clone().css('opacity', 0);
      $container.append($firstTen);

      wookmark.initItems();
      wookmark.layout(true, function () {
        // Fade in items after layout
        setTimeout(function() {
          $firstTen.css('opacity', 1);
        }, 300);
      });
    }
  };

  // Capture scroll event.
  $window.bind('scroll.wookmark', onScroll);

   /** --------------------------------------------------------------------------------- **/


})(jQuery);
