<?php   include("../src/static/menu.php") ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br />

        <?php
     if(isset($_SESSION['food_add'])){
        echo($_SESSION['food_add']);
        UNSET($_SESSION['food_add']);
    }

    if(isset($_SESSION['update_food'])){
        echo($_SESSION['update_food']);
        UNSET($_SESSION['update_food']);
        }
        
        ?>

        <a href="<?php echo siteurl  ?>src/add-food.php " class="btn-primary">Add Food</a>
        <br />
        <br />
        <br />
        <table class="tbl_full">

            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php 
         //Fetch data from food table.
    $query="select * from `tbl_food`;";
    $execute=mysqli_query($conn,$query);
    $countRows=mysqli_num_rows($execute);
    $sn=0;
    if($countRows>0){
        while($data=mysqli_fetch_assoc($execute)){
           $id=$data['id'];
           $title=$data['title'];
           $description=$data['description'];
           $price=$data['price'];
           $imageName=$data['image_name'];
           $featured=$data['featured'];
           $active=$data['active'];
            ?>
            <tr>
                <td><?php echo(++$sn) ?></td>
                <td><?php echo($title) ?></td>
                <td><?php echo($description) ?></td>
                <td><?php echo($price) ?></td>
                <td><img src="<?php echo(siteurl."images/food/".$imageName) ?>" width="80px"></td>
                <td><?php echo($featured) ?></td>
                <td><?php echo($active) ?></td>
                <td>
                    <a href="<?php echo(siteurl)?>src/update-food.php?id=<?php echo($id) ?>" class="btn-secondary">
                        Update
                        Food</a>&nbsp;
                    <a href="<?php echo(siteurl)?>src/delete-food.php?id=<?php echo($id) ?>" class="btn-secondary"
                        class="btn-danger">Delete Food</a>
                </td>
            </tr>

            <?php           
        }
    }
            ?>
        </table>
    </div>
</div>
<?php include("../src/static/footer.php") ?>