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



<!-- Food Menu Section Starts Here -->
<section class="food-menu">
    <h2 class="text-center">Food Menu</h2>
    <div class="food-container">

        <?php 
                //Display Foods that are Active
                $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

                //Execute the Query
                $res=mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //Check whether the foods are available or not
                if($count>0)
                {
                    //Foods Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the Values
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        ?>

        <div class="food-menu-box">
            <div class="food-menu-img">

                <img src="<?php echo siteurl; ?>images/food/<?php echo $image_name; ?>"
                    class="img-responsive img-curve">
            </div>

            <div class="food-menu-desc">
                <h4><?php echo $title; ?></h4>
                <p class="food-price"><?php echo $price; ?> /=</p>
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
                    //Food not Available
                    echo "<div class='error'>Food not found.</div>";
                }
            ?>





        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>