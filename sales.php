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
                <li class="breadcrumb-item active">Sales</li>
              </ol>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header bg-primary text-white">
              <i class="fa fa-table"></i>
              Recorded Sales
              <a href="#" class="text-white" data-toggle="modal" data-target="#addSaleModal">
                <span class="float-right">
                  <i class="fa fa-plus"></i>
                  Add New Entry
                </span>
              </a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>INVOICE-ID</th>
                      <th>Product</th>
                      <th>In-Stock</th>
                      <th>Price</th>
                      <th>Date</th>
                      <th>Profit</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>INVOICE-ID</th>
                      <th>Product</th>
                      <th>In-Stock</th>
                      <th>Price</th>
                      <th>Date</th>
                      <th>Profit</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <tr>
                      <td>#456488</td>
                      <td>Audionic MIC AM-20</td>
                      <td class="text-danger">03</td>
                      <td>Rs2100</td>
                      <td>04/10/2018</td>
                      <td class="text-primary">Rs80</td>
                    </tr>
                    <tr>
                      <td>#451188</td>
                      <td>USB Audio Controller</td>
                      <td class="text-primary">12</td>
                      <td>Rs200</td>
                      <td>04/10/2018</td>
                      <td class="text-primary">Rs25</td>
                    </tr>
                    <tr>
                      <td>#456488</td>
                      <td>Audionic MIC AM-20</td>
                      <td class="text-danger">03</td>
                      <td>Rs2100</td>
                      <td>04/10/2018</td>
                      <td class="text-primary">Rs80</td>
                    </tr>
                    <tr>
                      <td>#456488</td>
                      <td>Audionic MIC AM-20</td>
                      <td class="text-danger">03</td>
                      <td>Rs2100</td>
                      <td>04/10/2018</td>
                      <td class="text-primary">Rs80</td>
                    </tr>
                    <tr>
                      <td>#456488</td>
                      <td>Audionic MIC AM-20</td>
                      <td class="text-danger">03</td>
                      <td>Rs2100</td>
                      <td>04/10/2018</td>
                      <td class="text-primary">Rs80</td>
                    </tr>
                    <tr>
                      <td>#456488</td>
                      <td>Audionic MIC AM-20</td>
                      <td class="text-danger">03</td>
                      <td>Rs2100</td>
                      <td>04/10/2018</td>
                      <td class="text-primary">Rs80</td>
                    </tr>
                    <tr>
                      <td>#456488</td>
                      <td>Audionic MIC AM-20</td>
                      <td class="text-danger">03</td>
                      <td>Rs2100</td>
                      <td>04/10/2018</td>
                      <td class="text-primary">Rs80</td>
                    </tr>
                    <tr>
                      <td>#456488</td>
                      <td>Audionic MIC AM-20</td>
                      <td class="text-danger">03</td>
                      <td>Rs2100</td>
                      <td>04/10/2018</td>
                      <td class="text-primary">Rs80</td>
                    </tr>
                    <tr>
                      <td>#456488</td>
                      <td>Audionic MIC AM-20</td>
                      <td class="text-danger">03</td>
                      <td>Rs2100</td>
                      <td>04/10/2018</td>
                      <td class="text-primary">Rs80</td>
                    </tr>
                    <tr>
                      <td>#456488</td>
                      <td>Audionic MIC AM-20</td>
                      <td class="text-danger">03</td>
                      <td>Rs2100</td>
                      <td>04/10/2018</td>
                      <td class="text-primary">Rs80</td>
                    </tr>
                    <tr>
                      <td>#456488</td>
                      <td>Audionic MIC AM-20</td>
                      <td class="text-danger">03</td>
                      <td>Rs2100</td>
                      <td>04/10/2018</td>
                      <td class="text-primary">Rs80</td>
                    </tr>
                    <tr>
                      <td>#456488</td>
                      <td>Audionic MIC AM-20</td>
                      <td class="text-danger">03</td>
                      <td>Rs2100</td>
                      <td>04/10/2018</td>
                      <td class="text-primary">Rs80</td>
                    </tr>
                    <tr>
                      <td>#456488</td>
                      <td>Audionic MIC AM-20</td>
                      <td class="text-danger">03</td>
                      <td>Rs2100</td>
                      <td>04/10/2018</td>
                      <td class="text-primary">Rs80</td>
                    </tr>
                    <tr>
                      <td>#456488</td>
                      <td>Audionic MIC AM-20</td>
                      <td class="text-danger">03</td>
                      <td>Rs2100</td>
                      <td>04/10/2018</td>
                      <td class="text-primary">Rs80</td>
                    </tr>
                    <tr>
                      <td>#456488</td>
                      <td>Audionic MIC AM-20</td>
                      <td class="text-danger">03</td>
                      <td>Rs2100</td>
                      <td>04/10/2018</td>
                      <td class="text-primary">Rs80</td>
                    </tr>
                    <tr>
                      <td>#456488</td>
                      <td>Audionic MIC AM-20</td>
                      <td class="text-danger">03</td>
                      <td>Rs2100</td>
                      <td>04/10/2018</td>
                      <td class="text-primary">Rs80</td>
                    </tr>
                    <tr>
                      <td>#456488</td>
                      <td>Audionic MIC AM-20</td>
                      <td class="text-danger">03</td>
                      <td>Rs2100</td>
                      <td>04/10/2018</td>
                      <td class="text-primary">Rs80</td>
                    </tr>
                    <tr>
                      <td>#456488</td>
                      <td>Audionic MIC AM-20</td>
                      <td class="text-danger">03</td>
                      <td>Rs2100</td>
                      <td>04/10/2018</td>
                      <td class="text-primary">Rs80</td>
                    </tr>
                    <tr>
                      <td>#456488</td>
                      <td>Audionic MIC AM-20</td>
                      <td class="text-danger">03</td>
                      <td>Rs2100</td>
                      <td>04/10/2018</td>
                      <td class="text-primary">Rs80</td>
                    </tr>
                    <tr>
                      <td>#456488</td>
                      <td>Audionic MIC AM-20</td>
                      <td class="text-danger">03</td>
                      <td>Rs2100</td>
                      <td>04/10/2018</td>
                      <td class="text-primary">Rs80</td>
                    </tr>
                    <tr>
                      <td>#456488</td>
                      <td>Audionic MIC AM-20</td>
                      <td class="text-danger">03</td>
                      <td>Rs2100</td>
                      <td>04/10/2018</td>
                      <td class="text-primary">Rs80</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>

          <p class="small text-center text-muted my-5">
            <em>More table examples coming soon...</em>
          </p>

        </div>
        <!-- /.container-fluid -->
        <br><br><br>

        <!-- Sticky Footer -->
        <?php
            include 'footer.php';
         ?>
         

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

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
  </body>
</html>
