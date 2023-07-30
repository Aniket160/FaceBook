<?php 
session_start();
header("Content-type:application/json");
header("Access-Control-Allow-Origin: *");

include ('Database.php');
$database = new Database();
$db = $database->getConnection();

$data=json_decode(file_get_contents('php://input'),true);
// echo($data['userid']);
// echo($data['feedid']);
$str="SELECT * from feeds inner join users on users.user_id=feeds.user_id where feeds.user_id <> :u_id order by feeds.feed_id desc";
$stmt=$db->prepare($str);
$stmt->bindParam("u_id",$data['userid']);
$stmt->execute();
$feeds=$stmt->fetchAll();
$id=0;
foreach($feeds as $feed)
{
   $likes=$feed['liked'];
   $likes=json_decode($likes,true);
   $ispresent=false;
   if(gettype($likes)=='array')
   {
     foreach($likes as $like)
     {
        if($like==$data['userid'])
       { 
            $ispresent=true;
            array_push($feeds[$id],true);
            break;
        }
     }
   }
   if(!$ispresent)
   {
    if(gettype($likes)!='array')
    {
        array_push($feeds[$id],false);
    }
    else
    {
        array_push($feeds[$id],false);
    }
     }

     if(gettype($likes)=='array')
     {
        array_push($feeds[$id],count($likes));
     }
     else if(gettype($likes)!='array')
     {
        array_push($feeds[$id],0);
     }

      $follower=json_decode($feed['follower'],true);
      $isfollower=false;
      if(gettype($follower)=='array')
      {
        foreach($follower as $follow)
        {
            if($follow==$data['userid'])
            {
                $isfollower=true;
                array_push($feeds[$id],true);
            }
        }
      }
      if(!$isfollower)
      {
        array_push($feeds[$id],false);
      }
$id++;
}


echo(json_encode($feeds));


?>