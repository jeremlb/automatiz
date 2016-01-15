define(["angular", "angular-chart", "common/services"], function (angular) {
    angular.module("Dashboard", ['angular-chartist', "common.services"])
        .controller("DashboardCtrl", ["$scope", "Me", function($scope, Me) {

            Me.stats().then(function (response) {
               console.log(response.data);
            });
            $scope.barData = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                series: [
                    [5, 4, 3, 7, 5, 10, 3, 4, 8, 10, 6, 8],
                    [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4]
                ]
            };
            $scope.onClick = function (points, evt) {
                console.log(points, evt);
            };

            $scope.$emit("page-change", {"page": "home", "title": "Accueil"});
        }]);
});