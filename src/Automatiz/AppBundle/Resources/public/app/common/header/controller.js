define(["angular", "common/sidebar/services"], function (angular) {
    angular.module("common.header", ["common.sidebar.services"])
        .controller("HeaderCtrl", ["$scope", "Sidebar", function ($scope, Sidebar) {
            $scope.icon = "menu";
            $scope.Sidebar = Sidebar;

            $scope.clickIconMorph = function() {
                if ($scope.icon === 'menu') {
                    $scope.icon = 'arrow_back';
                }
                else {
                    $scope.icon = 'menu';
                }
                Sidebar.toggleSidebar();
            };
        }]);
});
