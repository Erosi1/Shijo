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
    <?php include('frontend-partials/menu.php') ?>

    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php

            $sql = "SELECT * FROM tbl_category WHERE active='Yes' ";

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
    <!-- Categories Section Ends Here -->

    <?php include('frontend-partials/footer.php') ?>

</body>
</html>
