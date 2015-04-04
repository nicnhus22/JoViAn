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



$ID = $_POST["id"];
$TYPE = $_POST["type"];
$CADDR = $_POST["caddr"];
$CNAME = $_POST["cname"];
$EMPID = $_SESSION["id"];
$TODAY = getDate();
$TODAYSTRING = $TODAY["year"] . "-" . $TODAY["mon"] . "-" . $TODAY["mday"];

try {

    $sql = $db->prepare("INSERT INTO Sale (ProductID, EmployeeID, Date, CName, CAddress) VALUES (?, ?, ?, ?, ?)");

    $sql->bindValue(1, $ID);
    $sql->bindValue(2, $EMPID);
    $sql->bindValue(3, $TODAYSTRING);
    $sql->bindValue(4, $CNAME);
    $sql->bindValue(5, $CADDR);
    $sql->execute();

    if($TYPE == "Laptop") {
        $sql = $db->prepare("UPDATE Laptop SET Quantity = Quantity - 1 WHERE ID = ?");
    }

    else if($TYPE == "PC"){
        $sql = $db->prepare("UPDATE PC SET Quantity = Quantity - 1 WHERE ID = ?");
    }

    else if($TYPE == "Part"){
        $sql = $db->prepare("UPDATE Part SET Quantity = Quantity - 1 WHERE ID = ?");
    }

    else if($TYPE == "Software"){
        $sql = $db->prepare("UPDATE Software SET Quantity = Quantity - 1 WHERE ID = ?");
    }

    $sql->bindValue(1, $ID);
    $sql->execute();

    if($_POST["service"]) {
        $SERVICECOST = $_POST["serviceCost"];

        if($_POST["service"] == "Install") {

            echo 'yeeee dawg';

            $sql = $db->prepare("INSERT INTO Install (SoftwareID, EmployeeID, Date, CName, CAddress, ServiceCost) VALUES(?,?,?,?,?,?)");

            $sql->bindValue(1, $ID);
            $sql->bindValue(2, $EMPID);
            $sql->bindValue(3, $TODAYSTRING);
            $sql->bindValue(4, $CNAME);
            $sql->bindValue(5, $CADDR);
            $sql->bindValue(6, $SERVICECOST);
            $sql->execute();

        }



    }


} catch (PDOException $e) {
    echo 1;
}


?>