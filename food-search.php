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

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php 
              $search = $_POST['search'];
            ?>
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            //get the search keyword

          

            $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'"; //sql query me marr food based on qka ke lyp
            $res = mysqli_query($conn,$sql);

            $count = mysqli_num_rows($res);
            if($count>0){
            while($row = mysqli_fetch_assoc($res)){
                $id =$row['id'];
                $title =$row['title'];
                $price =$row['price'];
                $description =$row['description'];
                $image_name =$row['image_name'];
                ?>
           <div class="food-menu-box">
                <div class="food-menu-img">
                <?php 
                    if($image_name==""){
                        echo "<span style='color:#ff6b81;'>Image not available</span>";
                    }
                    else
                    {
                        ?>
                        <img src="<?php SITEURL ?>images/food/<?php  echo $image_name?>"  class="img-responsive img-curve"height="75px">
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
            else
            {
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