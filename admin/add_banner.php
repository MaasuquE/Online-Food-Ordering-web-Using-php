<?php 
    include "config.php";
    include "toper.php";
    if(isset($_POST['submit'])){
      if(isset($_FILES['fileToUpload'])){
          $error = array();
      
          $file_name = $_FILES['fileToUpload']['name'];
          $file_size = $_FILES['fileToUpload']['size'];
          $file_tmp = $_FILES['fileToUpload']['tmp_name'];
          $file_type = $_FILES['fileToUpload']['type'];
          $file_exp=explode('.',$file_name);
          $file_ext = end($file_exp);
          $extentions = array("jpeg","jpg","png");
      
          if(in_array($file_ext,$extentions) === false){
            $error[] = "This file extention are not allwed. Please choose a jpg or png file.";
          }
          if($file_size > 2097152){
            $error[]="File size must be 2mb or lower.";
          }
          $new_name = time()."-".basename($file_name);
          $target = "upload/".$new_name;
          $image_name = $new_name;

          if (empty($error)) {
            move_uploaded_file($file_tmp,$target);
            
          }
          else{
            print_r($error);
            die();
          }

        }
        $heading= mysqli_real_escape_string($conn,$_POST['heading']);
        $sub_heading= mysqli_real_escape_string($conn,$_POST['sub_heading']);
        $link= mysqli_real_escape_string($conn,$_POST['link']);
        $link_text = mysqli_real_escape_string($conn,$_POST['link_text']);
        $added_on= date("d M, Y");

        $sql="INSERT INTO banner(heading,sub_heading,link,link_txt,image,added_on,status)
        VALUES('{$heading}','{$sub_heading}','{$link}','{$link_text}','{$image_name}','{$added_on}',1)";
    
        if(mysqli_query($conn,$sql)){
            header("Location: {$hostname}/admin/banner.php");
        }else{
            echo "Insert Failed";
        }
  }

?>


<div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
			<h1 class="card-title ml10">Add Banner</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputEmail3">Heading</label>
                      <input type="text" class="form-control" name="heading" placeholder="heading">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Sub heading</label>
                      <input type="text" class="form-control" name="sub_heading" placeholder="sub-heading">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">link</label>
                      <input type="text" class="form-control" name="link" placeholder="link">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">link-text</label>
                      <input type="text" class="form-control" name="link_text" placeholder="link-text">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Image</label><br>
                        <input type="file"  name="fileToUpload" required/>
                    </div>
                    <br><span class="field_error" id="failed_error"></span><br>
                    <input type="submit" name="submit" class="btn btn-primary mr-2" value="submit" />
                  </form>
                </div>
              </div>
            </div>
		 </div>
</div>

<?php include "footer.php" ; ?>