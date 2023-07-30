<?php
session_start();
$target_directory = "facebook";
if(!is_dir($target_directory )){
    mkdir($target_directory);
}
print_r($_FILES);

$path = $target_directory. '/' . basename($_FILES["productimage"]["name"]);

echo("File will be saved at this path : " . $path. PHP_EOL);
$imageinfo = getimagesize($_FILES["productimage"]["tmp_name"]);
print_r($imageinfo);

$isSafe = true;

if($imageinfo['mime']  != 'image/jpeg' && $imageinfo['mime']  != 'image/jpg' &&  $imageinfo['mime']  != 'image/png'){
    echo("<br>Only JPG & PNG is allowed <br><hr>");
    $isSafe = false;
}

if($_FILES["productimage"]["size"] > 102400000){
    echo("<br>File size is more than allowed size<br><hr>");
    $isSafe = false;
}
if($isSafe == true){
    if (move_uploaded_file($_FILES["productimage"]["tmp_name"], $path)) {
        include ('Database.php');
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare("UPDATE users set image=:image_name where user_id=:u_id");
        $stmt->bindParam(":image_name",$_FILES['productimage']['name']);
        $stmt->bindParam(":u_id",$_SESSION['userid']);
       $stmt->execute(); 
      if($stmt->rowCount()==1)
      {
        echo("<br>File uploaded successfully <br><hr>");
      }
    }
    else{
        echo("<br>Error in uplading file <br><hr>");
    }
}
?>