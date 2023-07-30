<?php 
session_start();
header("Content-type:application/json");
header("Access-Control-Allow-Origin: *");

include ('Database.php');
$database = new Database();
$db = $database->getConnection();

$stmt=$db->prepare("SELECT * FROM categories");
$stmt->execute();
$categories=$stmt->fetchAll();

print_r(json_encode($categories));

?>