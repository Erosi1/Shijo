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
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <?php 
    if(isset($_SESSION['order'])){
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
    
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php

            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    //title,image_name,id
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>
                    <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id?>">
                        <div class="box-3 float-container">
                            <?php
                            if ($image_name == "") {
                                echo "<span style='color:#ff6b81;'>Image not available</span>";
                            } else {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name ?>"
                                     class="img-responsive img-curve">
                                <?php

                            }
                            ?>

                            <h3 class="float-text text-white"><?php echo $title ?></h3>
                        </div>
                    </a>
                    <?php
                }

            } else {
                echo "<span style='color:#ff6b81;'>Category not added</span>";
            }

            ?>


            <div class="clearfix"></div>
        </div>
    </section>

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            
            <?php 
            //price,image_name,title,description,id
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
            $res2 = mysqli_query($conn,$sql2);
            $count2 =mysqli_num_rows($res2);
            if($count2>0){
             while($row2 = mysqli_fetch_assoc($res2)){
            $id=$row2['id'];
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

                    <a href="<?php echo SITEURL?>order.php?food_id=<?php echo $id?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>
            
            <?php
             }
            }
            else
            {
                echo "<span style='color:#ff6b81;'>Food not added</span>";
            }
            
            ?>
           

           


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    

    <?php include('frontend-partials/footer.php')?>

</body>
</html>