<?php

require_once '../config/db.php';

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
    $sql = $db->prepare("SELECT ID FROM Laptop ORDER BY ID DESC LIMIT 1");
    $sql->execute();
    ($sql->rowCount() == 1 ? $lastID = $sql->fetch(PDO::FETCH_ASSOC) : $lastID = 2000);

    $sql = $db->prepare("INSERT INTO Laptop(ID,Name,CPU,RAM,HD,Screen,Price,Quantity)
                                 VALUES (?,?,?,?,?,?,?,?)"); 

    $laptopID = (int)$lastID['ID']+1;
    $sql->bindValue(1, $laptopID);
    $sql->bindValue(2, $laptop_name); 
    $sql->bindValue(3, $laptop_cpu); 
    $sql->bindValue(4, $laptop_ram); 
    $sql->bindValue(5, $laptop_hd); 
    $sql->bindValue(6, $laptop_screen); 
    $sql->bindValue(7, $laptop_price); 
    $sql->bindValue(8, $laptop_quantity); 
    $sql->execute(); 

    echo 1;
}catch(PDOException $e){
    echo 0;
}

?>