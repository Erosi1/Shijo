<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
<?php 
include('partials/menu.php');



?>
<div class="main-content">
    <div class="wrapper">
    <h1>Manage Category</h1>   
    <br>
        <br>
        <?php 
        if(isset($_SESSION['add-category'])){
          echo $_SESSION['add-category'];     //displaying session message
          unset($_SESSION['add-category']); //removing session message
        }
        if(isset($_SESSION['remove'])){
          echo $_SESSION['remove'];     //displaying session message
          unset($_SESSION['remove']); //removing session message
        }
        if(isset($_SESSION['delete'])){
          echo $_SESSION['delete'];     //displaying session message
          unset($_SESSION['delete']); //removing session message
        }
        if(isset($_SESSION['no-category-found'])){
          echo $_SESSION['no-category-found'];     //displaying session message
          unset($_SESSION['no-category-found']); //removing session message
        }
        if(isset($_SESSION['update'])){
          echo $_SESSION['update'];     //displaying session message
          unset($_SESSION['update']); //removing session message
        }
        if(isset($_SESSION['upload'])){
          echo $_SESSION['upload'];     //displaying session message
          unset($_SESSION['upload']); //removing session message
        }
        if(isset($_SESSION['failed-remove'])){
          echo $_SESSION['failed-remove'];     //displaying session message
          unset($_SESSION['failed-remove']); //removing session message
        }
        ?>
        <br>
        <br>
        <br>
        <a href="add-category.php" class="btn-primary">Add Category</a>
        <br>
        <br>
     
        <br><br>
        <table style="width: 100%;">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php 
            
            $sql = "SELECT * FROM tbl_category"; // ii merr kejt te dhenat prej databzes

            $res = mysqli_query($conn,$sql);  // e ekzekuton sql queryn 

            $count = mysqli_num_rows($res); // mi numru rreshtat
            $sn=1; //e krijon ni variabel per serial number ja len vleren 1 qe saher tkrijohet ni kategori me u rrit serial number per 1
            if($count>0){
              //we have data in database
             while($row=mysqli_fetch_assoc($res)){
               $id=$row['id'];
               $title=$row['title'];
               $image_name=$row['image_name'];
               $featured=$row['featured'];
               $active=$row['active'];

               ?>
<tr>
                <td><?php echo $sn++ ?></td>
                <td><?php echo $title?></td>

                <td>

                  <?php 
                  //check whether image name is availiable or not
                  if($image_name!=""){
                    //display the image
                    ?>
                    <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>"width="80px">
                    <?php 
                  }
                  else {
                    //display the message
                    echo "<span style='color:#ff6b81;'>Image not added</span>";
                  }
                  ?>
              
              </td>
                
                <td><?php echo $featured?></td>
                <td><?php echo $active?></td>
                <td>
                <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id?>" class="btn-secondary">Update Category</a>
                <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id?>&image_name=<?php echo $image_name?>" class="btn-danger">Delete Category</a>
                </td>
            </tr>
               <?php
             }
            }else {
              //we dont have data in database so we will display the message inside table
              ?>
              <tr>
                <td colspan="6"><span style="color:#ff6b81;">No Category added</span></td>
              </tr>

               <?php 

            }
            ?>


            
       
            
            
        </table>
    </div>
 

</div>
<?php include('partials/footer.php')?>
</body>
</html>