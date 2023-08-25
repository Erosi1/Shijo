<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php  include ('frontend-partials/menu.php')?>

<?php 
if(isset($_GET['food_id'])){
$food_id=$_GET['food_id'];
$sql = "SELECT * FROM tbl_food WHERE id=$food_id";
$res = mysqli_query($conn,$sql);

$count = mysqli_num_rows($res);

if($count==1){
 $row = mysqli_fetch_assoc($res);
 $title = $row['title'];
 $price = $row['price'];
 $image_name = $row['image_name'];
 
}
else{
    
    header('location:'.SITEURL);
}

}
else{
    header('location:'.SITEURL);
}

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST"class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php 
                        if($image_name==""){
                            echo "<span style='color:#ff6b81;'>Image not available</span>";
                        }
                        else{
                            ?> 
                             <img src="<?php echo SITEURL?>images/food/<?php echo $image_name?>"  class="img-responsive img-curve">
                            <?php
                        }
                        ?>
                       
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title?></h3>
                        <input type="hidden"name="food" value="<?php echo $title?>">
                        <p class="food-price">$<?php echo $price?></p>
                        <input type="hidden"name="price" value="<?php echo $price?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php 
            if(isset($_POST['submit'])){
             $food=$_POST['food'];
             $price=$_POST['price'];
             $qty=$_POST['qty'];
             $total=$price * $qty; // shuma osht sasia here qmimi prsh 5 topa ka 50 cente = 2.50$
             $order_date = date("Y-m-d h:i:sa"); //order date e merr kohen kur bohet porosia
             $status= "Ordered"; //ordered,on delivery,delivered,canceled
             $customer_name=$_POST['full-name'];
             $customer_contact=$_POST['contact'];
             $customer_email = $_POST['email'];
             $customer_address=$_POST['address'];
             
             //save the order in db

             $sql2 = "INSERT INTO tbl_order SET
             food = '$food',
             price= $price,
             qty = $qty,
             total = $total,
             order_date= '$order_date',
             status = '$status',
             customer_name='$customer_name',
             customer_contact=$customer_contact,
             customer_email='$customer_email',
             customer_address='$customer_address'
             
             ";
             $res2 = mysqli_query($conn,$sql2);

             if($res2==true){
                $_SESSION['order'] = '<div style="text-align: center; padding-top: 20px;"><span style="color:#2ed573;">Food ordered successfully</span></div>';
                
                header('location:'.SITEURL);
             }else{
                $_SESSION['order']='<span style="color:#ff6b81;">Food ordered  successfully</span>';
                header('location:'.SITEURL);
             }
            }
            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    

    <?php include('frontend-partials/footer.php')?>

</body>
</html>