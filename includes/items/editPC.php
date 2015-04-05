<?php

require_once '../config/db.php';

$pc_name        = $_POST['pc_name'];
$pc_cpu         = $_POST['pc_cpu'];
$pc_ram         = $_POST['pc_ram'];
$pc_hd          = $_POST['pc_hd'];
$pc_price       = $_POST['pc_price'];
$pc_quantity    = $_POST['pc_quantity'];
$pc_id          = $_POST['pc_id'];

try {
    //Connect to the databasse
    $db  = new PDO("mysql:dbname=$dbDatabase;host=$dbHost", $dbUser, $dbPass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

try {
    $sql = $db->prepare("UPDATE PC 
                         SET Name=?,CPU=?,RAM=?,HD=?,Price=?,Quantity=?
                         WHERE ID=?"); 

    $sql->bindValue(1, $pc_name); 
    $sql->bindValue(2, $pc_cpu); 
    $sql->bindValue(3, $pc_ram); 
    $sql->bindValue(4, $pc_hd); 
    $sql->bindValue(5, $pc_price); 
    $sql->bindValue(6, $pc_quantity); 
    $sql->bindValue(7, $pc_id); 
    $sql->execute(); 

    echo 1;
}catch(PDOException $e){
    echo 0;
}

?>