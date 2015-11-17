requirejs.config({
    baseUrl: "/bundles/automatizapp/app",
    paths: {
        "jquery": "../bower_components/jquery/dist/jquery.min",
        "chart": "../bower_components/Chart.js/Chart.min",
        "angular-chart": "../bower_components/angular-chart.js/dist/angular-chart.min",
        "angular": "../bower_components/angular/angular",
        "angular-route": "../bower_components/angular-route/angular-route.min",
        "angular-ui-router": "../bower_components/angular-ui-router/release/angular-ui-router.min",
        "angular-aria": "../bower_components/angular-aria/angular-aria.min",
        "angular-sanitize": "../bower_components/angular-sanitize/angular-sanitize.min",
        "angular-material-icons": "../lib/angular-material-icons/angular-material-icons",
        "angular-material": "../bower_components/angular-material/angular-material.min",
        "angular-animate":  "../bower_components/angular-animate/angular-animate.min",
        "svg-morpheus": "../bower_components/svg-morpheus/compile/minified/svg-morpheus",
        "lumx": "../bower_components/lumx/dist/lumx",
        "moment-with-locales": "../bower_components/moment/min/moment-with-locales",
        "velocity": "../bower_components/velocity/velocity",
        "css": "../bower_components/require-css/css.min",
    },
    shim: {
        "angular": {
            exports: 'angular'
        },
        "lumx": {
            deps: ["angular", "jquery", "moment-with-locales", "velocity"],
            exports: "lumx"
        },
        "angular-aria": {
            deps: ["angular"],
            exports: "angular-aria"
        },
        "angular-animate": {
            deps: ["angular"],
            exports: "angular-animate"
        },
        "angular-ui-router": {
            deps: ["angular"],
            exports: "angular-ui-router"
        },
        "angular-sanitize": {
            deps: ["angular", "angular-aria"],
            exports: "angular-sanitize"
        },
        "material-calendar": {
            deps: ["angular", "angular-material", "angular-sanitize"],
            exports: "angular-sanitize"
        },
        "angular-material": {
            deps: ["angular", "angular-aria", "angular-animate"],
            exports: "angular-material"
        },
        "angular-chart": {
            deps: ["angular"],
            exports: "angular-chart"
        },
        "angular-material-icons": {
            deps: ["angular", "svg-morpheus"],
            exports: "angular-material-icons"
        },
        "angular-route": {
            deps: ["angular"],
            exports: "angular-route"
        }
    }
});

window.name = 'NG_DEFER_BOOTSTRAP!';

requirejs([ "angular", "../app", "angular-route", "lumx", "angular-material",
        "css!../css/lumx",
        "css!../bower_components/angular-chart.js/dist/angular-chart.min",
        "css!../lib/angular-material-icons/angular-material-icons",
        "css!../bower_components/angular-material/angular-material.min",
        "css!../bower_components/angular-material/angular-material.layouts.min",
        "css!../css/font-roboto"],
            function (angular, app, ngRoutes, lumx) {
    'use strict';

    angular.bootstrap(document, [app.name]);
    angular.element(document).ready(function() {
        angular.resumeBootstrap();
    });
});