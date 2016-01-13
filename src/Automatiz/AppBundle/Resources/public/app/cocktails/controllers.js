/**
 * Created by jeremi on 16/11/2015.
 */
define(["angular", "lumx", "cocktails/services"], function (angular) {
var module = angular.module("cocktails.controllers", ["cocktails.services", "lumx"]);

module.controller("CocktailsListCtrl", ["$scope", "$location", "ShareCocktail", "Cocktail", "LxProgressService",
function ($scope, $location, ShareCocktail, Cocktail, LxProgressService) {
    var cocktails = [];
    $scope.$emit("page-change", {page: "list-cocktail", title: "Liste de cocktails"});

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

    $scope.shareFB = function (cocktailId) {
        ShareCocktail.facebook(cocktailId);
    };

    $scope.getTwitterUrl = function (cocktailId) {
        return ShareCocktail.twitter(cocktailId);
    };



    $scope.cocktailsRows = splitCocktailsRow(cocktails);
    $scope.cocktails = cocktails;

    Cocktail.query().then(function (response) {
        cocktails = response.data.cocktails;
        $scope.cocktails = cocktails;
        $scope.cocktailsRows = splitCocktailsRow(cocktails);
        setTimeout(function () {
            LxProgressService.circular.hide();
        }, 10);
    });
}]);

module.controller("CocktailsGetCtrl", ["$scope", "$location", "ShareCocktail", "$routeParams", "Cocktail", "LxProgressService",
function ($scope, $location, ShareCocktail, $routeParams, Cocktail, LxProgressService) {
    $scope.cocktail = {};

    $scope.shareFB = function () {
        ShareCocktail.facebook($routeParams.id);
    };

    $scope.getTwitterUrl = function () {
        return ShareCocktail.twitter($routeParams.id);
    };

    Cocktail.get({id: $routeParams.id}).then(function (response) {
        console.log(response);
        $scope.cocktail = response.data.cocktail;

        $scope.$emit("page-change", {page: "get-cocktail", title: $scope.cocktail.name});
    });

    $scope.$emit("page-change", {page: "get-cocktail", title: ""});
}]);

module.controller("CocktailsNewCtrl", ["LxNotificationService", "Liquid", "Cocktail", "CocktailImage", "$location", "$scope",
function (LxNotificationService, Liquid, Cocktail, CocktailImage,  $location, $scope) {

    $scope.$emit("page-change", {page: "new-cocktail", title: "Créer un cocktail"});
    var that = this;

    this.cocktail = {
        steps: [{addIce: false}]
    };

    this.liquids = [];


    this.addStep = function () {
        var check = checkStep(that.cocktail.steps[that.cocktail.steps.length - 1]); // check the last step

        if(check === true) {
            that.cocktail.steps.push({
                addIce: false
            });
        } else {
            LxNotificationService.error("Certains champs sont vides !");
        }
    };

    this.addIce = function () {
        var laststep = that.cocktail.steps[that.cocktail.steps.length - 1];
        var check = checkStep(laststep);

        if(check) {
            that.cocktail.steps.push({addIce: true});
        } else {
            laststep.addIce = true;
        }
    };

    this.removeStep = function (index) {
        if(that.cocktail.steps.length > 1) {
            that.cocktail.steps.splice(index, 1);
        } else {
            LxNotificationService.info("Il n'est pas possible de supprimer toutes les étapes :D");
        }
    };

    this.cancelCocktail = function () {
        LxNotificationService.confirm('Hum... Tu veux pas créer de cocktail ?', 'En quitant cette page, pas de retour en arrière possible !', { cancel:'Je reste', ok:'Je veux m\'enfuir' }, function(answer)
        {
            if(answer === true) {
                $location.path("/cocktails");
            }
        });
    };

    this.saveCocktail = function () {
        var postData = {
            name: that.cocktail.name,
            description: that.cocktail.description,
            steps: formatStep(that.cocktail.steps)
        };

        Cocktail.save({cocktail: postData}).then(function (response) {
            var location = response.headers().location.split("/");
            var id = location[location.length - 1];
            console.log(id);

            if(that.cocktail.picture) {
                CocktailImage.save({id: id}, that.cocktail.picture)
                    .then(function (response) {
                        LxNotificationService.success("Cocktail créé");
                        $location.path("/cocktails");
                    });
            } else {
                LxNotificationService.success("Cocktail créé");
                $location.path("/cocktails");
            }
        });

        LxNotificationService.info("Création en cours");
    };

    this.imageChange = function (e) {
        that.cocktail.picture = e;
    };

    Liquid.query().$promise.then(function (response) {
        that.liquids = response.liquids;
    });

    // private method
    function checkStep(step) {
        if(step.addIce === true) {
            return true;
        } else {
            return (step.description !== undefined && step.quantity !== undefined && step.liquid !== undefined);
        }
    }

    function formatStep(steps) {
        var result = [];
        var step;
        var content;

        for(var i = 0; i < steps.length; i += 1) {
            step = steps[i];

            if(step.addIce) {
                content = {
                    addIce: true
                };
            } else {
                content = {
                    liquid: step.liquid.id,
                    quantity: parseInt(step.quantity, 10),
                    description: step.description
                };
            }
            result.push(content);
        }
        console.log(result);
        return result;
    }

}]);

});