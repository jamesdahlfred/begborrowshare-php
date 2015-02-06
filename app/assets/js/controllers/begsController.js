app.controller("begsController", ["$scope", "searchService", function($scope, searchService) {
  
  $scope.results = [];

  searchService.latestBegs().success(function(data) {
    for (var i = 0; i < data.length; i++) {
      var ca = data[i].created_at.split(/[- :]/);
      data[i].beggar = angular.fromJson(data[i].beggar);
      data[i].categories = angular.fromJson(data[i].categories);
      data[i].created_at = new Date(Date.UTC(ca[0], ca[1]-1, ca[2], ca[3], ca[4], ca[5]));
    };
    $scope.results = data;
  });

}]);
