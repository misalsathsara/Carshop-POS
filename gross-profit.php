<?php
  include 'header1.php';
?>
    <div id="wrapper">
      <!-- Sidebar -->
      <?php include 'wrapper.php';   ?>

        <div id="content-wrapper">
          <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="index.php">Home</a>
              </li>
              <li class="breadcrumb-item active">Gross Profit</li>
            </ol>
            <!-- Page Content -->
            <div class="row">
              <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                <div class="card text-white bg-primary o-hidden h-100">
                  <div class="card-header">
                    <h1>Last 7 Days</h1>
                  </div>
                  <div class="card-body">
                    <div class="card-body-icon">
                      <i class="fa fa-fw fa-money"></i>
                    </div>
                    <div class="card-text">
                      <h1 class="text-center display-3"><strong>Rs9.52k</strong></h1>
                    </div>
                  </div>
                  <a class="card-footer text-white clearfix small z-1" href="sales-count.php">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                      <i class="fa fa-angle-right"></i>
                    </span>
                  </a>
                </div>
              </div>
              <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                <div class="card text-white bg-info o-hidden h-100">
                  <div class="card-header">
                    <h1>Last 30 Days</h1>
                  </div>
                  <div class="card-body">
                    <div class="card-body-icon">
                      <i class="fa fa-fw fa-money"></i>
                    </div>
                    <div class="card-text">
                      <h1 class="text-center display-3"><strong>Rs38.0k</strong></h1>
                    </div>
                  </div>
                  <a class="card-footer text-white clearfix small z-1" href="">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                      <i class="fa fa-angle-right"></i>
                    </span>
                  </a>
                </div>
              </div>
              <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                <div class="card text-white bg-dark o-hidden h-100">
                  <div class="card-header">
                    <h1>Last 3 Months</h1>
                  </div>
                  <div class="card-body">
                    <div class="card-body-icon">
                      <i class="fa fa-fw fa-money"></i>
                    </div>
                    <div class="card-text">
                      <h1 class="text-center display-3"><strong>Rs114.2k</strong></h1>
                    </div>
                  </div>
                  <a class="card-footer text-white clearfix small z-1" href="">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                      <i class="fa fa-angle-right"></i>
                    </span>
                  </a>
                </div>
              </div>
              <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                <div class="card text-white bg-danger o-hidden h-100">
                  <div class="card-header">
                    <h1>Last 6 Months</h1>
                  </div>
                  <div class="card-body">
                    <div class="card-body-icon">
                      <i class="fa fa-fw fa-money"></i>
                    </div>
                    <div class="card-text">
                      <h1 class="text-center display-3"><strong>Rs228.4k</strong></h1>
                    </div>
                  </div>
                  <a class="card-footer text-white clearfix small z-1" href="">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                      <i class="fa fa-angle-right"></i>
                    </span>
                  </a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <!-- Area Chart Example-->
                <div class="card mb-3">
                  <div class="card-header bg-primary text-white">
                    <i class="fa fa-chart-area"></i>
                    Last 6 Months Profit
                  </div>
                  <div class="card-body">
                    <canvas id="myAreaChart" width="100%" height="30"></canvas>
                  </div>
                  <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                </div>
              </div>
            </div>
          </div>
          <br><br><br>
          <!-- Sticky Footer -->

        <!-- Sticky Footer -->
        <?php
            include 'footer.php';
         ?>
         
        </div>
      </div>
      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
      </a>
      
      <!-- Modals -->
      <?php
        include 'modals.php';
      ?>

      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery.easing.min.js"></script>
      <script src="js/chart.min.js"></script>
      <script src="js/jquery.dataTables.js"></script>
      <script src="js/dataTables.bootstrap4.js"></script>
      <script src="js/rc-pos.min.js"></script>
      <script src="js/datatables-demo.js"></script>
      <script src="js/chart-area-demo-6months.js"></script>
    </body>
  </html>
