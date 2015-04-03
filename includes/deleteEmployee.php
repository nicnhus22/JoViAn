<?php

require_once 'config/db.php';

$ID       = $_POST['ID'];

try {
    //Connect to the databasse
    $db  = new PDO("mysql:dbname=$dbDatabase;host=$dbHost", $dbUser, $dbPass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

try {
    $sql = $db->prepare("DELETE FROM Employee WHERE ID=?");
    $sql->bindValue(1, $ID);
    $sql->execute();
    echo 1;
}catch(PDOException $e){
    echo 0;
}

?>