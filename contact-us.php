<?php
include "config.php";
include "toper.php";
date_default_timezone_set('Asia/Dhaka');
if(isset($_POST['send_message'])){
    $name=mysqli_real_escape_string($con,$_POST['name']);
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $mobile=mysqli_real_escape_string($con,$_POST['mobile']);
    $subject=mysqli_real_escape_string($con,$_POST['subject']);
    $message=mysqli_real_escape_string($con,$_POST['subject']);
    $date=date('Y-m-d h:i:sa');
    $sql="INSERT INTO contact_us(name,email,mobile,subject,message,added_on)
    VALUES('{$name}','{$email}',{$mobile},'{$subject}','{$message}','{$date}')";
    if(mysqli_query($con,$sql)){
       header("Location:{$hostname}/contact-us.php");
    }
}

?>

<div class="breadcrumb-area gray-bg">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="shop.php">Home</a></li>
                        <li class="active"> Contact Us </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="contact-area pt-100 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="contact-info-wrapper text-center mb-30">
                            <div class="contact-info-icon">
                                <i class="ion-ios-location-outline"></i>
                            </div>
                            <div class="contact-info-content">
                                <h4>Our Location</h4>
                                <p>012 345 678 / 123 456 789</p>
                                <p><a href="#">info@example.com</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="contact-info-wrapper text-center mb-30">
                            <div class="contact-info-icon">
                                <i class="ion-ios-telephone-outline"></i>
                            </div>
                            <div class="contact-info-content">
                                <h4>Contact us Anytime</h4>
                                <p>Mobile: 012 345 678</p>
                                <p>Fax: 123 456 789</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="contact-info-wrapper text-center mb-30">
                            <div class="contact-info-icon">
                                <i class="ion-ios-email-outline"></i>
                            </div>
                            <div class="contact-info-content">
                                <h4>Write Some Words</h4>
                                <p><a href="#">Support24/7@example.com </a></p>
                                <p><a href="#">info@example.com</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="contact-message-wrapper">
                            <h4 class="contact-title">GET IN TOUCH</h4>
                            <div class="contact-message">
                                <form id="contact-form" action="" method="post">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="contact-form-style mb-20">
                                                <input name="name" id="name" placeholder="Full Name" type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="contact-form-style mb-20">
                                                <input name="email" id="email" placeholder="Email Address" type="email" required>
                                            </div>
                                        </div>
										<div class="col-lg-4">
                                            <div class="contact-form-style mb-20">
                                                <input name="mobile" id="mobile" placeholder="Mobile" type="number" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="contact-form-style mb-20">
                                                <input name="subject" id="subject"  placeholder="Subject" type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="contact-form-style">
                                                <textarea name="message"  id="message" placeholder="Message" type="text" required></textarea>
                                                <button class="submit btn-style" name="send_message" id="send_message" type="button">SEND MESSAGE</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <p class="form-messege"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
include("footer.php");
?>