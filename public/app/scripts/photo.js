$(function() {
  
  function initPopup($el, closeFunc) {
    closeFunc = closeFunc || function(){};
    var _popup = $el.magnificPopup({
      type: 'image',
      removalDelay: 500,
      callbacks: {
        beforeOpen: function() {
           this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
           this.st.mainClass = 'mfp-move-from-top';
        },
        close: function() {
          closeFunc();
        }
      },
      closeOnContentClick: true,
      showCloseBtn: false,
      tLoading: 'Загрузка...'
    });
    
    return _popup
  }
  
  initPopup($('#list-view td.photo a.photo'));
  $(document).on('click', '.billboard-mark .photo', function(e){
    e.preventDefault();
    initPopup($(this)).magnificPopup('open');
  })
  
  $('.content-wrapper .photos').magnificPopup({
    delegate: 'a',
    type: 'image',
    gallery: {
      enabled: true,  
      tPrev: 'Предыдущая (Стрелка влево)',
      tNext: 'Следующая (Стрелка вправо)',
      tCounter: '<span class="mfp-counter">%curr% из %total%</span>'
    },
    callbacks: {
      beforeOpen: function() {
         this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
         this.st.mainClass = 'mfp-move-from-top';
      }
    },

    image: {
      titleSrc: 'title'
    },
  });
  
  
  
});