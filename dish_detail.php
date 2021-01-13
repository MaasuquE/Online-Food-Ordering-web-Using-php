<?php
    include "config.php";
    include "toper.php";
    date_default_timezone_set('Asia/Dhaka');
    $pid=$_GET['pid'];
    $sql="SELECT * FROM dish WHERE dish_id={$pid}";
    $res=mysqli_query($con,$sql);
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
    }
?>

<div class="product_deatils">
    <div class="dish_design"><h3>DISH DETAIL</h3></div>
    <div class="row container">
        <div class="col-md-5">
            <div class="dish_detail_img">
                <img src="admin/upload/<?php echo $row['image']?>" alt="">
            </div>
        </div>
        <div class="col-md-7">
            <div><h3><a href=""><?php echo $row['dish']; ?></a></h3></div>
            <div><h5>Price : <?php echo $row['dish_price']; ?></h5></div>
            <div><h5>Description : <?php echo $row['dish_detail']; ?></h5></div>
            <div class="rating-design">
                <!-- Rating Start -->
                <div class="rate">
                    <input type="radio" id="star5" name="rate" value="5" />
                    <label for="star5" title="text">5</label>
                    <input type="radio" id="star4" name="rate" value="4" />
                    <label for="star4" title="text">4</label>
                    <input type="radio" id="star3" name="rate" value="3" />
                    <label for="star3" title="text">3</label>
                    <input type="radio" id="star2" name="rate" value="2" />
                    <label for="star2" title="text" >2</label>
                    <input type="radio" id="star1" name="rate" value="1" />
                    <label for="star1" title="text">1</label>
                    <input type="hidden" id="rating_hidden" value="<?php echo $row['dish_id']?>">
                </div>
                <!-- Rating End -->
            </div>
            <div class="dish_cart_button">
                <a href="cart.php?pid=<?php echo $row['dish_id']; ?>"><button>Add-To-Cart</button></a>
            </div>
        </div>
    </div>
</div>
<div class="describe_bar">
    <ul class='bar_list'>
        <li class="comment active">Comment</li>
        <li class="review">Review</li>
        
    </ul>
</div>
<?php
    $avg=0;
    $t_review=0;
    $sql_rating="SELECT * FROM rating WHERE dish_id={$pid}";
    $res_rating=mysqli_query($con,$sql_rating);
    if(mysqli_num_rows($res_rating)>0){
        $row_rating=mysqli_fetch_assoc($res_rating);
        $t_review=($row_rating['5_star']+$row_rating['4_star']+$row_rating['3_star']+$row_rating['2_star']+$row_rating['1_star']);
        $avg=($row_rating['5_star']*5+$row_rating['4_star']*4+$row_rating['3_star']*3+$row_rating['2_star']*2+$row_rating['1_star']*1)/$t_review;
    }
    
?>
<div class="review_show container">
    <span class="heading">User Rating</span>
    <?php  
        if($avg>0){
        for($i=1;$i<=round($avg);$i++){
            echo '<span class="fa fa-star checked"></span>';
        }
        for($i=round($avg);$i<5;$i++){
            echo '<span class="fa fa-star"></span>';
        }
    }else{
        for($i=1;$i<=5;$i++){
            echo '<span class="fa fa-star"></span>';
        }
    
     } ?>
    <p><?php echo number_format($avg,2) ?> average based on <?php echo $t_review; ?> reviews.</p>
    <hr style="border:3px solid #f1f1f1">

    <div class="row rating_bar">
        <div class="side">
            <div>5 star</div>
        </div>
        <div class="middle">
            <div class="bar-container">
                <div class="bar-5"></div>
            </div>
        </div>
        <div class="side right">
            <div><?php 
                if($avg>0){
                    echo $row_rating['5_star'];
                }else{
                    echo 0;
                }
            ?></div>
        </div>
        <div class="side">
            <div>4 star</div>
        </div>
        <div class="middle">
            <div class="bar-container">
                <div class="bar-4"></div>
            </div>
        </div>
        <div class="side right">
        <div><?php 
                if($avg>0){
                    echo $row_rating['4_star'];
                }else{
                    echo 0;
                }
            ?></div>
        </div>
        <div class="side">
            <div>3 star</div>
        </div>
        <div class="middle">
            <div class="bar-container">
                <div class="bar-3"></div>
            </div>
        </div>
        <div class="side right">
        <div><?php 
                if($avg>0){
                    echo $row_rating['3_star'];
                }else{
                    echo 0;
                }
            ?></div>
        </div>
        <div class="side">
            <div>2 star</div>
        </div>
        <div class="middle">
            <div class="bar-container">
                <div class="bar-2"></div>
            </div>
        </div>
        <div class="side right">
        <div><?php 
                if($avg>0){
                    echo $row_rating['2_star'];
                }else{
                    echo 0;
                }
            ?></div>
        </div>
        <div class="side">
            <div>1 star</div>
        </div>
        <div class="middle">
            <div class="bar-container">
                <div class="bar-1"></div>
            </div>
        </div>
        <div class="side right">
        <div><?php 
                if($avg>0){
                    echo $row_rating['1_star'];
                }else{
                    echo 0;
                }
            ?></div>
        </div>
    </div>
