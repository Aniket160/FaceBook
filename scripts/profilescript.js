var app2 = angular.module('myapp3', ['ui.bootstrap']);
app2.controller('Follow', ["$scope", "$http","$uibModal",function ($scope, $http,$uibModal) {
    angular.element(document).ready(function () {
        $("#sidebar").height($("#content").height());
    });

    $scope.followers1;
    $scope.following1;
    $scope.followers=function(id)
    {
        $http({
            url:'http://localhost/facebook/template/userfollower.php',
            method:'POST',
            data:{
                'userid':id,
            }
        }).then(function (response) {
            $scope.followers1 = response.data;
        }, function (response) {
            $scope.followers1 = "Error in AJAX Call";
        });

        var handle=$uibModal.open({
            templateUrl:'../template/followers.html',
            controller : ["$scope","$uibModalInstance",function($scope, $uibModalInstance){                
                $scope.ok=function(){
                    $uibModalInstance.close();
                };
            }],            
            scope:$scope
        })
    }

    $scope.following=function(id)
    {
        $http({
            url:'http://localhost/facebook/template/userfollowing.php',
            method:'POST',
            data:{
                'userid':id,
            }
        }).then(function (response) {
            $scope.following1 = response.data;
        }, function (response) {
            $scope.following1 = "Error in AJAX Call";
        });

        var handle=$uibModal.open({
            templateUrl:'../template/following.html',
            controller : ["$scope","$uibModalInstance",function($scope, $uibModalInstance){                
                $scope.ok=function(){
                    $uibModalInstance.close();
                };
            }],            
            scope:$scope
        })
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
        console.log($scope.people);
    }

}]);