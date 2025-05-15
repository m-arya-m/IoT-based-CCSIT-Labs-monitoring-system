<?php
session_start();
include_once('DbHandler.php');
$db = new DbHandler();
$db->dbConnect();

if (isset($_SESSION["user"])){
    $username= $_SESSION["user"];
    $auth_code = ' '; 

   $res= $db->updateAccess($auth_code, $username);
     if ($res){
        unset($_SESSION["user"]);
        session_destroy();
        
        // forward user to the login area
        header("Location: login.php");
        exit();
    }
}else{
    header("location: login.php");
    exit();
}
?>
