<?php 
session_start();
header("Content-type:application/json");
header("Access-Control-Allow-Origin: *");

include ('Database.php');
$database = new Database();
$db = $database->getConnection();

$data=json_decode(file_get_contents('php://input'),true);
$stmt=$db->prepare("SELECT * FROM items where category_id=:c_id");
$stmt->bindParam(":c_id",$data['category_id']);
$stmt->execute();
$categories=$stmt->fetchAll();

print_r(json_encode($categories));

?>