<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Admin</title>
<style>
table tr th {
    border-bottom: 1px solid black;
    padding:1%;
    text-align:left;
}
table tr td {
  padding:1%;
}
.btn-primary {
  background-color:#1e90ff;
  padding:1%;
  color:white;
  text-decoration:none;
  font-weight:bold;
}
.btn-primary:hover{
  background-color:#3742fa;
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
.btn-danger{
  background-color:#ff6b81;
  padding:1%;
  color:white;
  text-decoration:none;
  font-weight:bold;
}
.btn-danger:hover{
background-color:#ff4757;
}
</style>

</head>
<body>

<?php include('partials/menu.php')?>

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br>
       
        <?php 
        if(isset($_SESSION['add'])){
          echo $_SESSION['add'];     //displaying session message
          unset($_SESSION['add']); //removing session message
        }
       if(isset($_SESSION['delete'])){
          echo $_SESSION['delete'];     //displaying session message
          unset($_SESSION['delete']); //removing session message
        }
        if(isset($_SESSION['update'])){
          echo $_SESSION['update'];     //displaying session message
          unset($_SESSION['update']); //removing session message
        }
        ?>
        
        <br>
        <br>
        <br>
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br>
        <br>
        
        <table style="width: 100%;">
            <tr>
                <th>S.N</th>
                <th>Fullname</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            <?php 
            //mi marr te dhenat prej databazes
            $sql = "SELECT * FROM tbl_admin";
            //execute the query 
            $res = mysqli_query($conn,$sql);
            //check whether the query is executed or not if $res == true 
            if($res==TRUE){
              //COUNT ROWS to check whether we have data in database or not
              $count = mysqli_num_rows($res); //funksion mi marr kejt rreshtat ne databaze
              $sn=1; //create a variable and Assign value 1 - ID

              //check the number of rows if $rows 
              if($count>0){
                //we have data in database
               while($rows=mysqli_fetch_assoc($res)){
                //using while loop to get all the data from database
                $id=$rows['id'];
                $full_name=$rows['full_name'];
                $username=$rows['username'];
                //DISPLAY THE DATA IN TABLE
               
               ?>
                <tr>
                <td><?php echo $sn++ ?>.</td>
                <td><?php echo $full_name ?></td>
                <td><?php echo $username ?></td>
                <td>
                <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id?>"class="btn-secondary">Update Admin</a>
                <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id?>" class="btn-danger">Delete Admin</a>
                </td>
            </tr>
               <?php
               }
              }else {
                //we do not have data in database
              }


            }

            
            ?>
        
        </table>
    </div>
</div>
<!-- Main Content Section Ends -->

<?php include('partials/footer.php')?>

</body>
</html>
