<?php

#require_once 'includes/main.php';
echo 'Hello World';
/** 
 * @author Ryan Naddy <ryan@ryannaddy.com> 
 * @updated 3/15/2015 
 * @note Feel free to replace the pdo found below with the pdo wrapper 
 * @see http://phpsnips.com/616/PDO-Wrapper 
 */ 
// if(isset($_POST['submit'])){ 
//     $dbHost = 'clipper.encs.concordia.ca';
// 	$dbDatabase = 'kgc353_4';
// 	$dbUser = 'kgc353_4';
// 	$dbPass = 'janv001';

//     //Connect to the databasse 
//     $db  = new PDO("mysql:dbname=$dbDatabase;host=$dbHost", $dbUser, $dbPass); 

//     $sql = $db->prepare("SELECT * FROM users 
//         WHERE email = ? AND 
//         password = ? 
//         LIMIT 1"); 

//     //Lets search the databse for the user name and password 
//     //Choose some sort of password encryption, I choose sha256 
//     //Password function (Not In all versions of MySQL). 
//     $pas = hash('sha256', $_POST['password']); 
     
//     echo password.' '.email;

//     $sql->bindValue(1, $_POST["email"]); 
//     $sql->bindValue(2, $pas); 

//     $sql->execute(); 

//     // Row count is different for different databases 
//     // Mysql currently returns the number of rows found 
//     // this could change in the future. 
//     if($sql->rowCount() == 1){ 
//         $row                  = $sql->fetch($sql); 
//         session_start(); 
//         $_SESSION['email']    = $row['email']; 
//         $_SESSION['fname']    = $row['first_name']; 
//         $_SESSION['lname']    = $row['last_name']; 
//         $_SESSION['logged']   = TRUE; 
//         #header("Location: protected.php"); // Modify to go to the page you would like 
//         exit; 
//     }else{ 
//         #redirect("index.php"); 
//         exit; 
//     } 
// }else{ //If the form button wasn't submitted go to the index page, or login page 
//     #redirect("index.php"); 
//     exit; 
// }

/*--------------------------------------------------
	Output the login form
---------------------------------------------------*/

?>