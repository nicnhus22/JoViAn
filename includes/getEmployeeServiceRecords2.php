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


if ($TYPE == "Sale")
    $sql = $db->prepare("SELECT ID, Name, Price, Total
                            FROM (SELECT ProductID, COUNT(ProductID) as Total
                            From Sale
                            GROUP BY ProductID
                            ORDER BY Total DESC
                            ) as T1, (SELECT ID, Name, Price
                            FROM PC
                            UNION
                            SELECT ID, Name, Price
                            FROM Laptop
                            UNION
                            SELECT ID, Name, Price
                            FROM Software
                            UNION
                            SELECT ID, Name, Price
                            FROM Part) as T2
                            WHERE T1.ProductID = T2.ID;");
else if ($TYPE == "Repair")
    $sql = $db->prepare("SELECT ID, Name, ServiceCost, Total
                            FROM (SELECT ComputerID, ServiceCost, COUNT(ComputerID) as Total
                            From Repair
                            GROUP BY ComputerID
                            ORDER BY Total DESC
                            ) as T1, (SELECT ID, Name
                            FROM PC
                            UNION
                            SELECT ID, Name
                            FROM Laptop
                            UNION
                            SELECT ID, Name
                            FROM Software
                            UNION
                            SELECT ID, Name
                            FROM Part) as T2
                            WHERE T1.ComputerID = T2.ID;");
else if ($TYPE == "OnlineSale")
    $sql = $db->prepare("SELECT ID, Name, Price, Total
                            FROM (SELECT ProductID, COUNT(ProductID) as Total
                            From OnlineSale
                            GROUP BY ProductID
                            ORDER BY Total DESC
                            ) as T1, (SELECT ID, Name, Price
                            FROM PC
                            UNION
                            SELECT ID, Name, Price
                            FROM Laptop
                            UNION
                            SELECT ID, Name, Price
                            FROM Software
                            UNION
                            SELECT ID, Name, Price
                            FROM Part) as T2
                            WHERE T1.ProductID = T2.ID;");
else if ($TYPE == "Install")
    $sql = $db->prepare("SELECT ID, Name, ServiceCost, Total
                            FROM (SELECT SoftwareID, ServiceCost, COUNT(SoftwareID) as Total
                            From Install
                            GROUP BY SoftwareID
                            ORDER BY Total DESC
                            ) as T1, (SELECT ID, Name
                            FROM PC
                            UNION
                            SELECT ID, Name
                            FROM Laptop
                            UNION
                            SELECT ID, Name
                            FROM Software
                            UNION
                            SELECT ID, Name
                            FROM Part) as T2
                            WHERE T1.SoftwareID = T2.ID;");
else if ($TYPE == "Upgrade")
    $sql = $db->prepare("SELECT ID, Name, ServiceCost, Total
                            FROM (SELECT ComputerID, ServiceCost, COUNT(ComputerID) as Total
                            From Upgrade
                            GROUP BY ComputerID
                            ORDER BY Total DESC
                            ) as T1, (SELECT ID, Name
                            FROM PC
                            UNION
                            SELECT ID, Name
                            FROM Laptop
                            UNION
                            SELECT ID, Name
                            FROM Software
                            UNION
                            SELECT ID, Name
                            FROM Part) as T2
                            WHERE T1.ComputerID = T2.ID;");


$sql->execute();
$rows = $sql->fetchALL();

echo json_encode($rows);





?>