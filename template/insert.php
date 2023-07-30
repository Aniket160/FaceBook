<?php 
header("Content-type:application/json");
header("Access-Control-Allow-Origin: *");
include ('Database.php');
$database = new Database();
$db = $database->getConnection();

$arr=[];

// print_r($_POST);
if(count($arr)==0){
if(preg_match("/^[a-zA-Z]+$/",$_POST['firstname'])!=1)
{
    array_push($arr,"Invalid first name");
}
if(preg_match("/^[a-zA-Z]+$/",$_POST['lastname'])!=1)
{
    array_push($arr,"Invalid last name");
}
if(preg_match("/^[0-9]+$/",$_POST['age'])!=1)
{
    array_push($arr,"Invalid age");
}
if(preg_match("/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/",$_POST['email'])!=1)
{
    array_push($arr,"Please Enter the valid Email");
}
if(preg_match("/^([+]\d{2})?\d{10}$/",$_POST['mobile'])!=1)
{
    array_push($arr,"Please Enter the valid phone Number");
}
if(preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/",$_POST['password'])!=1)
{
      array_push($arr,"Please Enter the valid Password");
}
if($_POST['password']!==$_POST['rpassword'])
{
   array_push($arr,"Password and Repeat Password are not matching");
}
}
$stmt=$db->prepare("SELECT * FROM users where username=:u_name");
$stmt->bindParam(":u_name",$_POST['username']);
$stmt->execute();
$users=$stmt->fetchAll(PDO::FETCH_ASSOC);
    if(count($users)>0 && $_POST['username']===$users[0]['username'])
    {
        array_push($arr,"This username is already take please try with different Username");
    }
    // print_r($arr);
if(count($arr)==0){
$pwd=$_POST['password']; 
$age=(int)$_POST['age'];
$pincode=(int)$_POST['pincode'];
$stmt = $db->prepare("INSERT INTO `users` (`first_name`,`last_name`,`age`,`gender`,`email_id`,`username`,`pincode`,
`password`) VALUES (:f_name,:l_name,:age,:gender,:email,:username,:pincode,md5(:pwd))");
$stmt->bindParam(":f_name",$_POST['firstname']);
$stmt->bindParam(":l_name",$_POST['lastname']);
$stmt->bindParam(":age",$age);
$stmt->bindParam(":gender",$_POST['gender']);
$stmt->bindParam(":email",$_POST['email']);
$stmt->bindParam(":username",$_POST['username']);
$stmt->bindParam(":pincode",$pincode);
$stmt->bindParam(":pwd",$pwd);
$stmt->execute(); 		

if($stmt->rowCount()==1){
//    array_push($arr,"successfully added");
    // header("Location:login.html");
}
else{
  array_push($arr,"failed to add the data");
    // header("Location:signup.html");
}
}
echo(json_encode($arr));

?>