<?php
  include "config.php";
  include "toper.php";

?>
        
<div class="main-panel">
  <div class="content-wrapper">   
  <!-- Dashboard Start-->
  <div id="wrapper">
    <div id="page-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12-->
      </div>
      <!-- /.row-->
      <?php
      $sql_contuct=mysqli_query($conn,"SELECT * FROM contact_us");
      $m=mysqli_num_rows($sql_contuct);
      ?>
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3"><i class="fa fa-comments fa-5x"></i></div>
                <div class="col-xs-9 text-right">
                  <div class="huge"><?php echo $m; ?></div>
                  <div>Message!</div>
                </div>
              </div>
            </div><a href="#">
              <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
              </div></a>
          </div>
        </div>
        <?php
        $sql_user=mysqli_query($conn,"SELECT * FROM user");
        $m=mysqli_num_rows($sql_user);
        ?>
        <div class="col-lg-3 col-md-6">
          <div class="panel panel-green">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3"><i class="fa fa-tasks fa-5x"></i></div>
                <div class="col-xs-9 text-right">
                  <div class="huge"><?php echo $m; ?></div>
                  <div>Total User!</div>
                </div>
              </div>
            </div><a href="user.php">
              <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
              </div></a>
          </div>
        </div>
        <?php
        $sql_order=mysqli_query($conn,"SELECT * FROM order_detail");
        $i=mysqli_num_rows($sql_order);
        ?>
        <div class="col-lg-3 col-md-6">
          <div class="panel panel-yellow">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3"><i class="fa fa-shopping-cart fa-5x"></i></div>
                <div class="col-xs-9 text-right">
                  <div class="huge"><?php echo $i; ?></div>
                  <div>Orders!</div>
                </div>
              </div>
            </div><a href="order_admin.php">
              <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
              </div></a>
          </div>
        </div>
        <?php
        $sql_d=mysqli_query($conn,"SELECT * FROM delivery_boy");
        $i=mysqli_num_rows($sql_d);
        ?>
        <div class="col-lg-3 col-md-6">
          <div class="panel panel-red">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3"><i class="fa fa-support fa-5x"></i></div>
                <div class="col-xs-9 text-right">
                  <div class="huge"><?php echo $i; ?></div>
                  <div>Total Delivery Boy!</div>
                </div>
              </div>
            </div><a href="delivery_boy.php">
              <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
              </div></a>
          </div>
        </div>
      </div>
    </div>
    <!-- /#page-wrapper-->
  </div>
  <!-- Dashboard End -->
</div>

<?php include "footer.php"; ?>