<?php

require_once 'config/db.php';

/** 
 * @author Ryan Naddy <ryan@ryannaddy.com> 
 * @updated 3/15/2015 
 * @note Feel free to replace the pdo found below with the pdo wrapper 
 * @see http://phpsnips.com/616/PDO-Wrapper 
 */ 
if(isset($_POST['email']) && isset($_POST['password'])){ 

    try {
        //Connect to the databasse
        $db  = new PDO("mysql:dbname=$dbDatabase;host=$dbHost", $dbUser, $dbPass);
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }


    $sql = $db->prepare("SELECT * FROM users 
        WHERE email = ? AND 
        password = ? 
        LIMIT 1"); 

    //Lets search the databse for the user name and password 
    //Choose some sort of password encryption, I choose sha256 
    //Password function (Not In all versions of MySQL). 
    $pas = hash('sha256', $_POST['password']); 
     
    $sql->bindValue(1, $_POST["email"]); 
    $sql->bindValue(2, $pas); 
    $sql->execute(); 

    // Row count is different for different databases 
    // Mysql currently returns the number of rows found 
    // this could change in the future.

    if($sql->rowCount() == 1){ 
        $row                  = $sql->fetch(PDO::FETCH_ASSOC);
        session_start(); 
        $_SESSION['username']    = $row['username'];
        $_SESSION['privelege']   = $row['privelege'] ;
        $_SESSION['logged']      = TRUE;
        echo 1;
    }else{ 
        echo 0; 
    } 
}else{ //If the form button wasn't submitted go to the index page, or login page 
    echo 0;
}

/*--------------------------------------------------
	Output the login form
---------------------------------------------------*/

?>