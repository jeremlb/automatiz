define(["angular"], function (angular) {
   angular.module("cocktails.filters", [])
    .filter("cocktailsearch", function () {
        return function (list, search) {
            var result = [];

            if(search !== undefined) {
                for(var i = 0; i < list.length; i += 1) {
                    if(list[i].name.toUpperCase().indexOf(search.toUpperCase()) > -1 ) {
                        result.push(list[i]);
                    }
                }
            } else {
                result = list;
            }

            return result;
        };
    });
});