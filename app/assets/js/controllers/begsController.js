app.controller("begsController", ["$scope", "searchService", function($scope, searchService) {
  
  $scope.results = [];

  searchService.latestBegs().success(function(data) {
    $scope.results = data;
  });

}]);
