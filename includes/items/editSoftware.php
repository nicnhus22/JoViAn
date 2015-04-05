<?php

require_once '../config/db.php';

$software_name        = $_POST['software_name'];
$software_type        = $_POST['software_type'];
$software_price       = $_POST['software_price'];
$software_size        = $_POST['software_size'];
$software_quantity    = $_POST['software_quantity'];

try {
    //Connect to the databasse
    $db  = new PDO("mysql:dbname=$dbDatabase;host=$dbHost", $dbUser, $dbPass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

try {
    $sql = $db->prepare("SELECT ID FROM Software ORDER BY ID DESC LIMIT 1");
    $sql->execute();
    ($sql->rowCount() == 1 ? $lastID = $sql->fetch(PDO::FETCH_ASSOC) : $lastID = 3000);

    $sql = $db->prepare("INSERT INTO Software(ID,Name,Size,Type,Price,Quantity)
                                 VALUES (?,?,?,?,?,?)"); 

    $softwareID = (int)$lastID['ID']+1;
    $sql->bindValue(1, $softwareID);
    $sql->bindValue(2, $software_name); 
    $sql->bindValue(3, $software_size); 
    $sql->bindValue(4, $software_type);
    $sql->bindValue(5, $software_price); 
    $sql->bindValue(6, $software_quantity); 
    $sql->execute(); 

    echo 1;
}catch(PDOException $e){
    echo 0;
}

?>