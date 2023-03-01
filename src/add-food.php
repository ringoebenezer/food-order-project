<?php include("../src/static/menu.php")  ?>
<div class="main-content">
    <h1 class="text-center">Add Food</h1>
    <div class="add-food">
        <br><br>

        <?php
        if(isset($_SESSION['food_add'])){
        echo($_SESSION['food_add']);
        UNSET($_SESSION['food_add']);
        }
?>

        <!-- add_food form starts here -->
        <form action="add-food.php" method="POST" enctype="multipart/form-data">
            Title <br> <input type="text" name="title" required> <br><br>

            Description <br><textarea name="description" id="" cols="30" rows="5"
                placeholder="Food Description Goes Here"></textarea> <br><br>

            Price <br><input type="num" name="price" required> <br><br>

            Select Image <br><input type="file" name="image"> <br><br>

            Category <br> &nbsp; &nbsp;
            <select name="category">
                <?php 
    //SQL Query to get data from table category.
    $query="select * from `tbl_category` WHERE `active`='Yes';";
    $execute=mysqli_query($conn,$query);
    $countRows=mysqli_num_rows($execute);

if($countRows>0){
        //Meaning kuna categories with active
    while($data=mysqli_fetch_assoc($execute)){
        $id=$data['id'];
        $title=$data['title'];
            ?>
                <option value="<?php echo($id) ?>"><?php echo($title) ?></option>
                <?php
        }
}
    else{
        ?>
                <option value="0">Other</option>
                <?php
    }

?>
            </select><br><br>

            Featured <br> &nbsp; &nbsp;
            Yes &nbsp; &nbsp;<input type="radio" name="featured" value="Yes"> &nbsp; &nbsp;
            No &nbsp; &nbsp;<input type="radio" name="featured" value="No"> <br>

            <br>

            Active <br> &nbsp; &nbsp;
            Yes &nbsp; &nbsp;<input type="radio" name="active" value="Yes"> &nbsp; &nbsp;
            No &nbsp; &nbsp;<input type="radio" name="active" value="No"> <br>


            <br><br>
            <input type="submit" name="submit" value="Add Food" class="btn-secondary">
        </form>
        <!-- ends here -->
        <?php
    //Processing the form data.
if(isset($_POST['submit'])){
    $category=$_POST['category'];
    $featured=$_POST['featured'];
    $active=$_POST['active'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];
        //Working with the image_file.
    $name=$_FILES['image']['name'];
    $nameNew=pathinfo($name,PATHINFO_FILENAME);
    $temp=$_FILES['image']['tmp_name'];
    $size=$_FILES['image']['size'];
    $error=$_FILES['image']['error'];
    $temp=$_FILES['image']['tmp_name']; 
    $ext= strtolower(pathinfo($name,PATHINFO_EXTENSION));
        //Check if the file to be uploaded has the required extension.
    if($ext != 'png' && $ext != 'jpg' && $ext != 'gif' && $ext !='svg'){
        echo 'Format must be PNG,JPG,SVG or GIF';
        exit();
    }
         //Checking file size.
    if($size>512000){
        echo 'File size must not exceed 500kb;';
        exit();
    }     

    $nameNew=uniqid('','true').".".$ext;
        //Create SQL Query to Add Food into database.
    $query="insert into tbl_food set `title`='$title',`description`='$description',`price`=$price,`image_name`='$nameNew',`category_id`=$category, `featured`='$featured', `active`='$active';";                         
        //Execute Query.
    $execute=mysqli_query($conn,$query);
        //Check whether the query has been executed or not 
if($execute){
    $target_file="../images/food/".$nameNew;  
    $result=move_uploaded_file($temp,$target_file);
    if($result){
        $_SESSION['food_add']="<div class='success'>Food Added Successfully.</div>";
         }
    else{
        // Failed to Add Category.
    $_SESSION['food_add']="<div class='error'>Failed to Add Food Image.</div>";
        //Redirect to Manage Category Page
    header('location:'.siteurl.'src/add-food?failedtoaddimage.php');  
          }        
        //Query Executed and Category Added.
    $_SESSION['food_add']="&nbsp; &nbsp; &nbsp;<div class='success'>Food Added Successfully.</div> <br><br>";
        //Redirect to Manage Category Page
    header('location:'.siteurl.'src/manage-food.php?done');
    }
    else{   
        // Failed to Add Category.
    $_SESSION['food_add']="<div class='error'>Failed to Add Food.</div> <br><br>";
    echo($query);
        // Redirect to Manage Category Page
    header('location:'.siteurl.'src/manage-food.php?failed');   
    }
}
        ?>
    </div>
</div>
<?php include("../src/static/footer.php")  ?>