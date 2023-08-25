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
</html>
<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br>
        <br>
        <?php 
        if(isset($_GET['id'])){
            
            $id=$_GET['id'];

            $sql = "SELECT * FROM tbl_category WHERE id=$id";

            $res = mysqli_query($conn,$sql);

            $count = mysqli_num_rows($res);

            if($count==1)
            {
                $row = mysqli_fetch_assoc($res);
                $title=$row['title'];
                $current_image=$row['image_name'];
                $featured=$row['featured'];
                $active=$row['active'];
                
            
            }else {
               
                $_SESSION['no-category-found']='<span style="color:#ff6b81;">Category not found</span>';
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        }
        else {
             //Redirect to manage-category.php
      header('location:'.SITEURL.'admin/manage-category.php');
        }
        ?>
        <form action=""method="POST"enctype="multipart/form-data">
        <table class="tbl-30">
        <tr>
            <td>Title: </td>
            <td><input type="text"name="title"value="<?php echo $title?>"></td>
        </tr>

        <tr>
            <td>Current Image: </td>
            <td><?php 
            if($current_image !=""){

                 ?>
                 <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image?>" width="150px">
                 <?php
            }
            else
            {
                echo "<span style='color:#ff6b81;'>Image not added</span>";
            }
            
            ?></td>
        </tr>

        <tr>
            <td>New Image: </td>
            <td>
                <input type="file"name="image">
            </td>
        </tr>

        <tr>
    <td>Featured: </td>
    <td>
        <input type="radio" name="featured" value="Yes" <?php if($featured == "Yes") echo "checked"; ?>>Yes
        <input type="radio" name="featured" value="No" <?php if($featured == "No") echo "checked"; ?>>No
    </td>
</tr>
<tr>
    <td>Active: </td>
    <td>
        <input type="radio" name="active" value="Yes" <?php if($active == "Yes") echo "checked"; ?>>Yes
        <input type="radio" name="active" value="No" <?php if($active == "No") echo "checked"; ?>>No
    </td>
</tr>
        <tr>
            <td>
            <input type="hidden" name="current_image"value="<?php echo $current_image?>">
            <input type="hidden"name="id"value="<?php echo $id?>">    
            <input type="submit"name="submit"value="Update Category"class="btn-secondary"></td>
        </tr>
 

        </table>
        </form>
        <?php 
        if(isset($_POST['submit'])){
           //1.get all the data from form
           $id=$_POST['id'];
           $title=mysqli_real_escape_string($conn,$_POST['title']);
           $current_image=$_POST['current_image'];
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
            $image_name = "Food_Category_".rand(000,999).'.'.$ext;  //New image name Food_Category(ni vlere random 000-999).extensioni prsh jpg

            $source_path=$_FILES['image']['tmp_name'];
 
            $destination_path="../images/category/".$image_name;
 
            //Finally upload the image
            $upload = move_uploaded_file($source_path,$destination_path);
 
            //Check whether the image is uploaded or not
            if($upload==false){
             //Set message
             $_SESSION['upload']='<span style="color:#ff6b81;">Failed to upload image</span>';
         //redirect page 
           header("location:".SITEURL.'admin/manage-category.php');
           //stop the process
           die();
             
            }
            //remove the current image only if it is available
            if($current_image!=""){
                $remove_path ="../images/category/".$current_image;
                $remove = unlink($remove_path);
    
                //Check whether the image is removed
    
               if($remove==false){
                $_SESSION['failed-remove']='<span style="color:#ff6b81;">Failed to remove image</span>';
                header("location:".SITEURL.'admin/manage-category.php');
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
           $sql2 = "UPDATE  tbl_category SET
           title='$title',
           image_name='$image_name',
           featured='$featured',
           active='$active'
           WHERE id=$id
           ";
     
          $res2 = mysqli_query($conn,$sql2);



           //redirect to manage-category.php with message

           if($res2==true){
            $_SESSION['update']='<span style="color:#2ed573;">Category updated successfully</span>';
            //redirect page to manage admin
            header("location:".SITEURL.'admin/manage-category.php');
           }
           else {
            $_SESSION['update']='<span style="color:#ff6b81;">Failed to update category</span>';
            //redirect page to manage admin
            header("location:".SITEURL.'admin/update-admin.php');
           }
          
        }
        
        
        ?>
    </div>
</div>


<?php include('partials/footer.php')?>