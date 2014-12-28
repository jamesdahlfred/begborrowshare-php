app.service("authenticationService", ["$http", "$sanitize", "sessionService", "flashService", "CSRF_TOKEN", function($http, $sanitize, sessionService, flashService, CSRF_TOKEN) {

  var cacheSession = function() {
    sessionService.set("authenticated", true);
  };

  var uncacheSession = function() {
    sessionService.unset("authenticated");
  };

  var loginError = function(response) {
    flashService.show(response.flash);
  };

  var sanitizeCredentials = function(credentials) {
    return {
      email: $sanitize(credentials.email),
      password: $sanitize(credentials.password),
      csrf_token: CSRF_TOKEN
    };
  };

  return {
    login: function(credentials) {
      var login = $http.post("/auth/login", sanitizeCredentials(credentials));
      login.success(cacheSession);
      login.success(flashService.clear);
      login.error(loginError);
      return login;
    },
    logout: function() {
      var logout = $http.get("/auth/logout");
      logout.success(uncacheSession);
      return logout;
    },
    isLoggedIn: function() {
      return sessionService.get("authenticated");
    }
  };
}]);
