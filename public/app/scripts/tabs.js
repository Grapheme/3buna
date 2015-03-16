$(function() {
  var $btns = $('.tabs-btn>a'),
      $tabs = $('.tabs>.tab');
  
  getIndex();
  
  function showAndHide(index) {
    $tabs.slideUp();
    $tabs.eq(index).slideDown();
  }
  
  function getIndex() {
    $activeBtn = $btns.filter('.active'),
    index = $btns.index($activeBtn);
    showAndHide(index);
  }
  
  $btns.click(function(e){
    e.preventDefault();
    if (!$(this).is('.active')) {
      $btns.removeClass('active');
      $(this).addClass('active');
      _mapMarkers_.forEach(function(element){
        element.marker.balloon.close();
      });
      getIndex();
    }
  })
  
});