function arrayObjectIndexOf(e,o,t){for(var r=0,a=e.length;a>r;r++)if(e[r][t]===o)return r;return-1}function triads(e){return e=e.toString(),e.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g,"$1 ")}function jsTils(e,o){var t;return count=e%100,count>=5&&count<=20?t=o[2]:(count%=10,t=1==count?o[0]:count>=2&&count<=4?o[1]:o[2]),t}function localstorageGet(e){return Modernizr.localstorage?localStorage.getItem(e)?JSON.parse(localStorage.getItem(e)):!1:void 0}function localstorageSet(e,o,t){Modernizr.localstorage&&localStorage.setItem(e,JSON.stringify(o)),(t=t||function(){})()}console.log("'Allo 'Allo!"),$(function(){function e(e){r.slideUp(300),r.eq(e).slideDown(300,function(){_billboards_map_&&_billboards_map_.container.fitToViewport()})}function o(){$activeBtn=t.filter(".active"),index=t.index($activeBtn),e(index)}var t=$(".tabs-btn>a"),r=$(".tabs>.tab");o(),t.click(function(e){e.preventDefault(),$(this).is(".active")||(t.removeClass("active"),$(this).addClass("active"),_mapMarkers_.forEach(function(e){e.marker.balloon.close()}),o())})});var _mapMarkers_=[],_billboards_map_;$(function(){function e(){var e=localstorageGet("billboards_ids");console.log(e),console.log(e.length),$(".billboards #list-view tr").removeClass("ordered"),_mapMarkers_.forEach(function(e){var o=e.marker.properties.get("type");e.marker.properties.set("btn_type","Заказать"),e.marker.properties.set("ordered",""),e.marker.options.set("iconImageHref",a[o])}),e&&e.forEach(function(e){$(".billboards #list-view tr[data-id="+e+"]").addClass("ordered"),_mapMarkers_.forEach(function(o){if(e==o.id){var t=o.marker.properties.get("type");o.marker.properties.set("btn_type","Отменить"),o.marker.properties.set("ordered","ordered"),o.marker.options.set("iconImageHref",s[t])}})})}function o(){var e=localstorageGet("billboards_ids"),o=0,t=0;if(e){e.forEach(function(e){billboards_json.items.forEach(function(r){e==r.id&&(o+=1,t+=r.price)})});var r=jsTils(o,["Выбран ","Выбрано ","Выбрано "])+o+jsTils(o,[" щит"," щита"," щитов"]);t=triads(t),i.find(".count").text(r),i.find(".numbers").text(t+" рублей."),0==o?i.hide():i.show()}else i.hide()}function t(){"undefined"!=typeof billboards_json&&localstorageSet("billboards_json",billboards_json.items)}function r(){if($("#request-form .selected-billboards").size()){var e=localstorageGet("billboards_ids"),o=localstorageGet("billboards_json");if(e&&o&&e.length>0){var t=[];e.forEach(function(e){o.forEach(function(o){e==o.id?$('<div class="unit" data-id="'+o.id+'">'+o.address+'<a href="" class="close"></a></div>').prependTo("#request-form .selected-billboards .list"):t.push(e)})}),t.forEach(function(o){e.splice(e.indexOf(o),1)})}else $("#request-form .selected-billboards .title").text("Вы не выбрали ни одного щита."),$("#request-form .selected-billboards .more a").text("Добавить щит")}}var a={yellow:tribuna_theme_path_+"/images/ico-marker_yellow.png",green:tribuna_theme_path_+"/images/ico-marker_green.png",red:tribuna_theme_path_+"/images/ico-marker_red.png"},s={yellow:tribuna_theme_path_+"/images/ico-marker_yellow_ordered.png",green:tribuna_theme_path_+"/images/ico-marker_green_ordered.png",red:tribuna_theme_path_+"/images/ico-marker_red_ordered.png"};"undefined"!=typeof billboards_json&&ymaps.ready(function(){var o=new ymaps.Map("billboard-map",{center:billboards_json.center,zoom:billboards_json.zoom}),t=ymaps.templateLayoutFactory.createClass('<div class="billboard-mark">          <div class="mark {{properties.type}}"></div><div class="address">{{properties.address}}</div>          <div class="info">            <span class="reserved">{{properties.reserved}}<strong>{{properties.strong}}</strong>,<br>            <strong>{{properties.price}} руб.</strong></div>          <a href="{{properties.photo}}" class="photo">Фото</a><br>          <a href="" data-id="{{properties.id}}" class="order {{properties.ordered}}">{{properties.btn_type}}</a>        </div>',{});_billboards_map_=o,o.behaviors.disable("scrollZoom"),$.each(billboards_json.items,function(r,s){var i="";if(s.reserved){var l="Зарезервирован до ";i=s.reserved}else if(s.available){var l="Доступно через ";i=s.available+jsTils(s.available,[" день"," дня"," дней"])}else var l="Доступен";var n=new ymaps.Placemark(s.position,{type:s.type,address:s.address,reserved:l,strong:i,price:triads(s.price),photo:s.photo,id:s.id,btn_type:"Заказать",ordered:""},{balloonContentLayout:t,balloonPanelMaxMapArea:0,balloonMaxWidth:500,iconLayout:"default#image",iconImageHref:a[s.type],iconImageSize:[53,65],iconImageOffset:[-26,-65]});n.events.add("balloonopen",function(){console.log("balloonopen!")}),_mapMarkers_.push({id:s.id,position:s.position,marker:n}),o.geoObjects.add(n),e()})});var i=$(".tabs-btn .selected");if("undefined"!=typeof billboards_json){var l=".billboards #list-view .order a, .billboard-mark .order";$(document).on("click",l,function(t){var r=$(this).closest("tr").attr("data-id")||$(this).attr("data-id");if(localstorageGet("billboards_ids"))var a=localstorageGet("billboards_ids");else var a=[];if($(this).is(".ordered")||$(this).closest("tr").is(".ordered")){var a=localstorageGet("billboards_ids");a.splice(a.indexOf(r),1)}else-1==a.indexOf(r)&&a.push(r);localstorageSet("billboards_ids",a),t.preventDefault(),o(),e()}),o(),e()}$(".billboards #list-view .price .numbers").each(function(){var e=$(this).text();$(this).text(triads(e))}),t(),$(document).on("click","#request-form .selected-billboards .unit .close",function(e){var o=$(this).closest(".unit").attr("data-id"),t=localstorageGet("billboards_ids");console.log(o,t),t.splice(t.indexOf(o),1),console.log(t);var a=$(this);localstorageSet("billboards_ids",t,function(){a.closest(".unit").fadeOut(300,function(){0==t.length&&r()})}),e.preventDefault()}),r(),$("#request-form").validate({rules:{org:"required",phone:"required"},messages:{org:"Обязательное поле",phone:"Обязательное поле"},submitHandler:function(e){var o=localstorageGet("billboards_ids");return o.length>0?($.ajax({type:$(e).attr("method"),url:$(e).attr("action"),dataType:"json",data:$(e).serialize()+"&"+$.param({billboards:o})}).done(function(e){console.log(e),jsonResponse=e,1==jsonResponse.status?($("#request-form .wrapper").slideUp(),$("#request-form .final").slideDown(),o=[],localstorageSet("billboards_ids",o)):alert("Произошёл сбой. Пожалуйста попробуйте ещё раз.")}).fail(function(e){console.log(e),alert("Произошёл сбой. Пожалуйста попробуйте ещё раз.")}),$("#request-form button").prop("disabled",!0)):$("#request-form .selected-billboards .title").css({color:"red"}),0==$(".selected-billboards").size()&&($.ajax({type:$(e).attr("method"),url:$(e).attr("action"),dataType:"json",data:$(e).serialize()}).done(function(e){console.log(e),jsonResponse=e,1==jsonResponse.status?($("#request-form .wrapper").slideUp(),$("#request-form .final").slideDown()):alert("Произошёл сбой. Пожалуйста попробуйте ещё раз.")}).fail(function(e){console.log(e),alert("Произошёл сбой. Пожалуйста попробуйте ещё раз.")}),$("#request-form button").prop("disabled",!0)),!1},invalidHandler:function(){var e=localstorageGet("billboards_ids");e.length<=0&&$("#request-form .selected-billboards .title").css({color:"red"})}}),$("body.billboards #list-view .address a").click(function(e){e.preventDefault();var o=$(this).closest("tr").attr("data-id");$(".tabs-btn .map-view").click(),setTimeout(function(){_mapMarkers_.forEach(function(e){e.id==o&&(_billboards_map_.setZoom(18),_billboards_map_.setCenter(e.position),console.log(e),e.marker.balloon.open())})},500)})}),$(function(){function e(e,o){o=o||function(){};var t=e.magnificPopup({type:"image",removalDelay:500,callbacks:{beforeOpen:function(){this.st.image.markup=this.st.image.markup.replace("mfp-figure","mfp-figure mfp-with-anim"),this.st.mainClass="mfp-move-from-top"},close:function(){o()}},closeOnContentClick:!0,showCloseBtn:!1,tLoading:"Загрузка..."});return t}e($("#list-view td.photo a")),$(document).on("click",".billboard-mark .photo",function(o){o.preventDefault(),e($(this)).magnificPopup("open")}),$(".content-wrapper .photos").magnificPopup({delegate:"a",type:"image",gallery:{enabled:!0,tPrev:"Предыдущая (Стрелка влево)",tNext:"Следующая (Стрелка вправо)",tCounter:'<span class="mfp-counter">%curr% из %total%</span>'},callbacks:{beforeOpen:function(){this.st.image.markup=this.st.image.markup.replace("mfp-figure","mfp-figure mfp-with-anim"),this.st.mainClass="mfp-move-from-top"}},image:{titleSrc:"title"}})}),$(function(){ymaps.ready(function(){var e=new ymaps.Map($("body.index .small-map, body.contacts .map")[0],{center:[47.24470432,39.72322986],zoom:18}),o=new ymaps.Placemark([47.24470432,39.72322986],{},{iconLayout:"default#image",iconImageHref:tribuna_theme_path_+"/images/ico-marker-mark.png",iconImageSize:[50,73],iconImageOffset:[-25,-73]});e.geoObjects.add(o),e.controls.remove("mapTools"),e.controls.remove("scaleLine"),e.controls.remove("searchControl"),e.controls.remove("trafficControl")})}),$(function(){$(".contacts-form").validate({rules:{name:"required",phone:"required",content:"required"},messages:{name:"Обязательное поле",phone:"Обязательное поле",content:"Обязательное поле"},submitHandler:function(e){return $.ajax({type:$(e).attr("method"),url:$(e).attr("action"),data:$(e).serialize()}).done(function(){$(".contacts-form .wrapper").slideUp(),$(".contacts-form .final").slideDown()}),!1}})});