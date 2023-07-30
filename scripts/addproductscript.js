var app2 = angular.module('myapp5', ['ui.bootstrap']);
app2.controller('Add', ["$scope", "$http","$q","$uibModal","$timeout","$location",
function ($scope, $http,$q,$uibModal,$timeout,$location) { 
    angular.element(document).ready(function () {
        $("#sidebar").height(1000);
    });

    $scope.categoryName;
    $scope.collapse='collapse';
    $scope.categorylength;
    for (var i = 1; i <= 7; i++) {
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
        for (var i = 1; i <= 7; i++) {
                $scope['collapse' + i] = 'collapse';
          }
    }
    $scope.category1=function()
    {
        $http({
            url:'http://localhost/facebook/template/category.php',
            method :'GET'
        }) .then(function (response) {
            $scope.categories = response.data;
            $scope.categorylength=$scope.categories.length;
        }, function (response) {
            
        });
        for (var i = 1; i <= 7; i++) {
                $scope['collapse' + i] = 'collapse';
          }
    }
    $scope.category();
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

        for (var i = 1; i <= 7; i++) {
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

        $scope.showmessage;
        $scope.showError;
        $scope.addcategory=function()
        {
            var handle=$uibModal.open({
                templateUrl:'../template/addcategory.html',
                controller : ["$scope","$uibModalInstance",function($scope, $uibModalInstance){                
                    $scope.upload = function()
                    {
                       var file= document.getElementById('file').files[0];
                       var formData = new FormData();
                       formData.append('name',$scope.formData.categoryName);
                       formData.append('file',file);

                       $http({
                        url:'http://localhost/facebook/template/insertcategory.php',
                        method:'POST',
                        data : formData,
                        headers: {'Content-Type': undefined},
                       }).then(function (response) {
                        $scope.insertresponse = response.data;
                    }, function (response) {
                        $scope.insertresponse = "Error in AJAX Call";
                    });
                     
                    $timeout(()=>
                    {     
                            if($scope.insertresponse[0]['message']!=''){
                           window.location.href="http://localhost/facebook/template/addproduct.php";
                        }
                      },5000)
                      
                    }
                    $scope.close=function(){
                        $uibModalInstance.close();
                    };
                }],            
                scope:$scope
            })
        }
        $scope.categoryid;
        $scope.additems=function(id)
        {
            $scope.categoryid=id;
            var handle=$uibModal.open({
                templateUrl:'../template/additems.html',
                controller : ["$scope","$uibModalInstance",function($scope, $uibModalInstance){
                    $http({
                        url:'http://localhost/facebook/template/items.php',
                        method :'POST',
                        data:
                        {
                           'category_id':id,
                        }
                    }) .then(function (response) {
                       $scope.itemstodisplay = response.data;
                    }, function (response) {
                        alert ("Error in AJAX Call");
                    });                
                    $scope.upload = function()
                    {
                       var file= document.getElementById('file').files[0];
                       var formData = new FormData();
                       formData.append('name',$scope.formData.categoryName);
                       formData.append('file',file);

                       $http({
                        url:'http://localhost/facebook/template/insertitem.php',
                        method:'POST',
                        data : formData,
                        headers: {'Content-Type': undefined},
                       }).then(function (response) {
                        $scope.insertresponse = response.data;
                    }, function (response) {
                        $scope.insertresponse = "Error in AJAX Call";
                    });       
                    }
                    $scope.close=function(){
                        $uibModalInstance.close();
                    };
                }],            
                scope:$scope
            })
        };

    }]);