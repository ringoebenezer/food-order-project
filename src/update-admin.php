<?php  include('static/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Update Admin</h1>

        <?php 
        //Get Id of the Admin to be updated  
                $id=$_GET['id'];
            
        //  Get all the data of the Admin from the Database 
        $query="SELECT * FROM `tbl_admin` WHERE `id`='$id';";
        $execute=mysqli_query($conn,$query);
       
        if($execute){
           
            while($data=mysqli_fetch_assoc($execute)){
                $id=$data['id'];
                $fullname=$data['fullname'];
                $username=$data['username'];
                $_SESSION['id']=$id;
            }             
        }
        else{
            echo("Failed to Update");
        }

        ?>
        <br><br>
        <div class="form-content">
            <form action="update-admin.php" method="POST">
                Full Name<input type="text" name="fullname" placeholder="<?php echo($fullname);?>" required> <br><br>
                User Name<input type=" text" name="username" placeholder="<?php echo($username);  ?>" required> <br><br>
                <input type="submit" name="submit" value="Update Admin" class="form_button">
            </form>
        </div>
        <?php

    if(isset($_POST['submit'])){
       $fullname=$_POST['fullname'];
       $username=$_POST['username'];
       $id=$_SESSION['id'];
       
        ?>

        <?php 
    $query="update `tbl_admin` set `fullname`='$fullname' , `username`='$username' where `id`=$id;";
    $execute=mysqli_query($conn,$query);
    
    if($execute){
        $_SESSION['updated_admin']="<div class='success'>Updated Successfully</div>";
        header('location:'.siteurl.'src/admin.php');   
    }

        


    }

        ?>


    </div>
</div>
</div>

<?php include('static/footer.php');?>




?