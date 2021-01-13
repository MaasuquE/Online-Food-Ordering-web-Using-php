<?php  
    ob_start();
  include "config.php";
  include "toper.php";
  if($_SESSION['status']==0){
    header("Location: {$hostname}/admin/admin_user.php");
    ob_end_flush();
  }
?>
      
      
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
			<h1 class="card-title ml10">Add Admin User</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample">
                    <div class="form-group">
                      <label for="exampleInputName1">name</label>
                      <input type="text" class="form-control" id="name" placeholder="name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">username</label>
                      <input type="email" class="form-control" id="username" placeholder="username">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">email</label>
                      <input type="email" class="form-control" id="email" placeholder="email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">password</label>
                      <input type="email" class="form-control" id="password" placeholder="password">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">User Status</label>
                      <select id="status" class="form-control">
                        <?php 
                        if($row['status']==1){
                            echo '<option value="1" selected>Admin</option>
                            <option value="0">Normal</option>';
                        }
                        else{
                            echo '<option value="1" >Admin</option>
                            <option value="0"selected>Normal</option>';
                        }
                        ?>
                        
                      </select>
                    </div>
                    <br><span class="field_error" id="failed_error"></span><br>
                    <button type="button" id="add_user_btn" class="btn btn-primary mr-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>
		 </div>
		</div>
<?php include "footer.php"; ?>