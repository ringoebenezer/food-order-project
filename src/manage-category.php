<?php   include("../src/static/menu.php") ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br /> <br>

        <?php 
if(isset($_SESSION['category_add'])){
echo($_SESSION['category_add']);
UNSET($_SESSION['category_add']);
}

if(isset($_SESSION['category_updation'])){
echo($_SESSION['category_updation']);
UNSET($_SESSION['category_updation']);
}

if(isset($_SESSION['category_deletion'])){
echo($_SESSION['category_deletion']);
UNSET($_SESSION['category_deletion']);
}
?>

        <br> <br>
        <!-- Button To Add Admin -->
        <a href="<?php echo(siteurl.'src/add-category.php') ?>" class="btn-primary">Add Category</a>
        <br />
        <br />
        <br />
        <table class="tbl_full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php  
//SQL query to fetch Data from table category in the database.
$query="select * from tbl_category;";

//Execute Query.
$execute=mysqli_query($conn,$query);

if($execute){
$countRows=mysqli_num_rows($execute);

if($countRows>0){
$count=1;
//Means there is data in the table category.
while($data=mysqli_fetch_assoc($execute))    {
    $title=$data['title'];
    $id=$data['id'];
    $imageName=$data['image_name'];
    $featured=$data['featured'];
    $active=$data['active'];
?>
            <tr>
                <td><?php echo $count++;  ?></td>
                <td><?php echo $title;  ?></td>
                <td><?php 
?>
                    <img src="<?php echo siteurl; ?>images/category/<?php echo $imageName ?>" width="60px">

                    <?php

?>
                </td>
                <td><?php echo $featured;  ?></td>
                <td><?php echo $active ;  ?></td>
                <td>
                    <a href="<?php echo siteurl; ?>src/update-category.php?id=<?php echo($id); ?>"
                        class="btn-secondary"> Update
                        Category</a>&nbsp;
                    <a href="<?php echo siteurl; ?>src/delete-category.php?id=<?php echo($id); ?>"
                        class="btn-danger">Delete Category</a>
                </td>
            </tr>

            <?php
}
}

}        
?>

        </table>
    </div>
</div>

<?php include("../src/static/footer.php") ?>