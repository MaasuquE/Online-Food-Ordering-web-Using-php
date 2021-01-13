<?php  
    include "config.php";
    session_start();
    date_default_timezone_set('Asia/Dhaka');
    
    if(isset($_POST['type'])){
        $type=$_POST['type'];
    }
    if($type=='update_qty'){
        $qty = $_POST['qty'];
        $cart_id = $_POST['did'];

        $sql = "UPDATE cart SET cart_qty = {$qty} WHERE cart_id={$cart_id}";
        if(mysqli_query($con,$sql)){
            echo "done";
        }
        else{
            echo "failed";
        }
    }
    if($type=='cat_chk'){
        $html='';
        $sub_cat_id = $_POST['cat_id'];

        $res =mysqli_query($con,"SELECT * FROM dish WHERE category_id={$sub_cat_id}");
        if(mysqli_num_rows($res) > 0){
            while($row = mysqli_fetch_assoc($res)){
               $html .= '<div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
               <div class="product-wrapper">
                   <div class="product-img">
                       <a href="javascript:void(0)">
                           <img src="admin/upload/'.$row['image'].'" alt="">
                       </a>
                   </div>
                   <div class="product-content">
                       <h4>
                           <a href="javascript:void(0)"> '.$row['dish'].'</a>
                       </h4>
                       <div class="product-price-wrapper">
                           <span>'.$row['dish_price'].'</span>
                       </div>
                       <div class="fr__hover__info">
                           <ul class="product__action">
                               <li><a href="insert_wishlist.php?pid=16"><i class="icon-heart icons"></i></a></li>

                               <li><a href="cart.php?pid='.$row['dish_id'].'"><i class="icon-handbag icons"></i></a></li>

                               <li><a href="#"><i class="icon-shuffle icons"></i></a></li>
                           </ul>
                       </div>
                   </div>
               </div>
           </div>'; 
                echo $html;
            }
        }
        
    }

    if($type=='register_submit'){
        $name=mysqli_real_escape_string($con,$_POST['name']);
        $email=mysqli_real_escape_string($con,$_POST['email']);
        $mobile=mysqli_real_escape_string($con,$_POST['mobile']);
        $password=mysqli_real_escape_string($con,$_POST['password']);
        
        $added_on=date("Y-m-d H:i:s");
        $sql="INSERT INTO user(name,email,mobile,password,added_on,status,image) 
        VALUES ('{$name}','{$email}','{$mobile}','{$password}','{$added_on}',1,'default.png')";
        
        if(mysqli_query($con,$sql)){
            echo "done";
        }
    }

    if($type=='login'){
        $email=mysqli_real_escape_string($con,$_POST['email']);
        $password=mysqli_real_escape_string($con,$_POST['pass']);
        $page =mysqli_real_escape_string($con,$_POST['page']);
        $sql_login="SELECT * FROM user WHERE email='{$email}' and password='{$password}'";
        
        $res=mysqli_query($con,$sql_login);
        if(mysqli_num_rows($res)>0){
           $row=mysqli_fetch_assoc($res);
           $_SESSION['login']="yes"; 
           $_SESSION['email']=$row['email']; 
           $_SESSION['name']=$row['name']; 
           $_SESSION['user_id'] = $row['id'];
           if($page=='login'){
               echo "login";
           }
           elseif($page=='checkout'){
               echo "checkout";
           }
        }
        else{
            echo "failed";
        }
    }

    if($type=="checked_done"){
        $done='';
        $total_all=$_POST['sub_total'];
        $name=$_POST['name'];
        $email=$_POST['email'];
        $address=$_POST['address'];
        $mobile=$_POST['mobile'];
        $payment_type=$_POST['payment_type'];
        $user_id = $_SESSION['user_id'];
        $res_db = mysqli_query($con,"SELECT * FROM delivery_boy ORDER BY RAND() LIMIT 1");
        $row_db = mysqli_fetch_assoc($res_db);
        $del_boy_id = $row_db['id'];
        $date =date('Y-m-d h:i:sa');
        $sql="INSERT INTO order_detail(name,address,email,mobile,payment_type,added_on,user_id,delivery_boy_id,total_price)
            VALUES('{$name}','{$address}','{$email}','{$mobile}','{$payment_type}','{$date}',{$user_id},{$del_boy_id},{$total_all})";   
        
        if(mysqli_query($con,$sql)){
            $res_cart = mysqli_query($con,"SELECT * FROM cart ORDER BY cart_id DESC");
            while($row_cart=mysqli_fetch_assoc($res_cart)){
                $res_od=mysqli_query($con,"SELECT * FROM order_detail WHERE added_on = '{$date}'");
                if(mysqli_num_rows($res_od) > 0){
                    $row_od = mysqli_fetch_assoc($res_od);
                    $od_id = $row_od['order_details_id'];
                }
                $dish_id=$row_cart['dish_id'];
                $cart_id =$row_cart['cart_id'];
                $order_qty=$row_cart['cart_qty'];
                $sql_om="INSERT INTO order_master(dish_id,order_qty,added_on,order_details_id,user_id,order_sts)
                VALUES({$dish_id},{$order_qty},'{$date}',{$od_id},{$user_id},1)";
                if(mysqli_query($con,$sql_om)){
                    $sql_dup = "UPDATE dish SET qty = qty-{$order_qty} WHERE dish_id= {$dish_id}";
                    if(mysqli_query($con,$sql_dup)){
                        $sql_del = "DELETE FROM cart WHERE cart_id={$cart_id}";
                        if(mysqli_query($con,$sql_del)){
                            $done = "done";
                        }
                    }
                    
                }

            }
        }
        else{
            echo "failed";     
           }
           echo $done;
    }



    if($type=='dboy_submit'){
        $name=mysqli_real_escape_string($con,$_POST['name']);
        $email=mysqli_real_escape_string($con,$_POST['email']);
        $mobile=mysqli_real_escape_string($con,$_POST['mobile']);
        $password=mysqli_real_escape_string($con,$_POST['password']);
        $added_on=date("Y-m-d H:i:s");
        $sql_insert="INSERT INTO delivery_boy(boy_name,email,password,mobile,status,added_on)
        VALUES('{$name}','{$email}','{$password}','{$mobile}',1,'{$added_on}')";
        if(mysqli_query($con,$sql_insert)){
            echo "done";
        }
    }

    if($type=='sub_cat'){
        $sub_cat='';
        $cat_id='';
        
        $cat =mysqli_real_escape_string($con,$_POST['cat']);
        if($cat==''){
            $cat_id='';
        }
        else{
            $cat_id =" AND category_id={$cat}";
        }

        $val = mysqli_real_escape_string($con,$_POST['val']);
        if($val=='both'){
            $sub_cat='';
            if($cat!=''){
                $cat_id =" WHERE category_id={$cat}";
            }
            
        }
        else{
            $sub_cat = " WHERE dish_type='{$val}'";
        }

        $sql = "SELECT * FROM dish {$sub_cat} {$cat_id}";
        $res =mysqli_query($con,$sql);
        if(mysqli_num_rows($res)>0){
            while($row=mysqli_fetch_assoc($res)){
                $html ='<div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                <div class="product-wrapper">
                    <div class="product-img">
                        <a href="javascript:void(0)">
                            <img src="admin/upload/'.$row['image'].'" alt="">
                        </a>
                    </div>
                    <div class="product-content">
                        <h4>
                            <a href="javascript:void(0)">'.$row['dish'].' ('.strtoupper($row['dish_type']).')</a>
                        </h4>
                        <div class="product-price-wrapper">
                            <span>'.$row['dish_price'].'</span>
                        </div>
                        <div class="fr__hover__info">
                            <ul class="product__action">
                                <li><a href="wishlist.php?pid='.$row['dish_id'].'"><i class="icon-heart icons"></i></a></li>

                                <li><a href="cart.php?pid='.$row['dish_id'].'"><i class="icon-handbag icons"></i></a></li>

                                <li><a href="#"><i class="icon-shuffle icons"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>';
                echo $html;
            }
            
        }
        else{
            echo "No Data Found";
        }
    }



    if($type=="update_profile"){
        $pass_sql='';
        $email_err='';
        $phn_err='';
        $both_err='';
        $id=$_POST['id'];
        $img=mysqli_real_escape_string($con,$_POST['img']);
        $name=mysqli_real_escape_string($con,$_POST['name']);
        $email=mysqli_real_escape_string($con,$_POST['email']);
        $phn=mysqli_real_escape_string($con,$_POST['phn']);
        $pass=mysqli_real_escape_string($con,$_POST['pass']);
        if($pass==''){
            $pass_sql='';
        }
        else{
            $pass_sql=",password='{$pass}'";
        }
        $sql="SELECT * FROM user WHERE  id!={$id}";
        $res = mysqli_query($con,$sql);
        if(mysqli_num_rows($res)>0){
            while($row=mysqli_fetch_assoc($res)){
                if($row['email']==$email){
                    $email_err = "email_ex";
                }
                if($row['mobile']==$phn){
                    $phn_err = "phn_ex";
                }
                if(($row['email']==$email) && ($row['mobile']==$phn)){
                    $both_err ="both_ex";
                }
            }
            
            echo $phn_err;
            echo $email_err;
            echo $both_err;
            
        }
        if($phn_err=='' || $email_err==''||$both_err==''){
            $sql_update="UPDATE user SET name='{$name}', email='{$email}'{$pass_sql},mobile='{$phn}', image='{$img}' WHERE id={$id}";
            
            if(mysqli_query($con,$sql_update)){
                $_SESSION['update_success']='success';
                echo "done";
            }
        }
 }
    if($type=="pass_check"){
        $pass=mysqli_real_escape_string($con,$_POST['pass']);     
        $id=mysqli_real_escape_string($con,$_POST['id']);    
        $sql="SELECT * FROM user WHERE id={$id} AND password='{$pass}'";
        $res =mysqli_query($con,$sql);
        if(mysqli_num_rows($res)>0){
            echo "checked";
        }
        else{
            echo "failed";
        }

    }

    if($type=="send_otp"){
        $email=mysqli_real_escape_string($con,$_POST['email']);
        $res= mysqli_num_rows(mysqli_query($con,"SELECT * FROM user WHERE email='{$email}'"));
        if($res>0){
            echo "exist";
            die();
        }
        else{
            $otp =rand(11111,99999);
            $_SESSION['otp']=$otp;
            $html="$otp is your OTP";
            
            require('smtp/PHPMailerAutoload.php');
            $mail=new PHPMailer();
            $mail->isSMTP();
            $mail->Host="smtp.sendgrid.net";
            $mail->Port=587;
            $mail->SMTPSecure="TLS";
            $mail->SMTPAuth=true;
            $mail->Username="MaasuquE";
            $mail->Password="1m2a3s4U123456789!";
            $mail->SetFrom("mauskmia94@gmail.com");
            $mail->addAddress($email);
            $mail->IsHTML(true);
            $mail->Subject="New OTP";
            $mail->Body=$html;
            $mail->SMTPOptions=array('ssl'=>array(
                'verify_peer'=>false,
                'verify_peer_name'=>false,
                'allow_self_signed'=>false
            ));
            if($mail->send()){
                echo "done";
            }else{
                echo "failed";
            }
        }
    }
    if($type=="comment"){
        if(isset($_SESSION['login'])){
            $user_id= $_SESSION['user_id'];
            $cmt=mysqli_real_escape_string($con,$_POST['cmt']);
            $dish_id=mysqli_real_escape_string($con,$_POST['dish_id']);
            $date=date('Y-m-d h:i:sa');
            $sql="INSERT INTO comment(comment,user_id,dish_id,comment_date)
            VALUES('{$cmt}',{$user_id},{$dish_id},'{$date}')";
            if(mysqli_query($con,$sql)){
                echo "done";
            }
        }
        else{
            echo "no login";
        }
    }        
    if($type=="reply"){
        if(isset($_SESSION['login'])){
            $cmt_id=$_POST['cmt_id'];
            $user_id=$_POST['user_id'];
            $reply=mysqli_real_escape_string($con,$_POST['reply']);
            $date=date('Y-m-d h:i:sa');
            $sql="INSERT INTO comment_reply(reply,comment_id,user_id,reply_date)
            VALUES('{$reply}',{$cmt_id},{$user_id},'{$date}')";
            if(mysqli_query($con,$sql)){
                echo "done";
            }
        }
    }

    ///----Search Dish---///
    if($type=='search_box'){
        $search=mysqli_real_escape_string($con,$_POST['search']);
        $sql="SELECT * FROM dish 
        JOIN category ON dish.category_id=category.category_id
        WHERE dish.dish LIKE '%{$search}%' OR dish.dish_detail LIKE '%{$search}%' OR category.category LIKE '%{$search}%' ";
        $res=mysqli_query($con,$sql);
        if(mysqli_num_rows($res)>0){
            while($row=mysqli_fetch_assoc($res)){
                $html='<div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                <div class="product-wrapper">
                    <div class="product-img">
                        <a href="dish_detail.php?pid='.$row['dish_id'].'">
                            <img src="admin/upload/'.$row['image'].'" alt="">
                        </a>
                    </div>
                    <div class="product-content">
                        <h4>
                            <a href="javascript:void(0)">'.$row['dish'].' ('.strtoupper($row['dish_type']).')  </a>
                        </h4>
                        <div class="product-price-wrapper">
                            <span>'.$row['dish_price'].'</span>
                        </div>
                        <div class="fr__hover__info">
                            <ul class="product__action">
                                <li><a href="wishlist.php?pid='.$row['dish_id'].'"><i class="icon-heart icons"></i></a></li>

                                <li><a href="cart.php?pid='.$row['dish_id'].'"><i class="icon-handbag icons"></i></a></li>

                                <li><a href="#"><i class="icon-shuffle icons"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>';
            echo $html;
            }
        }
    }
    

    if($type=="send_message"){
        $name=mysqli_real_escape_string($con,$_POST['name']);
        $email=mysqli_real_escape_string($con,$_POST['email']);
        $mobile=mysqli_real_escape_string($con,$_POST['mobile']);
        $subject=mysqli_real_escape_string($con,$_POST['subject']);
        $message=mysqli_real_escape_string($con,$_POST['message']);
        $date=date('Y-m-d h:i:sa');
        $sql="INSERT INTO contact_us(name,email,mobile,subject,message,added_on)
        VALUES('{$name}','{$email}',{$mobile},'{$subject}','{$message}','{$date}')";
        if(mysqli_query($con,$sql)){
            echo "done";
        }
    }    


    if($type=="rating"){
        $rate=mysqli_real_escape_string($con,$_POST['rate']);
        $pid=mysqli_real_escape_string($con,$_POST['pid']);
        
        $res_q= mysqli_query($con,"SELECT * FROM rating WHERE dish_id={$pid}");
        if(mysqli_num_rows($res_q)>0){
            $sql_updt = "UPDATE rating SET {$rate}_star={$rate}_star+1 WHERE dish_id={$pid}";
            if(mysqli_query($con,$sql_updt)){
                echo "done";
            }
        }else{
            $sql_insert="INSERT INTO rating({$rate}_star,dish_id) VALUES(1,{$pid})";
            if(mysqli_query($con,$sql_insert)){
                echo "done";
            }
            
        }

    }
?>