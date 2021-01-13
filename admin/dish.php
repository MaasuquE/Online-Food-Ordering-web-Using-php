<?php
    include "config.php";
    include "toper.php";
?>

<div class="main-panel">
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Dish</h4>
              <h6 class="card-title"><a href='add_dish.php'>Add Dish</a></h6>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                  <?php  
                    $sql="SELECT * FROM dish JOIN category ON dish.category_id=category.category_id ORDER BY dish.dish_id DESC";
                    $res=mysqli_query($conn,$sql);
                     
                  ?>
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>Serial no </th>
                            <th>image</th>
                            <th>category</th>
                            <th>dish</th>
                            <th>dish-detail</th>
                            <th>dish-price</th>
                            <th>User-Status</th>
                            <th colspan="2">action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        if(mysqli_num_rows($res)>0){ 
                      $i=1; while($row=mysqli_fetch_assoc($res)){ ?>
                        <tr>

                            <td><?php echo $i++; ?></td>
                            <td><img src="upload/<?php echo $row['image']; ?>"></td>
                            <td><?php echo $row['category']; ?></td>
                            <td><?php echo $row['dish']; ?>(<?php echo strtoupper($row['dish_type']); ?>)</td>
                            <td><?php echo $row['dish_detail']; ?></td>
                            <td><?php echo $row['dish_price']; ?></td>
                                <td><?php 
                                if($row['dish_sts']== 1){?>
                                    <span class="status-active" onclick="dish_sts_btn('<?php echo $row['dish_id']; ?>','1')"><a>Active </a></span>
                                <?php }else{?>
                                    <span class='status-deactive' onclick="dish_sts_btn('<?php echo $row['dish_id']; ?>','0')" ><a>Deactive</a></span>
                                <?php  }
                                ?></td>
                            <td>
                            <a href="edit_dish.php?cid=<?php echo $row['dish_id']; ?>"> <button type="button" class="btn btn-outline-primary" id="edit-dish-btn">edit</button></a>
                            </td>
                            <td class='delete_user'>
                              <button type="button" id="delete_user" onclick="dish_dlt_btn('<?php echo $row['dish_id']; ?>')" class="btn btn-outline-primary"><a>delete</a></button>
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