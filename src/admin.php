<!-- Menu Starts  -->
<?php   include("static/menu.php"); ?>
<!-- Menu Ends  -->

<!-- Main Content Starts-->
<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Manage Admin</h1>
        <br />
        <br>
        <?php 
            if(isset($_SESSION['add'])){
                echo $_SESSION['add']; //Displaying Session Message.
                unset($_SESSION['add']); //Removing Session Message.
            }

           if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
           }

           if(isset($_SESSION['updated_admin'])){
            echo $_SESSION['updated_admin'];
            unset($_SESSION['updated_admin']);
           }
           
           if(isset($_SESSION['incorrect_old_password'])){
            echo $_SESSION['incorrect_old_password'];
            unset($_SESSION['incorrect_old_password']);
           }

           if(isset($_SESSION['same_old_and_new_password'])){
            echo $_SESSION['same_old_and_new_password'];
            unset($_SESSION['same_old_and_new_password']);
           }

           if(isset($_SESSION['error_unmatching'])){
            echo $_SESSION['error_unmatching'];
            unset($_SESSION['error_unmatching']);
           }
            
           if(isset($_SESSION['password_updated'])){
            echo $_SESSION['password_updated'];
            unset($_SESSION['password_updated']);
           }

           if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
           }
           

        ?>
        <br>
        <br>
        <br>
        <!-- Button To Add Admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br />
        <br />
        <br />
        <table class="tbl_full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php    
    //Query ot Get all Admins in tbl_admin
        $query="SELECT * FROM `tbl_admin`;";
    //Execute Query
        $execute=mysqli_query($conn,$query);

    //Check whether the Query is Executed or Not.
    if($execute){
        //Count Rows to check whether we have data in database or not.
        $countRows=mysqli_num_rows($execute); //This function gets the number of rows we have in table `tbl_admin`.

        //Check the number of Rows.
        if ($countRows>0) {
            //Means we have data in the table.
            $count=1;
            while ($data=mysqli_fetch_assoc($execute)) {
                
                //Using While loop to get all the data from database.
                //The while loop will run as long as we have data in database.
                
                    //Get individual data 
                $id=$data['id'];
                $fullname=$data['fullname'];
                $username=$data['username'];

                //Display the values in our Table.
?>

            <tr>
                <td><?php echo $count++;  ?></td>
                <td><?php echo $fullname ?></td>
                <td><?php echo $username ?></td>
                <td>
                    <a href="<?php echo siteurl; ?>src/update-password.php?id=<?php echo($id); ?>"
                        class="btn-secondary">Update
                        Password &nbsp;</a>
                    <a href="<?php echo siteurl;?>src/update-admin.php?id=<?php echo($id);?>" class="btn-secondary">
                        Update Admin</a>
                    &nbsp;
                    <a href="<?php echo siteurl; ?>src/delete-admin.php?id=<?php echo($id); ?>"
                        class="btn-danger">Delete
                        Admin</a>

                </td>
            </tr>
            <?php
                 }
    } else {
        //Data Fetching Failed.
    }
    

    }
            ?>
        </table>

    </div>
</div>
<!-- Main Content End  -->

<!--Footer Starts-->
<?php include("static/footer.php") ?>
<!-- Footer Ends -->