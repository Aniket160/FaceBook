var app2 = angular.module('myapp4', []);
app2.controller('Admin', ["$scope", "$http","$q", function ($scope, $http,$q) {
    angular.element(document).ready(function () {
        $("#sidebar").height(1000);
    });

    $scope.collapse='collapse';
    $scope.categorylength;
    for (var i = 1; i <= 5; i++) {
        $scope['collapse' + i] = 'collapse';
        $scope['items'+i];
      }
    $scope.category=function()
    {
        $http({
            url:'http://localhost/facebook/template/category.php',
            method :'GET'
        }) .then(function (response) {
            $scope.categories = response.data;
            $scope.categorylength=$scope.categories.length;
        }, function (response) {
            
        });
        $scope.collapse = ($scope.collapse==='collapse')?'active':'collapse';
        for (var i = 1; i <= 5; i++) {
                $scope['collapse' + i] = 'collapse';
          }
    }
    
    $scope.items1=function(id)
    {
        
        console.log($scope[`collapse${id}`]);
        $http({
            url:'http://localhost/facebook/template/items.php',
            method :'POST',
            data:
            {
               'category_id':id,
            }
        }) .then(function (response) {
           $scope.items = response.data;
           $scope[`collapse${id}`] = ($scope[`collapse${id}`]==='collapse')?'active':'collapse';
        }, function (response) {
            alert ("Error in AJAX Call");
        });

        for (var i = 1; i <= 5; i++) {
            if(i==id)
            {
                continue;
            }
            else
            {
                $scope['collapse' + i] = 'collapse';
            }
          }
       
        }
    }]);