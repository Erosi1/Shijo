<?php 
include('../config/constant.php');
//Check whether the id and image_name value is set or not

if(isset($_GET['id']) && isset($_GET['image_name'])){
    //get the value and delete 
   $id=$_GET['id'];
   $image_name=$_GET['image_name'];

  //Remove the physical image file if available 

  if($image_name != ""){

    //Image osht available munesh me fshi

   $path = "../images/category/".$image_name;
   //Remove the image
   $remove = unlink($path);

   if($remove==false){
    $_SESSION['remove']='<span style="color:#ff6b81;">Failed to  delete Category Image</span>';
    header("location:" . SITEURL . 'admin/manage-category.php');
    die();
   }
  }

  //Delete data from database

  $sql = "DELETE FROM tbl_category WHERE id=$id";

  $res = mysqli_query($conn,$sql);

  //Check whether the data is deleted from database

  if($res==true)
  {
    $_SESSION['delete'] = '<span style="color:#2ed573;">Category deleted successfully</span>';
    header("location:" . SITEURL . 'admin/manage-category.php');
  }
  else
  {
    $_SESSION['delete']='<span style="color:#ff6b81;">Failed to  delete Category Image</span>';
    header("location:" . SITEURL . 'admin/manage-category.php');
  
  }

 

}
else {
    //redirect to manage-category.php 
    header("location:" . SITEURL . 'admin/manage-category.php');

}

?>