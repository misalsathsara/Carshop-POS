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
              <li class="breadcrumb-item active">History</li>
            </ol>
            <!-- Page Content -->
            <!-- DataTables Example -->
            <div class="card mb-3">
              <div class="card-header bg-primary text-white">
                <i class="fa fa-table"></i>
                History
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th>Transaction Type</th>
                        <th>Amount</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th>Transaction Type</th>
                        <th>Amount</th>
                        <th>Date</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <tr>
                        <td>01</td>
                        <td>Sold A4-Tech Mouse A20</td>
                        <td>Income</td>
                        <td>Rs680</td>
                        <td>06/10/2018</td>
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>Sold A4-Tech Mouse A20</td>
                        <td>Income</td>
                        <td>Rs680</td>
                        <td>06/10/2018</td>
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>Sold A4-Tech Mouse A20</td>
                        <td>Income</td>
                        <td>Rs680</td>
                        <td>06/10/2018</td>
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>Sold A4-Tech Mouse A20</td>
                        <td>Income</td>
                        <td>Rs680</td>
                        <td>06/10/2018</td>
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>Sold A4-Tech Mouse A20</td>
                        <td>Income</td>
                        <td>Rs680</td>
                        <td>06/10/2018</td>
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>Sold A4-Tech Mouse A20</td>
                        <td>Income</td>
                        <td>Rs680</td>
                        <td>06/10/2018</td>
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>Sold A4-Tech Mouse A20</td>
                        <td>Income</td>
                        <td>Rs680</td>
                        <td>06/10/2018</td>
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>Sold A4-Tech Mouse A20</td>
                        <td>Income</td>
                        <td>Rs680</td>
                        <td>06/10/2018</td>
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>Sold A4-Tech Mouse A20</td>
                        <td>Income</td>
                        <td>Rs680</td>
                        <td>06/10/2018</td>
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>Sold A4-Tech Mouse A20</td>
                        <td>Income</td>
                        <td>Rs680</td>
                        <td>06/10/2018</td>
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>Sold A4-Tech Mouse A20</td>
                        <td>Income</td>
                        <td>Rs680</td>
                        <td>06/10/2018</td>
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>Sold A4-Tech Mouse A20</td>
                        <td>Income</td>
                        <td>Rs680</td>
                        <td>06/10/2018</td>
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>Sold A4-Tech Mouse A20</td>
                        <td>Income</td>
                        <td>Rs680</td>
                        <td>06/10/2018</td>
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>Sold A4-Tech Mouse A20</td>
                        <td>Income</td>
                        <td>Rs680</td>
                        <td>06/10/2018</td>
                      </tr>
                      <tr>
                        <td>01</td>
                        <td>Sold A4-Tech Mouse A20</td>
                        <td>Income</td>
                        <td>Rs680</td>
                        <td>06/10/2018</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
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
      <script src="js/jquery.dataTables.js"></script>
      <script src="js/dataTables.bootstrap4.js"></script>
      <script src="js/datatables-demo.js"></script>
      <script src="js/rc-pos.min.js"></script>
    </body>
  </html>
