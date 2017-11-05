var myApp = angular.module('myApp', ['ngRoute', 'ngAnimate', 'angularUtils.directives.dirPagination']);

myApp.config(function($routeProvider,$locationProvider){
    $locationProvider.hashPrefix('');
    $routeProvider.when('/', {
        controller: 'HomeController',
        templateUrl: 'views/home.html'
    })
    .when('/master/cacat', {
        controller:  'CacatController',
        templateUrl: 'views/cacat.html'
    })
    .when('/master/produk', {
        controller: 'ProdukController',
        templateUrl: 'views/produk.html'
    })
    .when('/dashboard/peta-kendali', {
        controller: 'THController',
        templateUrl: 'views/hitung-cacat.html'
    })
    .when('/dashboard/peta-kendali-variable', {
        controller: 'PKVController',
        templateUrl: 'views/peta-variable.html'
    })
    .when('/dashboard/produksi', {
        controller: 'PController',
        templateUrl: 'views/produksi.html'
    })
    .when('/dashboard/produksi-variable', {
        controller: 'ProdVarController',
        templateUrl: 'views/produksi-variable.html'
    })
    .when('/dashboard/fmea', {
      controller: 'FMEAController',
      templateUrl: 'views/fmea.html'
    })
    .otherwise({
        redirectTo: '/'
    });
})
