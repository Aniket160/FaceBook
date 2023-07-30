<?php
session_start();

include ('Database.php');
$database = new Database();
$db = $database->getConnection();

$msg=[];
$id=$_SESSION['userid'];
$target_directory = "../facebook";
if(!is_dir($target_directory )){
    mkdir($target_directory);
}
if($_FILES['productimage']['name']!='')
{
   
   // rename($_FILES['productimage']['name'],$data[0]['username'].'jpg');
   print_r($_FILES);
   
   $path = $target_directory. '/' . basename($_FILES["productimage"]["name"]);
   // print_r($path);

echo("File will be saved at this path : " . $path. PHP_EOL);
$imageinfo = getimagesize($_FILES["productimage"]["tmp_name"]);
var_dump($imageinfo);

$isSafe = true;

if($imageinfo===false ||($imageinfo['mime']  != 'image/jpeg' && $imageinfo['mime']  != 'image/jpg' && $imageinfo['mime']  != 'image/png')){
    echo("<br>Only JPG and PNG is allowed <br><hr>");
    array_push($msg,"Only JPG and PNG is allowed");
    $isSafe = false;
}

if($_FILES["productimage"]["size"] > 100000000000){
    echo("<br>File size is more than allowed size<br><hr>");
    array_push($msg,"File size is more than allowed size");
    $isSafe = false;
}
if($isSafe == true){
   $image=time().'.jpg';
   $date=date("Y-m-d H:i:s");
   $contents=$_POST['content'];
   if(strlen($contents)>100)
   {
       $contents=substr($contents,0,100);
   }
    if (move_uploaded_file($_FILES["productimage"]["tmp_name"], $path)) {
        $stmt = $db->prepare("insert into  feeds (`user_id`,`content`,`image`,`DateAndTime`) values (:id,:content,:i,:d)");
        $stmt->bindParam(":id",$id);
        $stmt->bindParam(":content",$contents);
        $stmt->bindParam(":i",$image);
        $stmt->bindParam(":d",$date);
       $stmt->execute(); 
      if($stmt->rowCount()==1)
      {
         rename($path, $target_directory. '/' . $image);
         array_push($msg,"Successfully Added");
        //  header("Location:insertfeed.php");
      }
    }
    else{
        array_push($msg,"Faile to add");
    }

}

    
    $_SESSION['error']=$msg;
header("Location:insertfeed.php");
}
