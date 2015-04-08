/* jshint devel:true */
//console.log('\'Allo \'Allo!');

function arrayObjectIndexOf(myArray, searchTerm, property) {
    for(var i = 0, len = myArray.length; i < len; i++) {
        if (myArray[i][property] === searchTerm) return i;
    }
    return -1;
}

function triads(num) {
  num = num.toString();
  return num.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
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

function localstorageGet(key, callback) {
  if (Modernizr.localstorage) {
    //return lscache.get(key);
    if (lscache.get(key)) {
      //return JSON.parse(lscache.get(key));
      return lscache.get(key);
    } else {
      localStorage.clear();
      return false;
    }
  }
}

function localstorageSet(key, value, callback) {
  if (Modernizr.localstorage) {
    lscache.set(key, JSON.stringify(value), 24*60);
    //lscache.set(key, value, 24*60);
    //localStorage.setItem(key, JSON.stringify(value));
  }
  callback = callback || function(){};
  callback();
}
