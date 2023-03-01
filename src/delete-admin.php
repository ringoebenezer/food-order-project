<?php include("static/menu.php") ?>

<?php
    // Get the ID of the admin to be deleted.
    $id=$_GET['id'];


    //  SQL Query to Delete Admin
    $query="delete from `tbl_admin` where `tbl_admin`.`id`=$id;";
   
    if ($conn) {
        $execute=mysqli_query($conn,$query);
        if ($execute) {
              // Redirect to Manage Admin page with message (success/error)
              $_SESSION['delete']="<div class='error'>Admin Deleted Successfully</div>"; 
              header('location:'.siteurl.'src/admin.php');
            ?>



<?php
        } 
        
    }
?>