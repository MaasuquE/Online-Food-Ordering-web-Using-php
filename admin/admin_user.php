<?php
  include "config.php";
  include "toper.php";
 
?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Admin User</h4>
              <?php if($_SESSION['status']==1) { ?>
              <h6 class="card-title"><a href='add_admin_user.php'>Add Admin User</a></h6>
              <?php } ?>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                  <?php  
                    $sql_cat="SELECT * FROM admin ORDER BY id DESC";
                    $res_cat=mysqli_query($conn,$sql_cat);
                     
                  ?>
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>Serial no </th>
                            <th>name</th>
                            <th>username</th>
                            <th>email</th>
                            <th>User Status</th>
                            <th colspan="2">action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        if(mysqli_num_rows($res_cat)>0){ 
                      $i=1; while($row_cat=mysqli_fetch_assoc($res_cat)){ ?>
                        <tr>

                            <td><?php echo $i++; ?></td>
                            <td><?php echo $row_cat['name']; ?></td>
                            <td><?php echo $row_cat['username']; ?></td>
                            <td><?php echo $row_cat['email']; ?></td>
                            <?php if($_SESSION['status']==1) { ?>
                                <td><?php 
                                if($row_cat['status']== 1){?>
                                    <span class="status-active" onclick="admin_sts_btn('<?php echo $row_cat['id']; ?>','1')"><a>Admin </a></span>
                                <?php }else{?>
                                    <span class='status-deactive' onclick="admin_sts_btn('<?php echo $row_cat['id']; ?>','0')" ><a>Normal</a></span>
                                <?php  }
                                ?></td>
                            <?php  }?>
                            <td>
                            <button class="btn btn-outline-primary" id="edit-btn"><a href="edit_admin.php?cid=<?php echo $row_cat['id']; ?>">edit</a></button>
                            </td>
                            <td class='delete_user'>
                              <button type="button" id="delete_user" onclick="admin_dlt_btn('<?php echo $row_cat['id']; ?>')" class="btn btn-outline-primary"><a>delete</a></button>
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