var myApp = angular.module('myApp');

myApp.controller('FMEAController', function($scope, $http){
  $scope.base_url = 'http://localhost/spk_pk/server/api/';
  $scope.data_fmea = [];
  $scope.getFMEA = function(){
    $http.get($scope.base_url+'master-cacat/data-fmea.php').then(function(res){
      $scope.data_fmea = res;
      console.log(res)
    })
  }
})
