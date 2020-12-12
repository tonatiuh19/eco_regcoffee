(function(){
  var portfolioWork = $('.portfolio-list');
  $(portfolioWork).isotope({
    resizable: false,
    itemSelector: '.portfolio-item',
    layoutMode: 'masonry',
    filter: '.all'
  });
  
  $('.portfolio-filter .filter li').on('click', function(){
    //remove all class .active
    $('.portfolio-filter .filter li').removeClass('active');
    // add class .active
    $(this).addClass('active');
    // filter
    const f = $(this).attr('data-filter');
    const df = `.${f}`;
    portfolioWork.isotope({
      filter: df
    });
  });
}());