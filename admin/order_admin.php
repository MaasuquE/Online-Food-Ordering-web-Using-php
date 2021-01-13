<?php
    include "config.php";
    include "toper.php";
    $sql="SELECT * FROM order_detail 
    LEFT JOIN delivery_boy ON order_detail.delivery_boy_id=delivery_boy.id
    ORDER BY order_detail.order_details_id DESC";
    $res=mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)>0){

?>

<div class="container">
    <div class="order_sec">
        <h3>Order Table</h3>
        <table class="order_table">
            <thead class="main_head">
                <tr>
                    <th>Order No.</th>
                    <th>Personal Info.</th>
                    <th>Address</th>
                    <th>Order Details</th>
                    <th>Order Date</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i=1;
            while($row=mysqli_fetch_assoc($res)){
                
            ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><b>Name:</b> <?php echo $row['name']; ?> <br><b>Email:</b><?php echo $row['email']; ?> <br><b>Mobile: </b>01725-110034</td>
                    <td><?php echo $row['address']; ?></td>
                    <td><table class="inner_table"><thead><tr><th>Dish-id</th><th>Dish-Name</th><th>Price</th><th>Quantity</th></tr></thead>
                        <tbody>
                            <?php 
                                $or_dls=$row['order_details_id'];
                                $res_or=mysqli_query($conn,"SELECT * FROM order_master
                                LEFT JOIN dish ON order_master.dish_id=dish.dish_id
                                 WHERE order_details_id={$or_dls}");
                                if(mysqli_num_rows($res_or)>0){

                                while($row_or=mysqli_fetch_assoc($res_or)){
                            
                            ?>
                            <tr>
                                <td><?php echo $row_or['dish_id']; ?></td>
                                <td><?php echo $row_or['dish']; ?></td>
                                <td><?php echo $row_or['dish_price']; ?></td>
                                <td><?php echo $row_or['order_qty']; ?></td>
                            </tr>
                            <?php  } }?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">Delivery Charge</td>
                                <td colspan="2">60 tk</td>
                            </tr>
                            <tr>
                                <td colspan="2">Total</td>
                                <td colspan="2"><?php echo $row['total_price']; ?></td>
                            </tr>
                            
                        </tfoot>
                        </table>
                    </td>
                    <td><?php echo $row['added_on']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } ?>
    </div>
</div>
</div>
<?php include "footer.php"; ?>