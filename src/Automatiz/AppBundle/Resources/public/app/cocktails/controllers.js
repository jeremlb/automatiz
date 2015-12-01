/**
 * Created by jeremi on 16/11/2015.
 */
define(["angular", "lumx", "fb", "cocktails/services"], function (angular) {
    angular.module("cocktails.controllers", ["cocktails.services", "lumx"])
        .controller("CocktailsListCtrl", ["$scope", "CocktailsService", "LxProgressService", function ($scope, CocktailsService, LxProgressService) {
            var cocktails = [];

            function splitCocktailsRow(cocktails)
            {
                var cocktailsRows = [];
                var cocktailRow = [];

                for(var i = 0; i < cocktails.length; i += 1) {
                    if(i % 1 == 0 && i != 0) {
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

            $scope.cocktails = cocktails;

            console.log(cocktails.length);
            if(cocktails.length === 0) {
                LxProgressService.circular.show('primary', '#progress');
                CocktailsService.getCocktails().then(function (cocktailsResp) {
                    cocktails = cocktailsResp;
                    $scope.cocktails = cocktails;
                    $scope.cocktailsRows = splitCocktailsRow(cocktails);
                    setTimeout(function () {
                        LxProgressService.circular.hide();
                    }, 10);
                }, function () {
                });
            }
        }])


        .controller("CocktailsGetCtrl", ["$scope", "$routeParams", "CocktailsService", "LxProgressService", function ($scope, $routeParams, CocktailsService, LxProgressService) {
            $scope.cocktail = {};

            $scope.shareFB = function () {
                FB.ui({
                    method: 'feed',
                    link: 'http://automatiz.local:8000/share/' + $scope.cocktail.id,
                    caption: 'An automatiz amazing cocktail'
                }, function(response){});
            };

            $scope.getTwitterUrl = function () {
                return "http://automatiz.local:8000/share/" + $scope.cocktail.id;
            };

            CocktailsService.getCocktail($routeParams.id).then(function (response) {
                $scope.cocktail = response;
                console.log($scope.cocktail);
            }, function () {
                console.log("ERROR");
            });
        }]);
});