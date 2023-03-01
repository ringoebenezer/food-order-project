<?php include("static/menu.php"); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Password</h1>
        <div class="form-content">
            <form action="update-password.php" method="POST">
                <input type="hidden" name='id' value="<?php echo($_GET['id']) ?>">
                Old Password<input type="password" name="old" required> <br>
                New Password<input type="password" name="new" required> <br>
                Confirm Password<input type="password" name="confirm" required> <br>

                <input type="submit" name="submit" value="Change Password" class="form_button">
            </form>
        </div>

        <?php  
        if(isset($_POST['submit'])){
            $id=$_POST['id'];
            $old_password=md5($_POST['old']);
            $new_password=md5($_POST['new']);
            $confirm_password=md5($_POST['confirm']);

            $query="select `id`,`password` from `tbl_admin` where `id`=$id AND `password`='$old_password';"; 
            $execute=mysqli_query($conn,$query);
            $countRows=mysqli_num_rows($execute);
           
            if ($countRows==0) {    
                $_SESSION['incorrect_old_password']="Incorrect Old Password";
                header('location:'.siteurl.'src/admin.php');
            } else {
               while($data=mysqli_fetch_assoc($execute)){
                   $id=$data['id'];
                    $old_password=$data['password'];
                };

                if($new_password==$old_password){
                    $_SESSION['same_old_and_new_password']="<div class='error'>Please enter a new Password</div>";
                    header('location:'.siteurl.'src/admin.php');
                }
                else if($new_password!=$confirm_password){
                    $_SESSION['error_unmatching']="<div class='error'>Passwords don't Match</div>";
                    header('location:'.siteurl.'src/admin.php');
                }
                else if($new_password==$confirm_password){
                    $query="update `tbl_admin` set `password`='$new_password' where `id`=$id AND `password`='$old_password';";
                    $execute=mysqli_query($conn,$query);
                    $_SESSION['password_updated']="<div class='success'>Password Updated Successfully</div>";
                    header('location:'.siteurl.'src/admin.php');
                }
                    ?>
        <?php
                }
            }
            ?>

    </div>
</div>


<?php include("static/footer.php"); ?>