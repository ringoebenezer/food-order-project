    <?php include('partials-front/menu.php'); ?>

    <!-- Food Search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <form action="<?php echo siteurl; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
        </div>
    </section>
    <!-- Food Search Section Ends Here -->

    <?php 
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!--Food Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore &nbsp; &nbsp; &nbsp; &nbsp;</h2>

            <?php 
                //Create SQL Query to Display CAtegories from Database
                    $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3;";
                //Execute the Query
                    $res = mysqli_query($conn, $sql);
                //Count rows to check whether the category is available or not
                    $count = mysqli_num_rows($res);
                if($count>0)
                {
                    //Categories Available
                while($row=mysqli_fetch_assoc($res))
                    {
                    //Get the Values like id, title, image_name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
            <a href="<?php echo siteurl; ?>category-foods.php?category_id=<?php echo $id; ?>">
                <div class="box-3 float-container">
                    <img src="<?php echo siteurl; ?>images/category/<?php echo $image_name; ?>"
                        class="img-responsive img-curve">
                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                </div>
            </a>

            <?php
                    }
                }
                else
                {
                    //Categories not Available
                    echo "<div class='error'>Category not Added.</div>";
                }
            ?>


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Food Categories Section Ends Here -->



    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Today's Menu</h2>

            <?php 
            //Getting Foods from Database that are active and featured
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 4";
            //Execute the Query
            $res2 = mysqli_query($conn, $sql2);
            //Count Rows
            $count2 = mysqli_num_rows($res2);

            //CHeck whether food available or not
            if($count2>0)
            {
                //Food Available
                while($row=mysqli_fetch_assoc($res2))
                {
                    //Get all the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="<?php echo siteurl; ?>images/food/<?php echo $image_name; ?>"
                        class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title; ?></h4>
                    <p class="food-price"><?php echo $price; ?>&nbsp; /=</p>
                    <p class="food-detail">
                        <?php echo $description; ?>
                    </p>
                    <br>

                    <a href="<?php echo siteurl; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order
                        Now</a>
                </div>
            </div>

            <?php
                }
            }
            else
            {
                //Food Not Available 
                echo "<div class='error'>Food not available.</div>";
            }
            
            ?>
            <div class="clearfix"></div>
        </div>

        <p class="text-center">
            <a href="<?php echo(siteurl) ?>foods.php">See All Foods</a>
        </p>
    </section>
    <!--Food Menu Section Ends Here-->


    <?php include('partials-front/footer.php'); ?>