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

if($TYPE == "Laptop")
    $sql = $db->prepare("SELECT * FROM Laptop WHERE ID = ?");
else if($TYPE == "PC")
    $sql = $db->prepare("SELECT * FROM PC WHERE ID = ?");
else if($TYPE == "Part")
    $sql = $db->prepare("SELECT * FROM Part WHERE ID = ?");
else if($TYPE == "Software")
    $sql = $db->prepare("SELECT * FROM Software WHERE ID = ?");


$sql->bindValue(1, $ID);
$sql->execute();
$row = $sql->fetch(PDO::FETCH_ASSOC);

echo json_encode($row);

?>