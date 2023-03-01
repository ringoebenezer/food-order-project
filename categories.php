<?php include('partials-front/menu.php'); ?>


<!-- Categories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore &nbsp; &nbsp; &nbsp; &nbsp;</h2>

        <?php 
                //Display all the categories that are active
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //Check if there's anything available within the categories(table).
                if($count>0)
                {
                    //Something is available on the categories.
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the Values
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
                    //Categories Not Available.
            echo "<div class='error'>Category not found.</div>";
                } 
            ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->


<?php include('partials-front/footer.php'); ?>