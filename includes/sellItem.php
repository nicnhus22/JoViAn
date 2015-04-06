<?php
session_start();

require_once '../includes/config/db.php';

if (!$_SESSION['logged']) {
    header("Location: index.php");
    exit;
}

include '../includes/views/menu.php';
include '../includes/views/head.php';
include '../includes/views/scripts.php';

try {
    //Connect to the databasse
    $db = new PDO("mysql:dbname=$dbDatabase;host=$dbHost", $dbUser, $dbPass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}



$id = $_POST["id"];
$type = $_POST["type"];
$custAdd = $_POST["caddr"];
$custName = $_POST["cname"];
$empID = $_SESSION["id"];
$date = getDate();
$dateString = $date["year"] . "-" . $date["mon"] . "-" . $date["mday"];

try {

    $sql = $db->prepare("INSERT INTO Sale (ProductID, EmployeeID, Date, CName, CAddress) VALUES (?, ?, ?, ?, ?)");

    $sql->bindValue(1, $id);
    $sql->bindValue(2, $empID);
    $sql->bindValue(3, $dateString);
    $sql->bindValue(4, $custName);
    $sql->bindValue(5, $custAdd);
    $sql->execute();

    if($type == "Laptop" && !$_POST["service"]) {
        $sql = $db->prepare("UPDATE Laptop SET Quantity = Quantity - 1 WHERE ID = ?");
    }

    else if($type == "PC" && !$_POST["service"]){
        $sql = $db->prepare("UPDATE PC SET Quantity = Quantity - 1 WHERE ID = ?");
    }

    else if($type == "Part"){
        $sql = $db->prepare("UPDATE Part SET Quantity = Quantity - 1 WHERE ID = ?");
    }

    else if($type == "Software"){
        $sql = $db->prepare("UPDATE Software SET Quantity = Quantity - 1 WHERE ID = ?");
    }

    $sql->bindValue(1, $id);
    $sql->execute();

    if($_POST["service"]) {
        $serviceCost = $_POST["serviceCost"];

        if($_POST["service"] == "Install") {

            $sql = $db->prepare("INSERT INTO Install (SoftwareID, EmployeeID, Date, CName, CAddress, ServiceCost) VALUES(?,?,?,?,?,?)");

            $sql->bindValue(1, $id);
            $sql->bindValue(2, $empID);
            $sql->bindValue(3, $dateString);
            $sql->bindValue(4, $custName);
            $sql->bindValue(5, $custAdd);
            $sql->bindValue(6, $serviceCost);
            $sql->execute();

        } else if ($_POST["service"] == "Upgrade") {

            $compID = $_POST["compID"];

            $sql = $db->prepare("INSERT INTO Upgrade (ComputerID, EmployeeID, Date, CName, CAddress, ServiceCost, PartID) VALUES(?,?,?,?,?,?,?)");

            $sql->bindValue(1, $compID);
            $sql->bindValue(2, $empID);
            $sql->bindValue(3, $dateString);
            $sql->bindValue(4, $custName);
            $sql->bindValue(5, $custAdd);
            $sql->bindValue(6, $serviceCost);
            $sql->bindValue(7, $id);
            $sql->execute();

        } else if ($_POST["service"] == "Repair") {

            $repairDesc = $_POST["desc"];

            $sql = $db->prepare("INSERT INTO Repair (ComputerID, EmployeeID, Date, CName, CAddress, Type, ServiceCost) VALUES(?,?,?,?,?,?,?)");

            $sql->bindValue(1, $id);
            $sql->bindValue(2, $empID);
            $sql->bindValue(3, $dateString);
            $sql->bindValue(4, $custName);
            $sql->bindValue(5, $custAdd);
            $sql->bindValue(6, $repairDesc);
            $sql->bindValue(7, $serviceCost);

            $sql->execute();

        }



    }

    print_r($_POST);

} catch (PDOException $e) {
    echo 1;
}


?>