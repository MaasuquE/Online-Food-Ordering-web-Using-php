
<?php
  include "config.php";
  include "toper.php";
  if(isset($_GET['type'])){
    $type= $_GET['type'];
    if($type == 'delete'){
      $cid=$_GET['cid'];
    $sql_dlt="DELETE FROM banner WHERE id={$cid}";
    mysqli_query($conn,$sql_dlt);
    }
  }
?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Banner</h4>
              <h6 class="card-title"><a href='add_banner.php'>Add Banner</a></h6>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                  <?php  
                    $sql_ban="SELECT * FROM banner ORDER BY id DESC";
                    $res_ban=mysqli_query($conn,$sql_ban);
                     
                  ?>
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Image</th>
                            <th>Heading</th>
                            <th>Sub Heading</th>
                            <th>Status</th>
                            <th colspan="2">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        if(mysqli_num_rows($res_ban)>0){ 
                        $i=1; while($row_ban=mysqli_fetch_assoc($res_ban)){ ?>
                        <tr>

                            <td><?php echo $i++; ?></td>
                            <td><img src="<?php echo "upload/".$row_ban['image']; ?>"/></td>
                            <td><?php echo $row_ban['heading']; ?></td>
                            <td><?php echo $row_ban['sub_heading']; ?></td>
                            <td><?php 
                              if($row_ban['status']== 1){?>
                                <span class="status-active" onclick="sts_banner('<?php echo $row_ban['id']; ?>','1')"><a>Active </a></span>
                              <?php }else{?>
                                <span class='status-deactive' onclick="sts_banner('<?php echo $row_ban['id']; ?>','0')" ><a>Deactive </a></span>
                       <?php     }
                            ?></td>
                            <td>
                            <button class="btn btn-outline-primary" id="edit-btn"><a href="edit_banner.php?cid=<?php echo $row_ban['id']; ?>">edit</a></button>
                            </td>
                            <td>
                              <button class="btn btn-outline-primary"><a href="banner.php?type=delete&cid=<?php echo $row_ban['id']; ?>">delete</a></button>
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