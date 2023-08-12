<?php 
//AUTHORIZATION
//check whether the user is logged in or not 
if(!isset($_SESSION['user'])){
    $_SESSION['no-login-message'] = '<div style="text-align: center; margin-top: 20px;"><span style="color:#ff6b81;">Please login to access Admin Panel </span></div>';
    header("location:".SITEURL.'admin/login.php');
}
?>