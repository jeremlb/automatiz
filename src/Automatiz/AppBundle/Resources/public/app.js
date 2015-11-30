/*jshint unused: vars */
define(['angular', 'lumx', "fb", 'dashboard/controller', 'common/sidebar/controller', 'common/header/controller', "angular-material-icons", "users/controllers", "cocktails/controllers"]/*deps*/, function (angular, lumx)/*invoke*/ {
    'use strict';

    /**
     * Main module of the application.
     */
    var app = angular.module('automatizAdmin', [
            'lumx',
            'ngRoute',
            'Dashboard',
            'ngMdIcons',
            'common.header',
            'common.sidebar',
            'users.controllers',
            'cocktails.controllers'
        ]);

    app.config(["$locationProvider", "$routeProvider", function($locationProvider, $routeProvider) {
        $locationProvider.html5Mode({
            enabled: true,
            requireBase: false
        });

        $routeProvider.
            when('/', {
                templateUrl: '/bundles/automatizapp/app/dashboard/dashboard.html',
                controller: "DashboardCtrl",
                controllerAs: "dashboard"
            })
            .when('/cocktails', {
                templateUrl: '/bundles/automatizapp/app/cocktails/templates/cocktails.html',
                controller: "CocktailsListCtrl"
            })
            .when('/cocktails/:id', {
                templateUrl: '/bundles/automatizapp/app/cocktails/templates/get.html',
                controller: "CocktailsGetCtrl"
            })
            .when('/users', {
                templateUrl: '/bundles/automatizapp/app/users/templates/list.html',
                controller: "ListCtrl",
                controllerAs: "listusers"
            });
    }]);

    return app;

});
