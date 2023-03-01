<?php   include("../src/static/menu.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <div class="main-content">
        <div class="wrapper">
            <h2>Hello</h2>

            <?php 
              $id=$_GET['id']; 
              $query="delete from `tbl_food` where `id`=$id;";
              $execute=mysqli_query($conn,$query);
              
              if($execute){
                $_SESSION['update_food']="<div class='success'>Food deleted Successfully</div><br> <br>";
                header("location:manage-food.php?done");
              }else{
                $_SESSION['update_food']="<div class='error'>Food deletion Failed</div><br><br>";
                header("location:manage-food.php?done");
              }
             
        ?>

        </div>
    </div>

</body>

</html>