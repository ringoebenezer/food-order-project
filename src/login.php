<?php
    include("../config/constants.php")
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../src/css/src.css">
</head>

<body>
    <div class="login">
        <h1 class="text-center" class="text-center">Login </h1>
        <br> <br>

        <?php  
                if(isset($_SESSION['login_failed'])){
                    echo($_SESSION['login_failed']);
                    unset($_SESSION['login_failed']);
                }       
                if( $_SESSION['not_logged_in']){
                    echo($_SESSION['not_logged_in']);
                    unset($_SESSION['not_logged_in']);
                }       

        ?>

        <!-- Login Form Starts Here-->
        <form action="login.php" method="POST">
            <br> <br>
            Username <br> <br>
            <input type="text" name="username" placeholder="Enter Username">
            <br>
            Password <br> <br>
            <input type="password" name="password" placeholder="Enter Password">
            <br> <br>
            <input type="submit" name="submit" class="text-center" value="Login" class="btn-primary">
            <br>
            <br>
        </form>
        <!-- Login Form ends here  -->

        <p class="text-center">Created By - <a href="#">Ringo Ebenezer</a></p>
    </div>
</body>

</html>

<?php
        //Check whether the Submit Button is Clicked or Not
    if(isset($_POST['submit'])){
        //Process the given Login Data
            $username=mysqli_real_escape_string($conn,$_POST['username']);
            $password=mysqli_real_escape_string($conn,md5($_POST['password']));
     
        //SQL Query to Check whether the user exists or not
            $query="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password';";
      
        //Execute the Query
            $execute=mysqli_query($conn,$query);

        //  Count Rows to check if the query is executed successfully
            $countRows=mysqli_num_rows($execute);   
        

    if($countRows==1){
        // User is available. (Login Success)
            $_SESSION['login']="<div class='success'>Login Successful.</div>";
            $_SESSION['user']=$username; // To check whether the user is logged in or not, Logout button in menu will unset it.
        // Redirect to Home Page/Dashboard.
            header("location:".siteurl.'src/admin.php');
    }
        else{
        // User is not available. (Login Fail)
            $_SESSION['login_failed']="<div class='error'>Username or Password did not match.</div>";
        }
    }
?>