<?php  
    // Include contants.php so you can use the 'siteurl' 
    include('../config/constants.php');
    // Destroy all  sessions then Redirect to Login Page.
    session_destroy(); 
    header('location:'.siteurl.'src/login.php');
?>