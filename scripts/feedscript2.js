var app2 = angular.module('myapp2', []);
app2.controller('Feed', ["$scope", "$http", "$q", function ($scope, $http, $q) {
    angular.element(document).ready(function () {
        $("#sidebar").height(6200);
    });
    $scope.like1=true;
    $scope.like2=true;
    $scope.feeds;
    $scope.feeds1= function (userid) {
        // alert(userid);
        $http({
            url: 'http://localhost/facebook/template/feedsexcept.php',
            method: 'post',
            data:
            {
                'userid': userid,
            }
        })
            .then(function (response) {
                $scope.feeds = response.data;
                // deferred.resolve($scope.feeds);
            }, function (response) {
                $scope.feeds = "Error in AJAX Call";
                // deferred.reject($scope.feeds);
            });
        //    console.log(deferred.promise);
        // return deferred.promise;
    }
   

    $scope.liked = function (id,feed) {
        // console.log(feed);
        alert(id);
        $http({
            url: 'http://localhost/facebook/template/liked.php',
            method: 'POST',
            data:
            {
                'userid': id,
                'feedid': feed[0]
            }
        }).then(function (response) {
          $scope.feeds=response.data;
        },function (){
            alert("Error in AJAX call"); 
        });
    }

    $scope.peopleliked=function(feedid)
    {
        $http({
            url:'http://localhost/facebook/template/peopleliked.php',
            method:'POST',
            data:{
                'feed_id':feedid,
            }
        }) .then(function (response) {
            $scope.people = response.data;
        }, function (response) {
            $scope.people = "Error in AJAX Call";
        });
        // console.log($scope.people);
    }


}]);