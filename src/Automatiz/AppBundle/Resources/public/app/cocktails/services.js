define(["angular", "common/constants"], function (angular) {
    angular.module("cocktails.services", ["common.constants"])
        .service("CocktailsService", ["$log", "$q", "$http", "CocktailApi",
            function ($log, $q, $http, CocktailApi) {

                var cocktails = null;

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
                            $log.debug(response);
                            cocktails = response.data.cocktails;
                            defered.resolve(cocktails);
                        }, function () {
                            defered.error();
                        });
                    } else {
                        defered.resolve(cocktails)
                    }
                    return defered.promise;
                }

                function getCocktail() {

                }

                return {
                    getCocktails: getCocktails,
                    getCocktail: getCocktail
                };
            }]);
});
