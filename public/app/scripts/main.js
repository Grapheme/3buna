/* jshint devel:true */
console.log('\'Allo \'Allo!');

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
    localStorage.setItem(key, JSON.stringify(value));
  }
  callback = callback || function(){};
  callback();
}
