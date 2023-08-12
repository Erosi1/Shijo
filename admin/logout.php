
<?php 
include('../config/constant.php');
//Query me destroy the session tana met redirect nlogin page

session_destroy();
header("location:".SITEURL.'admin/login.php')


?>