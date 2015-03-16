
  var $infoBox = $('.tabs-btn .selected');
  
  function localstorageGet(key, callback) {
    if (Modernizr.localstorage) {
      if (localStorage.getItem(key)) {
        return JSON.parse(localStorage.getItem(key));
      } else {
        return false;
      }
      
    }
    callback = callback || function(){};
  }
  
  function localstorageSet(key, value, callback) {
    if (Modernizr.localstorage) {
      return localStorage.setItem(key, JSON.stringify(value));
    }
    callback = callback || function(){};
  }
  
  function jsTils(num, expressions) {
    var result;
    count = num % 100;
    if (count >= 5 && count <= 20) {
        result = expressions['2'];
    } else {
        count = count % 10;
        if (count == 1) {
            result = expressions['0'];
        } else if (count >= 2 && count <= 4) {
            result = expressions['1'];
        } else {
            result = expressions['2'];
        }
    }
    return result;
  }
  
  function triads(num) {
    num = num.toString();
    return num.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
  }
  
  function renderBtns() {
    var ids = localstorageGet('billboards_ids');
    $('.billboards #list-view tr').removeClass('ordered');
    if (ids) {
      ids.forEach(function(element, index){
        $('.billboards #list-view tr[data-id='+element+']').addClass('ordered');
      });
    }
  }
  
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
  
  var listViewBtns = '.billboards #list-view .order a';
  $(document).on('click', listViewBtns, function(e){
    var id = $(this).closest('tr').attr('data-id');
    if (localstorageGet('billboards_ids')) {
      var ids = localstorageGet('billboards_ids');
    } else {
      var ids = [];
    }
        
    if (!$(this).closest('tr').is('.ordered')) {
      if (ids.indexOf(id)==-1) {
        ids.push(id);
      }
    } else {
      var ids = localstorageGet('billboards_ids');
      ids.splice(ids.indexOf(id), 1);
    };
    
    localstorageSet('billboards_ids', ids);
    e.preventDefault();
    renderInfo();
    renderBtns();
  });
  
  renderInfo();
  renderBtns();
  
  $('.billboards #list-view .price .numbers').each(function(index){
    var num = $(this).text();
    $(this).text(triads(num));
  });