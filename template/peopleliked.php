<?php 
header("Content-type:application/json");
header("Access-Control-Allow-Origin: *");
include ('Database.php');
$database = new Database();
$db = $database->getConnection();

$arraypeople=[];
$data=json_decode(file_get_contents('php://input'),true);
$result=array();
$str="SELECT liked FROM feeds where feed_id=:f_id";
$stmt=$db->prepare($str);
$stmt->bindParam(":f_id",$data['feed_id']);
$stmt->execute();
$people=$stmt->fetchAll();


// $people=json_decode($people,true);
$userids=$people[0]['liked'];
$useridsarray=explode(",",$userids);

foreach($useridsarray as $useridarray)
{
    $useridarr=explode(":",$useridarray);
    if(count($useridarr)>1)
    {
        $userid=$useridarr[1];
    }
    else
    {
        $userid=$useridarr[0];
    }

    $userid=trim($userid,"[");
    $userid=trim($userid,"]");
    $userid=trim($userid,"{");
    $userid=trim($userid,"}");
    $userid1=(int)$userid;
   array_push($arraypeople,$userid1);

   
}
// print_r($arraypeople);

$str2="SELECT first_name , last_name , image FROM users WHERE user_id =:u_id";
foreach($arraypeople as $people)
{
    $stmt=$db->prepare($str2);
    $stmt->bindParam(":u_id",$people);
    $stmt->execute();
    $users=$stmt->fetch();
   array_push($result,$users);
}

print_r(json_encode($result));

?>