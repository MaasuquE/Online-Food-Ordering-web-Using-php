<?php
include "config.php";
$name=mysqli_real_escape_string($con,$_POST['name']);
$email=mysqli_real_escape_string($con,$_POST['email']);
$mobile=mysqli_real_escape_string($con,$_POST['mobile']);
$subject=mysqli_real_escape_string($con,$_POST['subject']);
$message=mysqli_real_escape_string($con,$_POST['message']);

$added_on=date('Y-m-d h:i:sa');
$sql="INSERT INTO contact(name,email,mobile,subject,message,added_on)
VALUES('{$name}','{$email}','{$mobile}','{$subject}','{$message}','{$added_on}')";
if(mysqli_query($con,$sql)){
    
}
?>
