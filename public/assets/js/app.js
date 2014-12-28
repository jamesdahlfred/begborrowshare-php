;(function($,window,document,undefined){'use strict';var app = app || angular.module("begborrowshare", ["ngSanitize", "ngResource", "ngRoute", "ngAnimate", "ngCookies", "ngTouch"]);

app.config(["$routeProvider", "$httpProvider", function($routeProvider, $httpProvider) {
  $routeProvider
    .when("/dashboard", {
      templateUrl: "/assets/partials/dashboard.html"
    })
    .when("/account", {
      templateUrl: "/assets/partials/account.html"
    })
    .when("/settings", {
      templateUrl: "/assets/partials/settings.html"
    })
    .when("/login", {
      templateUrl: "/assets/partials/login.html"
    })
    .when("/search", {
      templateUrl: "/assets/partials/search.html"
    })
    .when("/", {
      templateUrl: "/assets/partials/home.html"
    })
    .otherwise({
      redirectTo: "/"
    })
  ;

  // var logsOutUserOn401 = function($location, $q, sessionService, flashService) {
  //   var success = function(response) {
  //     return response;
  //   };

  //   var error = function(response) {
  //     if(response.status === 401) {
  //       sessionService.unset("authenticated");
  //       $location.path("/login");
  //       flashService.show(response.data.flash);
  //     }
  //     return $q.reject(response);
  //   };

  //   return function(promise) {
  //     return promise.then(success, error);
  //   };
  // };

  // $httpProvider.responseInterceptors.push(logsOutUserOn401);

}]);

app.run(["$rootScope", "$location", "authenticationService", "flashService", function($rootScope, $location, authenticationService, flashService) {

  var routesThatRequireAuth = ["/account", "/beg/:id", "/borrow/:id", "/share/:id"];

  $rootScope.$on("$routeChangeStart", function(event, next, current) {

    if (routesThatRequireAuth.indexOf($location.path()) > -1 && !authenticationService.isLoggedIn()) {
      $location.path("/login");
      flashService.show("Please log in to continue.");
    }

    $(".navbar-brand, .navbar a").each(function(i, el) {
      var fragment = $(el).attr("href");
      if (location.href.substr(location.href.indexOf(fragment)) == fragment) {
        $(el).parent().addClass("active");
      } else {
        $(el).parent().removeClass("active");
      }
    });
  });

}]);;
app.controller("loginController", ["$scope", "$location", "authenticationService", function($scope, $location, authenticationService) {
  $scope.credentials = { email: "", password: "" };

  $scope.login = function() {
    authenticationService.login($scope.credentials).success(function() {
      $location.path("/home");
    });
  };
}]);;
app.controller("searchController", ["$scope", "searchService", function($scope, searchService) {
  $scope.query = "";

  $scope.search = function() {
    searchService.search($scope.query).success(function(data) {
      $location.path("/#/search?q=" + $scope.query);
      $scope.searchResults = data;
    });
  };

}]);;
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
;
app.service("flashService", ["$rootScope", function($rootScope) {
  return {
    show: function(message) {
      $rootScope.flash = message;
    },
    clear: function() {
      $rootScope.flash = "";
    }
  }
}]);;
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
;
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
}]);})(jQuery,window,document);