define(["angular", "fb", "angular-resource", "common/constants"], function (angular) {

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

    function query(params) {
        var urlparams = {};
        if(params && params.liquid) {
            urlparams["liquid"] = params.liquid;
        }
        var uri = url.replace("/:id", "");
        return $http.get(uri, {
            params: urlparams
        });
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

module.service("Note", ["$resource", function ($resource) {
    return $resource("/api/cocktails/:id/note", {id: "@id"}, {
        save : {method: "POST"}
    });
}]);

module.service("ShareCocktail", ["$location", function ($location) {
    var service = {
        facebook: shareFacebook,
        twitter: shareTwitter
    };

    var port = ($location.port() !== 80)? ":"+$location.port(): "";
    var url = $location.host() + port + "/share/";

    url = "http://www.automatiz.fr/share/5696816e2f374";

    var text = 'An automatiz amazing cocktail';

    function shareFacebook(cocktailId) {
        FB.ui({
            method: 'feed',
            link: url, //+ cocktailId,
            name: 'Daiquiri',
            picture: 'http://www.automatiz.fr/uploads/cocktails_pictures/570d6634895e17cca41ed3a059e9290c.jpeg',
            caption: 'www.automatiz.fr',
            description: 'Appelé aussi à tort "Daikiri", cette recette fût inventée en 1896 par l\'ingénieur "Pagliuchi" quand il visita une mine de fer nommée "Daïquirí" à l\'est de Cuba, où travaillait "Jennings S. Cox", un ingénieur américain. La journée de travail terminée, Pagliuchi proposa de boire un verre.'
        }, function(response){});
    }

    function shareTwitter(cocktailId) {
        return [
            "https://twitter.com/intent/tweet?text=",
            text,
            "via=automatiz&url=",
            url + cocktailId
        ].join("");
    }

    return service;
}]);

});
