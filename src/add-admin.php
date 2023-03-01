<!-- Menu Starts -->
<?php include("static/menu.php") ?>
<!-- Menu Ends -->

<div class="form-content">
    <form action="add-admin.php" method="POST">
        Full Name<input type="text" name="fullname" placeholder="Enter Your Name" required> <br><br>
        User Name<input type="text" name="username" placeholder="Enter User Name" required> <br><br>
        Password<input type="password" name="password" placeholder="Enter Password" required> <br><br>
        <input type="submit" name="submit" class="form_button">
    </form>
</div>

<!-- Footer Starts -->
<?php include("static/footer.php") ?>
<!-- Footer Ends -->

<?php
//Check whether the submit button is clicked or not
//Process the values submitted from form and save it in Database.


    if(isset($_POST['submit'])){
        //Button Submit is Clicked
        //Get the form data
        $fullname=$_POST["fullname"];
        $username=$_POST["username"];
        $password=md5($_POST["password"]);

       
    
        //Query to insert form data into the database.
        $query="INSERT INTO tbl_admin (fullname,username,password) values  ('$fullname', '$username', '$password')";
       
        if ($conn) {
            //Query Execution.
            $execute=mysqli_query($conn,$query);
            if($execute){
                //Data Inserted
                //Create a Session Variable to display message.
                $_SESSION['add']="<div class='success'>Admin Added Successfully.</div>";

                //Redirect Page to Admin Panel.
                header("location:".siteurl.'src/admin.php');
            }
            else{
                die("Data Insertion Failed");
            }
        } else {
           echo ("Database Connection Failed");
        }

    
        }    
?>