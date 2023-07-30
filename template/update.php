<?php
session_start();

include ('Database.php');
$database = new Database();
$db = $database->getConnection();

$updated=false;
$stmt = $db->prepare("SELECT * FROM users where user_id=:u_id");
$stmt->bindParam(":u_id",$_POST['id']);
$stmt->execute(); 
$data=$stmt->fetchAll();
// print_r($data);
$id=$_POST['id'];
$target_directory = "../facebook";
if(!is_dir($target_directory )){
    mkdir($target_directory);
}
if($_FILES['productimage']['name']!='')
{
   $updated=true;
   
   // rename($_FILES['productimage']['name'],$data[0]['username'].'jpg');
   // print_r($_FILES);
   
   $path = $target_directory. '/' . basename($_FILES["productimage"]["name"]);
   // print_r($path);

echo("File will be saved at this path : " . $path. PHP_EOL);
$imageinfo = getimagesize($_FILES["productimage"]["tmp_name"]);
// print_r($imageinfo);

$isSafe = true;

if($imageinfo===false ||($imageinfo['mime']  != 'image/jpeg' && $imageinfo['mime']  != 'image/jpg' && $imageinfo['mime']  != 'image/png')){
    echo("<br>Only JPG is allowed <br><hr>");
    $_SESSION['error1']="Only JPG is allowed";
    $isSafe = false;
}

if($_FILES["productimage"]["size"] > 102400000){
    echo("<br>File size is more than allowed size<br><hr>");
    $_SESSION['error2']="File size is more than allowed size";
    $isSafe = false;
}
if($isSafe == true){
   $image=time().'.jpg';
    if (move_uploaded_file($_FILES["productimage"]["tmp_name"], $path)) {
        $stmt = $db->prepare("UPDATE users set image=:image_name where user_id=:u_id");
        $stmt->bindParam(":image_name",$image);
        $stmt->bindParam(":u_id",$_SESSION['userid']);
       $stmt->execute(); 
      if($stmt->rowCount()==1)
      {
         rename($path, $target_directory. '/' . $image);
         echo('success');
        echo("<br>File uploaded successfully <br><hr>");
      }
    }
    else{
        echo("<br>Error in uplading file <br><hr>");
    }
}
}


if($_POST['firstname']!='')
{
   $updated=true;
   $fname=$_POST['firstname'];
}
else
{
   $fname=$data[0]['first_name'];
}
if($_POST['lastname']!='')
{
   $updated=true;
   $lname=$_POST['lastname'];
}
else
{
   $lname=$data[0]['last_name'];
}
if($_POST['age']!='')
{
   $updated=true;
   $age=$_POST['age'];
}
else
{
   $age=$data[0]['age'];
}
if($_POST['email']!='')
{
   $updated=true;
   $email=$_POST['email'];
}
else
{
   $email=$data[0]['email_id'];
}
if($_POST['pincode']!='')
{
   $updated=true;
   $pincode=$_POST['pincode'];
}
else
{
   $pincode=$data[0]['pincode'];
}
if($_POST["gender"]!='')
{
   $updated=true;
   $gender=$_POST['gender'];
}
else
{
   $gender=$data[0]['gender'];
}
$stmt = $db->prepare("UPDATE users
SET
first_name = :f,
last_name = :l,
age = :a ,
gender=:g,
email_id = :e,
pincode = :p
WHERE user_id = :u_id");
$stmt->bindParam(":f",$fname);
$stmt->bindParam(":l",$lname);
$stmt->bindParam(":a",$age);
$stmt->bindParam(":g",$gender);
$stmt->bindParam(":e",$email);
$stmt->bindParam(":p",$pincode);
$stmt->bindParam(":u_id",$id);
$stmt->execute(); 		
$prdoucts= $stmt->fetchAll(PDO::FETCH_ASSOC);

$_SESSION['message']="Successfully Updated the Profile";


if(isset($_POST['password']) && $_POST['password']!='')
{
   $updated=true;
   $password=$_POST['password'];
   $stmt=$db->prepare("update users set password=md5(:p) where user_id=:u");
   $stmt->bindParam(":p",$password); 
   $stmt->bindParam(":u",$id);
   $stmt->execute();
   if($stmt->rowCount()==1)
   {
      $_SESSION['message']="Successfully Updated the Profile and Password";
   } 
}
if(!$updated)
{
   $_SESSION['message']="You have not selected anything";
}
header("Location:profile.php");
?>