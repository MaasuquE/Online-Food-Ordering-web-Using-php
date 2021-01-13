<?php  
  include "config.php";
  include "toper.php";
  $cid=$_GET['cid'];
  if(isset($_POST['update'])){
    if(empty($_FILES['new-image']['name'])){
        $image_name = $_POST['old-image'];
      }
      else {
        $error = array();
    
        $file_name = $_FILES['new-image']['name'];
        $file_size = $_FILES['new-image']['size'];
        $file_tmp = $_FILES['new-image']['tmp_name'];
        $file_type = $_FILES['new-image']['type'];
        $file_ext = end(explode('.',$file_name));
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

      $sql_ins="UPDATE banner SET heading='{$heading}',sub_heading='{$sub_heading}',link='{$link}',link_txt='{$link_text}',image='{$image_name}' WHERE id={$cid}";
      

      if(mysqli_query($conn,$sql_ins)){
          header("Location: {$hostname}/admin/banner.php");
      }else{
          echo "update  Failed";
      }
}
?>
      
      
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
			      <h1 class="card-title ml10">Edit Banner</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <form class="forms-sample" method="post" enctype="multipart/form-data">
                      <?php
                        $sql="SELECT * FROM banner WHERE id={$cid}";
                        $res=mysqli_query($conn,$sql);
                        if(mysqli_num_rows($res)>0){
                            $row=mysqli_fetch_assoc($res);
                        }

                      ?>
                    <div class="form-group">
                      <label for="exampleInputName1">Heading</label>
                      <input type="text" class="form-control" name="heading" value="<?php echo $row['heading'] ;?>"  placeholder="category">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Sub heading</label>
                      <input type="text" class="form-control" name="sub_heading" value="<?php echo $row['sub_heading'] ;?>"  placeholder="sub heading">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Link</label>
                      <input type="text" class="form-control" name="link" value="<?php echo $row['link'] ;?>"  placeholder="link">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Link text</label>
                      <input type="text" class="form-control" name="link_text" value="<?php echo $row['link_txt'] ;?>"  placeholder="link text">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Image</label><br>
                        <input type="file"  name="new-image" />
                        <img  src="upload/<?php echo $row['image']; ?>" height="50%" width="40%" />
                        <input type="hidden"  name="old-image"  value="<?php echo $row['image']; ?>" />
                    </div>
                    <button type="submit" name="update" class="btn btn-primary mr-2">Update</button>
                  </form>
                </div>
              </div>
            </div>
		 </div>
		</div>
<?php include "footer.php"; ?>