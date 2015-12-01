define(["angular", "common/constants"], function (angular) {
    angular.module("cocktails.services", ["common.constants"])
        .service("CocktailsService", ["$log", "$q", "$http", "CocktailApi",
            function ($log, $q, $http, CocktailApi) {

                var cocktails = null;

                var cocktailsDetails = {};

                function getCocktails () {
                    var defered = $q.defer();

                    if(cocktails === null) {
                        $http({
                            url : CocktailApi.url,
                            method: "GET",
                            headers: {
                                "Content-type": "application/json"
                            }

                        }).then(function (response) {
                            cocktails = response.data.cocktails;
                            defered.resolve(cocktails);
                        }, function () {
                            defered.error();
                        });
                    } else {
                        defered.resolve(cocktails);
                    }
                    return defered.promise;
                }

                function getCocktail(id) {
                    var defered = $q.defer();

                    if(!cocktailsDetails.hasOwnProperty(id)) {
                        $http({
                            url : CocktailApi.url + "/" + id,
                            method: "GET",
                            headers: {
                                "Content-type": "application/json"
                            }

                        }).then(function (response) {
                            cocktailsDetails[id] = response.data.cocktail;
                            defered.resolve(cocktailsDetails[id]);
                        }, function () {
                            defered.error();
                        });
                    } else {
                        defered.resolve(cocktailsDetails[id]);
                    }
                    return defered.promise;
                }

                return {
                    getCocktails: getCocktails,
                    getCocktail: getCocktail
                };
            }]);
});
