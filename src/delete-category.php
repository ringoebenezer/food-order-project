<?php  include('static/menu.php');?>

<div class="main-content">
    <?php
    $id=$_GET['id'];
    $query="select * from `tbl_category` where `id`=$id;";
    $execute=mysqli_query($conn,$query);


    ?>


    <?php
    if($execute){
        //SQL Query to delete a row in table category 
        $query="delete from `tbl_category` where `tbl_category`.`id`= $id;";
        $execute=mysqli_query($conn,$query);

        if($execute){
            //Query Executed.
            $_SESSION['category_deletion']="<div class='error'>Category Deleted Successfully.</div>";
            //Redirect to Manage Category Page
            header('location:'.siteurl.'src/manage-category.php');
        }
        else{
            //Query Executed and Category Added.
            $_SESSION['category_add']="<div class='error'>Failed to Delete Category.</div>";
            //Redirect to Manage Category Page
            header('location:'.siteurl.'src/manage-category.php');
        }
    }
        ?>


</div>
</div>