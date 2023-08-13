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
<?php  include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br>
        <br>
        <?php 
        if(isset($_SESSION['add-category'])){
          echo $_SESSION['add-category'];     //displaying session message
          unset($_SESSION['add-category']); //removing session message
        }
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];     //displaying session message
            unset($_SESSION['upload']); //removing session message
          }?>
        <br>
        <br>
        <!--Category Form Starts -->
       <form action="" method="POST" enctype="multipart/form-data"> <!--ENCTYPE NA MUNDESON ME UPLOAD FOTO-->
        <table class="tbl-30">
           <tr>
            <td>Title: </td>
            <td><input type="text"name="title"placeholder="Category Title"required</td>
           </tr>

           <tr>
            <td>Select Image: </td>
            <td>
                <input type="file"name="image">
            </td>
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
            <td colspan="2"><input type="submit"name="submit"value="Add Category" class="btn-secondary"></td>
           </tr>
        </table>
       </form>




        <!--Category Form Ends -->
        <?php 
        if(isset($_POST['submit'])){
           //1.Get the values from form

        $title=$_POST['title'];
        //For radio input type we need to check whether the button is selected or not
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
        //check whether the image is selected or not
         if(isset($_FILES['image']['name'])){
            //UPLOAD THE IMAGE
            //To upload the image we need image name,source path,destination path
           $image_name=$_FILES['image']['name'];

           //1.Get the extension of our image(jpg)
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
            $_SESSION['upload']='<span style="color:#2ed573;">Failed to upload image</span>';
        //redirect page 
          header("location:".SITEURL.'admin/add-category.php');
          //stop the process
          die();
            
           }

           //If image isnt uploaded than we will stop the process and redirect with error message

         }
         else {
            //DONT UPLOAD IMAGE AND SET THE IMAGE NAME VALUE AS BLANK
            $image_name="";

         }
        //create sql query to insert data to database
       $sql = "INSERT INTO tbl_category SET
       title='$title',
       image_name='$image_name',
       featured='$featured',
       active='$active'
       ";
       $res=mysqli_query($conn,$sql);

       if($res==true){
        $_SESSION['add-category']='<span style="color:#2ed573;">Category added successfully</span>';
       //redirect page to manage admin
       header("location:".SITEURL.'admin/manage-category.php'); 

       }else {
        $_SESSION['add-category']='<span style="color:#2ed573;">Failed to  add category</span>';
        //redirect page to manage admin
        header("location:".SITEURL.'admin/add-category.php');
       }

        }
        
        ?>
    </div>
</div>






<?php  include('partials/footer.php')?>