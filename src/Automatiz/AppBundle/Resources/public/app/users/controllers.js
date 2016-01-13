define(["angular", "users/services"], function (angular) {
   angular.module("users.controllers", ["users.services"])
    .controller("ListCtrl", ["$scope", "UsersService", function ($scope, UsersService) {
            $scope.$emit("page-change", {page: "list-user", title: "Liste des utilisateurs"});
            UsersService.getUsers().then(function (users) {
                console.log(users);
                $scope.users = users;
            }, function () {

            });
   }]);
});