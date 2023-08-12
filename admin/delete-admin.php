<?php 
include ('../config/constant.php');
//1. Get the id of admin that you want to delete
$id=$_GET['id'];



//2.Create sql query that deletes admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";

//execute the query

$res = mysqli_query($conn,$sql);

//Check whether the query executed successfully or not

if($res==true){
    //Query executed succesfully and admin deleted
    
    $_SESSION['delete'] = '<span style="color:#2ed573;">Admin deleted successfully</span>';
    header("location:" . SITEURL . 'admin/manage-admin.php');


}
else 
{
    //query failed to execute
    $_SESSION['delete']='<span style="color:#ff6b81;">Failed to  delete admin</span>';
    header("location:".SITEURL.'admin/manage-admin.php');
}




//3.Redirect to manage-admin.php with message (Success || Error)



?>

