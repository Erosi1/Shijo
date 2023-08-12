<?php include('../config/constant.php');?>
<!DOCTYPE html>
<head>
   
    <title>Login - Shijo</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>
        <?php
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>
        <br><br>
        <!--Login Form Starts-->
      <form action=""method="POST" class="text-center">
        Username: <br>
        <input type="text" name="username" placeholder="Enter Username"> <br> <br>
        Password:  <br>
        <input type="password" name="password" placeholder="Enter Password"> <br> <br>
        <input type="submit"name="submit" value="Login" class="btn-primary">
        <br>
        <br>
      </form>

        <!--Login Form Ends-->
        
    </div>
</body>
</html>
<?php 
//me kshyr a osht kliku submit button
if(isset($_POST['submit']))
{
//Process for login
//1.Get the data from the login form
$username=$_POST['username'];
$password=md5($_POST['password']);
//SQL ME KSHYR A E EKZISTON USERI ME QAT USERNAME EDHE PASSWORD

$sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
//ekzektu sql query 
$res = mysqli_query($conn,$sql);

    
$count = mysqli_num_rows($res);
if($count==1){
//User available
$_SESSION['login']='<span style="color:#2ed573;">Logged in Successfully </span>';
header("location:".SITEURL.'admin/');

}
else {
    //User not available
    $_SESSION['login'] = '<div style="text-align: center; margin-top: 20px;"><span style="color:#ff6b81;">Username or password is incorrect</span></div>';
    header("location:".SITEURL.'admin/login.php');
}


}


?>