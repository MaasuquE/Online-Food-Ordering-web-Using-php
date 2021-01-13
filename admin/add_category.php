<?php  
  include "config.php";
  include "toper.php";

?>
      
      
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
			<h1 class="card-title ml10">Add Category</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample">
                    <div class="form-group">
                      <label for="exampleInputName1">category</label>
                      <input type="text" class="form-control" id="category" placeholder="category">
                      <br><span class="field_error" id="category_error"></span>
                    </div>
                    <br><span class="field_error" id="failed_error"></span><br>
                    <button type="button" id="btn" class="btn btn-primary mr-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>
		 </div>
		</div>
<?php include "footer.php"; ?>