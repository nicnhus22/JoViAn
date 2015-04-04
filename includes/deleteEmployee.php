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
    $sqlEmployee = $db->prepare("DELETE FROM users WHERE EmployeeID=?;DELETE FROM Employee WHERE ID=?");
    $sqlEmployee->bindValue(1, $ID);
    $sqlEmployee->bindValue(2, $ID);

    $sqlEmployee->execute();

    echo 1;
}catch(PDOException $e){
    echo $e;
}

?>