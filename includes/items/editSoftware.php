<?php

require_once '../config/db.php';

$software_name        = $_POST['software_name'];
$software_type        = $_POST['software_type'];
$software_price       = $_POST['software_price'];
$software_size        = $_POST['software_size'];
$software_quantity    = $_POST['software_quantity'];
$software_id          = $_POST['software_id'];

try {
    //Connect to the databasse
    $db  = new PDO("mysql:dbname=$dbDatabase;host=$dbHost", $dbUser, $dbPass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

try {
    $sql = $db->prepare("UPDATE Software 
                         SET Name=?,Size=?,Type=?,Price=?,Quantity=?
                         WHERE ID=?"); 

    $sql->bindValue(1, $software_name); 
    $sql->bindValue(2, $software_size); 
    $sql->bindValue(3, $software_type);
    $sql->bindValue(4, $software_price); 
    $sql->bindValue(5, $software_quantity); 
    $sql->bindValue(6, $software_id); 
    $sql->execute(); 

    echo 1;
}catch(PDOException $e){
    echo 0;
}

?>