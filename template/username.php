<?php
    header("Content-type:application/json");
    header("Access-Control-Allow-Origin: *");

    include 'Database.php';
    $database = new Database();
    $db = $database->getConnection();


    // $username=$_POST['username'];
    $data= json_decode(file_get_contents('php://input'), true);
    $username=$data['username'];
    $result=[];
    $stmt = $db->prepare("SELECT username FROM users where username=:u_name");
    $stmt->bindParam("u_name",$username);
    $stmt->execute(); 		
    $users= $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($users as $user)
    {
        if($user['username']===$username)
        {
           array_push($result,"This username is already taken");
        }
    }
echo (json_encode($result));
?>