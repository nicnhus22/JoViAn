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
    $db  = new PDO("mysql:dbname=$dbDatabase;host=$dbHost", $dbUser, $dbPass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

$ID = $_GET["id"];
$TYPE = $_GET["type"];
$BEGINDATE = ($_GET["beginDate"] == "") ? "1900-01-01" : $_GET["beginDate"];
$ENDDATE = ($_GET["endDate"] == "") ? "2015-01-01" : $_GET["endDate"];

if($TYPE == "Sale")
    $sql = $db->prepare("SELECT * FROM Sale WHERE EmployeeID = ? AND Date between ? and ?");
else if($TYPE == "Repair")
    $sql = $db->prepare("SELECT * FROM Repair WHERE EmployeeID = ? AND Date between ? and ?");
else
    $sql = $db->prepare("SELECT * FROM Upgrade WHERE EmployeeID = ? AND Date between ? and ?");

$sql->bindValue(1, $ID);
$sql->bindValue(2, $BEGINDATE);
$sql->bindValue(3, $ENDDATE);

$sql->execute();
$rows = $sql->fetchALL();


print_r($rows);
?>