app.controller("resultsController", ["$scope", "$location", "$routeParams", "searchService", function($scope, $location, $routeParams, searchService) {
  
  $scope.query = $routeParams['query'];
  $scope.results = [];
  
  searchService.search($scope.query).success(function(data) {
    $scope.results = data;
  });

}]);