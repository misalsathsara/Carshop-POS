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
              <li class="breadcrumb-item active">Short Items</li>
            </ol>
            <!-- Page Content -->
            <!-- DataTables Example -->
            <div class="card mb-3">
              <div class="card-header bg-primary text-white">
                <i class="fa fa-table"></i>
                A List of Short Items
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>SKU</th>
                        <th>Brand</th>
                        <th>Product Name</th>
                        <th>In-Stock</th>
                        <th>Vendor</th>
                        <th>Revenue Percentage</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>SKU</th>
                        <th>Brand</th>
                        <th>Product Name</th>
                        <th>In-Stock</th>
                        <th>Vendor</th>
                        <th>Revenue Percentage</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <tr>
                        <td>054681</td>
                        <td>Audionic</td>
                        <td>MAX-4 Speakers</td>
                        <td class="text-danger">01</td>
                        <td>Anees Ahmad</td>
                        <td>4.63%</td>
                      </tr>
                      <tr>
                        <td>054681</td>
                        <td>Audionic</td>
                        <td>MAX-4 Speakers</td>
                        <td class="text-danger">01</td>
                        <td>Anees Ahmad</td>
                        <td>4.63%</td>
                      </tr>
                      <tr>
                        <td>054681</td>
                        <td>Audionic</td>
                        <td>MAX-4 Speakers</td>
                        <td class="text-danger">01</td>
                        <td>Anees Ahmad</td>
                        <td>4.63%</td>
                      </tr>
                      <tr>
                        <td>054681</td>
                        <td>Audionic</td>
                        <td>MAX-4 Speakers</td>
                        <td class="text-danger">01</td>
                        <td>Anees Ahmad</td>
                        <td>4.63%</td>
                      </tr>
                      <tr>
                        <td>054681</td>
                        <td>Audionic</td>
                        <td>MAX-4 Speakers</td>
                        <td class="text-danger">01</td>
                        <td>Anees Ahmad</td>
                        <td>4.63%</td>
                      </tr>
                      <tr>
                        <td>054681</td>
                        <td>Audionic</td>
                        <td>MAX-4 Speakers</td>
                        <td class="text-danger">01</td>
                        <td>Anees Ahmad</td>
                        <td>4.63%</td>
                      </tr>
                      <tr>
                        <td>054681</td>
                        <td>Audionic</td>
                        <td>MAX-4 Speakers</td>
                        <td class="text-danger">01</td>
                        <td>Anees Ahmad</td>
                        <td>4.63%</td>
                      </tr>
                      <tr>
                        <td>054681</td>
                        <td>Audionic</td>
                        <td>MAX-4 Speakers</td>
                        <td class="text-danger">01</td>
                        <td>Anees Ahmad</td>
                        <td>4.63%</td>
                      </tr>
                      <tr>
                        <td>054681</td>
                        <td>Audionic</td>
                        <td>MAX-4 Speakers</td>
                        <td class="text-danger">01</td>
                        <td>Anees Ahmad</td>
                        <td>4.63%</td>
                      </tr>
                      <tr>
                        <td>054681</td>
                        <td>Audionic</td>
                        <td>MAX-4 Speakers</td>
                        <td class="text-danger">01</td>
                        <td>Anees Ahmad</td>
                        <td>4.63%</td>
                      </tr>
                      <tr>
                        <td>054681</td>
                        <td>Audionic</td>
                        <td>MAX-4 Speakers</td>
                        <td class="text-danger">01</td>
                        <td>Anees Ahmad</td>
                        <td>4.63%</td>
                      </tr>
                      <tr>
                        <td>054681</td>
                        <td>Audionic</td>
                        <td>MAX-4 Speakers</td>
                        <td class="text-danger">01</td>
                        <td>Anees Ahmad</td>
                        <td>4.63%</td>
                      </tr>
                      <tr>
                        <td>054681</td>
                        <td>Audionic</td>
                        <td>MAX-4 Speakers</td>
                        <td class="text-danger">01</td>
                        <td>Anees Ahmad</td>
                        <td>4.63%</td>
                      </tr>
                      <tr>
                        <td>054681</td>
                        <td>Audionic</td>
                        <td>MAX-4 Speakers</td>
                        <td class="text-danger">01</td>
                        <td>Anees Ahmad</td>
                        <td>4.63%</td>
                      </tr>
                      <tr>
                        <td>054681</td>
                        <td>Audionic</td>
                        <td>MAX-4 Speakers</td>
                        <td class="text-danger">01</td>
                        <td>Anees Ahmad</td>
                        <td>4.63%</td>
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
