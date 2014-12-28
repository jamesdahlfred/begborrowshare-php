app.service('sessionService', ['$cookieStore', function($cookieStore) {
  return {
    get: function(key) {
      if (Modernizr.sessionStorage) {
        return sessionStorage.getItem(key);
      } else {
        return $cookieStore.get(key);
      }
    },
    set: function(key, val) {
      if (Modernizr.sessionStorage) {
         return sessionStorage.setItem(key, val);
      } else {
        return $cookieStore.put(key, val);
      }
    },
    unset: function(key) {
      if (Modernizr.sessionStorage) {
        return sessionStorage.removeItem(key);
      } else {
        return $cookieStore.remove(key);
      }
    }
  }
}]);