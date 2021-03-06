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

# Get Sale Infromation
$sql = $db->prepare("SELECT * FROM Upgrade WHERE ComputerID=? AND EmployeeID=? AND PartID=? LIMIT 1");
$sql->bindValue(1, $_GET["ProductID"]);
$sql->bindValue(2, $_GET["EmployeeID"]);
$sql->bindValue(3, $_GET["PartID"]);
$sql->execute();
$rows["Upgrade"] = $sql->fetch(PDO::FETCH_ASSOC);

# Get Product Information
$sql = $db->prepare("SELECT ID,Name,Price FROM Laptop WHERE ID=?	 UNION  
					 SELECT ID,Name,Price FROM PC WHERE ID=?");

$sql->bindValue(1, $_GET["ProductID"]);
$sql->bindValue(2, $_GET["ProductID"]);
$sql->execute();
$rows["Product"] = $sql->fetch(PDO::FETCH_ASSOC);

# Get Employee Information
$sql = $db->prepare("SELECT Name,Commission FROM Employee WHERE ID=? LIMIT 1");
$sql->bindValue(1, $_GET["EmployeeID"]);
$sql->execute();
$rows["Employee"] = $sql->fetch(PDO::FETCH_ASSOC);

# Get Part ID
$sql = $db->prepare("SELECT * FROM Part WHERE ID=? LIMIT 1");
$sql->bindValue(1, $_GET["PartID"]);
$sql->execute();
$rows["Part"] = $sql->fetch(PDO::FETCH_ASSOC);


echo json_encode($rows);

?>