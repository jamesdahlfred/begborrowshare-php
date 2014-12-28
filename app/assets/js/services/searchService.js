app.service("searchService", ["$http", "$sanitize", "CSRF_TOKEN", function($http, $sanitize, CSRF_TOKEN) {
  var sanitizeQuery = function(credentials) {
    return {
      query: $sanitize(query),
      csrf_token: CSRF_TOKEN
    };
  };

  return {
    search: function(query) {
      return $http
        .post("/search", sanitizeQuery(sanitizeQuery))
        .success(function(){})
        .error(function(){})
      ;
    }
  };
}]);
