define(["angular", "common/sidebar/services", "common/services"], function (angular) {
    var module = angular.module("common.header", ["common.sidebar.services", "common.services"]);

    module.controller("HeaderCtrl", ["$scope", "Sidebar", "Me",
    function ($scope, Sidebar, Me) {
        $scope.me = {};
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

        Me.me().then(function (response) {
            $scope.me = response.data.me;
        });

    }]);
});
