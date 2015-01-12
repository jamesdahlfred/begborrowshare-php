app.controller("searchController", ["$scope", "$location", "$routeParams", "searchService", function($scope, $location, $routeParams, searchService) {
  
  $scope.query = $routeParams['query'];
  $scope.results = [];
  
  $scope.search = function() {
    searchService.search($scope.query).success(function(data) {
      $location.path("/results/" + $scope.query);
      // $scope.results = data;
    });
  };

}]);