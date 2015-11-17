define(["angular", "common/sidebar/directives", "common/sidebar/services"], function (angular) {
   angular.module("common.sidebar", ['angAccordion', "common.sidebar.services"])
        .controller("SidebarCtrl", ["$scope", "Sidebar", function ($scope, Sidebar) {
           $scope.Sidebar = Sidebar;

       }]);
});
