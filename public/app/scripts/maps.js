$(function() {
  ymaps.ready(function () {
    var index_map = new ymaps.Map($('body.index .small-map')[0], {
          center: [47.24470432, 39.72322986],
          zoom: 18
    });
    var placemark = new ymaps.Placemark([47.24470432, 39.72322986], {},
    {
      iconLayout: 'default#image',
      iconImageHref: tribuna_theme_path_+'/images/ico-marker-mark.png',
      iconImageSize: [50, 73],
      iconImageOffset: [-25, -73]
    });
    index_map.geoObjects.add(placemark);
    index_map.controls.remove('mapTools');
    index_map.controls.remove('scaleLine');
    index_map.controls.remove('searchControl');
    index_map.controls.remove('trafficControl');
  });
});