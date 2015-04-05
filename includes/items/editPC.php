<?php

require_once '../config/db.php';

$pc_name        = $_POST['pc_name'];
$pc_cpu         = $_POST['pc_cpu'];
$pc_ram         = $_POST['pc_ram'];
$pc_hd          = $_POST['pc_hd'];
$pc_price       = $_POST['pc_price'];
$pc_quantity    = $_POST['pc_quantity'];

try {
    //Connect to the databasse
    $db  = new PDO("mysql:dbname=$dbDatabase;host=$dbHost", $dbUser, $dbPass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

try {
    $sql = $db->prepare("SELECT ID FROM PC ORDER BY ID DESC LIMIT 1");
    $sql->execute();
    ($sql->rowCount() == 1 ? $lastID = $sql->fetch(PDO::FETCH_ASSOC) : $lastID = 1000);

    $sql = $db->prepare("INSERT INTO PC(ID,Name,CPU,RAM,HD,Price,Quantity)
                                 VALUES (?,?,?,?,?,?,?)"); 

    $pcID = (int)$lastID['ID']+1;
    $sql->bindValue(1, $pcID);
    $sql->bindValue(2, $pc_name); 
    $sql->bindValue(3, $pc_cpu); 
    $sql->bindValue(4, $pc_ram); 
    $sql->bindValue(5, $pc_hd); 
    $sql->bindValue(6, $pc_price); 
    $sql->bindValue(7, $pc_quantity); 
    $sql->execute(); 

    echo 1;
}catch(PDOException $e){
    echo 0;
}

?>