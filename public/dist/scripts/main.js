function arrayObjectIndexOf(e,r,o){for(var t=0,a=e.length;a>t;t++)if(e[t][o]===r)return t;return-1}function triads(e){return e=e.toString(),e.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g,"$1 ")}function jsTils(e,r){var o;return count=e%100,count>=5&&count<=20?o=r[2]:(count%=10,o=1==count?r[0]:count>=2&&count<=4?r[1]:r[2]),o}function localstorageGet(e){return Modernizr.localstorage?localStorage.getItem(e)?JSON.parse(localStorage.getItem(e)):!1:void 0}function localstorageSet(e,r,o){Modernizr.localstorage&&localStorage.setItem(e,JSON.stringify(r)),(o=o||function(){})()}console.log("'Allo 'Allo!"),$(function(){function e(e){t.slideUp(),t.eq(e).slideDown()}function r(){$activeBtn=o.filter(".active"),index=o.index($activeBtn),e(index)}var o=$(".tabs-btn>a"),t=$(".tabs>.tab");r(),o.click(function(e){e.preventDefault(),$(this).is(".active")||(o.removeClass("active"),$(this).addClass("active"),_mapMarkers_.forEach(function(e){e.marker.balloon.close()}),r())})});var _mapMarkers_=[];$(function(){function e(){var e=localstorageGet("billboards_ids");$(".billboards #list-view tr").removeClass("ordered"),_mapMarkers_.forEach(function(e){var r=e.marker.properties.get("type");e.marker.properties.set("btn_type","Заказать"),e.marker.properties.set("ordered",""),e.marker.options.set("iconImageHref",a[r])}),e&&e.forEach(function(e){$(".billboards #list-view tr[data-id="+e+"]").addClass("ordered"),_mapMarkers_.forEach(function(r){if(e==r.id){var o=r.marker.properties.get("type");r.marker.properties.set("btn_type","Отменить"),r.marker.properties.set("ordered","ordered"),r.marker.options.set("iconImageHref",s[o])}})})}function r(){var e=localstorageGet("billboards_ids"),r=0,o=0;if(e){e.forEach(function(e){billboards_json.items.forEach(function(t){e==t.id&&(r+=1,o+=t.price)})});var t=jsTils(r,["Выбран ","Выбрано ","Выбрано "])+r+jsTils(r,[" щит"," щита"," щитов"]);o=triads(o),i.find(".count").text(t),i.find(".numbers").text(o+" рублей."),0==r?i.hide():i.show()}else i.hide()}function o(){"undefined"!=typeof billboards_json&&localstorageSet("billboards_json",billboards_json.items)}function t(){if($("#request-form .selected-billboards").size()){var e=localstorageGet("billboards_ids"),r=localstorageGet("billboards_json");if(e&&r&&e.length>0){var o=[];e.forEach(function(e){r.forEach(function(r){e==r.id?$('<div class="unit" data-id="'+r.id+'">'+r.address+'<a href="" class="close"></a></div>').prependTo("#request-form .selected-billboards .list"):o.push(e)})}),o.forEach(function(r){e.splice(e.indexOf(r),1)})}else $("#request-form .selected-billboards .title").text("Вы не выбрали ни одного щита."),$("#request-form .selected-billboards .more a").text("Добавить щит")}}var a={yellow:tribuna_theme_path_+"/images/ico-marker_yellow.png",green:tribuna_theme_path_+"/images/ico-marker_green.png",red:tribuna_theme_path_+"/images/ico-marker_red.png"},s={yellow:tribuna_theme_path_+"/images/ico-marker_yellow_ordered.png",green:tribuna_theme_path_+"/images/ico-marker_green_ordered.png",red:tribuna_theme_path_+"/images/ico-marker_red_ordered.png"};"undefined"!=typeof billboards_json&&ymaps.ready(function(){var r=new ymaps.Map("billboard-map",{center:billboards_json.center,zoom:billboards_json.zoom}),o=ymaps.templateLayoutFactory.createClass('<div class="billboard-mark">          <div class="mark {{properties.type}}"></div><div class="address">{{properties.address}}</div>          <div class="info">            <span class="reserved">{{properties.reserved}}<strong>{{properties.strong}}</strong>,<br>            <strong>{{properties.price}} руб.</strong></div>          <a href="{{properties.photo}}" class="photo">Фото</a><br>          <a href="" data-id="{{properties.id}}" class="order {{properties.ordered}}">{{properties.btn_type}}</a>        </div>',{});r.behaviors.disable("scrollZoom"),$.each(billboards_json.items,function(t,s){var i="";if(s.reserved){var l="Зарезервирован до ";i=s.reserved}else if(s.available){var l="Доступно через ";i=s.available+jsTils(s.available,[" день"," дня"," дней"])}else var l="Доступен";var n=new ymaps.Placemark(s.position,{type:s.type,address:s.address,reserved:l,strong:i,price:triads(s.price),photo:s.photo,id:s.id,btn_type:"Заказать",ordered:""},{balloonContentLayout:o,balloonPanelMaxMapArea:0,balloonMaxWidth:500,iconLayout:"default#image",iconImageHref:a[s.type],iconImageSize:[53,65]});n.events.add("balloonopen",function(){console.log("balloonopen!")}),_mapMarkers_.push({id:s.id,marker:n}),r.geoObjects.add(n),e()})});var i=$(".tabs-btn .selected");if("undefined"!=typeof billboards_json){var l=".billboards #list-view .order a, .billboard-mark .order";$(document).on("click",l,function(o){var t=$(this).closest("tr").attr("data-id")||$(this).attr("data-id");if(localstorageGet("billboards_ids"))var a=localstorageGet("billboards_ids");else var a=[];if($(this).is(".ordered")||$(this).closest("tr").is(".ordered")){var a=localstorageGet("billboards_ids");a.splice(a.indexOf(t),1)}else-1==a.indexOf(t)&&a.push(t);localstorageSet("billboards_ids",a),o.preventDefault(),r(),e()}),r(),e()}$(".billboards #list-view .price .numbers").each(function(){var e=$(this).text();$(this).text(triads(e))}),o(),$(document).on("click","#request-form .selected-billboards .unit .close",function(e){var r=$(this).attr("data-id"),o=localstorageGet("billboards_ids");console.log(r,o),o.splice(o.indexOf(r),1),console.log(o);var a=$(this);localstorageSet("billboards_ids",o,function(){a.closest(".unit").fadeOut(300,function(){0==o.length&&t()})}),e.preventDefault()}),t(),$("#request-form").validate({rules:{org:"required",phone:"required"},messages:{org:"Обязательное поле",phone:"Обязательное поле"},submitHandler:function(e){var r=localstorageGet("billboards_ids");return r.length>0?($.ajax({type:$(e).attr("method"),url:$(e).attr("action"),dataType:"json",data:$(e).serialize()+"&"+$.param({billboards:r})}).done(function(e){console.log(e),jsonResponse=e,1==jsonResponse.status?($("#request-form .wrapper").slideUp(),$("#request-form .final").slideDown(),r=[],localstorageSet("billboards_ids",r)):alert("Произошёл сбой. Пожалуйста попробуйте ещё раз.")}).fail(function(e){console.log(e),alert("Произошёл сбой. Пожалуйста попробуйте ещё раз.")}),$("#request-form button").prop("disabled",!0)):$("#request-form .selected-billboards .title").css({color:"red"}),!1},invalidHandler:function(){var e=localstorageGet("billboards_ids");e.length<=0&&$("#request-form .selected-billboards .title").css({color:"red"})}})}),$(function(){function e(e,r){r=r||function(){};var o=e.magnificPopup({type:"image",removalDelay:500,callbacks:{beforeOpen:function(){this.st.image.markup=this.st.image.markup.replace("mfp-figure","mfp-figure mfp-with-anim"),this.st.mainClass="mfp-move-from-top"},close:function(){r()}},closeOnContentClick:!0,showCloseBtn:!1,tLoading:"Загрузка..."});return o}e($("#list-view td.photo a")),$(document).on("click",".billboard-mark .photo",function(r){r.preventDefault(),e($(this)).magnificPopup("open")})}),$(function(){ymaps.ready(function(){var e=new ymaps.Map($("body.index .small-map, body.contacts .map")[0],{center:[47.24470432,39.72322986],zoom:18}),r=new ymaps.Placemark([47.24470432,39.72322986],{},{iconLayout:"default#image",iconImageHref:tribuna_theme_path_+"/images/ico-marker-mark.png",iconImageSize:[50,73],iconImageOffset:[-25,-73]});e.geoObjects.add(r),e.controls.remove("mapTools"),e.controls.remove("scaleLine"),e.controls.remove("searchControl"),e.controls.remove("trafficControl")})}),$(function(){$(".contacts-form").validate({rules:{name:"required",phone:"required",message:"required"},messages:{name:"Обязательное поле",phone:"Обязательное поле",message:"Обязательное поле"},submitHandler:function(e){return $.ajax({type:$(e).attr("method"),url:$(e).attr("action"),data:$(e).serialize()}).done(function(){$(".contacts-form .wrapper").slideUp(),$(".contacts-form .final").slideDown()}),!1}})});