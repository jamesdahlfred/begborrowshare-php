app.controller("searchController", ["$scope", "searchService", function($scope, searchService) {
  $scope.query = "";

  $scope.search = function() {
    searchService.search($scope.query).success(function(data) {
      $location.path("/#/search?q=" + $scope.query);
      $scope.searchResults = data;
    });
  };

}]);