<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin</title>
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
<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
       
        <br>
        <br>
        <?php 
        if(isset($_SESSION['add'])){ //checking a osht session variable set or not
          echo $_SESSION['add'];     //displaying session message
          unset($_SESSION['add']); //removing session message
        }
        ?>
       <form name="myForm" action="" method="POST" ">
            <table class="tbl-30">
                <tr>
                    <td>Fullname: </td>
                    <td><input type="text"name="full_name"placeholder="Enter your name"required> </td>
                   
                </tr>

                <tr>
                    <td>Username: </td>
                    <td><input type="text"name="username"placeholder="Enter your username"required></td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td><input type="password"name="password"placeholder="Enter your password"required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <br>
                        <input type="submit"name="submit" value="Add Admin" class="btn-secondary"required>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php');?>

<?php 
//Process the value from Form and save it in database
//E kshyr a eshte kliku butoni submit me ane te name submit qe e ka nese eshte kliku vlerat qe i vendos input i ruhen variablave

if(isset($_POST['submit']))
{
    //Button clicked
    //I merr te dhenat prej formes i run nvariabla 
    $full_name = $_POST['full_name'];
    $username= $_POST['username'];
    $password= md5($_POST['password']);//Me enkriptu passwordin amo smunesh me dekriptu osht one way encryption

    //CREATE SQL QUERY PER ME I RUJT TE DHENAT NDATABAZE
    $sql = "INSERT INTO tbl_admin SET
     full_name='$full_name',
     username='$username',
     password='$password'
    ";
 

      //executing query and saving data into database - QEKY LINE OF CODE I INSERTON QUERYN E PLOTSUM NE DATABAZE
    $res = mysqli_query($conn,$sql) or die(mysqli_error());

    //Check whether(the query is executed or not) the data is inserted or not and display appropriate message
    
    if($res==TRUE){
        //data inserted
        //create session variable to display message
       $_SESSION['add']='<span style="color:#2ed573;">Admin added successfully</span>';
       //redirect page to manage admin
       header("location:".SITEURL.'admin/manage-admin.php');
    }
    else {
        //failed to insert data
        $_SESSION['add']='<span style="color:#ff6b81;">Failed to  add admin</span>';
        //redirect page to manage admin
        header("location:".SITEURL.'admin/add-admin.php');
      
    }

    
    

}



?>
</body>
</html>
