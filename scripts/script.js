var app = angular.module('myapp',[]);
app.controller('SignUp',["$scope", "$http","$q", function($scope, $http,$q){

    $scope.users;
    $scope.firstname = '';
    $scope.first_name_valid_flag;
    $scope.message='';
    $scope.iscorrect;

    $scope.lastname;
    $scope.last_name_valid_flag;
    $scope.message1='';
    $scope.iscorrect1;

    $scope.age;
    $scope.age_valid_flag;
    $scope.message2;
    $scope.iscorrect2;

    $scope.gender;

    $scope.email;
    $scope.email_valid_flag;
    $scope.message3;
    $scope.iscorrect3;

    $scope.mobile;
    $scope.mobile_valid_flag;
    $scope.message4;
    $scope.iscorrect4;

    $scope.username;
    $scope.username_valid_flag;
    $scope.message5;
    $scope.iscorrect5;

    $scope.pincode;
    $scope.pincode_valid_flag;
    $scope.message6;
    $scope.iscorrect6;

    $scope.getAllUsers = function(){
        $http({
            url : 'http://localhost/facebook/template/getUsers.php',
            method : 'GET',            
        })
        .then(function(response){
            $scope.users = response.data; //data is builtin variable that contains all the data received from api
        },function(response){
            alert("Error in AJAX Call");
        });
         
    };
    $scope.validate1=function()
    {
        if(/[a-zA-Z]{3,}$/.exec($scope.firstname)!=null && /[a-zA-Z]{3,}$/.exec($scope.firstname)[0]===$scope.firstname)
        {
            $scope.first_name_valid_flag = false;
            $scope.message="";

        }
        else if($scope.firstname.length >=3)
        {
            $scope.message="Minimum character should be 3 and Number is not allowed";
            $scope.iscorrect=false;
             $scope.first_name_valid_flag = true;
             
        }
    }
    $scope.validate2=function()
    {
        if(/[a-zA-Z]{3,}$/.exec($scope.lastname)!=null && /[a-zA-Z]{3,}$/.exec($scope.lastname)[0]===$scope.lastname)
        {
            $scope.last_name_valid_flag = false;
            $scope.message1="";

        }
        else if($scope.lastname.length >=3)
        {
            $scope.message1="Minimum character should be 3 and Number is not allowed";
            $scope.iscorrect1=false;
             $scope.last_name_valid_flag = true;
             
        }
    }

    $scope.validate3=function()
    {
        if($scope.age>0 && $scope.age< 100)
        {
            $scope.age_valid_flag = false;
            $scope.message2="";

        }
        else if($scope.age>=100 || $scope.age <= 0)
        {
            $scope.message2="Invalid Age";
            $scope.iscorrect2=false;
             $scope.age_valid_flag = true;
             
        }
    }

    $scope.validate4=function()
    {
        if(/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.exec($scope.email)!=null && /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.exec($scope.email)[0]===$scope.email)
        {
            $scope.email_valid_flag = false;
            $scope.message3="";

        }
        else if($scope.email.length >=10)
        {
            $scope.message3="Invalid Email";
            $scope.iscorrect3=false;
             $scope.email_valid_flag = true;
             
        }
    }

    $scope.validate5=function()
    {
        console.log($scope.mobile);
        if(/^(\+\d{1,3}[- ]?)?\d{10}$/.exec($scope.mobile)!=null && /^(\+\d{1,3}[- ]?)?\d{10}$/.exec($scope.mobile)[0]===$scope.mobile)
        {
            $scope.mobile_valid_flag = false;
            $scope.message4="";

        }
        else if($scope.mobile.length>5)
        {
            $scope.message4="Invalid Mobile";
            $scope.iscorrect4=false;
             $scope.mobile_valid_flag = true;
             
        }
    }

    $scope.validate6=function()
    {
        // console.log($scope.username);
        var deferred=$q.defer();
      
        if($scope.username.length>3)
        {
            $http({
                url :'http://localhost/facebook/template/username.php',
                method : 'POST',
                data:
                {    
                   'username':$scope.username,
                }             
            })
            .then(function(response){
                $scope.users = response.data;
                deferred.resolve($scope.users);
              if($scope.users.length>0)
              {
                $scope.message5="This username is already exists please try different";
                $scope.iscorrect5=false;
                 $scope.username_valid_flag = true;
              }
              else
              {
                $scope.username_valid_flag = false;
                $scope.message5="";
              }
            },function(response){
                $scope.users="Error in AJAX Call";
                deferred.reject($scope.users);
            });
            //    console.log(deferred.promise);
            return deferred.promise;
        }
    }

}]);