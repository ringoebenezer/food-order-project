<?php   include("../src/static/menu.php") ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Manage Order</h1>
        <br />
        <table class="tbl_full">
            <tr>
                <th>S.N</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty.</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>

            <?php
        
    $query="select * from tbl_order order by id desc;";
    $execute=mysqli_query($conn,$query);
    
    if($execute){
        $count=0;
        while($data=mysqli_fetch_assoc($execute)){
            $id=$data['id'];
            $food=$data['food'];
            $price=$data['price'];
            $qty=$data['qty'];
            $total=$data['total'];
            $order_date=$data['order_date'];
            $status=$data['status'];
            $customer_name=$data['customer_name'];
            $customer_contact=$data['customer_contact'];
            $customer_email=$data['customer_email'];
            $customer_address=$data['customer_address'];

            ?>
            <tr>
                <td><?php echo(++$count); ?></td>
                <td><?php echo($food); ?></td>
                <td><?php echo($price); ?></td>
                <td><?php echo($qty); ?></td>
                <td><?php echo($total); ?></td>
                <td><?php echo($order_date); ?></td>
                <td>
                    <?php
                    // Ordered, On Delivery,Delivered,Cancelled.
                    if($status=="Ordered"){
                        echo "<label>$status</label>";
                    }
                    else if($status=="On Delivery"){
                        echo "<label style='color:orange;'>$status</label>";
                    }
                    else if($status=="Delivered"){
                        echo "<label style='color:green;'>$status</label>";
                    }
                    else if($status=="Cancelled"){
                        echo "<label class='error'>$status</label>";
                    }
                    ?>

                </td>
                <td><?php echo($customer_name); ?></td>
                <td><?php echo($customer_contact); ?></td>
                <td><?php echo($customer_email); ?></td>
                <td><?php echo($customer_address);?></td>
                <td>
                    <a href="<?php echo(siteurl); ?>src/update-order.php?id=<?php echo($id); ?>" class="btn-secondary">
                        Update Order</a>&nbsp;
                </td>
            </tr>

            <?php

            }
            }

            
        ?>

        </table>
    </div>
</div>

<?php include("../src/static/footer.php") ?>