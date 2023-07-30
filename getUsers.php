<?php
    header("Content-type:application/json");
    header("Access-Control-Allow-Origin: *");

    include 'Database.php';
    $database = new Database();
    $db = $database->getConnection();

    $stmt = $db->prepare("SELECT username FROM users");
    $stmt->execute(); 		
    $prdoucts= $stmt->fetchAll(PDO::FETCH_ASSOC);
echo (json_encode($prdoucts));
?>