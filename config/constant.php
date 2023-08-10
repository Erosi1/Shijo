<?php 
//start session
session_start();


//CREATE CONSTANT TO STORE Non Repeating Values 
//CREATE CONSTANT FOR HOME URL 
define('SITEURL','http://localhost/restaurant/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','restaurant');
 //Ekzekuton queryn qe me u rujt te dhenat ne databaze
 $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());//DATABASE CONNECTION
 $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error()); //SELECTING DB NAME

?>