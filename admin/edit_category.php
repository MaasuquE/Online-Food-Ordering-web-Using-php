<?php  
  include "config.php";
  include "toper.php";
?>
      
      
<div class="main-panel">        
  <div class="content-wrapper">
    <div class="row">
      <h1 class="card-title ml10">Edit Category</h1>
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <form class="forms-sample">
                <?php
                    $cid=$_GET['cid'];
                    $sql="SELECT * FROM category WHERE category_id={$cid}";
                    $res=mysqli_query($conn,$sql);
                    if(mysqli_num_rows($res)>0){
                      $row=mysqli_fetch_assoc($res);
                  ?>
                <div class="form-group">
                  <label for="exampleInputName1">category</label>
                  <input type="text" id="category" value="<?php echo $row['category']; ?>" class="form-control" required>
                </div>
                <?php  } ?>
                <button type="button" name="update" onclick="edit_category(<?php echo $cid; ?>)"  class="btn btn-primary mr-2">Update</button>
              </form>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
</div>

<?php include "footer.php"; ?>