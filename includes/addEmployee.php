<?php

require_once 'config/db.php';

$name       = $_POST['firstName'].' '.$_POST['lastName'];
$DOE        = $_POST['DOE'];
$commission = $_POST['commission'];
$annualPay  = (int)$_POST['annualPay'];
$monthlyPay = $annualPay/12;
$weeklyPay  = $annualPay/52;

try {
    //Connect to the databasse
    $db  = new PDO("mysql:dbname=$dbDatabase;host=$dbHost", $dbUser, $dbPass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

try {
    $sql = $db->prepare("SELECT ID FROM Employee ORDER BY ID DESC LIMIT 1");
    $sql->execute();
    ($sql->rowCount() == 1 ? $lastID = $sql->fetch(PDO::FETCH_ASSOC) : $lastID = 5000);

    $sql = $db->prepare("INSERT INTO Employee(ID,Name,WeeklyPay,MonthlyPay,AnnualPay,Commission,DOE)
                                 VALUES (?,?,?,?,?,?,?)"); 

    $sql->bindValue(1, (int)$lastID['ID']+1);
    $sql->bindValue(2, $name); 
    $sql->bindValue(3, $weeklyPay); 
    $sql->bindValue(4, $monthlyPay); 
    $sql->bindValue(5, $annualPay); 
    $sql->bindValue(6, $commission); 
    $sql->bindValue(7, $DOE); 
    $sql->execute(); 

    echo 1;
}catch(PDOException $e){
    echo 0;
}

?>