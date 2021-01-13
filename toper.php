<?php
session_start();
include('config.php');
include('function.inc.php');
include('constant.inc.php');

?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo FRONT_SITE_NAME?></title> <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/animate.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/slick.css">
        <link rel="stylesheet" href="assets/css/chosen.min.css">
        <link rel="stylesheet" href="assets/css/ionicons.min.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/simple-line-icons.css">
        <link rel="stylesheet" href="assets/css/jquery-ui.css">
        <link rel="stylesheet" href="assets/css/meanmenu.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/custom.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!-- header start -->
        <header class="header-area">
            <div class="header-middle">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-12 col-sm-4">
                            <div class="logo">
                                <a href="index.php">
                                    <img alt="" src="admin\upload\logo.png">
                                </a>
                            </div>
                        </div>
                        
                                <div class="col-lg-9 col-md-8 col-12 col-sm-8">
                                    <div class="header-middle-right f-right">
                                    <div class="d-truck">
                                    <a href="delivery_boy.php">Apply</a>
                                    <p>For Delivery Boy</p>
                                </div>
                                <div class="header-login">
                                    <a href="profile.php">
                                        <?php  if(isset($_SESSION['login'])){  ?>
                                        <div class="header-icon-style">
                                            <i class="icon-user icons"></i>
                                        </div>
                                        <div class="login-text-content">
                                            <?php 
                                                
                                                    echo '<p>'.$_SESSION['name'].'</p>';
                                                }
                                                else{
                                                    echo '<a href="login-register.php"><p>Register <br> or <span>Sign in</span></p></a>';
                                                }
                                            ?>
                                            
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <marquee class="marquee-design" direction="right" scrollamount="15"><span class="multicolortext">Welcome To Food World!</span></marquee>
            <div class="header-bottom transparent-bar black-bg">
                <div class="container">
                            <div class="main-menu">
                                <nav>
                                    <div class="row">
                                        <div class="col-md-8">            
                                            <ul>
                                                <li><a href="index.php">Home</a></li>
                                                <li><a href="shop.php">Shop</a></li>
                                                <li id="cat_li"><a href="shop.php">Category</a>
                                                    <ul class='drop'>
                                                        <?php 
                                                            $res_cat =mysqli_query($con,"SELECT * FROM category");
                                                            if(mysqli_num_rows($res_cat)>0){
                                                                while($cat_row = mysqli_fetch_assoc($res_cat)){
                                                                    echo '<li><a  href="shop.php?cat_id='.$cat_row['category_id'].'">'.$cat_row['category'].'</a></li>';
                                                            } 
                                                        } ?>
                                                    </ul>
                                                </li>
                                                <li><a href="about-us.php">about</a></li>
                                                <li><a href="contact-us.php">contact us</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="header-cart">
                                                <?php if(isset($_SESSION['login'])){ ?>
                                                    <a href="cart.php">
                                                        <div class="header-icon-style">
                                                            <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                                            <span class="count-style">
                                                                <?php
                                                                    $user_id = $_SESSION['user_id'];
                                                                    $sql="SELECT * FROM cart WHERE user_id={$user_id}";
                                                                    $res=mysqli_query($con,$sql);
                                                                    $total_cart = mysqli_num_rows($res);
                                                                    echo $total_cart;
                                                                    ?>
                                                            </span>
                                                        </div>
                                                    </a>
                                                <?php } ?>  
                                            </div>
                                            <div class="header-cart" id="header_wishlist">
                                                <?php if(isset($_SESSION['login'])){ ?>
                                                <a href="wishlist.php">
                                                    <div class="header-icon-style">
                                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                                        <span class="count-style">
                                                            <?php
                                                            $user_id = $_SESSION['user_id'];
                                                                $sql="SELECT * FROM wishlist WHERE user_id={$user_id}";
                                                                $res=mysqli_query($con,$sql);
                                                                $total_wishlist = mysqli_num_rows($res);
                                                                echo $total_wishlist;
                                                                ?>
                                                        </span>
                                                    </div>
                                                </a>
                                                <?php } ?> 
                                            </div>
                                            <div class="account-curr-lang-wrap f-right">
                                            <?php if(isset($_SESSION['login'])){ ?>
                                                <ul>
                                                    <li class="top-hover"><a href="#">Setting  <i class="ion-chevron-down"></i></a>
                                                        <ul>
                                                            <li><a href="profile.php">Profile  </a></li>
                                                            <li><a href="order.php">Order History</a></li>
                                                            <li><a href="logout.php">Logout</a></li>
                                                            
                                                        </ul>
                                                    </li>
                                                </ul>
                                            <?php } ?>
                                            </div>
                                        </div>    
                                    </div>
                                </nav>
                            </div>
                    
                </div>
            </div>
            <!-- mobile-menu-area-start -->
			<div class="mobile-menu-area">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="mobile-menu">
								<nav id="mobile-menu-active">
									<ul class="menu-overflow" id="nav">
										<li><a href="shop.php">Home</a></li>
										<li><a href="about-us.php">About Us</a></li>
										<li><a href="contact-us.php">Contact Us</a></li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- mobile-menu-area-end -->
        </header>