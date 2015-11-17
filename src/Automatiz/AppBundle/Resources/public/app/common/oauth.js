define(["angular", "common/constants"], function (angular) {
    angular.module("common.oauth", ["common.constants"])
        .factory("Oauth2PasswordService", ["$http", "$q", "$log", "Oauth2",
        function ($http, $q, $log, Oauth2) {
            var access_token = null;
            var refresh_token = null;
            var expired_in = null;

            var getTimestamp = function () {
                return Math.floor(new Date().getTime()/1000);
            };

            function isValid() {
                return expired_in !== null && (expired_in > (getTimestamp() + 10));
            }

            function getAccessToken() {
                var defered = $q.defer();

                if(isValid()) {
                    defered.resolve(access_token);
                } else {
                    $http({
                        method: "GET",
                        url: Oauth2.token_url,
                        params: {
                            client_id: Oauth2.client_id,
                            client_secret: Oauth2.client_secret,
                            grant_type: Oauth2.grant_type,
                            scope: Oauth2.scope,
                            username: Oauth2.username,
                            password: Oauth2.password
                        },
                        headers: {
                            "Content-Type": "application/json"
                        }
                    }).success(function(response) {
                        access_token = response.access_token;
                        refresh_token = response.refresh_token;
                        expired_in =  getTimestamp() + response.expires_in;
                        defered.resolve(access_token);
                    }).error(function (data, status) {
                        defered.error(status);
                    });
                }

                return defered.promise;
            }

            return {
                getAccessToken: getAccessToken
            };
        }])
        .factory("Oauth2Request", ["$log", "$q", "$http", "Oauth2PasswordService", function ($log, $q, $http, Oauth2PasswordService) {
            return function (config) {
                var defered = $q.defer();

                Oauth2PasswordService.getAccessToken().then(function (access_token) {
                    if(!config.headers) {
                        config.headers = {};
                    }
                    config.headers["Authorization"] = "Bearer " + access_token;
                    $http(config).then(function (response) {
                        defered.resolve(response);
                    }, function () {
                        defered.error();
                    })
                }, function () {
                    defered.error();
                });

                return defered.promise;
            };
        }]);
});
