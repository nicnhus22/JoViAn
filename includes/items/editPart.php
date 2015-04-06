<?php

require_once '../config/db.php';

$part_name        = $_POST['part_name'];
$part_type        = $_POST['part_type'];
$part_value       = $_POST['part_value'];
$part_price       = $_POST['part_price'];
$part_quantity    = $_POST['part_quantity'];
$part_id          = $_POST['part_id'];

try {
    //Connect to the databasse
    $db  = new PDO("mysql:dbname=$dbDatabase;host=$dbHost", $dbUser, $dbPass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

try {
    $sql = $db->prepare("UPDATE Part 
                         SET Name=?,Value=?,Type=?,Price=?,Quantity=?
                         WHERE ID=?"); 

    $sql->bindValue(1, $part_name); 
    $sql->bindValue(2, $part_value); 
    $sql->bindValue(3, $part_type); 
    $sql->bindValue(4, $part_price); 
    $sql->bindValue(5, $part_quantity); 
    $sql->bindValue(6, $part_id); 
    $sql->execute(); 

    echo 1;
}catch(PDOException $e){
    echo 0;
}

?>