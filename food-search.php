<?php include('partials-front/menu.php'); ?>

<!-- Food Search Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <?php 
                //Get the Search Keyword            
            $search = mysqli_real_escape_string($conn, $_POST['search']);
        ?>
        <h2>Search Keyword :<a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>
    </div>
</section>
<!-- Food Search Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Foods Available Based On Search Results.</h2>
        <?php 

                //SQL Query to Get foods based on search keyword
                //$search = burger '; DROP database name;
                // "SELECT * FROM tbl_food WHERE title LIKE '%burger'%' OR description LIKE '%burger%'";
                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //Check whether food available of not
                if($count>0)
                {
                        //Food is Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the details
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                        ?>

        <div class="food-menu-box">
            <div class="food-menu-img">

                <img src="<?php echo siteurl; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza"
                    class="img-responsive img-curve">
            </div>

            <div class="food-menu-desc">
                <h4><?php echo $title; ?></h4>
                <p class="food-price">$<?php echo $price; ?></p>
                <p class="food-detail">
                    <?php echo $description; ?>
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
                    //Food Not Available
                    echo "<div class='error'>Food not found.</div>";
                }
            ?>
        <div class="clearfix"></div>
    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>