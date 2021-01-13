<?php  
ob_start();
include "config.php";
include "toper.php";
if(!isset($_SESSION['login'])){
    header("Location:{$hostname}/login.php");
    ob_end_flush();
  }
    $user_id=$_SESSION['user_id'];
    $sql="SELECT * FROM user WHERE id={$user_id}";
    $res=mysqli_query($con,$sql);
    if(mysqli_num_rows($res) >0){
        $row=mysqli_fetch_assoc($res);
    }
    
?>
<link rel="stylesheet" href="assets/css/profile.css">
<div class="container emp-profile">
    <form method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                       <img src="admin/upload/<?php echo $row['image']; ?>" alt=""/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                            <h5>
                                <?php echo $row['name']; ?>
                            </h5>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item active">
                            <a class="active nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 profile-edit-btn">
                <a href="update-profile.php">Edit Profile</a>
            </div>
            <div class="success-design">
                <text><span>Profile Update Successfully</span></text>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-8 body_info">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $row['name']; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $row['email']; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Phone</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $row['mobile']; ?></p>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </form>           
</div>
<?php   
    include "footer.php";
if(isset($_SESSION['update_success'])){ ?>
        <script>
            $('.success-design').animate({left: "78%"},500);
            setInterval(function(){
                $('.success-design').animate({left: "105%"},500);
            },3000);
        </script>
<?php
    unset($_SESSION['update_success']);
    }
  ?>
