define(["angular"], function (angular) {
    angular.module("common.sidebar.services", [])
        .service('Sidebar', function()
        {
            var sidebarIsShown = false;

            return {
                toggleSidebar: function () {
                  sidebarIsShown = !sidebarIsShown;
                },
                isSidebarShown: function()
                {
                    return sidebarIsShown;
                }
            };
        });
});