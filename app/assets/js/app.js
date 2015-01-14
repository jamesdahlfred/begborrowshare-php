var app = app || angular.module("begborrowshare", ["ngSanitize", "ngResource", "ngRoute", "ngAnimate", "ngCookies", "ngTouch", "ui.utils"]);

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
    .when("/results/:query", {
      templateUrl: "/assets/partials/results.html"
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

}]);