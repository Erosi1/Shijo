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
//e kshyr a eshte kliku kategoria qe me marr id 

if(isset($_GET['category_id'])){
    $category_id=$_GET['category_id'];
    //get category title based on category_id

    $sql = "SELECT title from tbl_category WHERE id=$category_id";
    $res = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($res);
    $category_title=$row['title'];

}
else{
    header('location:'.SITEURL);
}


?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            
            $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";

            $res2 = mysqli_query($conn,$sql2);

            $count2 = mysqli_num_rows($res2);
            
            if($count2>0){
                while($row2 = mysqli_fetch_assoc($res2)){
                   $title=$row2['title'];
                   $description=$row2['description'];
                   $price=$row2['price'];
                   $image_name=$row2['image_name'];
                   ?>
                    <div class="food-menu-box">
                <div class="food-menu-img">
                    <?php
                    if($image_name==""){
                        echo "<span style='color:#ff6b81;'>Image not available</span>";
                    }
                    else{
                        ?>
                         <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name?>"  class="img-responsive img-curve">
                        <?php
                    }
                    ?>
                   
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title?></h4>
                    <p class="food-price">$<?php echo $price?></p>
                    <p class="food-detail">
                       <?php echo $description?>
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>
                   <?php
                }
            }
            else{
                echo "<span style='color:#ff6b81;'>Food  not available</span>";
            }
            
            ?>

           


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    
    <?php include('frontend-partials/footer.php')?>

</body>
</html>