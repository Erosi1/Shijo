<?php include('partials/menu.php')?>
<?php 

if(isset($_GET['id'])){

   $id=$_GET['id'];

   $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
   $res2 = mysqli_query($conn,$sql2);
   $count2 = mysqli_num_rows($res2);
   if($count2==1){
    $row2 = mysqli_fetch_assoc($res2);
    $title=$row2['title'];
    $description=$row2['description'];
    $price=$row2['price'];
    $current_image=$row2['image_name'];
    $current_category=$row2['category_id'];
    $featured=$row2['featured'];
    $active=$row2['active'];
   } 
}
else
{
    //redirect to manage-food.php
    header('location:'.SITEURL.'admin/manage-food.php');
}


?>
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
}</style>
</head>
<body>
    
</body>
</html>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
    <br>
    <br>
    
    <form action=""method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title: </td>
                <td><input type="text"name="title"value="<?php echo $title?>"></td>
            </tr>

            <tr>
                <td>Description: </td>
                <td><textarea name="description"  cols="30" rows="5"value=""><?php echo $description?></textarea></td>
            </tr>

            <tr>
                <td>Price: </td>
                <td><input type="number"name="price"value="<?php echo $price?>"></td>
            </tr>

            <tr>
                <td>Current Image: </td>
                <td>
                    <?php 
                    if($current_image!=""){
                        ?>
                        <img src="<?php echo SITEURL?>images/food/<?php echo $current_image?>"width="120px" >
                        <?php
                    }
                    else
            {
                echo "<span style='color:#ff6b81;'>Image not added</span>";
            }
                    
                    ?>
                </td>
            </tr>
            <tr>
                <td>New Image: </td>
                <td>
                   <input type="file"name="image">
                </td>
            </tr>
            <tr>
                <td>Category: </td>
                <td>
                    <select name="category">
                        <?php 
                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                        $res = mysqli_query($conn,$sql);

                        $count = mysqli_num_rows($res);

                        if($count>0){
                            while($row=mysqli_fetch_assoc($res)){
                                $category_title=$row['title'];
                                $category_id=$row['id'];

                               //echo "<option value='$category_id'>$category_title</option>"; //html mbrenda phps
                               ?> 
                               <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                               <?php
                            }


                        }else{
                            echo "<option value='0'>Category Not Available</option>";
                        }
                        
                        
                        ?>

                    </select>
                </td>
            </tr>
            <tr>
    <td>Featured: </td>
    <td>
        <input type="radio" name="featured" value="Yes"<?php if($featured=="Yes") echo "Checked"?>>Yes
        <input type="radio" name="featured" value="No" <?php if($featured=="No")echo "Checked"?>>No
    </td>
</tr>
<tr>
<tr>
    <td>Active: </td>
    <td>
        <input type="radio" name="active" value="Yes"<?php if($active=="Yes")echo "Checked"?>>Yes
        <input type="radio" name="active" value="No" <?php if($active=="No") echo "Checked"?>>No
    </td>
</tr>
<tr>
    <td>
     <input type="hidden"name="current_image" value="<?php echo $current_image?>">   <!-- Per me mujt me bo update vyn id edhe image_name -->
     <input type="hidden"name="id"value=<?php echo $id?>>
    
    <input type="submit"name="submit" value="Update Food" class="btn-secondary"></td>
</tr>
        </table>
    </form>
    <?php 
        if(isset($_POST['submit'])){
           //1.get all the data from form
           $id=$_POST['id'];
           $title=$_POST['title'];
           $description=$_POST['description'];
           $price=$_POST['price'];
           $current_image=$_POST['current_image'];
           $category=$_POST['category'];
           $featured=$_POST['featured'];
           $active=$_POST['active'];

           //updating new image
          //check whether the image is selected or not 
          if(isset($_FILES['image']['name'])){
          //get the image details
          $image_name=$_FILES['image']['name'];
          //check whether image is available
          if($image_name!=""){
            $ext = end(explode('.',$image_name));

            //Rename the image
            $image_name = "Food_Item_".rand(0000,9999).'.'.$ext;  //New image name Food_Category(ni vlere random 000-999).extensioni prsh jpg

            $source_path=$_FILES['image']['tmp_name'];
 
            $destination_path="../images/food/".$image_name;
 
            //Finally upload the image
            $upload = move_uploaded_file($source_path,$destination_path);
 
            //Check whether the image is uploaded or not
            if($upload==false){
             //Set message
             $_SESSION['upload']='<span style="color:#ff6b81;">Failed to upload image</span>';
         //redirect page 
           header("location:".SITEURL.'admin/manage-food.php');
           //stop the process
           die();
             
            }
            //remove the current image only if it is available
            if($current_image!=""){
                $remove_path ="../images/food/".$current_image;
                $remove = unlink($remove_path);
    
                //Check whether the image is removed
    
               if($remove==false){
                $_SESSION['failed-remove']='<span style="color:#ff6b81;">Failed to remove image</span>';
                header("location:".SITEURL.'admin/manage-food.php');
                die(); //stop the process
            }
           
           }
          }
          else{
            $image_name=$current_image;
          }
          }
          else {
            $image_name=$current_image;
          }


           //update the database
           $sql3 = "UPDATE  tbl_food SET
           title='$title',
           description='$description',
           price=$price,
           image_name='$image_name',
           category_id='$category',
           featured='$featured',
           active='$active'
           WHERE id=$id
           ";
     
          $res3 = mysqli_query($conn,$sql3);



           //redirect to manage-category.php with message

           if($res3==true){
            $_SESSION['update']='<span style="color:#2ed573;">Food updated successfully</span>';
            //redirect page to manage admin
            header("location:".SITEURL.'admin/manage-food.php');
           }
           else {
            $_SESSION['update']='<span style="color:#ff6b81;">Failed to update food</span>';
            //redirect page to manage admin
            header("location:".SITEURL.'admin/update-food.php');
           }
          
        }
        
        
        ?>

    </div>
</div>

<?php include('partials/footer.php')?>