<?php include("static/menu.php"); ?>

<div class="main-content">
    <div class="add-category">
        <h1 class="text-center">Add Category</h1>
        <br><br>

        <?php 
if(isset($_SESSION['category_add'])){
    echo($_SESSION['category_add']);
    UNSET($_SESSION['category_add']);
}
    ?>
        <br> <br>
        <!-- Add Category Form -->
        <form action="add-category.php" method="POST" enctype="multipart/form-data">
            Title <br> <input type="text" name="title" placeholder="Category Title" required> <br> <br>

            Select Image <br> <input type="file" name="image" required> <br> <br>

            Featured <br> <br>
            <input type="radio" name="featured" required value="Yes" class="text-center inline"> Yes
            <input type="radio" name="featured" required value="No" class="text-center inline"> No
            <br><br>

            Active <br> <br>
            <input type="radio" name="active" class="text-center inline" required value="Yes"> Yes
            <input type="radio" name="active" class="text-center inline" required value="No"> No
            <br> <br> <br>
            <input type="submit" name="submit" class="btn-primary">
        </form>
        <!-- Add Category Form Ends  -->

        <!--  Form Processing. -->
        <?php 
if(isset($_POST['submit'])){
    $title=$_POST['title'];
    $featured=$_POST['featured'];
    $active=$_POST['active']; 
        //File uploading.
    $name = $_FILES['image']['name']; 
    $temp = $_FILES['image']['tmp_name']; 
    $size = $_FILES['image']['size'];
    $ext=strtolower(pathinfo($name,PATHINFO_EXTENSION));
        //Check if the file to be uploaded has the required extension.
    if($ext != 'png' && $ext != 'jpg' && $ext != 'gif' && $ext !='svg'){
        echo 'Format must be PNG,JPG, or GIF';
        exit();
    }
        //Checking file size.
    if($size>512000){
        echo 'File size must not exceed 500kb;';
        exit();
    } 
        // Uploading the file.
    $nameNew=uniqid('','true').".".$ext;
    $target_file="../images/category/".$nameNew;

    $result=move_uploaded_file($temp, $target_file);
    
    if($result){
        $_SESSION['category_add']="<div class='success'>Category Image Added Successfully.</div>";
    } 
    else{
        //Failed to Add Category.
    $_SESSION['category_add']="$query <div class='error'>Failed to Add Category Image.</div>";
        //Redirect to Manage Category Page
    header('location:'.siteurl.'src/add-category?failed.php');  
    }        
        //Create SQL Query to Add Category into database.
    $query="insert into tbl_category set title='$title',image_name='$nameNew', featured='$featured', active='$active';";                         
        //Execute Query.
    $execute=mysqli_query($conn,$query);
        //Check whether the query is executed or not 
    if($execute){
        //Query Executed and Category Added.
    $_SESSION['category_add']="<div class='success'>Category Added Successfully.</div>";
        //Redirect to Manage Category Page
    header('location:'.siteurl.'src/manage-category.php?done');
    }
    else{   
        //Failed to Add Category.
    $_SESSION['category_add']="$query <div class='error'>Failed to Add Category.</div>";
        //Redirect to Manage Category Page
    header('location:'.siteurl.'src/add-category.php?failed');   
    }
}
        ?>
    </div>
</div>

<?php include("static/footer.php"); ?>