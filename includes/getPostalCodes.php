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
$sql = $db->prepare("SELECT CAddress FROM Install UNION SELECT CAddress FROM Repair UNION SELECT CAddress FROM Upgrade UNION SELECT CAddress FROM Sale UNION SELECT CAddress FROM OnlineSale");
$sql->execute();
$rows = $sql->fetchAll();

echo json_encode($rows);

?>