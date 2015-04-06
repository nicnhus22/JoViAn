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
$TODAY = getDate();
$TODAYSTRING = $TODAY["year"] . "-" . $TODAY["mon"] . "-" . $TODAY["mday"];
$BEGINDATE = ($_GET["beginDate"] == "") ? "1900-01-01" : $_GET["beginDate"];
$ENDDATE = ($_GET["endDate"] == "") ? $TODAYSTRING : $_GET["endDate"];


    if ($TYPE == "Sale") {
        $sql = $db->prepare("SELECT * FROM Sale WHERE ProductID = ? AND Date between ? and ? ORDER BY Date");
        $sql->bindValue(1, $ID);
        $sql->bindValue(2, $BEGINDATE);
        $sql->bindValue(3, $ENDDATE);
    }
    else if ($TYPE == "Repair") {
        $sql = $db->prepare("SELECT * FROM Repair WHERE ComputerID = ? AND Date between ? and ? ORDER BY Date");
        $sql->bindValue(1, $ID);
        $sql->bindValue(2, $BEGINDATE);
        $sql->bindValue(3, $ENDDATE);
    }
    else if ($TYPE == "OnlineSale") {
        $sql = $db->prepare("SELECT * FROM OnlineSale WHERE EmployeeID = ? AND Date between ? and ? ORDER BY Date");
        $sql->bindValue(1, $ID);
        $sql->bindValue(2, $BEGINDATE);
        $sql->bindValue(3, $ENDDATE);
    }
    else if ($TYPE == "Install") {
        $sql = $db->prepare("SELECT * FROM Install WHERE SoftwareID = ? AND Date between ? and ? ORDER BY Date");
        $sql->bindValue(1, $ID);
        $sql->bindValue(2, $BEGINDATE);
        $sql->bindValue(3, $ENDDATE);
    }
    else if ($TYPE == "Upgrade") {
        $sql = $db->prepare("SELECT * FROM Upgrade WHERE ComputerID = ? OR PartID = ? AND Date between ? and ? ORDER BY Date");
        $sql->bindValue(1, $ID);
        $sql->bindValue(2, $ID);
        $sql->bindValue(3, $BEGINDATE);
        $sql->bindValue(4, $ENDDATE);
    }




$sql->execute();
$rows = $sql->fetchALL();

echo json_encode($rows);





?>