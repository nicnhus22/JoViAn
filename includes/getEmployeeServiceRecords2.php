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

$ID = $_GET["id"];
$TYPE = $_GET["type"];

if ($ID == "") {
    if ($TYPE == "Sale")
        $sql = $db->prepare("SELECT * FROM Sale ");
    else if ($TYPE == "Repair")
        $sql = $db->prepare("SELECT * FROM Repair ");
    else if ($TYPE == "OnlineSale")
        $sql = $db->prepare("SELECT * FROM OnlineSale");
    else if ($TYPE == "Install")
        $sql = $db->prepare("SELECT * FROM Install");
    else if ($TYPE == "Upgrade")
        $sql = $db->prepare("SELECT * FROM Upgrade");
} else {
    if ($TYPE == "Sale")
        $sql = $db->prepare("SELECT * FROM Sale WHERE EmployeeID = ? ");
    else if ($TYPE == "Repair")
        $sql = $db->prepare("SELECT * FROM Repair WHERE EmployeeID = ?");
    else if ($TYPE == "OnlineSale")
        $sql = $db->prepare("SELECT * FROM OnlineSale WHERE EmployeeID = ?");
    else if ($TYPE == "Install")
        $sql = $db->prepare("SELECT * FROM Install WHERE EmployeeID = ?");
    else if ($TYPE == "Upgrade")
        $sql = $db->prepare("SELECT * FROM Upgrade WHERE EmployeeID = ?");

    $sql->bindValue(1, $ID);
}

$sql->execute();
$rows = $sql->fetchALL();

echo json_encode($rows);





?>