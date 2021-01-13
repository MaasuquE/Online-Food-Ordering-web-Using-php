<?php
ob_start();
include "toper.php";
if(!isset($_SESSION['login'])){
    header("Location: {$hostname}/shop.php");
}
$user_id = $_SESSION['user_id'];
if(isset($_GET['cl'])){
    
    $sql_cl = "UPDATE order_master SET order_sts='0' WHERE user_id={$user_id}";
    mysqli_query($con,$sql_cl);
}
if(isset($_GET['type'])){
    if($_GET['type']="delete"){
        $did=$_GET['did'];
        $sql_up="UPDATE order_master SET order_sts='0' WHERE order_id={$did}";
        $res=mysqli_query($con,$sql_up);

    }
}

?>

<div class="cart-main-area pt-95 pb-100">
    <div class="container">
        <h3 class="page-title">Your order items</h3>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="#">
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Dish Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Delivery boy</th>
                                    <th>Address</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <?php
                                $sql="SELECT * FROM order_master 
                                LEFT JOIN order_detail ON order_master.order_details_id=order_detail.order_details_id
                                LEFT JOIN dish ON order_master.dish_id = dish.dish_id
                                LEFT JOIN delivery_boy ON order_detail.delivery_boy_id=delivery_boy.id
                                WHERE order_master.order_sts=1 AND order_master.user_id={$user_id}
                                ORDER BY order_master.order_id DESC";
                                $res=mysqli_query($con,$sql);
                                if(mysqli_num_rows($res)>0){
                            ?>
                            <tbody>
                                <?php
                                
                                    $subtotal = 0;
                                    while($row=mysqli_fetch_assoc($res)){
                                ?>
                                <tr>
                                    <td class="product-thumbnail">
                                        <a href="#"><img src="admin/upload/<?php echo $row['image']; ?>" alt=""></a>
                                    </td>
                                    <td class="product-name"><a href="#"><?php echo $row['dish'];  ?></a></td>
                                    <td class="product-price-cart"><span class="amount"><?php echo $row['dish_price'] ?></span></td>
                                    <td class="product-price-cart"><span class="amount"><?php echo $row['order_qty'] ?></span></td>
                                    <td class="product-name"><a href="#"><?php echo $row['boy_name'];  ?></a></td>
                                    <td class="product"><a href="#"><?php echo $row['address'];  ?></a></td>
                                    <td class="product-subtotal">
                                    <?php
                                            echo $row['dish_price']*$row['order_qty'];
                                    ?>
                                    </td>
                                    <td class="product-remove">
                                        <a href="order.php?type=delete&did=<?php echo $row['order_id']; ?>"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                                    <?php } ?>
                            </tbody>
                            <?php } ?>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                                $res_clear=mysqli_query($con,"SELECT * FROM order_master");
                                if(mysqli_num_rows($res)>0){
                            ?>
                            <div class="cart-shiping-update-wrapper">
                                <div class="cart-clear">
                                    <a href="order.php?cl=cl">Clear Order</a>
                                </div>
                                <div class="cart-clear">
                                    <a href="order_pdf.php"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>