<?php

require_once 'config/db.php';

$name       = $_POST['firstName'].' '.$_POST['lastName'];
$commission = $_POST['commission'];
$annualPay  = (int)$_POST['annualPay'];
$monthlyPay = $annualPay/12;
$weeklyPay  = $annualPay/52;
$seniority  = $_POST['seniority'];
$employeeID = $_POST['id'];

try {
    //Connect to the databasse
    $db  = new PDO("mysql:dbname=$dbDatabase;host=$dbHost", $dbUser, $dbPass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

try {
    #
    #   Update entry in EMPLOYEE table
    #


    $sql = $db->prepare("UPDATE Employee SET Name = ?, Commission = ?, AnnualPay = ?, WeeklyPay = ?, MonthlyPay = ? WHERE ID = ?");

    $sql->bindValue(1, $name);
    $sql->bindValue(2, $commission);
    $sql->bindValue(3, $annualPay);
    $sql->bindValue(4, $weeklyPay);
    $sql->bindValue(5, $monthlyPay);
    $sql->bindValue(6, $employeeID);
    $sql->execute(); 

    #
    #   Update Users table
    #   
    $sql = $db->prepare("UPDATE users SET email = ?,username = ?, privelege = ? WHERE EmployeeID = ?");
    $sql->bindValue(1, strtolower($_POST['email']));
    $sql->bindValue(2, $_POST['username']);
    $sql->bindValue(3, $seniority);
    $sql->bindValue(4, $employeeID);
    $sql->execute(); 

    echo 1;
}catch(PDOException $e){
    echo 0;
}

?>