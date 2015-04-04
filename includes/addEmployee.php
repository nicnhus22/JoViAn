<?php

require_once 'config/db.php';

$name       = $_POST['firstName'].' '.$_POST['lastName'];
$DOE        = $_POST['DOE'];
$commission = $_POST['commission'];
$annualPay  = (int)$_POST['annualPay'];
$monthlyPay = $annualPay/12;
$weeklyPay  = $annualPay/52;
$seniority  = $_POST['seniority'];

try {
    //Connect to the databasse
    $db  = new PDO("mysql:dbname=$dbDatabase;host=$dbHost", $dbUser, $dbPass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

try {
    #
    #   Add to EMPLOYEE table
    #
    $sql = $db->prepare("SELECT ID FROM Employee ORDER BY ID DESC LIMIT 1");
    $sql->execute();
    ($sql->rowCount() == 1 ? $lastID = $sql->fetch(PDO::FETCH_ASSOC) : $lastID = 5000);

    $sql = $db->prepare("INSERT INTO Employee(ID,Name,WeeklyPay,MonthlyPay,AnnualPay,Commission,DOE)
                                 VALUES (?,?,?,?,?,?,?)"); 

    $employeeID = (int)$lastID['ID']+1;
    $sql->bindValue(1, $employeeID);
    $sql->bindValue(2, $name); 
    $sql->bindValue(3, $weeklyPay); 
    $sql->bindValue(4, $monthlyPay); 
    $sql->bindValue(5, $annualPay); 
    $sql->bindValue(6, $commission); 
    $sql->bindValue(7, $DOE); 
    $sql->execute(); 

    #
    #   Add to Users table
    #   
    $sql = $db->prepare("INSERT INTO users(email,password,username,privelege,EmployeeID) VALUES(?,?,?,?,?)");
    $sql->bindValue(1, strtolower($_POST['firstName'].'.'.$_POST['lastName'].'@gmail.com'));
    $sql->bindValue(2, "8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918"); 
    $sql->bindValue(3, $_POST['firstName'].''.$_POST['lastName']); 
    $sql->bindValue(4, $seniority); 
    $sql->bindValue(5, $employeeID); 
    $sql->execute(); 

    echo 1;
}catch(PDOException $e){
    echo 0;
}

?>