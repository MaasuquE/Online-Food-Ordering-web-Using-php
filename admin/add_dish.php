<?php
    include "config.php";
    include "toper.php";
?>

<div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
			<h1 class="card-title ml10">Add Dish</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample">
                    <div class="form-group">
                      <label for="exampleInputEmail3">dish</label>
                      <input type="text" class="form-control" id="dish" placeholder="dish">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">dish-detail</label>
                      <input type="text" class="form-control" id="dish_detail" placeholder="dish detail">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">dish-price</label>
                      <input type="text" class="form-control" id="dish_price" placeholder="dish price">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">type</label>
                      <select id="type" class="form-control">
                        <option disabled>select type</option>
                        <option value="veg">veg</option>
                        <option value="non-veg">non-veg</option>
                        
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">quantity</label>
                      <input type="text" class="form-control" id="qty" placeholder="quantity">
                    </div>
                    <div class="form-group">
                    <?php
                        $sql="SELECT * FROM category";
                        $res=mysqli_query($conn,$sql);
                        if(mysqli_num_rows($res)>0){
                            
                    ?>
                      <label for="exampleInputName1">category</label>
                      <select id="category" class="form-control">
                        <option disabled>select category</option>
                        <?php
                        while($row=mysqli_fetch_assoc($res)){
                           echo '<option value='.$row['category_id'].'>'.$row['category'].'</option>'; 
                        }
                        ?>
                      </select>
                     <?php } ?>
                    </div>
                    <div class="form-group">
                        <input type="file" onchange="upload_img()" name="image" id="image"/>
                    </div>
                    <br><span class="field_error" id="failed_error"></span><br>
                    <button type="button" id="add_dish_btn" class="btn btn-primary mr-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>
		 </div>
</div>

<?php include "footer.php"; ?>