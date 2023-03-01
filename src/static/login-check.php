<?php
                // Authorization and Access-Control..
        // Check whether the user is logged in or not
        if(!isset($_SESSION['user'])){
            //User is not Logged in
            // Redirect to login page with message 
            $_SESSION['not_logged_in']= "<div class='error'>&nbsp;&nbsp;&nbsp;&nbsp; Please login to Proceed</div>";
            header('location:'.siteurl.'src/login.php');
        }
?>