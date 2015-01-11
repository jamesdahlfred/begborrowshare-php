app.service("searchService", ["$http", "$sanitize", "CSRF_TOKEN", "flashService", function($http, $sanitize) { // , CSRF_TOKEN, flashService
  // var sanitizeQuery = function(query) {
  //   return {
  //     query: $sanitize(query),
  //     csrf_token: CSRF_TOKEN
  //   };
  // };

  return {
    search: function(query) {
      return $http.get("/search/" + $sanitize(query));
    }
  };
}]);