</div>
<div class="comment_show">
    <div class="comments-container">
		<h1>Comment</h1>
        <div class="cmt_input">
            <input type="text" id="cmt_inp" placeholder="Write your comment">
            <span>send</span>
            <input type="hidden" id="pid" value="<?php echo $pid; ?>">
        </div>
        <?php
            $sql_comment="SELECT * FROM comment JOIN user ON comment.user_id=user.id WHERE comment.dish_id={$pid} ORDER BY comment.comment_id DESC";
            
            $res_comment=mysqli_query($con,$sql_comment);
            if(mysqli_num_rows($res_comment)>0){
                
        ?>
		<ul id="comments-list" class="comments-list">
        <?php while($row_comment=mysqli_fetch_assoc($res_comment)){ ?>
			<li>
				<div class="comment-main-level">
					<!-- Avatar -->
					<div class="comment-avatar"><img src="admin/upload/<?php echo $row_comment['image']; ?>" alt=""></div>
					<!-- Contenedor del Comentario -->
					<div class="comment-box">
						<div class="comment-head">
							<h6 class="comment-name by-author"><?php echo $row_comment['name'] ;?></h6>
                            <span><?php
                                $date1 = $row_comment['comment_date'];
                                $date2=date('Y-m-d h:i:sa');
                                $diff = abs(strtotime($date2) - strtotime($date1));
                                $time="";
                                $years = floor($diff / (365*60*60*24));
                                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                $hrs = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24- $days*60*60*24)/(60*60));
                                $min = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24- $days*60*60*24-$hrs*60*60)/60);
                                $sec = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24- $days*60*60*24-$hrs*60*60-$min*60));
                                if($years>0){
                                    $time .= $years." years, ";
                                }
                                if($months>0){
                                    $time .= $months." months, ";
                                }
                                if($days>0){
                                    $time .= $days." days, ";
                                }
                                if($hrs>0){
                                    $time.=$hrs." hrs, ";
                                }
                                if($min>0){
                                    $time.=$min." mins";
                                }
                                else{
                                    $time.=$sec." sec";
                                }
                                $time.=" ago";
                                echo $time;
                            ?></span>
							<i class="fa fa-reply" onclick="reply()"></i>
                            <i class="fa fa-trash"></i>
							<i class="fa fa-heart"></i>
						</div>
						<div class="comment-content">
                            <?php echo $row_comment['comment']; ?>
						</div>
                        <div class="cmt_input reply_input">
                            <input type="text" id="reply_inp" placeholder="Write your comment">
                            <span onclick="reply_cmt('<?php echo $row_comment['comment_id']; ?>','<?php echo $row_comment['id']; ?>')">send</span>
                            <input type="hidden" id="cmnt_id" value="<?php echo $row_comment['comment_id']; ?>">
                        </div>
					</div>
				</div>
                <?php
                    $sql_reply="SELECT * FROM comment_reply 
                     LEFT JOIN user ON user.id=comment_reply.user_id
                     ORDER BY comment_reply.reply_id DESC";
                     
                     $res_reply=mysqli_query($con,$sql_reply);
                     if(mysqli_num_rows($res_reply)>0){
                         
                ?>
				<!-- Respuestas de los comentarios -->
				<ul class="comments-list reply-list">
                    <?php while($row_reply=mysqli_fetch_assoc($res_reply)){ 
                        
                        if($row_comment['comment_id']==$row_reply['comment_id']){
                        ?>
                    
					<li>
						<!-- Avatar -->
						<div class="comment-avatar"><img src="admin/upload/<?php echo $row_reply['image']; ?>" alt=""></div>
						<!-- Contenedor del Comentario -->
						<div class="comment-box">
							<div class="comment-head">
								<h6 class="comment-name"><?php echo $row_reply['name'] ;?></h6>
								<span><?php
                                $date1 = $row_reply['reply_date'];
                                $date2=date('Y-m-d h:i:sa');
                                $diff = abs(strtotime($date2) - strtotime($date1));
                                $time="";
                                $years = floor($diff / (365*60*60*24));
                                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                $hrs = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24- $days*60*60*24)/(60*60));
                                $min = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24- $days*60*60*24-$hrs*60*60)/60);
                                $sec = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24- $days*60*60*24-$hrs*60*60-$min*60));
                                if($years>0){
                                    $time .= $years." years, ";
                                }
                                if($months>0){
                                    $time .= $months." months, ";
                                }
                                if($days>0){
                                    $time .= $days." days, ";
                                }
                                if($hrs>0){
                                    $time.=$hrs." hrs, ";
                                }
                                if($min>0){
                                    $time.=$min." mins";
                                }
                                else{
                                    $time.=$sec." sec";
                                }
                                $time.=" ago";
                                echo $time;
                            ?></span>
								<i class="fa fa-reply" onclick="reply()"></i>
                                <i class="fa fa-trash"></i>
								<i class="fa fa-heart"></i>
							</div>
							<div class="comment-content">
								<?php echo $row_reply['reply']; ?>
							</div>
						</div>
					</li>
                    <?php  } } ?>
				</ul>
                <?php  } ?>
			</li>
		<?php  }?>	
		</ul>
        <?php } ?>
	</div>
</div>

<?php include "footer.php" ?>