define(["angular", "lumx"], function (angular) {
   angular.module("cocktails.directives", ["lumx"])
    .directive("listCocktails", function () {
        return {
            restrict: "E",
            scope: {
                "cocktails": "="
            },
            link: function ($scope, element, attrs, ctrls) {

            }
        };
    })
});