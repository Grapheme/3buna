$(function() {
  ymaps.ready(function () {
    var billboard_map = new ymaps.Map('billboard-map', {
      center: billboards_json.center,
      zoom: billboards_json.zoom
    }),
    BalloonContentLayout = ymaps.templateLayoutFactory.createClass(
        '<div class="billboard-mark">\
          <div class="mark {{properties.type}}"></div><div class="address">{{properties.address}}</div>\
          <div class="info">\
            <span class="reserved">Зарезервирован до <strong>{{properties.reserved}},\</strong></span><br>\
            <strong>{{properties.price}} руб.</strong></div>\
          <a href="{{properties.photo}}" class="photo">Фото</a>\
          <a href="" data-id="{{properties.id}}" class="order">Заказать</a>\
        </div>',
    {}),
    colorIcons = {
      yellow: '/images/ico-marker_yellow.png'
    };
    
    billboard_map.behaviors.disable('scrollZoom');
    
    $.each(billboards_json.items, function(index, value){
      var placemark = new ymaps.Placemark(value.position, {
        type: value.type,
        address: value.address,
        reserved: value.reserved,
        price: value.price,
        photo: value.photo,
        id: value.id
      }, {
        balloonContentLayout: BalloonContentLayout,
        balloonPanelMaxMapArea: 0,
        balloonMaxWidth: 500,
        iconLayout: 'default#image',
        iconImageHref: colorIcons[value.type],
        iconImageSize: [53, 65],
        iconImageOffset: [-3, -3]
      });
      billboard_map.geoObjects.add(placemark);
    })
  });
});