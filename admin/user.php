<?php
  include "config.php";
  include "toper.php";
?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">User</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                  <?php  
                    $sql="SELECT * FROM user ORDER BY id DESC";
                    $res=mysqli_query($conn,$sql);
                     
                  ?>
                    <table id="order-listing" class="table">
                      <thead class="order-listing">
                        <tr>
                            <th>Serial no </th>
                            <th>name</th>
                            <th>email</th>
                            <th>mobile</th>
                            <th>added on</th>
                            <th>action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        if(mysqli_num_rows($res)>0){ 
                      $i=1; while($row=mysqli_fetch_assoc($res)){ ?>
                        <tr>

                            <td><?php echo $i++; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['mobile']; ?></td>
                            <td><?php echo $row['added_on']; ?></td>
                            <?php if($_SESSION['status']==1) { ?>
                                <td><?php 
                                if($row['status']== 1){?>
                                    <span class="status-active" onclick="user_sts_btn('<?php echo $row['id']; ?>','1')"><a>Active </a></span>
                                <?php }else{?>
                                    <span class='status-deactive' onclick="user_sts_btn('<?php echo $row['id']; ?>','0')" ><a>Deactive</a></span>
                                <?php  }
                                ?></td>
                            <?php  }?>
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