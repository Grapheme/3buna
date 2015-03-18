var _mapMarkers_ = [];

$(function() {
  var colorIcons = {
        yellow: tribuna_theme_path_+'/images/ico-marker_yellow.png',
        green: tribuna_theme_path_+'/images/ico-marker_green.png',
        red: tribuna_theme_path_+'/images/ico-marker_red.png'
      },
      colorIconsChecked = {
        yellow: tribuna_theme_path_+'/images/ico-marker_yellow_ordered.png',
        green: tribuna_theme_path_+'/images/ico-marker_green_ordered.png',
        red: tribuna_theme_path_+'/images/ico-marker_red_ordered.png'
      };
  if (typeof billboards_json !=="undefined"){
    ymaps.ready(function () {
      var billboard_map = new ymaps.Map('billboard-map', {
          center: billboards_json.center,
          zoom: billboards_json.zoom
      }),
      BalloonContentLayout = ymaps.templateLayoutFactory.createClass(
        '<div class="billboard-mark">\
          <div class="mark {{properties.type}}"></div><div class="address">{{properties.address}}</div>\
          <div class="info">\
            <span class="reserved">{{properties.reserved}}<strong>{{properties.strong}}</strong>,<br>\
            <strong>{{properties.price}} руб.</strong></div>\
          <a href="{{properties.photo}}" class="photo">Фото</a><br>\
          <a href="" data-id="{{properties.id}}" class="order {{properties.ordered}}">{{properties.btn_type}}</a>\
        </div>',
      {});
      
      billboard_map.behaviors.disable('scrollZoom');
      
      $.each(billboards_json.items, function(index, value){
        var strong = ''
        if (value.reserved) {
          var placeholder = 'Зарезервирован до ';
          strong = value.reserved
        } else if (value.available) {
          var placeholder = 'Доступно через ';
          strong = value.available+jsTils(value.available, [' день', ' дня', ' дней'])
        } else {
          var placeholder = 'Доступен';
        }
        var placemark = new ymaps.Placemark(value.position, {
          type: value.type,
          address: value.address,
          reserved: placeholder,
          strong: strong,
          price: triads(value.price),
          photo: value.photo,
          id: value.id,
          btn_type: "Заказать",
          ordered: '',
        }, {
          balloonContentLayout: BalloonContentLayout,
          balloonPanelMaxMapArea: 0,
          balloonMaxWidth: 500,
          iconLayout: 'default#image',
          iconImageHref: colorIcons[value.type],
          iconImageSize: [53, 65],
          iconImageOffset: [-26, -65]
        });
        placemark.events.add('balloonopen', function(e){
          console.log('balloonopen!');
        });
        _mapMarkers_.push({
          id: value.id,
          marker: placemark
        });
        billboard_map.geoObjects.add(placemark);
        renderBtns();
      })
    });
  };
  
  
  var $infoBox = $('.tabs-btn .selected');
  
  function renderBtns() {
    var ids = localstorageGet('billboards_ids');
    $('.billboards #list-view tr').removeClass('ordered');
    _mapMarkers_.forEach(function(element2, index2){
      var _type = element2.marker.properties.get('type');
      element2.marker.properties.set('btn_type', 'Заказать');
      element2.marker.properties.set('ordered', '');
      element2.marker.options.set('iconImageHref', colorIcons[_type]);
    });
    if (ids) {
      ids.forEach(function(element, index){
        $('.billboards #list-view tr[data-id='+element+']').addClass('ordered');
        
        //arrayObjectIndexOf()
        _mapMarkers_.forEach(function(element2, index2){
          if (element == element2.id) {
            var _type = element2.marker.properties.get('type');
            element2.marker.properties.set('btn_type', 'Отменить');
            element2.marker.properties.set('ordered', 'ordered');
            element2.marker.options.set('iconImageHref', colorIconsChecked[_type]);
          };
        });
      });
    }
    if (ids.length == 0) {
      $('body.billboards a.send-btn').slideUp();
    } else {
      $('body.billboards a.send-btn').slideDown();
    }
  }
  if (typeof billboards_json !=="undefined"){
  
    function renderInfo() {
      var ids = localstorageGet('billboards_ids'),
          counter = 0,
          totalPrice = 0;
      if (ids) {
        ids.forEach(function(element, index) {
          billboards_json.items.forEach(function(element2, index2){
            if (element == element2.id) {
              counter+=1;
              totalPrice+=element2.price;
            };
          })
        });
        var counterText = jsTils(counter, ['Выбран ', 'Выбрано ', 'Выбрано '])+counter+jsTils(counter, [' щит', ' щита', ' щитов']);
        totalPrice = triads(totalPrice);
        $infoBox.find('.count').text(counterText);
        $infoBox.find('.numbers').text(totalPrice+' рублей.');
        if (counter==0) {
          $infoBox.hide();
        } else {
          $infoBox.show();
        }
      } else {
        $infoBox.hide();
      }
    }
  
    var listViewBtns = '.billboards #list-view .order a, .billboard-mark .order';
    $(document).on('click', listViewBtns, function(e){
      var id = $(this).closest('tr').attr('data-id') || $(this).attr('data-id');
      if (localstorageGet('billboards_ids')) {
        var ids = localstorageGet('billboards_ids');
      } else {
        var ids = [];
      }
      
      if ($(this).is('.ordered') || $(this).closest('tr').is('.ordered')) {
        var ids = localstorageGet('billboards_ids');
        ids.splice(ids.indexOf(id), 1);
      } else {
        if (ids.indexOf(id)==-1) {
          ids.push(id);
        }
      };
      
      localstorageSet('billboards_ids', ids);
      e.preventDefault();
      renderInfo();
      renderBtns();
    });
    renderInfo();
    renderBtns();
  }
  
  $('.billboards #list-view .price .numbers').each(function(index){
    var num = $(this).text();
    $(this).text(triads(num));
  });
  
  function saveBillboardsJson() {
    if (typeof billboards_json !=="undefined"){
      localstorageSet('billboards_json', billboards_json.items);
    };
  };
  
  saveBillboardsJson();
  
  function renderBillboardsOnForm() {
    if ($('#request-form .selected-billboards').size()) {
      var ids = localstorageGet('billboards_ids');
      var billboards_json = localstorageGet('billboards_json');
      if (ids && billboards_json && ids.length>0) {
        var forDel = []
        ids.forEach(function(element, index){
          billboards_json.forEach(function(element2, index2){
            if (element == element2.id) {
              $('<div class="unit" data-id="'+element2.id+'">'+element2.address+'<a href="" class="close"></a></div>').prependTo('#request-form .selected-billboards .list');
            } else {
              forDel.push(element);
            };
          });
        })
        forDel.forEach(function(e, i){
          ids.splice(ids.indexOf(e), 1);
        })
      } else {
        $('#request-form .selected-billboards .title').text('Вы не выбрали ни одного щита.');
        $('#request-form .selected-billboards .more a').text('Добавить щит');
      }
    }
  }
  
  $(document).on('click', '#request-form .selected-billboards .unit .close', function(e){
    var _id = $(this).closest('.unit').attr('data-id');
    var ids = localstorageGet('billboards_ids');
    console.log(_id, ids);
    ids.splice(ids.indexOf(_id), 1);
    console.log(ids);
    var $_this = $(this);
    localstorageSet('billboards_ids', ids, function(){
      $_this.closest('.unit').fadeOut(300, function(){
        if (ids.length == 0) {
          renderBillboardsOnForm();
        }
      });
    });
    e.preventDefault();
  });
  
  renderBillboardsOnForm();
  
  $('#request-form').validate({
    rules: {
      org: 'required',
      phone: 'required',
    },
    messages: {
      org: 'Обязательное поле',
      phone: 'Обязательное поле'
    },
    submitHandler: function (form) {
      var ids = localstorageGet('billboards_ids');
      //$(form).find('input[name="billboards"]').val(JSON.stringify(ids));
      if (ids.length>0) {
        $.ajax({
          type: $(form).attr('method'),
          url: $(form).attr('action'),
          dataType: 'json',
          data: $(form).serialize()+ "&" + $.param({"billboards":ids}),
        })
        .done(function (response) {
          console.log(response);
          //jsonResponse = JSON.parse(response);
          jsonResponse = response;
          if (jsonResponse.status == true) {
            $('#request-form .wrapper').slideUp();
            $('#request-form .final').slideDown();
            ids = [];
            localstorageSet('billboards_ids', ids);
          } else {
            alert('Произошёл сбой. Пожалуйста попробуйте ещё раз.');
          }
        }).fail(function(response) {
          console.log(response);
          alert('Произошёл сбой. Пожалуйста попробуйте ещё раз.');
        });
        $('#request-form button').prop('disabled', true);
      } else {
        $('#request-form .selected-billboards .title').css({
          color:'red'  
        });
      }
      return false;
    },
    invalidHandler: function(event, validator) {
      var ids = localstorageGet('billboards_ids');
      if (ids.length<=0) {
        $('#request-form .selected-billboards .title').css({
          color:'red'  
        });
      }
    }
  });
  
});