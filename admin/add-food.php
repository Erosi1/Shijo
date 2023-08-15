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
<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br>
        <br>
        <?php 
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']); 
        }
        
        ?>
        <form action=""method="POST"enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text"name="title"placeholder="Food title"></td>
                </tr>
                
                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="30"rows="5"placeholder="Food Description..."></textarea></td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td><input type="number"name="price"></td>
                </tr>

                <tr>
                    <td>Image: </td>
                    <td><input type="file"name="image"></td>

                </tr>
                <tr>
                    <td>Category: </td>
                    <td><select name="category" >
                        <?php 
                        //only display active categories
                        $sql = "SELECT * FROM tbl_category WHERE active='Yes' ";
                        $res = mysqli_query($conn,$sql);
                        $count = mysqli_num_rows($res); //qekjo e kshyr a ka tdhena apo jo
                       
                        if($count>0){
                          while($row=mysqli_fetch_assoc($res)){
                            $id=$row['id'];
                            $title=$row['title'];
                           ?>

                             <option value="<?php echo $id?>"><?php echo $title?></option>
                           <?php
                          }
                        }
                        else
                         {

                         ?>
                        <option value="0">No Categories Found</option>
                        
                         
                         <?php
                        }

                        
                        ?>
                     
                    </select></td>
                </tr>
                <tr>
            <td>Featured: </td>
            <td><input type="radio"name="featured"value="Yes">Yes
            <input type="radio"name="featured"value="No">No</td>
           </tr>
           <tr> 
            <td>Active: </td>
            <td><input type="radio"name="active"value="Yes">Yes
            <input type="radio"name="active"value="No">No</td>
           </tr>
           <tr>
            <td colspan="2"><input type="submit"name="submit"value="Add Food"class="btn-secondary"></td>
           </tr>

            </table>

        </form>
        <?php 
        if(isset($_POST['submit'])){
           //1.Get the data from form
           $title=$_POST['title'];
           $description=$_POST['description'];
           $price=$_POST['price'];
           $category=$_POST['category'];
           if(isset($_POST['featured'])){
            $featured=$_POST['featured'];
        }
        else{
            //Set the default value
            $featured="No";
        }
      if(isset($_POST['active'])){
            $active=$_POST['active'];
        }
        else{
            //Set the default value
            $active="No";
        }
           
           //2.Upload Image if selected
           if(isset($_FILES['image']['name'])){
            //UPLOAD THE IMAGE
            //To upload the image we need image name,source path,destination path
           $image_name=$_FILES['image']['name'];

           if($image_name !="")
           {

           //1.Get the extension of our image(jpg)
           $ext = end(explode('.',$image_name));

           //Rename the image
           $image_name = "Food_Name_".rand(0000,9999).'.'.$ext;  //New image name Food_Category(ni vlere random 0000-9999).extensioni prsh jpg

           $source_path=$_FILES['image']['tmp_name'];

           $destination_path="../images/food/".$image_name;

           //Finally upload the image
           $upload = move_uploaded_file($source_path,$destination_path);

           //Check whether the image is uploaded or not
           if($upload==false){
            //Set message
            $_SESSION['upload']='<span style="color:#ff6b81;">Failed to upload image</span>';
        //redirect page 
          header("location:".SITEURL.'admin/add-food.php');
          //stop the process
          die();
            
           }
          }

           

         }
         else {
            //DONT UPLOAD IMAGE AND SET THE IMAGE NAME VALUE AS BLANK
            $image_name="";

         }
           //3.Insert data to database

           $sql2 = "INSERT INTO tbl_food SET
           title='$title',
           description='$description',
           price=$price,
           image_name='$image_name',
           category_id=$category,
           featured='$featured',
           active='$active'
           ";
           $res2 = mysqli_query($conn,$sql2);


           //4.Redirect with message to manage-food.php
           if($res2==true){
            $_SESSION['add-food']='<span style="color:#2ed573;">Food added successfully</span>';
           //redirect page to manage food
           header("location:".SITEURL.'admin/manage-food.php'); 
    
           }else {
            $_SESSION['add-food']='<span style="color:#ff6b81;">Failed to  add Food</span>';
            //redirect page to manage food
            header("location:".SITEURL.'admin/add-food.php');
           }
        }
        
        ?>
       
    </div>
</div>

<?php include('partials/footer.php');?>