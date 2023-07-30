<?php
session_start();
include ('Database.php');
$database = new Database();
$db = $database->getConnection();

// echo($_POST['follower']);
// echo($_POST['following']);
$str="SELECT follower from users where user_id=:u_id";
$stmt=$db->prepare($str);
$stmt->bindParam(":u_id",$_POST['following']);
$stmt->execute();
$followers=$stmt->fetchAll();
$follower=(json_decode($followers[0]['follower'],true));
$true=false;
if((gettype($follower)=='array'))
{
    foreach($follower as $follow)
    {
        if($follow==$_POST['follower'])
        {
            $true=true;
            print_r($follow." ".$_POST['follower']);
            $_SESSION['error']="Already following";
            // header("Location:person.php?userid=".$_POST['following']);
            // die();
        }
    }
    if(!$true)
    array_push($follower,(int)($_POST['follower']));
}
else
{
    $follower=[];
    array_push($follower,(int)($_POST['follower']));
}
if(!$true)
{
    $follower=json_encode($follower);
    // print_r($follower);
    $str1="UPDATE users set follower=:flwr where user_id=:u_id";
     
    $stmt=$db->prepare($str1);
    $stmt->bindParam(":flwr",$follower);
    $stmt->bindParam(":u_id",$_POST['following']);
    $stmt->execute();
    if($stmt->rowCount()==1)
    {
        echo("successful");
    }
    else
    {
        echo("Failed");
    }
}


$tru2=false;
$str="SELECT following from users where user_id=:u_id";
$stmt=$db->prepare($str);
$stmt->bindParam(":u_id",$_POST['follower']);
$stmt->execute();
$following=$stmt->fetchAll();
$follow=(json_decode($following[0]['following'],true));
if((gettype($follow)=='array'))
{
    foreach($follow as $foll)
    {
        if($foll==$_POST['following'])
        {
            $tru2=true;
            $_SESSION['error']="Already following";
            // header("Location:person.php?userid=".$_POST['following']);
            // die();
        }
    }
    if(!$tru2)
    array_push($follow,(int)$_POST['following']);
}
else
{
    $follow=[];
    array_push($follow,(int)($_POST['following']));
}

if(!$tru2)
{
    $follow=json_encode($follow);
    print_r($follow);
    $str1="UPDATE users set following=:flwr where user_id=:u_id";
     
    $stmt=$db->prepare($str1);
    $stmt->bindParam(":flwr",$follow);
    $stmt->bindParam(":u_id",$_POST['follower']);
    $stmt->execute();
    if($stmt->rowCount()==1)
    {
        $_SESSION['message']="Followed";
    }
    else
    {
        $_SESSION['error']="Failed to Add";
    }

}
header("Location:person.php?userid=".$_POST['following']);
?>