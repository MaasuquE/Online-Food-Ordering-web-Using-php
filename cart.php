<?php
ob_start();
include "toper.php";
if(!isset($_SESSION['login'])){
    header("Location:{$hostname}/login-register.php");    
}
if(isset($_GET['wid'])){
    $wid = $_GET['wid'];
    $date = date("d M, Y H:i:s");
    
        $user_id=$_SESSION['user_id'];
        $res_qry=mysqli_query($con,"SELECT * FROM cart WHERE dish_id={$wid}");
        if(mysqli_num_rows($res_qry)>0){
        }
        else{
            $sql_insrt = "INSERT INTO cart(dish_id,user_id,cart_qty,date) VALUES({$wid},'{$user_id}',1,'{$date}')";
            if(mysqli_query($con,$sql_insrt)){
                $sql_d="DELETE FROM wishlist WHERE dish_id={$wid} AND user_id={$user_id}";
                mysqli_query($con,$sql_d);
            }
        }
    
}
if(isset($_GET['pid'])){
    $pid = $_GET['pid'];
    $date = date("d M, Y H:i:s");
    
        $user_id=$_SESSION['user_id'];
        $res_qry=mysqli_query($con,"SELECT * FROM cart WHERE dish_id={$pid} AND user_id={$user_id}");
        if(mysqli_num_rows($res_qry)>0){
        }
        else{
            $sql_insrt = "INSERT INTO cart(dish_id,user_id,cart_qty,date) VALUES({$pid},'{$user_id}',1,'{$date}')";
            mysqli_query($con,$sql_insrt);
        }
    
}
if(isset($_GET['type'])){
    if($type="delete"){
        $did=$_GET['did'];
        $sql_delete="DELETE FROM cart WHERE dish_id={$did}";
        if(mysqli_query($con,$sql_delete)){
            header("Location:{$hostname}/cart.php");
            ob_end_flush();
        }
    }
}
?>

<div class="cart-main-area pt-95 pb-100">
            <div class="container">
                <h3 class="page-title">Your cart items</h3>
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
                                            <th>Subtotal</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        $sql="SELECT * FROM cart JOIN dish ON cart.dish_id=dish.dish_id WHERE user_id={$user_id} ORDER BY cart.cart_id DESC";
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
                                            <td class="product-quantity">
                                                <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" id="qty" type="text" name="qtybutton" value="<?php echo $row['cart_qty']; ?>">
                                                </div>
                                            </td>
                                            <td class="product-subtotal">
                                            <?php
                                                 echo $row['dish_price']*$row['cart_qty'];
                                            ?>
                                            </td>
                                            <td class="product-remove">
                                                <a onclick="update_qty('<?php echo $row['cart_id']; ?>')"><i class="fa fa-retweet" aria-hidden="true"></i></a>
                                                <a href="cart.php?type=delete&did=<?php echo $row['dish_id'] ?>"><i class="fa fa-times"></i></a>
                                           </td>
                                        </tr>
                                            <?php } ?>
                                    </tbody>
                                    <?php } ?>
                                </table>
                            </div>
                            <?php
                                $res=mysqli_query($con,"SELECT * FROM cart");
                                if(mysqli_num_rows($res)>0){
                            ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="cart-shiping-update-wrapper">
                                        <div class="cart-shiping-update">
                                            <a href="shop.php">Continue Shopping</a>
                                        </div>
                                        <div class="cart-clear">
                                            <a href="#">Clear Shopping Cart</a>
                                            <a href="checkout.php">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>

<?php
include("footer.php");
?>