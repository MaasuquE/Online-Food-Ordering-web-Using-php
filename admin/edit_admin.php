<?php  
  include "config.php";
  include "toper.php";

?>
      
      
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
			<h1 class="card-title ml10">Edit Admin</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample">
                      <?php
                        $cid=$_GET['cid'];
                        $sql="SELECT * FROM admin WHERE id={$cid}";
                        $res=mysqli_query($conn,$sql);
                        if(mysqli_num_rows($res)>0){
                            $row=mysqli_fetch_assoc($res);
                        }

                      ?>
                    <div class="form-group">
                      <label for="exampleInputName1">name</label>
                      <input type="text" class="form-control" value="<?php echo $row['name'] ;?>" id="name" placeholder="name">
                      
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">username</label>
                      <input type="text" class="form-control" value="<?php echo $row['username'] ;?>" id="username" placeholder="username">
                      
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputEmail3">password</label>
                      <input type="email" class="form-control" value="<?php echo $row['password'] ;?>" id="password" placeholder="password">
                    </div>
                    <br><span class="field_error" id="category_error"></span>
                    <button type="button" onclick="edit_admin('<?php echo $row['id']; ?>')" class="btn btn-primary mr-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>
		 </div>
		</div>
<?php include "footer.php"; ?>