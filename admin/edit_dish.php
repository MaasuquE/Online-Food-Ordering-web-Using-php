<?php  
  include "config.php";
  include "toper.php";
?>  
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
			      <h1 class="card-title ml10">Edit Dish</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample">
                      <?php
                        $cid=$_GET['cid'];
                        $sql="SELECT * FROM dish WHERE dish_id={$cid}";
                        $res=mysqli_query($conn,$sql);
                        if(mysqli_num_rows($res)>0){
                            $row=mysqli_fetch_assoc($res);
                        }

                      ?>
                    <div class="form-group">
                      <label for="exampleInputName1">dish</label>
                      <input type="text" class="form-control" value="<?php echo $row['dish'] ;?>" id="dish" placeholder="dish">
                      
                    </div>
                    <label for="exampleInputName1">type</label>
                    <select id="type" class="form-control">
                        <option disabled>select type</option>
                        <?php if($row['type']=='veg') {
                            echo '<option value="veg" selected>veg</option>
                                  <option value="non-veg">non-veg</option>';
                          }else{
                            echo '<option value="veg" >veg</option>
                                  <option value="non-veg" selected>non-veg</option>';
                          }
                          ?> 
                        
                      </select>
                    <div class="form-group">
                    <?php
                        $sql_cat="SELECT * FROM category";
                        $res_cat=mysqli_query($conn,$sql_cat);
                        if(mysqli_num_rows($res_cat)>0){
                            
                    ?>
                      <label for="exampleInputName1">category</label>
                      <select id="category" class="form-control">
                        <option disabled>select category</option>
                        <?php
                        while($row_cat=mysqli_fetch_assoc($res_cat)){
                          if($row_cat['category_id']==$row['category_id']){
                            echo '<option value='.$row_cat['category_id'].' selected>'.$row_cat['category'].'</option>';
                          }
                          else{
                            echo '<option value='.$row_cat['category_id'].'>'.$row_cat['category'].'</option>';
                          }
                            
                        }
                        ?>
                      </select>
                     <?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">dish-detail</label>
                      <input type="text" class="form-control" value="<?php echo $row['dish_detail'] ;?>" id="dish_detail" placeholder="dish-detail">
                      
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">price</label>
                      <input type="text" class="form-control" value="<?php echo $row['dish_price'] ;?>" id="dish_price" placeholder="dish-price">
                      
                    </div>
                    <div class="form-group up_img">
                        <input type="file" onchange="upload_img()" name="image" id="image"/>
                        <img  src="upload/<?php echo $row['image']; ?>" />
                    </div>

                    <br><span class="field_error" id="category_error"></span>
                    <button type="button" onclick="update_dish('<?php echo $cid ?>')" class="btn btn-primary mr-2">Update</button>
                  </form>
                </div>
              </div>
            </div>
		 </div>
		</div>
<?php include "footer.php"; ?>