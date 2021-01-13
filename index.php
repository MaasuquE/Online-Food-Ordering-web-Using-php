<?php
    include "config.php";
    include "toper.php";
    
?>
        <div class="slider-area">
                <?php
                    $sql="SELECT * FROM banner ORDER BY id DESC";
                    $res=mysqli_query($con,$sql);
                    if(mysqli_num_rows($res)>0){
                        
                ?>
            <div class="slider-active owl-dot-style owl-carousel">
                <?php while($row =mysqli_fetch_assoc($res)){ ?>
                <div class="single-slider pt-210 pb-220 bg-img" style="background-image:url(admin/upload/<?php echo $row['image'];?>)" >
                    <div class="container">
                    
                        <div class="slider-content slider-animated-1" >
                            <h1 class="animated"><?php echo $row['heading']; ?></h1>
                            <h3 class="animated"><?php echo $row['sub_heading']; ?></h3>
                            <div class="slider-btn mt-90">
                                <a class="animated" href="<?php echo $row['link']; ?>"><?php echo $row['link_txt'];?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }  ?>
            </div>
            <?php }  ?> 
        </div>
        <section id="product_sec">
            <div class="shop-page-area pt-100 pb-100">
                <div class="food_head">Food Section</div>
                <div class="container">
                    <div class="row flex-row-reverse">
                        <div class="col-lg-9">
                                <div class="search_box">
                                    <input type="text" placeholder="search"><i class="fa fa-search"></i>
                                </div>
                            <div class="sub-categories">
                                <input type="radio" class="sub_cat" name="sub_cat" id="both" value="both" ><label  for="both">Both</label> 
                                <input type="radio" class="sub_cat" name="sub_cat" id="veg" value="veg"><label  for="veg">Veg</label>  
                                <input type="radio" class="sub_cat" name="sub_cat" id="non-veg" value="non-veg"><label  for="non-veg">Non-Veg</label>
                            </div>
                            <?php
                                $cat_id=0;
                                $product_sql="select * from dish where dish_sts=1";
                                if(isset($_GET['cat_id']) && $_GET['cat_id']>0){
                                    $cat_id=get_safe_value($_GET['cat_id']);
                                    $product_sql.=" and category_id='$cat_id' ";
                                }
                                $product_sql.=" order by RAND(dish_id) desc LIMIT 12";
                                $product_res=mysqli_query($con,$product_sql);
                            ?>
                            <div class="grid-list-product-wrapper">
                                <div class="product-grid product-view pb-20">
                                    <?php if(mysqli_num_rows($product_res)>0){ ?>
                                        <div class="row" id="cat_chk">
                                            <?php while($row=mysqli_fetch_assoc($product_res)){?>
                                            <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                                <div class="product-wrapper">
                                                    <div class="product-img">
                                                        <a href="dish_detail.php?pid=<?php echo $row['dish_id']; ?>">
                                                            <img src="admin/upload/<?php echo $row['image']?>" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="product-content">
                                                        <h4>
                                                            <a href="javascript:void(0)"><?php echo $row['dish'];?> (<?php echo  strtoupper($row['dish_type']); ?>) </a>
                                                        </h4>
                                                        <div class="product-price-wrapper">
                                                            <span><?php echo $row['dish_price'];?></span>
                                                        </div>
                                                        <div class="fr__hover__info">
                                                            <ul class="product__action">
                                                                <li><a href="wishlist.php?pid=<?php echo $row['dish_id']; ?>"><i class="icon-heart icons"></i></a></li>

                                                                <li><a href="cart.php?pid=<?php echo $row['dish_id']; ?>"><i class="icon-handbag icons"></i></a></li>

                                                                <li><a href="#"><i class="icon-shuffle icons"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>        
                                        </div>
                                    <?php } else{ 
                                        echo "No dish found";   
                                    }?>
                                </div>
                                
                            </div>
                            <div class="button-box show-more">
                                <a href="shop.php"><button type="button">Show More</button></a>           
                            </div>
                        </div>
                        <?php
                        $cat_res=mysqli_query($con,"SELECT * FROM category ORDER BY category_id DESC");
                        ?>
                        <div class="col-lg-3">
                            <div class="shop-sidebar-wrapper gray-bg-7 shop-sidebar-mrg">
                                <div class="shop-widget">
                                    <h4 class="shop-sidebar-title">Shop By Categories</h4>
                                    <div class="shop-catigory">
                                        <ul id="faq" class="category_list">
                                            <?php 
                                            while($cat_row=mysqli_fetch_assoc($cat_res)){
                                                
                                                if($cat_id==$cat_row['category_id']){
                                                    echo "<li class='active' value=".$cat_row['category_id']."><a href='shop.php?cat_id=".$cat_row['category_id']."'>".$cat_row['category']."</a></li>";
                                                }
                                                else{
                                                    echo "<li ><a href='shop.php?cat_id=".$cat_row['category_id']."'>".$cat_row['category']."</a></li>";
                                                    // echo'<input type="hidden" class="active" value="" >';
                                                }
                                                  

                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
<?php include "footer.php"; ?>