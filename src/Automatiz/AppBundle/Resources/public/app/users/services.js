define(["angular", "common/oauth", "common/constants"], function (angular) {
   angular.module("users.services", ["common.oauth", "common.constants"])
    .service("UsersService", ["$log", "$q", "Oauth2Request", "UserApi",
       function ($log, $q, Oauth2Request, UserApi) {

           var users = null;

           function getUsers () {
               var defered = $q.defer();

               if(users === null) {
                   Oauth2Request({
                       url : UserApi.url,
                       method: "GET",
                       headers: {
                           "Content-type": "application/json"
                       }

                   }).then(function (response) {
                       users = response.data.users;
                       defered.resolve(users);
                   }, function () {
                       defered.error();
                   });
               } else {
                   defered.resolve(users);
               }
               return defered.promise;
           }

           function getUser() {

           }

           return {
               getUsers: getUsers,
               getUser: getUser
           };
       }]);
});
