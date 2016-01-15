requirejs.config({
    baseUrl: "/bundles/automatizapp/app",
    paths: {
        "jquery": "../bower_components/jquery/dist/jquery.min",
        "angular-chart": "../bower_components/angular-chartist.js/dist/angular-chartist.min",
        "chartist": "../bower_components/chartist/dist/chartist.min",
        "angular": "../bower_components/angular/angular",
        "angular-route": "../bower_components/angular-route/angular-route.min",
        "angular-resource": "../bower_components/angular-resource/angular-resource.min",
        "lumx": "../bower_components/lumx/dist/lumx",
        "moment-with-locales": "../bower_components/moment/min/moment-with-locales",
        "velocity": "../bower_components/velocity/velocity",
        "angular-material-icons": "../lib/angular-material-icons/angular-material-icons",
        "svg-morpheus": "../bower_components/svg-morpheus/compile/minified/svg-morpheus",
        "css": "../bower_components/require-css/css.min",
        "facebook": '//connect.facebook.net/en_US/sdk'
    },
    shim: {
        "angular": {
            exports: 'angular'
        },
        "lumx": {
            deps: ["velocity", "angular", "jquery", "moment-with-locales"],
            exports: "lumx"
        },
        "angular-resource": {
            deps: ["angular"],
            exports: "angular-resource"
        },
        "angular-chart": {
            deps: ["chartist", "angular"],
            exports: "angular-chart"
        },
        "angular-route": {
            deps: ["angular"],
            exports: "angular-route"
        },
        "angular-material-icons": {
            deps: ["angular", "svg-morpheus"],
            exports: "angular-material-icons"
        },
        "facebook": {
            exports: "FB"
        }
    }
});

window.name = 'NG_DEFER_BOOTSTRAP!';

requirejs([ "angular", "../app", "angular-route", "lumx",
        "css!../css/lumx",
        "css!../bower_components/chartist/dist/chartist.min",
        "css!../lib/angular-material-icons/angular-material-icons",
        "css!../css/font-roboto"],
            function (angular, app) {
    'use strict';

    angular.bootstrap(document, [app.name]);
    angular.element(document).ready(function() {
        angular.resumeBootstrap();
    });



});