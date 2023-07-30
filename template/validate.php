<?php 

header("Content-type:application/json");
header("Access-Control-Allow-Origin: *");
include_once('Database.php');
$database = new Database();
$db = $database->getConnection();
$arr=[];
$isvalid=false;
if($_POST['username']==='')
{
$isvalid=false;
   array_push($arr,"Username and password should not be empty");
}
else if ($_POST['password']==='')
{
$isvalid=false;
   array_push($arr,"Username and password should not be empty"); 
}
if(count($arr)==0){
    $username=$_POST['username'];
    
    $pwd=$_POST['password'];
    
    // print_r($_POST['password']);
    // echo($pwd);.
    // echo("<br>");

    $stmt = $db->prepare("SELECT * FROM users where username=:u_name");
    $stmt->bindParam(":u_name",$username);
$stmt->execute(); 
$datas=$stmt->fetchAll();
// print_r($datas);
// print_r($pwd);
if(count($datas)>0)
{
    if( $username===$datas[0]['username']  && $datas[0]['password']===md5($pwd))
    {
        $isvalid=true;
        if(isset($_SESSION))
        {
            session_destroy();
        }
        if($datas[0]['typeofuser']=='admin')
        {
            array_push($arr,"admin");
        }
        session_start();
        // echo(session_id());
        $_SESSION['userid']=$datas[0]['user_id'];
        $_SESSION['username']=$username;
        // print_r($_SESSION);
        // header("Location:profile.php");
    
    }
    else
    {
        $isvalid=false;
    }
}   
}
if($isvalid==false)
{
    array_push($arr,"Username or password is not correct");
}
echo(json_encode($arr));

?>