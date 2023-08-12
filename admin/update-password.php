<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
   .tbl-30 {
    width:30%;
   }
   .btn-secondary{
  background-color:#7bed9f;
  padding:1%;
  color:white;
  text-decoration:none;
  font-weight:bold;
}
.btn-secondary:hover{
  background-color:#2ed573;
}
    </style>
</head>
<body>
    
</body>
</html><?php include ('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
      <h1>Change Password</h1>
      <br>
      <br>
      <?php 
      if(isset($_GET['id'])){
        $id=$_GET['id'];
      }
      ?>


      <form action=""method="POST">
        <table class="tbl-30">
            <tr>
                <td>Current Password: </td>
                <td><input type="password"name="current_password"placeholder="Current Password"></td>

            </tr>
            <tr>
                <td>New Password: </td>
                <td><input type="password"name="new_password"placeholder="New Password"></td>
                
            </tr>
            <tr>
                <td>Confirm Password: </td>
                <td><input type="password"name="confirm_password"placeholder="Confirm Password"></td>
                
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden"name="id" value="<?php echo $id;?>">
                    <input type="submit"name="submit"value="Change Password" class="btn-secondary">

                </td>
            </tr>
            
        </table>
      </form>
    </div>
</div>
<?php 
if(isset($_POST['submit'])){
   //get the data from form than check whether the user with current id and password exists or not than check whether the passwords match than  change password
   $id=$_POST['id'];
   $current_password=md5($_POST['current_password']);
   $new_password=md5($_POST['new_password']);
   $confirm_password=md5($_POST['confirm_password']);

   $sql = "SELECT * FROM tbl_admin WHERE id=$id AND  password='$current_password'";
   
   $res= mysqli_query($conn,$sql);
   
   if($res==true){
    //Check whether data is available or not
   
    $count = mysqli_num_rows($res);
   
    if($count==1){
     //USER EXISTS 
    //Check whether the new_password and confirm_password match
    if($new_password==$confirm_password){
        //update the password 
       $sql2 = "UPDATE tbl_admin SET
       password='$new_password'
       WHERE id=$id
       " ;
       $res2=mysqli_query($conn,$sql2);
       if($res2==true){
        $_SESSION['change-pwd']='<span style="color:#2ed573;">Password Changed Successfully </span>';
        header("location:".SITEURL.'admin/manage-admin.php');
       }
       else {
        $_SESSION['change-pwd']='<span style="color:#ff6b81;">Failed to change password </span>';
        header("location:".SITEURL.'admin/manage-admin.php');

       }
    }else {
        //Redirect to manage-admin.php with error 
        $_SESSION['pwd-not-match']='<span style="color:#ff6b81;">Passwords not matching </span>';
        header("location:".SITEURL.'admin/manage-admin.php');
    }
     
    }
    else {
        $_SESSION['user-not-found']='<span style="color:#ff6b81;">User not found</span>';
        header("location:".SITEURL.'admin/manage-admin.php');
    }
   }
}

?>





<?php include ('partials/footer.php')?>