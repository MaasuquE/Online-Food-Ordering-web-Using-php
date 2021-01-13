<?php
    include "config.php";
    include "toper.php";
    if(isset($_GET['type'])){
      $type= $_GET['type'];
      if($type == 'delete'){
        $cid=$_GET['cid'];
      $sql_dlt="DELETE FROM delivery_boy WHERE id={$cid}";
      mysqli_query($conn,$sql_dlt);
      }
    }
?>
     <div class="main-panel">
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Delivery Boy</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                  <?php  
                    $sql="SELECT * FROM delivery_boy ORDER BY id DESC";
                    $res=mysqli_query($conn,$sql);
                     
                  ?>
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>Serial no </th>
                            <th>name</th>
                            <th>email</th>
                            <th>mobile</th>
                            <th>added on</th>
                            <th colspan="2">action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        if(mysqli_num_rows($res)>0){ 
                      $i=1; while($row=mysqli_fetch_assoc($res)){ ?>
                        <tr>

                            <td><?php echo $i++; ?></td>
                            <td><?php echo $row['boy_name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['mobile']; ?></td>
                            <td><?php echo $row['added_on']; ?></td>
                                <td><?php 
                                if($row['status']== 1){?>
                                    <span class="status-active" onclick="dboy_sts_btn('<?php echo $row['id']; ?>','1')"><a>Active </a></span>
                                <?php }else{?>
                                    <span class='status-deactive' onclick="dboy_sts_btn('<?php echo $row['id']; ?>','0')" ><a>Deactive</a></span>
                                <?php  }
                                ?></td>
                            <td>
                              <a href="delivery_boy.php?type=delete&cid=<?php echo $row['id']; ?>"><button class="btn btn-outline-primary">delete</button></a>
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
<?php
    include "footer.php";
?>