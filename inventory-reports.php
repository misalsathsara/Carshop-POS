<?php
  include 'header1.php';
  include 'db.php';

  $sql = "SELECT * FROM products";
  $result = $conn->query($sql);

  $products = [];

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
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
                <li class="breadcrumb-item active">Inventory Reports</li>
            </ol>
            <!-- Page Content -->
            <!-- DataTables Example -->
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <i class="fa fa-table"></i>
                    Inventory Records
                    <a href="#" class="text-white" data-toggle="modal" data-target="#addProductModal">
                        <span class="float-right">
                            <i class="fa fa-plus"></i>
                            Add New Products
                        </span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Wholesale Cost</th>
                                    <th>Item Price</th>
                                    <th>Item Price</th>
                                    <th>Selling Price</th>
                                    <th>Warranty</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Wholesale Cost</th>
                                    <th>Item Price</th>
                                    <th>Item Price</th>
                                    <th>Selling Price</th>
                                    <th>Warranty</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            <tbody>
                                <?php
foreach ($products as $index => $product) {
    echo "<tr>";
    echo "<td>" . ($index + 1) . "</td>";
    echo "<td>" . htmlspecialchars($product['category']) . "</td>";
    echo "<td>" . htmlspecialchars($product['name']) . "</td>";
    echo "<td>" . htmlspecialchars($product['cost_price']) . "</td>";
    echo "<td>" . htmlspecialchars($product['wholesale_price']) . "</td>";
    echo "<td>" . htmlspecialchars($product['price']) . "</td>";
    echo "<td>" . htmlspecialchars($product['selling_price']) . "</td>";
    echo "<td>" . htmlspecialchars($product['warranty']) . "</td>";
    echo "<td>" . htmlspecialchars($product['stock']) . "</td>";
    echo "<td>
        <div class='d-flex'>
            <form id='edit-form-" . htmlspecialchars($product['id']) . "' method='GET' action='product-edit.php' class='mr-2'>
                <input type='hidden' name='edit' value='" . htmlspecialchars($product['id']) . "'>
                <button type='button' class='btn btn-sm btn-primary' data-toggle='modal' data-target='#editProductModal' 
                    data-id='" . htmlspecialchars($product['id']) . "' 
                    data-name='" . htmlspecialchars($product['name']) . "' 
                    data-cost-price='" . htmlspecialchars($product['cost_price']) . "' 
                    data-wholesale-price='" . htmlspecialchars($product['wholesale_price']) . "' 
                    data-price='" . htmlspecialchars($product['price']) . "' 
                    data-selling-price='" . htmlspecialchars($product['selling_price']) . "' 
                    data-warranty='" . htmlspecialchars($product['warranty']) . "' 
                    data-stock='" . htmlspecialchars($product['stock']) . "'>Edit</button>
            </form>
            <form id='delete-form-" . htmlspecialchars($product['id']) . "' method='POST' action='product-delete.php'>
                <input type='hidden' name='id' value='" . htmlspecialchars($product['id']) . "'>
                <button type='button' class='btn btn-sm btn-danger' data-toggle='modal' data-target='#deleteProductModal' data-id='" . htmlspecialchars($product['id']) . "'>Delete</button>
            </form>
        </div>
    </td>";
    echo "</tr>";
}
?>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            <p class="small text-center text-muted my-5">
            </p>

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

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[data-toggle="modal"]').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const costPrice = this.getAttribute('data-cost-price');
            const wholesalePrice = this.getAttribute('data-wholesale-price');
            const price = this.getAttribute('data-price');
            const sellingPrice = this.getAttribute('data-selling-price');
            const warranty = this.getAttribute('data-warranty');
            const stock = this.getAttribute('data-stock');
            const target = this.getAttribute('data-target');

            if (target === '#editProductModal') {
                document.getElementById('editProductId').value = id;
                document.getElementById('editProductName').value = name;
                document.getElementById('editCostPrice').value = costPrice;
                document.getElementById('editWholesalePrice').value = wholesalePrice;
                document.getElementById('editPrice').value = price;
                document.getElementById('editSellingPrice').value = sellingPrice;
                document.getElementById('editStock').value = stock;
                document.getElementById('editProductIdLabel').textContent = `Product ID: ${id}`;

                // Set the selected value for the warranty
                const warrantySelect = document.getElementById('editWarranty');
                warrantySelect.value = warranty; // Set the value of the select input
            }
        });
    });
});



document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[data-toggle="modal"]').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const target = this.getAttribute('data-target');

            if (target === '#deleteProductModal') {
                document.getElementById('deleteProductId').value = id;
            }
        });
    });
});
</script>




<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery.easing.min.js"></script>
<script src="js/rc-pos.min.js"></script>
</body>

</html>