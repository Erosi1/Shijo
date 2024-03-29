<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
          .tbl-30 {
    width:35%;
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
        <h1>Update Order</h1>
        <br>
        <br>
        <?php 
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $sql= "SELECT * FROM tbl_order WHERE id=$id";
            $res = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($res);
            if($count==1){
            $row =mysqli_fetch_assoc($res);
            $food=$row['food'];
            $price=$row['price'];
            $qty=$row['qty'];
            $status=$row['status'];
            $customer_name=$row['customer_name'];
            $customer_contact=$row['customer_contact'];
            $customer_email=$row['customer_email'];
            $customer_address=$row['customer_address'];
            }
            else{
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        }
        else{
            header('location:'.SITEURL.'admin/manage-order.php');
        }
      
        
        
        ?>

        <form action=""method="POST">
            <table class='tbl-30'>
            <tr>
                <td>Food Name: </td>
                <td><b><?php echo $food?></b></td>
            </tr>   
            <tr>
                <td>Price: </td>
                <td><b>$<?php echo $price?></b></td>
            </tr> 
            <tr>
                <td>Qty: </td>
                <td><input type="number"name="qty"value="<?php echo $qty?>"></td>
            </tr> 
            <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
            <tr>
                <td>Costumer Name: </td>
                <td><input type="text"name='customer_name'value="<?php echo $customer_name?>"></td>
            </tr>
            <tr>
                <td>Costumer Contact: </td>
                <td><input type="text"name='customer_contact'value="<?php echo $customer_contact?>"></td>
            </tr>
            <tr>
                <td>Costumer Email: </td>
                <td><input type="text"name='customer_email'value="<?php echo $customer_email?>"></td>
            </tr>
            <tr>
                <td>Costumer Address: </td>
                <td><textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address?></textarea></td>
            </tr>
            <tr>
                <td colspan='2'>
                    <input type="hidden"name="id"value="<?php echo $id?>">
                    <input type="hidden"name="price"value="<?php echo $price?>">
                    <input type="submit"name="submit"value="Update Order" class='btn-secondary'>
                </td>
            </tr>
            </table>
        </form>
        <?php 
        if(isset($_POST['submit'])){
          $id=$_POST['id'];
          $price=$_POST['price'];
          $qty=$_POST['qty'];
          $total = $price * $qty;
          $status = $_POST['status'];
          $customer_name=mysqli_real_escape_string($conn,$_POST['customer_name']);
          $customer_contact=mysqli_real_escape_string($conn,$_POST['customer_contact']);
          $customer_email=mysqli_real_escape_string($conn,$_POST['customer_email']);
          $customer_address=mysqli_real_escape_string($conn,$_POST['customer_address']);

          //update the values
          $sql2 = "UPDATE tbl_order SET
          qty=$qty,
          total=$total,
          status='$status',
          customer_name='$customer_name',
          customer_contact='$customer_contact',
          customer_email='$customer_email',
          customer_address='$customer_address'
          WHERE id=$id
          ";
          $res2= mysqli_query($conn,$sql2);

          if($res2==true){
            $_SESSION['update']='<span style="color:#2ed573;">Order updated successfully</span>';
            //redirect page to manage order
            header("location:".SITEURL.'admin/manage-order.php');
          }
          else{
            $_SESSION['update']='<span style="color:#ff6b81;">Failed to update order</span>';
            //redirect page to manage order
            header("location:".SITEURL.'admin/update-order.php');
          }
        }
        else{

        }
        
        ?>
    </div>
</div>
<?php include('partials/footer.php')?>