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
    <h1>Manage Food</h1>   
    <br>
        <br>
        <?php 
         if(isset($_SESSION['add-food'])){
          echo $_SESSION['add-food'];     //displaying session message
          unset($_SESSION['add-food']); //removing session message
        }
        if(isset($_SESSION['delete'])){
          echo $_SESSION['delete'];     //displaying session message
          unset($_SESSION['delete']); //removing session message
        }
        if(isset($_SESSION['upload'])){
          echo $_SESSION['upload'];     //displaying session message
          unset($_SESSION['upload']); //removing session message
        }
        ?>
        <br>
        <br>
        <br>
        <a href="add-food.php" class="btn-primary">Add Food</a>
        <br>
        <br>
        
        <table style="width: 100%;">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Feature</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php 
            $sql = "SELECT * FROM tbl_food";
            $res = mysqli_query($conn,$sql);
            //count rows to know whether there is data or not

            $count= mysqli_num_rows($res);
            $sn=1;
            if($count>0){
            
              //QETU I MERR TE DHENAT PREJ DB
              while($row=mysqli_fetch_assoc($res)){
              $id=$row['id'];
              $title=$row['title'];
              $price=$row['price'];
              $image_name=$row['image_name'];
              $featured=$row['featured'];
              $active=$row['active'];
              ?>
              <tr>
                <td><?php echo $sn++?></td>
                <td><?php echo $title?></td>
                <td><?php echo $price?></td>
                <td>

<?php 
//check whether image name is availiable or not
if($image_name!=""){
  //display the image
  ?>
  <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>"width="80px">
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
                <a href="#" class="btn-secondary">Update Food</a>
                <a href="delete-food.php/?id=<?php echo $id?>&image_name=<?php echo $image_name?>" class="btn-danger">Delete Food</a>
                </td>
            </tr>
              <?php
              }
            }
            else
            {
              echo "<tr><td colspan='7'style='color:#ff6b81;>Food not added yet</td></tr>";
            }

            
            
            ?>
            
           
        </table>
    </div>
 

</div>
<?php include('partials/footer.php')?>
</body>
</html>