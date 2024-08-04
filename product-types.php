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
                <a href="index.php">Dashboard</a>
              </li>
              <li class="breadcrumb-item active">Product Types</li>
            </ol>
            <!-- Page Content -->
            <!-- DataTables Example -->
            <div class="card mb-3">
              <div class="card-header bg-primary text-white">
                <i class="fa fa-table"></i>
                Product Types
                <a href="#" class="text-white" data-toggle="modal" data-target="#addProductTypeModal">
                  <span class="float-right">
                    <i class="fa fa-plus"></i>
                    Add New Product Type
                  </span>
                </a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>PTID</th>
                        <th>Product Type</th>
                        <th>Total Products</th>
                        <th>Brands</th>
                        <th>Vendors</th>
                        <th>Price Range</th>
                        <th>Inventory Worth</th>
                        <th>Profit</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>PTID</th>
                        <th>Product Type</th>
                        <th>Total Products</th>
                        <th>Brands</th>
                        <th>Vendors</th>
                        <th>Price Range</th>
                        <th>Inventory Worth</th>
                        <th>Profit</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <tr>
                        <td>66489</td>
                        <td>Mouse &amp; Pointing Devices</td>
                        <td><strong>7</strong> Variants with <strong>21</strong> items in stock</td>
                        <td>A4-Tech, Digilinks, DELL, HP, Apple</td>
                        <td>Anees Ahmad, Nouman Aslam, Haider Abbas, Mian Asim</td>
                        <td>Rs210-2200</td>
                        <td>Rs13635</td>
                        <td><span class="text-primary"><i class="fa fa-arrow-up"></i>12%</span> Rs1875</td>
                      </tr>
                      <tr>
                        <td>66489</td>
                        <td>Mouse &amp; Pointing Devices</td>
                        <td><strong>7</strong> Variants with <strong>21</strong> items in stock</td>
                        <td>A4-Tech, Digilinks, DELL, HP, Apple</td>
                        <td>Anees Ahmad, Nouman Aslam, Haider Abbas, Mian Asim</td>
                        <td>Rs210-2200</td>
                        <td>Rs13635</td>
                        <td><span class="text-primary"><i class="fa fa-arrow-up"></i>12%</span> Rs1875</td>
                      </tr>
                      <tr>
                        <td>66489</td>
                        <td>Mouse &amp; Pointing Devices</td>
                        <td><strong>7</strong> Variants with <strong>21</strong> items in stock</td>
                        <td>A4-Tech, Digilinks, DELL, HP, Apple</td>
                        <td>Anees Ahmad, Nouman Aslam, Haider Abbas, Mian Asim</td>
                        <td>Rs210-2200</td>
                        <td>Rs13635</td>
                        <td><span class="text-primary"><i class="fa fa-arrow-up"></i>12%</span> Rs1875</td>
                      </tr>
                      <tr>
                        <td>66489</td>
                        <td>Mouse &amp; Pointing Devices</td>
                        <td><strong>7</strong> Variants with <strong>21</strong> items in stock</td>
                        <td>A4-Tech, Digilinks, DELL, HP, Apple</td>
                        <td>Anees Ahmad, Nouman Aslam, Haider Abbas, Mian Asim</td>
                        <td>Rs210-2200</td>
                        <td>Rs13635</td>
                        <td><span class="text-primary"><i class="fa fa-arrow-up"></i>12%</span> Rs1875</td>
                      </tr>
                      <tr>
                        <td>66489</td>
                        <td>Mouse &amp; Pointing Devices</td>
                        <td><strong>7</strong> Variants with <strong>21</strong> items in stock</td>
                        <td>A4-Tech, Digilinks, DELL, HP, Apple</td>
                        <td>Anees Ahmad, Nouman Aslam, Haider Abbas, Mian Asim</td>
                        <td>Rs210-2200</td>
                        <td>Rs13635</td>
                        <td><span class="text-primary"><i class="fa fa-arrow-up"></i>12%</span> Rs1875</td>
                      </tr>
                      <tr>
                        <td>66489</td>
                        <td>Mouse &amp; Pointing Devices</td>
                        <td><strong>7</strong> Variants with <strong>21</strong> items in stock</td>
                        <td>A4-Tech, Digilinks, DELL, HP, Apple</td>
                        <td>Anees Ahmad, Nouman Aslam, Haider Abbas, Mian Asim</td>
                        <td>Rs210-2200</td>
                        <td>Rs13635</td>
                        <td><span class="text-primary"><i class="fa fa-arrow-up"></i>12%</span> Rs1875</td>
                      </tr>
                      <tr>
                        <td>66489</td>
                        <td>Mouse &amp; Pointing Devices</td>
                        <td><strong>7</strong> Variants with <strong>21</strong> items in stock</td>
                        <td>A4-Tech, Digilinks, DELL, HP, Apple</td>
                        <td>Anees Ahmad, Nouman Aslam, Haider Abbas, Mian Asim</td>
                        <td>Rs210-2200</td>
                        <td>Rs13635</td>
                        <td><span class="text-primary"><i class="fa fa-arrow-up"></i>12%</span> Rs1875</td>
                      </tr>
                      <tr>
                        <td>66489</td>
                        <td>Mouse &amp; Pointing Devices</td>
                        <td><strong>7</strong> Variants with <strong>21</strong> items in stock</td>
                        <td>A4-Tech, Digilinks, DELL, HP, Apple</td>
                        <td>Anees Ahmad, Nouman Aslam, Haider Abbas, Mian Asim</td>
                        <td>Rs210-2200</td>
                        <td>Rs13635</td>
                        <td><span class="text-primary"><i class="fa fa-arrow-up"></i>12%</span> Rs1875</td>
                      </tr>
                      <tr>
                        <td>66489</td>
                        <td>Mouse &amp; Pointing Devices</td>
                        <td><strong>7</strong> Variants with <strong>21</strong> items in stock</td>
                        <td>A4-Tech, Digilinks, DELL, HP, Apple</td>
                        <td>Anees Ahmad, Nouman Aslam, Haider Abbas, Mian Asim</td>
                        <td>Rs210-2200</td>
                        <td>Rs13635</td>
                        <td><span class="text-primary"><i class="fa fa-arrow-up"></i>12%</span> Rs1875</td>
                      </tr>
                      <tr>
                        <td>66489</td>
                        <td>Mouse &amp; Pointing Devices</td>
                        <td><strong>7</strong> Variants with <strong>21</strong> items in stock</td>
                        <td>A4-Tech, Digilinks, DELL, HP, Apple</td>
                        <td>Anees Ahmad, Nouman Aslam, Haider Abbas, Mian Asim</td>
                        <td>Rs210-2200</td>
                        <td>Rs13635</td>
                        <td><span class="text-primary"><i class="fa fa-arrow-up"></i>12%</span> Rs1875</td>
                      </tr>
                      <tr>
                        <td>66489</td>
                        <td>Mouse &amp; Pointing Devices</td>
                        <td><strong>7</strong> Variants with <strong>21</strong> items in stock</td>
                        <td>A4-Tech, Digilinks, DELL, HP, Apple</td>
                        <td>Anees Ahmad, Nouman Aslam, Haider Abbas, Mian Asim</td>
                        <td>Rs210-2200</td>
                        <td>Rs13635</td>
                        <td><span class="text-primary"><i class="fa fa-arrow-up"></i>12%</span> Rs1875</td>
                      </tr>
                      <tr>
                        <td>66489</td>
                        <td>Mouse &amp; Pointing Devices</td>
                        <td><strong>7</strong> Variants with <strong>21</strong> items in stock</td>
                        <td>A4-Tech, Digilinks, DELL, HP, Apple</td>
                        <td>Anees Ahmad, Nouman Aslam, Haider Abbas, Mian Asim</td>
                        <td>Rs210-2200</td>
                        <td>Rs13635</td>
                        <td><span class="text-primary"><i class="fa fa-arrow-up"></i>12%</span> Rs1875</td>
                      </tr>
                      <tr>
                        <td>66489</td>
                        <td>Mouse &amp; Pointing Devices</td>
                        <td><strong>7</strong> Variants with <strong>21</strong> items in stock</td>
                        <td>A4-Tech, Digilinks, DELL, HP, Apple</td>
                        <td>Anees Ahmad, Nouman Aslam, Haider Abbas, Mian Asim</td>
                        <td>Rs210-2200</td>
                        <td>Rs13635</td>
                        <td><span class="text-primary"><i class="fa fa-arrow-up"></i>12%</span> Rs1875</td>
                      </tr>
                      <tr>
                        <td>66489</td>
                        <td>Mouse &amp; Pointing Devices</td>
                        <td><strong>7</strong> Variants with <strong>21</strong> items in stock</td>
                        <td>A4-Tech, Digilinks, DELL, HP, Apple</td>
                        <td>Anees Ahmad, Nouman Aslam, Haider Abbas, Mian Asim</td>
                        <td>Rs210-2200</td>
                        <td>Rs13635</td>
                        <td><span class="text-primary"><i class="fa fa-arrow-up"></i>12%</span> Rs1875</td>
                      </tr>
                      <tr>
                        <td>66489</td>
                        <td>Mouse &amp; Pointing Devices</td>
                        <td><strong>7</strong> Variants with <strong>21</strong> items in stock</td>
                        <td>A4-Tech, Digilinks, DELL, HP, Apple</td>
                        <td>Anees Ahmad, Nouman Aslam, Haider Abbas, Mian Asim</td>
                        <td>Rs210-2200</td>
                        <td>Rs13635</td>
                        <td><span class="text-primary"><i class="fa fa-arrow-up"></i>12%</span> Rs1875</td>
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
