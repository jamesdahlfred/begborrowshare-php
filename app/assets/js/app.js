var app = app || angular.module("begborrowshare", ["ngSanitize", "ngResource", "ngRoute", "ngAnimate", "ngCookies", "ngTouch", "ui.utils", "relativeDate", "pascalprecht.translate"]);

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

app.config(["$translateProvider", function($translateProvider) {
  $translateProvider.translations('en', {
      just_now: 'just now',
      seconds_ago: '{{time}} seconds ago',
      a_minute_ago: 'a minute ago',
      minutes_ago: '{{time}} minutes ago',
      an_hour_ago: 'an hour ago',
      hours_ago: '{{time}} hours ago',
      a_day_ago: 'yesterday',
      days_ago: '{{time}} days ago',
      a_week_ago: 'a week ago',
      weeks_ago: '{{time}} weeks ago',
      a_month_ago: 'a month ago',
      months_ago: '{{time}} months ago',
      a_year_ago: 'a year ago',
      years_ago: '{{time}} years ago',
      over_a_year_ago: 'over a year ago',
      seconds_from_now: '{{time}} seconds from now',
      a_minute_from_now: 'a minute from now',
      minutes_from_now: '{{time}} minutes from now',
      an_hour_from_now: 'an hour from now',
      hours_from_now: '{{time}} hours from now',
      a_day_from_now: 'tomorrow',
      days_from_now: '{{time}} days from now',
      a_week_from_now: 'a week from now',
      weeks_from_now: '{{time}} weeks from now',
      a_month_from_now: 'a month from now',
      months_from_now: '{{time}} months from now',
      a_year_from_now: 'a year from now',
      years_from_now: '{{time}} years from now',
      over_a_year_from_now: 'over a year from now'
  });
  $translateProvider.preferredLanguage('en');
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