<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
      
</body>
</html>
<?php include('partials/menu.php')?>
<?php 

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br>
        <br>
    <?php 
    //1.Get the id of selected admin
    $id=$_GET['id'];
    //2.Create sql query to get the details 
    $sql = "SELECT * FROM tbl_admin WHERE id=$id";
    $res = mysqli_query($conn,$sql); // e ekzekuton queryn $sql
    if($res==true){ 

    $count = mysqli_num_rows($res);
    if($count==1)
    {
        //get the details prej databazes
     $row = mysqli_fetch_assoc($res);
     $full_name=$row['full_name'];
     $username= $row['username'];
    }
    }
    else {  
      //Redirect to manage-admin.php
      header('location:'.SITEURL.'admin/manage-admin.php');
    }

    
    ?>
        <form name="myForm" action="" method="POST" >
            <table class="tbl-30">
                <tr>
                    <td>Fullname: </td>
                    <td><input type="text"name="full_name" value="<?php echo $full_name ?>"> </td>
                   
                </tr>

                <tr>
                    <td>Username: </td>
                    <td><input type="text"name="username"value=" <?php echo $username ?>" ></td>
                </tr>

              
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php  echo $id?>">
                        <br>
                        <input type="submit"name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php 

//Check whether the submit button is clicked only then will the update be possible

if(isset($_POST['submit'])){
   //get all the values from form to update

$id= $_POST['id'];
  $full_name= $_POST['full_name'];
  $username= $_POST['username'];

  $sql = "UPDATE tbl_admin SET
  full_name='$full_name',
  username='$username'
  WHERE id='$id'
";

  $res = mysqli_query($conn,$sql); //Ekzekuton sql query

  //Check whether the query is executed
  if($res ==TRUE){
    //Query executed and admin updated
    $_SESSION['update']='<span style="color:#2ed573;">Admin added successfully</span>';
       //redirect page to manage admin
       header("location:".SITEURL.'admin/manage-admin.php');

  }
  else {
    $_SESSION['update']='<span style="color:#2ed573;">Failed to update admin</span>';
    //redirect page to manage admin
    header("location:".SITEURL.'admin/update-admin.php');
  }

   
}

?>






<?php include('partials/footer.php')?>