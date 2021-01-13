<?php
    
    include "config.php";
    date_default_timezone_set("Asia/Dhaka");

    $type=mysqli_real_escape_string($conn,$_POST['term']);
    session_start();
    if($type =='insert'){
        $category=mysqli_real_escape_string($conn,$_POST['category']);
        $date=date("d M ,Y H:i:s");
        $sql_cat="SELECT * FROM category WHERE category = '{$category}'";
        $res_cat=mysqli_query($conn,$sql_cat);
        if(mysqli_num_rows($res_cat)>0){
            echo "exist";
        }
        else{
            $sql_ins="INSERT INTO category(category,status,added_on) VALUES('{$category}',1,'{$date}')";
            if($res_ins=mysqli_query($conn,$sql_ins)){
                echo "done";
            }
            else{
                echo "failed";
            }
        }
    }

    if($type =='edit'){
        $category=mysqli_real_escape_string($conn,$_POST['category']);
        $cid =$_POST['cid'];
        $sql_cat="SELECT * FROM category WHERE category = '{$category}'";
        $res_cat=mysqli_query($conn,$sql_cat);
        if(mysqli_num_rows($res_cat)>0){
            echo "exist";
        }
        else{
            $sql_ins="UPDATE category SET category='{$category}' WHERE category_id={$cid}";
            if($res_ins=mysqli_query($conn,$sql_ins)){
                echo "done";
            }
            else{
                echo "failed";
            }
        }
    }

    if($type=='submit'){
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        $sql="SELECT * FROM admin WHERE email='{$email}' and password='{$password}'";
        $res=mysqli_query($conn,$sql);
        if(mysqli_num_rows($res)>0){
            $row=mysqli_fetch_assoc($res);
            $_SESSION['admin']='yes';
            $_SESSION['id']= $row['id'];
            $_SESSION['username']= $row['username'];
            $_SESSION['email']= $row['email'];
            $_SESSION['status']=$row['status'];
            echo "done";
        }

    }

    if($type == "status_change"){
        $cid=$_POST['cid'];
        $status=$_POST['status'];
        if($status==1){
            $status=0;
        }
        else{
            $status=1;
        }
        $sql_sts="UPDATE category SET status={$status} WHERE category_id={$cid}";
        if(mysqli_query($conn,$sql_sts)){
            echo $status;
        }
    }


    if($type == "admin_status_change"){
        $cid=$_POST['cid'];
        $status=$_POST['status'];
        if($status==1){
            $status=0;
        }
        else{
            $status=1;
        }
        $sql_sts="UPDATE admin SET status={$status} WHERE id={$cid}";
        if(mysqli_query($conn,$sql_sts)){
            echo $status;
        }
    }


    if($type == 'logout'){
        session_unset();
        session_destroy();
        echo "done";
    }


    if($type =='admin_edit'){
        $name=mysqli_real_escape_string($conn,$_POST['name']);
        $username=mysqli_real_escape_string($conn,$_POST['username']);
        $password=mysqli_real_escape_string($conn,$_POST['password']);
        $cid =$_POST['cid'];
        $sts=$_POST['sts'];
        $sql_ad="SELECT * FROM admin WHERE username = '{$username}' AND id != {$cid} ";
        $res_ad=mysqli_query($conn,$sql_ad);
        if(mysqli_num_rows($res_ad)>0){
            echo "exist";
        }
        else{
            $sql_adm="UPDATE admin SET name='{$name}', username='{$username}',status={$sts} ,password={$password} WHERE id={$cid}";
            if($res_adm=mysqli_query($conn,$sql_adm)){
                echo "done";
            }
            else{
                echo "failed";
            }
        }
    }

    if($type =='admin_insert'){
        $name=mysqli_real_escape_string($conn,$_POST['name']);
        $username=mysqli_real_escape_string($conn,$_POST['username']);
        $email=mysqli_real_escape_string($conn,$_POST['email']);
        $password=mysqli_real_escape_string($conn,$_POST['password']);
        $sts=$_POST['sts'];
        $sql_add="SELECT * FROM admin WHERE username = '{$username}' OR email= '{$email}'";
        $res_add=mysqli_query($conn,$sql_add);
        if(mysqli_num_rows($res_add)>0){
            echo "exist";
        }
        else{
            $sql_addm="INSERT INTO admin(name,username,email,password,status)
             VALUES('{$name}','{$username}','{$email}','{$password}',{$sts})";
            if(mysqli_query($conn,$sql_addm)){
                echo "done";
            }
            else{
                echo "failed";
            }
        }
    }


    if($type == "admin_delete"){
        $cid=$_POST['cid'];
        $sql="DELETE FROM admin WHERE id={$cid}";
        if(mysqli_query($conn,$sql)){
            echo "done";
        }
    }


    if($type == "user_status_change"){
        $cid=$_POST['cid'];
        $status=$_POST['status'];
        if($status==1){
            $status=0;
        }
        else{
            $status=1;
        }
        $sql_sts="UPDATE user SET status={$status} WHERE id={$cid}";
        if(mysqli_query($conn,$sql_sts)){
            echo $status;
        }
    }

    if($type == "dboy_status_change"){
        $cid=$_POST['cid'];
        $status=$_POST['status'];
        if($status==1){
            $status=0;
        }
        else{
            $status=1;
        }
        $sql_sts="UPDATE delivery_boy SET status={$status} WHERE id={$cid}";
        if(mysqli_query($conn,$sql_sts)){
            echo $status;
        }
    }


    if($type == "dish_status_change"){
        $cid=$_POST['cid'];
        $status=$_POST['status'];
        if($status==1){
            $status=0;
        }
        else{
            $status=1;
        }
        $sql_sts="UPDATE dish SET dish_sts={$status} WHERE dish_id={$cid};";
        if(mysqli_query($conn,$sql_sts)){
            echo $status;
        }
    }


    if($type=='upload'){
        $name = mysqli_real_escape_string($conn,$_POST['img']);
        $img_name = basename($name);
        $dish = mysqli_real_escape_string($conn,$_POST['dish']);
        $dish_detail = mysqli_real_escape_string($conn,$_POST['dish_detail']);
        $dish_price = mysqli_real_escape_string($conn,$_POST['dish_price']);
        $dish_type = mysqli_real_escape_string($conn,$_POST['dish_type']);
        $qty = mysqli_real_escape_string($conn,$_POST['qty']);
        $category = $_POST['category'];
        $date = date("d M, Y H:i:s");

        $sql="INSERT INTO dish(dish,dish_detail,dish_price,dish_type,qty,category_id,image,added_on,dish_sts)
            VALUES('{$dish}','{$dish_detail}',{$dish_price},'{$dish_type}',{$qty},{$category},'{$img_name}','{$date}',1)";
        
        if(mysqli_query($conn,$sql)){
            echo "done";
        }
    }

    if($type == "delete_btn"){
        $cid=$_POST['cid'];
        $sql="DELETE FROM dish WHERE dish_id={$cid}";
        if(mysqli_query($conn,$sql)){
            echo "done";
        }

    }


    if($type == "update_dish"){
        
        $cid=$_POST['cid'];
        
        $dish=mysqli_real_escape_string($conn,$_POST['dish']);
        $dish_detail=mysqli_real_escape_string($conn,$_POST['dish_detail']);
        $dish_price=mysqli_real_escape_string($conn,$_POST['dish_price']);
        $dish_type=mysqli_real_escape_string($conn,$_POST['dish_type']);
        $category=mysqli_real_escape_string($conn,$_POST['category']);
        $name=mysqli_real_escape_string($conn,$_POST['image']);
        $img_name = basename($name);
        if($img_name==''){
            $img="";
        }
        else{
            $img =  ",image='{$img_name}'";
        }

        $sql="UPDATE dish SET dish='{$dish}',dish_type='{$dish_type}',dish_detail='{$dish_detail}',dish_price='{$dish_price}',category_id='{$category}'{$img} Where dish_id = {$cid}";
        
        if(mysqli_query($conn,$sql)){
            echo "done";
        }
    }


    if($type == "banner_status_change"){
        $cid=$_POST['cid'];
        $status=$_POST['status'];
        if($status==1){
            $status=0;
        }
        else{
            $status=1;
        }
        $sql_sts="UPDATE banner SET status={$status} WHERE id={$cid}";
        if(mysqli_query($conn,$sql_sts)){
            echo $status;
        }
    }

?>