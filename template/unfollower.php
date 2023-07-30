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

    $i=0;
    foreach($follower as $follow)
    {
        if($follow==$_POST['follower'])
        {
            unset($follower[$i]);
            break;
        }
        $i++;
    }

    $follower=json_encode($follower);
    
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


$str="SELECT following from users where user_id=:u_id";
$stmt=$db->prepare($str);
$stmt->bindParam(":u_id",$_POST['follower']);
$stmt->execute();
$following=$stmt->fetchAll();
$follow=(json_decode($following[0]['following'],true));
$j=0;
    foreach($follow as $foll)
    {
        if($foll==$_POST['following'])
        {
            unset($follow[$j]);
            break;
        }
        $j++;
    }

    $follow=json_encode($follow);
    $str1="UPDATE users set following=:flwr where user_id=:u_id";
     
    $stmt=$db->prepare($str1);
    $stmt->bindParam(":flwr",$follow);
    $stmt->bindParam(":u_id",$_POST['follower']);
    $stmt->execute();
    if($stmt->rowCount()==1)
    {
        $_SESSION['error']="UNFollowed";
    }
    else
    {
        $_SESSION['error']="Failed to Unfollow  ";
    }

header("Location:person.php?userid=".$_POST['following']);
?>