<?php
ob_start();
include "toper.php";
$res=mysqli_query($con,"SELECT * FROM cart");
if(mysqli_num_rows($res)==0){
    header("Location: {$hostname}/shop.php");
    ob_end_flush();
}

?>

<div class="breadcrumb-area gray-bg">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="shop.php">Home</a></li>
                        <li class="active"> Checkout </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- checkout-area start -->
        <div class="checkout-area pb-80 pt-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="checkout-wrapper">
                            <div id="faq" class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><span>1.</span> <a data-toggle="collapse" data-parent="#faq" href="#payment-1">Register</a></h5>
                                    </div>
                                    <?php if(!isset($_SESSION['login'])){ ?>
                                    <div id="payment-1" class="panel-collapse collapse show">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-7">
                                                    <div class="checkout-login">
                                                        <div class="title-wrap">
                                                            <h4 class="cart-bottom-title section-bg-white">LOGIN</h4>
                                                        </div>
                                                        <p>Already have an account? </p>
                                                        <span>Please log in below:</span>
                                                        <form>
                                                            <div class="login-form">
                                                                <label>Email Address * </label>
                                                                <input name="user-email" placeholder="Email" id="login_email" type="email">
                                                                <br><span id="field_error" class="email_error"></span>
                                                            </div>
                                                            <div class="login-form">
                                                                <label>Password *</label>
                                                                <input type="password" id="login_password" name="user-password" placeholder="Password">
                                                                <br><span id="field_error" class="password_error"></span>
                                                            </div>
                                                        </form>
                                                        <div class="login-forget">
                                                            <a href="#">Forgot your password?</a>
                                                            <p><a href='login-register.php'>Create an account</a></p>
                                                        </div>
                                                        <br><span id="field_error" class="login_failed"></span>
                                                        <div class="checkout-login-btn">
                                                            <a  onclick="login('checkout')">Login</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php  } ?>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><span>2.</span> <a data-toggle="collapse" data-parent="#faq" href="#payment-2">billing information</a></h5>
                                    </div>
                                    <div id="payment-2" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="billing-information-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>First Name</label>
                                                            <input type="text" id="f_name">
                                                            <br><span id="field_error" class="f_name"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Last Name</label>
                                                            <input type="text" id="l_name">
                                                            <br><span id="field_error" class="l_name"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Email Address</label>
                                                            <input type="email" id="email">
                                                            <br><span id="field_error" class="email"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>city</label>
                                                            <input type="text" id="city">
                                                            <br><span id="field_error" class="city"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Postal Code</label>
                                                            <input type="text" id="postal_code">
                                                            <br><span id="field_error" class="postal_code"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-select">
                                                            <label>Country</label>
                                                            <select id="country">
                                                                <option value="United State">United State</option>
                                                                <option value="Azerbaijan">Azerbaijan</option>
                                                                <option value="Bahamas">Bahamas</option>
                                                                <option value="Bahrain">Bahrain</option>
                                                                <option value="Bangladesh">Bangladesh</option>
                                                                <option value="Barbados">Barbados</option>
                                                            </select>
                                                            <br><span id="field_error" class="country"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Mobile</label>
                                                            <input type="text" id="mobile">
                                                            <br><span id="field_error" class="mobile"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="billing-back-btn">
                                                    <div class="billing-back">
                                                        <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><span>3.</span> <a data-toggle="collapse" data-parent="#faq" href="#payment-5">payment information</a></h5>
                                    </div>
                                    <div id="payment-5" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="payment-info-wrapper">
                                                <div class="ship-wrapper">
                                                    <div class="single-ship">
                                                        <input type="radio" checked="" value="COD" name="payment">
                                                        <label>Check / Money order </label>
                                                        <br><span id="field_error" class="payment"></span>
                                                    </div>
                                                    <div class="single-ship">
                                                        <input type="radio" value="CC" name="payment">
                                                        <label>Credit Card (saved) </label>
                                                        <br><span id="field_error" class="payment"></span>
                                                    </div>
                                                </div>
                                                <div class="payment-info">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="billing-info">
                                                                <label>Name on Card </label>
                                                                <input type="text">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="billing-select">
                                                                <label>Credit Card Type</label>
                                                                <select>
                                                                    <option>American Express</option>
                                                                    <option>Visa</option>
                                                                    <option>MasterCard</option>
                                                                    <option>Discover</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="billing-info">
                                                                <label>Credit Card Number </label>
                                                                <input type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="expiration-date">
                                                        <label>Expiration Date </label>
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6">
                                                                <div class="billing-select">
                                                                    <select>
                                                                        <option>Month</option>
                                                                        <option>January</option>
                                                                        <option>February</option>
                                                                        <option> March</option>
                                                                        <option>April</option>
                                                                        <option> May</option>
                                                                        <option>June</option>
                                                                        <option>July</option>
                                                                        <option>August</option>
                                                                        <option>September</option>
                                                                        <option> October</option>
                                                                        <option> November</option>
                                                                        <option> December</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6">
                                                                <div class="billing-select">
                                                                    <select>
                                                                        <option>Year</option>
                                                                        <option>2015</option>
                                                                        <option>2016</option>
                                                                        <option>2017</option>
                                                                        <option>2018</option>
                                                                        <option>2019</option>
                                                                        <option>2020</option>
                                                                        <option>2021</option>
                                                                        <option>2022</option>
                                                                        <option>2023</option>
                                                                        <option>2024</option>
                                                                        <option>2025</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="billing-info">
                                                                <label>Card Verification Number</label>
                                                                <input type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="billing-back-btn">
                                                    <div class="billing-back">
                                                        <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                                                    </div>
                                                    <div class="billing-btn">
                                                        <button type="submit">Continue</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 order_previw">
                    
                        <div class="panel-heading">
                            <h5 class="order_review_title">Order Review</h5>
                        </div>
                        <div id="payment-6" class="panel-collapse">
                            <div class="panel-body">
                                <div class="order-review-wrapper">
                                    <div class="order-review">
                                        <div class="table-responsive">
                                            <?php
                                                $user_id=$_SESSION['user_id'];
                                                $sql_cart="SELECT * FROM cart JOIN dish ON cart.dish_id=dish.dish_id WHERE user_id={$user_id}";
                                                $res_cart=mysqli_query($con,$sql_cart);
                                                if(mysqli_num_rows($res_cart)>0){
                                            ?>
                                            <table class="table order_table">
                                                <thead>
                                                    <tr>
                                                        <th class="width-1">Product Name</th>
                                                        <th class="width-2">Price</th>
                                                        <th class="width-3">Qty</th>
                                                        <th class="width-4">Subtotal</th>
                                                    </tr>
                                                </thead>
                                                
                                                <tbody>
                                                    <?php
                                                    $grand_total = 0;
                                                     while($row_cart=mysqli_fetch_assoc($res_cart)){ ?>
                                                    <tr>
                                                        <td>
                                                            <div class="o-pro-dec">
                                                                <p><?php echo $row_cart['dish']; ?></p>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="o-pro-price">
                                                                <p><?php echo $row_cart['dish_price']; ?></p>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="o-pro-qty">
                                                                <p><?php echo $row_cart['cart_qty']; ?></p>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="o-pro-subtotal">
                                                                <p><?php
                                                                 $sub_total =$row_cart['dish_price']*$row_cart['cart_qty'];
                                                                  echo "&#2547 ".$sub_total; ?></p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php 
                                                    $grand_total += $sub_total;
                                                } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3">Subtotal </td>
                                                        <td colspan="1"><?php echo "&#2547 ".$grand_total; ?></td>
                                                    </tr>
                                                    <tr class="tr-f">
                                                        <td colspan="3">Shipping & Handling (Flat Rate - Fixed)</td>
                                                        <td colspan="1">&#2547 60</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">Grand Total</td>
                                                        <td colspan="1"><?php
                                                        $total_all = $grand_total+60;
                                                        echo "&#2547 ".$total_all; ?></td>
                                                    </tr>
                                                    
                                                </tfoot>
                                            </table>
                                                <?php } ?>
                                        </div>
                                        <div class="billing-back-btn">
                                            <span>
                                                Forgot an Item?
                                                <a href="cart.php"> Edit Your Cart.</a>

                                            </span>
                                            <div class="billing-btn">
                                                <button type="button" onclick="checkout_done('<?php echo $total_all; ?>')">DONE</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

<?php
include("footer.php");
?>