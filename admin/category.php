<?php
  include "config.php";
  include "toper.php";
  if(isset($_GET['type'])){
    $type= $_GET['type'];
    if($type == 'delete'){
      $cid=$_GET['cid'];
    $sql_dlt="DELETE FROM category WHERE category_id={$cid}";
    mysqli_query($conn,$sql_dlt);
    }
  }
?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Category</h4>
              <h6 class="card-title"><a href='add_category.php'>Add Category</a></h6>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                  <?php  
                    $sql_cat="SELECT * FROM category ORDER BY category_id DESC";
                    $res_cat=mysqli_query($conn,$sql_cat);
                  ?>
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>Order #</th>
                            <th>category</th>
                            <th>Status</th>
                            <th colspan="2">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        if(mysqli_num_rows($res_cat)>0){ 
                      $i=1; while($row_cat=mysqli_fetch_assoc($res_cat)){ ?>
                        <tr>

                            <td><?php echo $i++; ?></td>
                            <td><?php echo $row_cat['category']; ?></td>
                            <td><?php 
                              if($row_cat['status']== 1){?>
                                <span class="status-active" onclick="sts_btn('<?php echo $row_cat['category_id']; ?>','1')"><a>Active </a></span>
                              <?php }else{?>
                                <span class='status-deactive' onclick="sts_btn('<?php echo $row_cat['category_id']; ?>','0')" ><a>Deactive </a></span>
                       <?php     }
                            ?></td>
                            <td>
                            <a href="edit_category.php?cid=<?php echo $row_cat['category_id']; ?>"><button class="btn btn-outline-primary" id="edit-btn">edit</button></a>
                            </td>
                            <td>
                            <a href="category.php?type=delete&cid=<?php echo $row_cat['category_id']; ?>"><button class="btn btn-outline-primary">delete</button></a>
                            </td>
                        </tr>
                        <?php
                          }
                        }
                         ?>
                      </tbody>
                    </table>
                  </div>
				        </div>
              </div>
            </div>
          </div>
        </div>
		  </div>
    </div>
<?php include "footer.php"; ?>