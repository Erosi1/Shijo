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
        <a href="add-category.php" class="btn-primary">Add Category</a>
        
        <?php 
        if(isset($_SESSION['add-category'])){
          echo $_SESSION['add-category'];     //displaying session message
          unset($_SESSION['add-category']); //removing session message
        }?>
        <br><br>
        <table style="width: 100%;">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
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
                <a href="#" class="btn-secondary">Update Category</a>
                <a href="#" class="btn-danger">Delete Category</a>
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