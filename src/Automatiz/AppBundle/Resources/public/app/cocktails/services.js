define(["angular", "angular-resource", "common/constants"], function (angular) {

var module = angular.module("cocktails.services", ["common.constants", "ngResource"]);

module.service("Cocktail", ["$http", function ($http) {
    var service = {
        save: save,
        get: get,
        query: query,
        update: update,
        remove: remove
    };

    var url = '/api/cocktails/:id';

    function query() {
        var uri = url.replace("/:id", "");
        return $http.get(uri);
    }

    function get(param) {
        var uri = url.replace(":id", param.id);
        return $http.get(uri);
    }

    function save(data) {
        var uri = url.replace("/:id", "");
        return $http.post(uri, data, {
            headers: {
                "Content-Type": "application/json"
            }
        });
    }

    function update () {

    }

    function remove () {

    }

    return service;
}]);

module.service("CocktailImage", ["$http", function ($http) {
    var service = {
        save: save
    };

    function save(param, file) {
        var data = new FormData();
        data.append('cocktail_image[file]', file);

        var url = "/api/cocktails/" + param.id + "/image";

        return $http.post(url, data, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined}
        });

    }
    return service;
}]);

module.service("Liquid", ["$resource", function ($resource) {
    return $resource("/api/liquid", {}, {
        query: {
            method: "GET",
            cache: true
        },
        save : {method: "POST"}
    });
}]);

});
