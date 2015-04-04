<?php

require_once '../config/db.php';

$part_name        = $_POST['part_name'];
$part_type        = $_POST['part_type'];
$part_value       = $_POST['part_value'];
$part_price       = $_POST['part_price'];
$part_quantity    = $_POST['part_quantity'];

try {
    //Connect to the databasse
    $db  = new PDO("mysql:dbname=$dbDatabase;host=$dbHost", $dbUser, $dbPass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

try {
    $sql = $db->prepare("SELECT ID FROM Part ORDER BY ID DESC LIMIT 1");
    $sql->execute();
    ($sql->rowCount() == 1 ? $lastID = $sql->fetch(PDO::FETCH_ASSOC) : $lastID = 4000);

    $sql = $db->prepare("INSERT INTO Part(ID,Name,Value,Type,Price,Quantity)
                                 VALUES (?,?,?,?,?,?)"); 

    $partId = (int)$lastID['ID']+1;
    $sql->bindValue(1, $partId);
    $sql->bindValue(2, $part_name); 
    $sql->bindValue(3, $part_value); 
    $sql->bindValue(4, $part_type); 
    $sql->bindValue(5, $part_price); 
    $sql->bindValue(6, $part_quantity); 
    $sql->execute(); 

    echo 1;
}catch(PDOException $e){
    echo 0;
}

?>