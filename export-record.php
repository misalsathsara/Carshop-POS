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
              <li class="breadcrumb-item active">Export Record</li>
            </ol>
            <!-- Page Content -->
            <h1>Export Record</h1>
            <hr>
            <p>Create custom backups or <a href="#">clone</a> everything.</p>
            <div class="row">
              <div class="col-xl-6 col-sm-12 mb-3">
                <a href="#" class="no-text-decorations">
                  <div class="card o-hidden h-100">
                    <div class="card-body bg-info text-white">
                      <div class="card-body-icon">
                        <i class="fa fa-fw fa-clone text-white"></i>
                      </div>
                      <div class="card-text text-center">
                        <h1 class="display-1"><strong>Clone</strong></h1>
                        Extract & Run ./<strong>getinstalled.sh</strong> to bring system live
                      </div>
                    </div>
                  </div>
                </a>
                </div>
                <div class="col-xl-6 col-sm-12 mb-3">
                  <a href="#" class="no-text-decorations">
                    <div class="card o-hidden h-100">
                      <div class="card-body bg-dark text-white">
                        <div class="card-body-icon">
                          <i class="fa fa-fw fa-copy text-white"></i>
                        </div>
                        <div class="card-text text-center">
                          <h1 class="display-1"><strong>Backup</strong></h1>
                          Create custom backups of your data
                        </div>
                      </div>
                    </div>
                  </a>
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
      <script src="js/rc-pos.min.js"></script>
    </body>
  </html>
