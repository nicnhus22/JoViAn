<?php

require_once '../config/db.php';

$laptop_id          = $_POST['laptop_id'];
$laptop_name        = $_POST['laptop_name'];
$laptop_cpu         = $_POST['laptop_cpu'];
$laptop_ram         = $_POST['laptop_ram'];
$laptop_screen      = $_POST['laptop_screen'];
$laptop_hd          = $_POST['laptop_hd'];
$laptop_price       = $_POST['laptop_price'];
$laptop_quantity    = $_POST['laptop_quantity'];

try {
    //Connect to the databasse
    $db  = new PDO("mysql:dbname=$dbDatabase;host=$dbHost", $dbUser, $dbPass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

try {
    $sql = $db->prepare("UPDATE Laptop
                         SET Name=?,CPU=?,RAM=?,HD=?,Screen=?,Price=?,Quantity=? 
                         WHERE ID=?"); 

    $sql->bindValue(1, $laptop_name); 
    $sql->bindValue(2, $laptop_cpu); 
    $sql->bindValue(3, $laptop_ram); 
    $sql->bindValue(4, $laptop_hd); 
    $sql->bindValue(5, $laptop_screen); 
    $sql->bindValue(6, $laptop_price); 
    $sql->bindValue(7, $laptop_quantity); 
    $sql->bindValue(8, $laptop_id);
    $sql->execute(); 

    echo 1;
}catch(PDOException $e){
    echo $e;
}

?>