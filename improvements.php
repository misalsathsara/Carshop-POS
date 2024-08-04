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
              <li class="breadcrumb-item active">Improvements</li>
            </ol>
            <!-- Page Content -->
            <div class="row">
            <div class="col-lg-8 col-sm-12 col-md-12 col-xs-12">
              <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                  <i class="fa fa-chart-bar"></i>
                  Improvements Chart
                </div>
                <div class="card-body">
                  <canvas id="myBarChart" width="100%" height="50"></canvas>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card mb-3">
                <div class="card-header bg-dark text-white">
                  <i class="fa fa-chart-pie"></i>
                  Product Profits Chart
                </div>
                <div class="card-body">
                  <canvas id="myPieChart" width="100%" height="100"></canvas>
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
      <script src="js/chart-area-demo.js"></script>
      <script src="js/chart-bar-demo.js"></script>
      <script src="js/chart-pie-demo.js"></script>
    </body>
  </html>
