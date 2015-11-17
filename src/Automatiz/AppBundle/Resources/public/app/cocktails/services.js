define(["angular", "common/oauth", "common/constants"], function (angular) {
    angular.module("cocktails.services", ["common.oauth", "common.constants"])
        .service("CocktailsService", ["$log", "$q", "Oauth2Request", "CocktailApi",
            function ($log, $q, Oauth2Request, CocktailApi) {

                var cocktails = null;

                function getCocktails () {
                    var defered = $q.defer();

                    if(cocktails === null) {
                        Oauth2Request({
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
