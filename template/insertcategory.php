<?php


session_start();
header("Content-type:application/json");
header("Access-Control-Allow-Origin: *");

$res=[];
include ('Database.php');
$database = new Database();
$db = $database->getConnection();

if(isset($_POST) && isset($_FILES['file']) && $_POST['name']!='' && $_FILES['file']['name']!='')
{
    $path ='../facebook/' . basename($_FILES["file"]["name"]);
    move_uploaded_file($_FILES["file"]["tmp_name"], $path);
    $stmt=$db->prepare("INSERT INTO categories (`category_name`,`image`) values
    (:name,:path)");
    $stmt->bindParam(":name",$_POST['name']);
    $stmt->bindParam(":path",$path);
    $stmt->execute();
    if($stmt->rowCount()==1)
    {
     array_push($res,array('message'=>'Successfully Added Please Wait....'));
    }
    else
    {
            array_push($res,array('error'=>'Unable to add please wait'));
    }
    
}
else
{
        array_push($res,array('error'=>'Please Select both the fields'));
}
print_r(json_encode($res));
?>