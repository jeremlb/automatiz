/**
 * Created by jeremi on 16/11/2015.
 */
define(["angular", "lumx", "cocktails/services"], function (angular) {
    angular.module("cocktails.controllers", ["cocktails.services", "lumx"])
        .controller("CocktailsListCtrl", ["$scope", "CocktailsService", "LxProgressService", function ($scope, CocktailsService, LxProgressService) {
            var cocktails = [];

            function splitCocktailsRow(cocktails)
            {
                var cocktailsRows = [];
                var cocktailRow = [];

                for(var i = 0; i < cocktails.length; i += 1) {
                    if(i % 4 == 0 && i != 0) {
                        cocktailsRows.push(cocktailRow);
                        cocktailRow = [];
                        cocktailRow.push(cocktails[i]);
                    } else if((i + 1) >= cocktails.length) {
                        cocktailRow.push(cocktails[i]);
                        cocktailsRows.push(cocktailRow);
                    } else {
                        cocktailRow.push(cocktails[i]);
                    }
                }

                return cocktailsRows;
            }

            $scope.cocktailsRows = splitCocktailsRow(cocktails);
            console.log(cocktails.length)
            if(cocktails.length === 0) {
                LxProgressService.circular.show('primary', '#progress');
                CocktailsService.getCocktails().then(function (cocktailsResp) {
                    cocktails = cocktailsResp;
                    $scope.cocktailsRows = splitCocktailsRow(cocktails);
                    setTimeout(function () {
                        LxProgressService.circular.hide();
                    }, 10);
                }, function () {
                });
            }
        }])

        .controller("CocktailsGetCtrl", ["$scope", "CocktailsService", "LxProgressService", function ($scope, CocktailsService, LxProgressService) {
            console.log("coucou get");
        }]);
});