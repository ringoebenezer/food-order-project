<?php  include('static/menu.php');?>

<div class="main-content">
    <div class="add-category">
        <h1 class="text-center">Update Category</h1>
        <br><br><br>

        <?php
    $id=$_GET['id'];
    $query="select * from `tbl_category` where `id`=$id;";
    $execute=mysqli_query($conn,$query);

    if($execute){ 
        while($data=mysqli_fetch_assoc($execute)){
            $title=$data['title'];
            $featured=$data['featured'];
            $active=$data['active'];
            $imageName=$data['image_name'];
            
        }
    }
        ?>

        <!-- Update Category Form  -->

        <form action="update-category.php" method="POST" enctype="multipart/form-data">
            Title <br> <input type="text" name="title" value="<?php echo($title) ?>" required> <br> <br>
            Current Image <br> <br> <img src="<?php echo siteurl; ?>images/category/<?php echo $imageName ?>"
                width="60px">
            <br> <br><br>
            New Image <br> <input type="file" name="image" required> <br>
            <br>

            Featured <br> <br>
            <input <?php if($featured=="Yes"){echo "checked";}   ?> type="radio" name="featured"
                class="text-center inline" value="Yes" required> Yes
            <input <?php if($featured=="No"){echo "checked";}   ?> type="radio" name="featured"
                class="text-center inline" value="No" required> No
            <br><br>

            Active <br> <br>
            <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" class="text-center inline"
                value="Yes" required> Yes
            <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" class="text-center inline"
                value="No" required> No
            <br> <br> <br>

            <input type="hidden" name="id" value="<?php echo($id); ?>">
            <input type="hidden" name="current_image" value="<?php echo($current_image); ?>">
            <input type="submit" name="submit" class="btn-primary">
        </form>

        <!-- Update Category Form  Ends-->

        <?php

if (isset($_POST['submit'])){
    $id=$_POST['id'];
    $title=$_POST['title'];
    $featured=$_POST['featured'];
    $active=$_POST['active'];
        //Working with the image file.
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
    
        //Create SQL Query to Update Category in the database.
$query= "UPDATE `tbl_category` set `title`= '$title' ,`image_name`='$nameNew',`featured`='$featured', `active`='$active' WHERE `id`=$id;";
$execute=mysqli_query($conn,$query);

if($execute){
    $_SESSION['category_updation']="<div class='success'>Category Updated</div>";
    $result=move_uploaded_file($temp, $target_file);
    
    if($result){
        $_SESSION['file']="<div class='success'>Category Image Added Successfully.</div>";
    } 
    else{
        //Failed to Add Category.
    $_SESSION['file']="$query <div class='error'>Failed to Add Category Image.</div>";
        //Redirect to Manage Category Page
    header('location:'.siteurl.'src/add-category?failed.php');  
    }  
    header('location:'.siteurl.'src/manage-category.php?done');
}
else{
    $_SESSION['category_updation']="<div class='error'>Failed To Update Category</div>";
    header('location:'.siteurl.'src/manage-category.php?failed');
}
        }
?>

    </div>
</div>

<?php include("static/footer.php"); ?>