<?php
  include 'header1.php';
  include 'db.php';

  $sql = "SELECT * FROM category";
  $result = $conn->query($sql);

  $categories = [];

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
  }

  $conn->close();
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
                <li class="breadcrumb-item active">Product Category</li>
            </ol>
            <!-- Page Content -->
            <!-- DataTables Example -->
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <i class="fa fa-table"></i>
                    Product Category
                    <a href="#" class="text-white" data-toggle="modal" data-target="#addProductBrandModal">
                        <span class="float-right">
                            <i class="fa fa-plus"></i>
                            Add New Category
                        </span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Category Name</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Category Name</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                      foreach ($categories as $index => $category) {
                        echo "<tr>";
                        echo "<td>" . ($index + 1) . "</td>";
                        echo "<td>" . htmlspecialchars($category['name']) . "</td>";
                        // echo "<td>
                        //       <button class='btn btn-sm btn-danger'>Delete</button>
                        //       <button class='btn btn-sm btn-primary'>Edit</button>
                        //       </td>";
                        echo "</tr>";
                      }
                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
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