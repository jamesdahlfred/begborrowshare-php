app.controller("loginController", ["$scope", "$location", "authenticationService", function($scope, $location, authenticationService) {
  $scope.credentials = { email: "", password: "" };

  $scope.login = function() {
    authenticationService.login($scope.credentials).success(function() {
      $location.path("/home");
    });
  };
}]);