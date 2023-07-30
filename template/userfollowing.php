<?php 
session_start();
header("Content-type:application/json");
header("Access-Control-Allow-Origin: *");

include ('Database.php');
$database = new Database();
$db = $database->getConnection();

$res=[];
$data=json_decode(file_get_contents('php://input'),true);

$str1="SELECT following from users where user_id=:u_id";

$stmt=$db->prepare($str1);
$stmt->bindParam(":u_id",$data['userid']);
$stmt->execute();
$followers=$stmt->fetch();
$followersArray=(json_decode($followers['following'],true));
foreach($followersArray as $followerArray)
{
    $userid=(int)$followerArray;
    // var_dump($userid);
    $str2="SELECT first_name,last_name,image from users where user_id=:u_id";
    $stmt=$db->prepare($str2);
$stmt->bindParam(":u_id",$userid);
$stmt->execute();
$user=$stmt->fetch();
if(gettype($user)=='array')
array_push($res,$user);
}
print_r(json_encode($res));


?>