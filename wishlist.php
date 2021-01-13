<?php
ob_start();
include "toper.php";
if(isset($_GET['pid'])){
    $pid = $_GET['pid'];
    $date = date("d M, Y H:i:s");
    $user_id=$_SESSION['user_id'];
    $res_qry=mysqli_query($con,"SELECT * FROM wishlist WHERE dish_id={$pid}");
    if(mysqli_num_rows($res_qry)>0){
    }
    else{
        $sql_insrt = "INSERT INTO wishlist(dish_id,user_id,added_on) VALUES({$pid},{$user_id},'{$date}')";
        mysqli_query($con,$sql_insrt);
    }
   
}
if(isset($_GET['type'])){
    if($type="delete"){
        $did=$_GET['did'];
        $sql_delete="DELETE FROM wishlist WHERE dish_id={$did}";
        if(mysqli_query($con,$sql_delete)){
            header("Location:{$hostname}/wishlist.php");
            ob_end_flush();
        }
    }
}
?>

<div class="cart-main-area pt-95 pb-100">
            <div class="container">
                <h3 class="page-title">Your wishlist items</h3>
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        $sql="SELECT * FROM wishlist JOIN dish ON wishlist.dish_id=dish.dish_id WHERE wishlist.user_id={$user_id} ORDER BY wishlist.wishlist_id DESC";
                                        $res=mysqli_query($con,$sql);
                                        if(mysqli_num_rows($res)>0){
                                    ?>
                                    <tbody>
                                        <?php
                                            while($row=mysqli_fetch_assoc($res)){
                                        ?>
                                        <tr>
                                            <td class="product-thumbnail">
                                                <a href="#"><img src="admin/upload/<?php echo $row['image']; ?>" alt=""></a>
                                            </td>
                                            <td class="product-name"><a href="#"><?php echo $row['dish'];  ?></a></td>
                                            <td class="product-price-cart"><span class="amount"><?php echo $row['dish_price'] ?></span></td>
                                            <td class="product-remove cart_fa">
                                                <a  href="cart.php?wid=<?php echo $row['dish_id']; ?>"><i class="fa fa-cart-plus"></i></a>
                                                <a class="dtl_fa" href="wishlist.php?type=delete&did=<?php echo $row['dish_id'] ?>"><i class="fa fa-times"></i></a>
                                                
                                           </td>
                                        </tr>
                                            <?php } ?>
                                    </tbody>
                                    <?php } ?>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="cart-shiping-update-wrapper">
                                        <div class="cart-shiping-update">
                                            <a href="shop.php">Continue Shopping</a>
                                        </div>
                                        <div class="cart-clear">
                                            <a href="#">Clear Shopping Cart</a>
                                        </div>
                                    </div>
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