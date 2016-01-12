define(["angular"], function (angular) {
    var module = angular.module("common.controller", []);
    module.controller("MainCtrl", ["$scope", function ($scope) {
        var that = this;

        this.page = "";
        $scope.$on("page-change", function (event, page) {
            that.page = page.title;
        });
    }]);
});