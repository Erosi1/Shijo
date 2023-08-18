<?php 
include ('../config/constant.php');
//1.Duhet me kshyr a e ka marre id edhe image_name 

if(isset($_GET['id']) && isset($_GET['image_name'])){
    //vazho fshije 
  //1.get id and image-name
  $id=$_GET['id'];
  $image_name=$_GET['image_name'];


  
  //2.Remove the image if available
  //kshyre a ka image apo jo 
  if($image_name !=""){
    //image ekziston edhe duhet me u fshi prej folderi
    $path = "../images/food/".$image_name;
    $remove = unlink($path);

   if($remove==TRUE){
    $_SESSION['delete'] = '<span style="color:#2ed573;">Food deleted successfully</span>';
    header("location:" . SITEURL . 'admin/manage-food.php');
   }
   else{
    $_SESSION['upload']='<span style="color:#ff6b81;">Failed to  delete Food Image</span>';
    header("location:".SITEURL.'admin/manage-food.php');
    die();
   }
}


  //3.Delete from database
  
  $sql = "DELETE FROM tbl_food WHERE id=$id";

  $res = mysqli_query($conn,$sql);

  if($res==true){
    //food deleted 
    $_SESSION['delete'] = '<span style="color:#2ed573;">Food deleted successfully</span>';
    header("location:" . SITEURL . 'admin/manage-food.php');
  }
  else 
  {
    //failed to delete food
    $_SESSION['delete']='<span style="color:#ff6b81;">Failed to  delete food</span>';
    header("location:".SITEURL.'admin/manage-food.php');
  }

  //4.Redirect to manage-food with session message
}
else
{
 //redirect to manage-food.php
 $_SESSION['delete']='<span style="color:#ff6b81;">Failed to  delete food</span>';
 header("location:".SITEURL.'admin/manage-food.php');
}


?>