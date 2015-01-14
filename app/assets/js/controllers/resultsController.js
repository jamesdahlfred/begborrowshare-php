app.controller("resultsController", ["$scope", "$location", "$routeParams", "searchService", function($scope, $location, $routeParams, searchService) {
  
  $scope.query = $routeParams["query"];
  $scope.results = [];
  
  searchService.search($scope.query).success(function(data) {
    $scope.results = data;
  });

  $scope.sort = {
    column: '',
    descending: false
  };    

  $scope.sortBy = function(column) {
    var sort = $scope.sort;

    if (sort.column == column) {
      sort.descending = !sort.descending;
    } else {
      sort.column = column;
      sort.descending = false;
    }
  };

}]);
