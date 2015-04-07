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
$sql = $db->prepare("SELECT CAddress,CName, ServiceCost FROM Install WHERE SoftwareID=? LIMIT 1");
$sql->bindValue(1, $_GET["ProductID"]);
$sql->execute();
$rows["Install"] = $sql->fetch(PDO::FETCH_ASSOC);

# Get Employee Information
$sql = $db->prepare("SELECT Name,Commission FROM Employee WHERE ID=? LIMIT 1");
$sql->bindValue(1, $_GET["EmployeeID"]);
$sql->execute();
$rows["Employee"] = $sql->fetch(PDO::FETCH_ASSOC);

# Get Software Information
$sql = $db->prepare("SELECT Name,Price FROM Software WHERE ID=? LIMIT 1");
$sql->bindValue(1, $_GET["ProductID"]);
$sql->execute();
$rows["Software"] = $sql->fetch(PDO::FETCH_ASSOC);

echo json_encode($rows);

?>