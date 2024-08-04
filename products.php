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
              <li class="breadcrumb-item active">Products</li>
            </ol>
            <!-- Page Content -->
            <!-- DataTables Example -->
            <div class="card mb-3">
              <div class="card-header bg-primary text-white">
                <i class="fa fa-table"></i>
                Products
                <a href="#" class="text-white" data-toggle="modal" data-target="#addProductModal">
                  <span class="float-right">
                    <i class="fa fa-plus"></i>
                    Add New Product
                  </span>
                </a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>PID</th>
                        <th>Product Name</th>
                        <th>Product Type</th>
                        <th>Brand</th>
                        <th>In-stock</th>
                        <th>Cost/item</th>
                        <th>Inventory Worth</th>
                        <th>Revenue Generated</th>
                        <th>Vendor</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>PID</th>
                        <th>Product Name</th>
                        <th>Product Type</th>
                        <th>Brand</th>
                        <th>In-stock</th>
                        <th>Cost/item</th>
                        <th>Inventory Worth</th>
                        <th>Revenue Generated</th>
                        <th>Vendor</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <tr>
                        <td>054681</td>
                        <td>A4-Tech Mouse M60</td>
                        <td>Mouse &amp; Pointing Devices</td>
                        <td>A4-Tech</td>
                        <td>6</td>
                        <td>Rs840</td>
                        <td>Rs5040</td>
                        <td>Rs1370</td>
                        <td>Anees Ahmad</td>
                      </tr>
                      <tr>
                        <td>054681</td>
                        <td>A4-Tech Mouse M60</td>
                        <td>Mouse &amp; Pointing Devices</td>
                        <td>A4-Tech</td>
                        <td>6</td>
                        <td>Rs840</td>
                        <td>Rs5040</td>
                        <td>Rs1370</td>
                        <td>Anees Ahmad</td>
                      </tr>
                      <tr>
                        <td>054681</td>
                        <td>A4-Tech Mouse M60</td>
                        <td>Mouse &amp; Pointing Devices</td>
                        <td>A4-Tech</td>
                        <td>6</td>
                        <td>Rs840</td>
                        <td>Rs5040</td>
                        <td>Rs1370</td>
                        <td>Anees Ahmad</td>
                      </tr>
                      <tr>
                        <td>054681</td>
                        <td>A4-Tech Mouse M60</td>
                        <td>Mouse &amp; Pointing Devices</td>
                        <td>A4-Tech</td>
                        <td>6</td>
                        <td>Rs840</td>
                        <td>Rs5040</td>
                        <td>Rs1370</td>
                        <td>Anees Ahmad</td>
                      </tr>
                      <tr>
                        <td>054681</td>
                        <td>A4-Tech Mouse M60</td>
                        <td>Mouse &amp; Pointing Devices</td>
                        <td>A4-Tech</td>
                        <td>6</td>
                        <td>Rs840</td>
                        <td>Rs5040</td>
                        <td>Rs1370</td>
                        <td>Anees Ahmad</td>
                      </tr>
                      <tr>
                        <td>054681</td>
                        <td>A4-Tech Mouse M60</td>
                        <td>Mouse &amp; Pointing Devices</td>
                        <td>A4-Tech</td>
                        <td>6</td>
                        <td>Rs840</td>
                        <td>Rs5040</td>
                        <td>Rs1370</td>
                        <td>Anees Ahmad</td>
                      </tr>
                      <tr>
                        <td>054681</td>
                        <td>A4-Tech Mouse M60</td>
                        <td>Mouse &amp; Pointing Devices</td>
                        <td>A4-Tech</td>
                        <td>6</td>
                        <td>Rs840</td>
                        <td>Rs5040</td>
                        <td>Rs1370</td>
                        <td>Anees Ahmad</td>
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
