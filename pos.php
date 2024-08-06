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

  $sql2 = "SELECT id, name FROM customers";
$result = $conn->query($sql2);

$customers = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $customers[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>POS - AUTO LANKA CAR AUDIO</title>
    <link rel="stylesheet" href="./assets/admin/css/google-fonts.css">
    <link rel="stylesheet" href="./assets/admin/css/vendor.min.css">
    <link rel="stylesheet" href="./assets/admin/vendor/icon-set/style.css">
    <link rel="stylesheet" href="./assets/admin/css/theme.minc619.css">
    <meta name="csrf-token" content="IRlKNC2Ol9Iiy2TZJOEmjPMeOgcxOwOfiv2L6o7e">
    <link rel="stylesheet" href="./assets/admin/css/custom.css" />
    <link rel="stylesheet" href="./assets/admin/css/pos.css" />
    <link rel="stylesheet" href="./assets/admin/css/toastr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <style>
    .text-decoration {
        text-decoration: line-through;
    }

    /* Customize DataTables to match your existing table style */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.5em 1em;
        margin: 0 0.1em;
        border-radius: 4px;
        border: 1px solid #ddd;
        background: #f8f9fa;
        color: #333;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #e9ecef;
        border-color: #ccc;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #007bff;
        color: #fff;
        border-color: #007bff;
    }

    .dataTables_wrapper .dataTables_filter input {
        border-radius: 4px;
        border: 1px solid #ddd;
        padding: 0.5em;
    }

    .dataTables_wrapper .dataTables_length select {
        border-radius: 4px;
        border: 1px solid #ddd;
        padding: 0.5em;
    }

    .dataTables_wrapper .dataTables_info {
        padding: 0.5em;
        color: #333;
    }

    /* Hide DataTables search box */
    .dataTables_wrapper .dataTables_filter {
        display: none;
    }
    </style>
</head>

<body class="footer-offset">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="loading" class="d-none">
                    <!-- <div class="style-i1">
                        <img width="200" src="./assets/admin/img/loader.gif" alt="Loader gif">
                    </div> -->

                </div>
            </div>
        </div>
    </div>
    <header id="header"
        class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-flush navbar-container navbar-bordered">
        <div class="navbar-nav-wrap">
            <div class="navbar-nav-wrap-content-right">
                <ul class="navbar-nav align-items-center flex-row">
                    <li class="nav-item">
                        <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker navbar-dropdown-account-wrapper" href="javascript:;"
                                data-hs-unfold-options="{
                                        &quot;target&quot;: &quot;#accountNavbarDropdown&quot;,
                                        &quot;type&quot;: &quot;css-animation&quot;
                                    }">
                                <div class="avatar avatar-sm avatar-circle">
                                    <img class="avatar-img" src="./assets/admin/css/2022-09-20-6329abe53ec42.png"
                                        alt="Image">
                                    <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                                </div>
                            </a>
                            <div id="accountNavbarDropdown"
                                class="w-i2 hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right navbar-dropdown-menu navbar-dropdown-account">
                                <div class="dropdown-item-text">
                                    <div class="media align-items-center">
                                        <div class="avatar avatar-sm avatar-circle mr-2">
                                            <img class="avatar-img"
                                                src="./assets/admin/css/2022-09-20-6329abe53ec42.png" alt="Owner image">
                                        </div>
                                        <div class="media-body">
                                            <span class="card-title h5">Super</span>
                                            <span class="card-text"><a href="/cdn-cgi/l/email-protection"
                                                    class="__cf_email__"
                                                    data-cfemail="157471787c7b557471787c7b3b767a78">[email&#160;protected]</a></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" id="logoutLink">
                                    <span class="text-truncate pr-2" title="Sign out">Sign out</span>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <main id="content" role="main" class="main pointer-event">
        <section class="section-content ">
            <div class="container-fluid">
                <div class="d-flex flex-wrap">
                    <div class="order--pos-left">
                        <div class="card">
                            <h5 class="p-3 m-0 bg-light">Product Section</h5>
                            <div class="px-3 py-4">
                                <div class="row gy-1">
                                    <!-- <div class="col-sm-6">
                                        <div class="input-group d-flex justify-content-end">
                                            <select name="category" id="category"
                                                class="form-control js-select2-custom w-100 category-show"
                                                title="Select category">
                                                <option value>All categories</option>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="col-sm-6">
                                        <form class>

                                            <div class="input-group-overlay input-group-merge input-group-custom">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-search"></i>
                                                    </div>
                                                </div>
                                                <input id="search" autocomplete="off" type="text" name="search"
                                                    class="form-control search-bar-input"
                                                    placeholder="Search by code or name" aria-label="Search here">
                                                <div class="pos-search-card w-4 position-absolute z-index-1 w-100">
                                                    <div id="" class="card card-body search-result-box d--none"></div>
                                                </div>
                                            </div>

                                            <script>
                                            document.addEventListener('DOMContentLoaded', () => {
                                                const searchInput = document.getElementById('search');
                                                const tableRows = document.querySelectorAll(
                                                    '#dataTable tbody tr');

                                                searchInput.addEventListener('input', () => {
                                                    const query = searchInput.value.toLowerCase();

                                                    tableRows.forEach(row => {
                                                        const id = row.getAttribute('data-id')
                                                            .toLowerCase();
                                                        const category = row.getAttribute(
                                                            'data-category').toLowerCase();
                                                        const name = row.getAttribute(
                                                            'data-name').toLowerCase();

                                                        if (id.includes(query) || category
                                                            .includes(query) || name.includes(
                                                                query)) {
                                                            row.style.display = '';
                                                        } else {
                                                            row.style.display = 'none';
                                                        }
                                                    });
                                                });
                                            });
                                            </script>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div>

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Category</th>
                                            <th>Name</th>
                                            <th>Item Price</th>
                                            <th>Wholesale Price</th>
                                            <th>Selling Price</th>
                                            <th>Warranty</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Category</th>
                                            <th>Name</th>
                                            <th>Item Price</th>
                                            <th>Wholesale Price</th>
                                            <th>Selling Price</th>
                                            <th>Warranty</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
            foreach ($products as $index => $product) {
                echo "<tr data-id='" . ($index + 1) . "' data-category='" . htmlspecialchars($product['category']) . "' data-name='" . htmlspecialchars($product['name']) . "' data-price='" . htmlspecialchars($product['price']) . "' data-selling-price='" . htmlspecialchars($product['selling_price']) . "'>";
                    echo "<td>" . ($index + 1) . "</td>";
                echo "<td>" . htmlspecialchars($product['category']) . "</td>";
                echo "<td>" . htmlspecialchars($product['name']) . "</td>";
                echo "<td>" . htmlspecialchars($product['price']) . "</td>";
                echo "<td>" . htmlspecialchars($product['wholesale_price']) . "</td>";
                echo "<td>" . htmlspecialchars($product['selling_price']) . "</td>";
                echo "<td>" . htmlspecialchars($product['warranty']) . "</td>";
                echo "</tr>";
            }
        ?>
                                    </tbody>
                                </table>


                            </div>
                            <div class="table-responsive mt-4">
                                <div class="px-4 d-flex justify-content-lg-end">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order--pos-right">
                        <div class="card billing-section-wrap">
                            <h5 class="p-3 m-0 bg-light">Billing Section</h5>
                            <div>
                                <div class="card-body pb-0">
                                    <div class="d-flex align-items-center gap-2 mb-3">

                                        <div class="flex-grow-1">
                                            <select id="customer" name="customer_id"
                                                class="form-control js-data-example-ajax customer-change">
                                                <option value="">--select-customer--</option>
                                                <?php foreach ($customers as $customer): ?>
                                                <option value="<?php echo htmlspecialchars($customer['id']); ?>">
                                                    <?php echo htmlspecialchars($customer['name']); ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                        <script
                                            src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js">
                                        </script>
                                        <script>
                                        $(document).ready(function() {
                                            $('#customer').select2({
                                                placeholder: '--select-customer--',
                                                allowClear: true
                                            });

                                            $('#customer').on('change', function() {
                                                var selectedCustomerName = $(
                                                    '#customer option:selected').text();
                                                $('#current_customer').text(selectedCustomerName);
                                            });
                                        });
                                        </script>
                                        <div class>
                                            <button class="w-i6 d-inline-block btn btn-success rounded text-nowrap"
                                                id="add_new_customer" type="button" data-toggle="modal"
                                                data-target="#add-customer" title="Add Customer">
                                                <i class="fas fa-plus"></i>
                                                Customer
                                            </button>

                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="input-label text-capitalize">
                                            Current customer :
                                            <span class="style-i4" id="current_customer"></span>
                                        </label>
                                    </div>
                                    <div class="d-flex gap-2 flex-wrap align-items-center mb-3">
                                        <div class="flex-grow-1">
                                            <select id="cart_id" name="cart_id"
                                                class=" form-control js-select2-custom cart-change">
                                            </select>
                                        </div>
                                        <div>
                                            <a class="w-i6 d-inline-block btn btn-danger rounded" href="">
                                                Clear cart
                                            </a>
                                        </div>
                                        <div>
                                            <a class="w-i6 d-inline-block btn btn-success rounded" href="pos.php"
                                                target="_blank">
                                                New order
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <div id="cartloader" class="d-none">
                                            <img width="50" src="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="cart">
                                <div class="card-body pt-0">
                                    <div class="table-responsive pos-cart-table border">

                                        <table class="table table-align-middle mb-0" id="detailTable">
                                            <thead class="text-muted">
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Qty</th>
                                                    <th>Selling Price</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Rows will be added here dynamically -->
                                            </tbody>
                                        </table>


                                    </div>
                                </div>
                                <div class="box p-3">
                                    <dl class="row">
                                        <dt class="col-6">Sub total :</dt>
                                        <dd class="col-6 text-right" id="subtotal">0 Rs.</dd>

                                        <!-- <dt class="col-6">Product discount :</dt>
                                        <dd class="col-6 text-right">0 Rs.</dd> -->

                                        <dt class="col-6">Extra discount :</dt>
                                        <dd class="col-6 text-right">
                                            <button id="extra_discount" class="btn btn-sm" type="button"
                                                data-toggle="modal" data-target="#add-discount">
                                                <i class="fas fa-pen"></i>
                                            </button> <span id="discount_amount">0.00 Rs.</span>
                                        </dd>


                                        <!-- <dt class="col-6">Coupon discount :</dt>
                                        <dd class="col-6 text-right">
                                            <button id="coupon_discount" class="btn btn-sm" type="button"
                                                data-toggle="modal" data-target="#add-coupon-discount">
                                                <i class="fas fa-pen"></i>
                                            </button> 0 Rs.
                                        </dd> -->

                                        <dt class="col-6">Tax :</dt>
                                        <dd class="col-6 text-right">
                                            <span id="tax_amount" contenteditable="true" class="editable"
                                                data-value="0">0 %</span>
                                        </dd>




                                        <dt class="col-6">Total :</dt>
                                        <dd class="col-6 text-right h4 b">
                                            <span id="total_price">0</span> Rs.
                                        </dd>
                                    </dl>
                                    <br>
                                    <div class="row g-2">
                                        <!-- <div class="col-6 mt-2">
                                            <button type="button" class="btn btn-danger btn-block empty-cart">
                                                <i class="fa fa-times-circle "></i>
                                                Cancel Order
                                            </button>
                                        </div> -->
                                        <a href="place-order.php" class="btn btn-success btn-block">
                                            <i class="fa fa-shopping-bag"></i>
                                            Place Order
                                        </a>
                                    </div>
                                </div>
                                <div class="modal fade" id="add-customer" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Add new customer</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="add-customer.php" method="post" id="product_form">
                                                    <input type="hidden" name="_token"
                                                        value="IRlKNC2Ol9Iiy2TZJOEmjPMeOgcxOwOfiv2L6o7e"> <input
                                                        type="hidden" class="form-control" name="balance" value="0">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="input-label">Customer name <span
                                                                        class="input-label-secondary text-danger">*</span></label>
                                                                <input type="text" name="name" class="form-control"
                                                                    value placeholder="Customer name" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="input-label">Mobile no <span
                                                                        class="input-label-secondary text-danger">*</span></label>
                                                                <input type="tel" id="mobile" name="mobile"
                                                                    class="form-control" value pattern="[+0-9]+"
                                                                    title="Please enter a valid phone number with only numbers and the plus sign (+)"
                                                                    placeholder="Mobile no" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <button type="submit" id="submit_new_customer"
                                                            class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="add-discount" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Extra Discount</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="form-group col-sm-12">
                                                        <label for="dis_amount">Discount Amount</label>
                                                        <input type="number" id="dis_amount" class="form-control"
                                                            name="discount" step="0.01" min="0"
                                                            placeholder="Enter discount amount in Rs.">
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button class="btn btn-sm btn-primary extra-discount"
                                                        type="submit">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="modal fade" id="add-coupon-discount" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Coupon discount</h5>
                                                <button id="coupon_close" type="button" class="close"
                                                    data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for>Coupon code</label>
                                                    <input type="text" id="coupon_code" class="form-control"
                                                        name="coupon_code">
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button class="btn btn-sm btn-primary coupon-discount"
                                                        type="submit">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="modal fade" id="add-tax" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update tax</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="https://6pos.6amtech.com/admin/pos/tax" method="POST" class="row">
                                            <input type="hidden" name="_token"
                                                value="IRlKNC2Ol9Iiy2TZJOEmjPMeOgcxOwOfiv2L6o7e">
                                            <div class="form-group col-12">
                                                <label for>Tax (%)</label>
                                                <input type="number" class="form-control" name="tax" min="0">
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                                <!-- <div class="modal fade" id="paymentModal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Payment </h5>
                                                <button id="payment_close" type="button" class="close"
                                                    data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <span class="style-three-cart">Total</span>
                                                <h4 class="mb-0" id="total_balance"><span class="style-four-cart"> =
                                                    </span>
                                                    0
                                                    $</h4>
                                            </div> -->
                                <!-- <div class="modal-body">
                                                <form action="https://6pos.6amtech.com/admin/pos/order" id="order_place"
                                                    method="post">
                                                    <input type="hidden" name="_token"
                                                        value="IRlKNC2Ol9Iiy2TZJOEmjPMeOgcxOwOfiv2L6o7e">
                                                    <div class="form-group">
                                                        <label class="input-label" for>Type</label>
                                                        <select class="payment-opp form-control" name="type"
                                                            id="payment_opp" class="form-control select2" required>
                                                            <option value="1">Cash</option>
                                                            <option value="4">Standard Chartered</option>
                                                            <option value="5">Bank Asia</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group d-none" id="balance">
                                                        <label class="input-label" for>Customer balance
                                                            ($)</label>
                                                        <input type="number" id="balance_customer" class="form-control"
                                                            name="customer_balance" disabled>
                                                    </div>
                                                    <div class="form-group d-none" id="remaining_balance">
                                                        <label class="input-label" for>Remaining balance
                                                            ($)</label>
                                                        <input type="number" id="balance_remain" class="form-control"
                                                            name="remaining_balance" value readonly>
                                                    </div>
                                                    <div class="form-group d-none" id="transaction_ref">
                                                        <label class="input-label" for>Transaction reference
                                                            ($)
                                                            -(Optional)</label>
                                                        <input type="text" id="tran_ref" class="form-control"
                                                            name="transaction_reference">
                                                    </div>
                                                    <div class="form-group" id="collected_cash">
                                                        <label class="input-label" for>Collected cash
                                                            ($)</label>
                                                        <input type="number" id="cash_amount"
                                                            onkeyup="price_calculation();" class="form-control"
                                                            name="collected_cash" step="0.01">
                                                    </div>
                                                    <div class="form-group" id="returned_amount">
                                                        <label class="input-label" for>Returned amount
                                                            ($)</label>
                                                        <input type="number" id="returned" class="form-control"
                                                            name="returned_amount" value readonly>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <button class="btn btn-sm btn-primary" id="order_complete"
                                                            type="submit">Submit</button>
                                                    </div>
                                                </form>
                                            </div> -->
                                <!-- </div>
                                    </div>
                                </div> -->
                                <script data-cfasync="false"
                                    src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
                                <script>
                                "use strict";

                                $(".empty-cart").on('click', function() {
                                    emptyCart();
                                });

                                $(".submit-order").on('click', function() {
                                    submit_order();
                                });

                                $(".coupon-discount").on('click', function() {
                                    coupon_discount();
                                });

                                $(".extra-discount").on('click', function() {
                                    extra_discount();
                                });

                                $('.type_ext_dis').on('change', function() {
                                    limit(this);
                                });

                                $('.payment-opp').on('change', function() {
                                    payment_option(this);
                                });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade" id="quick-view" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content" id="quick-view-modal">
                </div>
            </div>
        </div>
    </main>
    <script src="./assets/admin/js/vendor.min.js"></script>
    <script src="./assets/admin/js/theme.min.js"></script>
    <script src="./assets/admin/js/sweet_alert.js"></script>
    <script src="./assets/admin/js/toastr.js"></script>
    <script src="./assets/admin/js/pos.js"></script>
    <script type="text/javascript"></script>
    <script>
    "use strict";

    $(document).on('click', '#logoutLink', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Do you want to logout?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonColor: '#FC6A57',
            cancelButtonColor: '#363636',
            confirmButtonText: `Yes`,
            denyButtonText: `Don t Logout'`,
        }).then((result) => {
            if (result.value) {
                window.location.href = 'https://6pos.6amtech.com/admin/auth/logout';
            } else {
                Swal.fire('Canceled', '', 'Info');
            }
        });
    });

    $(document).on('ready', function() {

        $(".print-div").on('click', function() {
            let divName = $(this).data('name');
            printDiv(divName);
        });

        $(".invoice-close").on('click', function() {
            window.location.href = $(this).data('route');
        });

        $('.category-show').on('change', function() {
            set_category_filter($(this).val());
        });

        $('.cart-change').on('change', function() {
            cart_change($(this).val());
        });

        $('.customer-change').on('change', function() {
            customer_change($(this).val());
        });

        $(".single-cart-data").on('click', function() {
            let order_id = $(this).data('id');
            addToCart(order_id);
        });

        $('.js-hs-unfold-invoker').each(function() {
            var unfold = new HSUnfold($(this)).init();
        });

        $('#search').focus();
        $.ajax({
            url: 'https://6pos.6amtech.com/admin/pos/get-cart-ids',
            type: 'GET',

            dataType: 'json',
            beforeSend: function() {
                $('#loading').removeClass('d-none');
            },
            success: function(data) {
                var output = '';
                for (var i = 0; i < data.cart_nam.length; i++) {
                    output +=
                        `<option value="${data.cart_nam[i]}" ${data.current_user==data.cart_nam[i]?'selected':''}>${data.cart_nam[i]}</option>`;
                }
                $('#cart_id').html(output);
                $('#current_customer').text(data.current_customer);
                $('#cart').empty().html(data.view);
                if (data.user_type === 'sc') {
                    console.log('after add');
                    customer_Balance_Append(data.user_id);
                }
            },
            complete: function() {
                $('#loading').addClass('d-none');
            },
        });
    });


    function payment_option(val) {
        if ($(val).val() != 1 && $(val).val() != 0) {
            $("#collected_cash").addClass('d-none');
            $("#returned_amount").addClass('d-none');
            $("#balance").addClass('d-none');
            $("#remaining_balance").addClass('d-none');
            $("#transaction_ref").removeClass('d-none');
            $('#cash_amount').attr('required', false);
            console.log($(val).val());
        } else if ($(val).val() == 1) {
            $("#collected_cash").removeClass('d-none');
            $("#returned_amount").removeClass('d-none');
            $("#transaction_ref").addClass('d-none');
            $("#balance").addClass('d-none');
            $("#remaining_balance").addClass('d-none');
            console.log($(val).val());

        } else if ($(val).val() == 0) {
            $("#balance").removeClass('d-none');
            $("#remaining_balance").removeClass('d-none');
            $("#collected_cash").addClass('d-none');
            $("#returned_amount").addClass('d-none');
            $("#transaction_ref").addClass('d-none');
            $('#cash_amount').attr('required', false);
            let customerId = $('#customer').val();
            $.ajax({
                url: 'https://6pos.6amtech.com/admin/pos/customer-balance',
                type: 'GET',
                data: {
                    customer_id: customerId
                },
                dataType: 'json',
                beforeSend: function() {
                    $('#loading').removeClass('d-none');
                    console.log("loding");
                },
                success: function(data) {
                    console.log(data.customer_balance);
                    let balance = data.customer_balance;
                    let order_total = $('#total_price').text();
                    let remain_balance = parseInt(balance) - parseInt(order_total);
                    $('#balance_customer').val(balance);
                    $('#balance_remain').val(remain_balance);
                },
                complete: function() {
                    $('#loading').addClass('d-none');
                },
            });
        }
    }

    function customer_change(val) {
        $.post({
            url: 'https://6pos.6amtech.com/admin/pos/remove-coupon',
            data: {
                _token: 'IRlKNC2Ol9Iiy2TZJOEmjPMeOgcxOwOfiv2L6o7e',
                user_id: val
            },
            beforeSend: function() {
                $('#loading').removeClass('d-none');
            },
            success: function(data) {
                var output = '';
                for (var i = 0; i < data.cart_nam.length; i++) {
                    output +=
                        `<option value="${data.cart_nam[i]}" ${data.current_user==data.cart_nam[i]?'selected':''}>${data.cart_nam[i]}</option>`;
                }
                $('#cart_id').html(output);
                $('#current_customer').text(data.current_customer);
                $('#cart').empty().html(data.view);
                customer_Balance_Append(val);
            },
            complete: function() {
                $('#loading').addClass('d-none');
            }
        });
    }

    function cart_change(val) {
        let cart_id = val;
        let url = "https://6pos.6amtech.com/admin/pos/change-cart" + '/?cart_id=' + val;
        document.location.href = url;
    }

    function extra_discount() {
        let discount = $('#dis_amount').val();
        console.log(discount);
        let type = $('#type_ext_dis').val();
        if (discount) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.post({
                url: 'https://6pos.6amtech.com/admin/pos/discount',
                data: {
                    _token: 'IRlKNC2Ol9Iiy2TZJOEmjPMeOgcxOwOfiv2L6o7e',
                    discount: discount,
                    type: type,
                },
                beforeSend: function() {
                    $('#loading').removeClass('d-none');
                },
                success: function(data) {
                    if (data.extra_discount === 'success') {
                        toastr.success('Extra discount added successfully', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    } else if (data.extra_discount === 'empty') {
                        toastr.warning('Your cart is empty', {
                            CloseButton: true,
                            ProgressBar: true
                        });

                    } else {
                        toastr.warning('This discount is not applied for this amount', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }

                    $('.modal-backdrop').addClass('d-none');
                    $('#cart').empty().html(data.view);
                    if (data.user_type === 'sc') {
                        customer_Balance_Append(data.user_id);
                    }
                    $('#search').focus();
                },
                complete: function() {
                    $('.modal-backdrop').addClass('d-none');
                    $(".footer-offset").removeClass("modal-open");
                    $('#loading').addClass('d-none');
                }
            });
        }
    }

    function coupon_discount() {
        let coupon_code = $('#coupon_code').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.post({
            url: 'https://6pos.6amtech.com/admin/pos/coupon-discount',
            data: {
                _token: 'IRlKNC2Ol9Iiy2TZJOEmjPMeOgcxOwOfiv2L6o7e',
                coupon_code: coupon_code,
            },
            beforeSend: function() {
                $('#loading').removeClass('d-none');
            },
            success: function(data) {
                console.log(data);
                if (data.coupon === 'success') {
                    toastr.success('Coupon added successfully', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                } else if (data.coupon === 'amount_low') {
                    toastr.warning('This discount is not applied for this amount', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                } else if (data.coupon === 'cart_empty') {
                    toastr.warning('Your cart is empty', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                } else {
                    toastr.warning('Coupon is invalid', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }

                $('#cart').empty().html(data.view);
                if (data.user_type === 'sc') {
                    customer_Balance_Append(data.user_id);
                }
                $('#search').focus();
            },
            complete: function() {
                $('.modal-backdrop').addClass('d-none');
                $(".footer-offset").removeClass("modal-open");
                $('#loading').addClass('d-none');
            }
        });

    }

    $(document).on('ready', function() {});

    // function set_category_filter(id) {
    //     var nurl = new URL('https://6pos.6amtech.com/admin/pos');
    //     nurl.searchParams.set('category_id', id);
    //     location.href = nurl;
    // }

    // $('#search-form').on('submit', function(e) {
    //     e.preventDefault();
    //     var keyword = $('#datatableSearch').val();
    //     var nurl = new URL('https://6pos.6amtech.com/admin/pos');
    //     nurl.searchParams.set('keyword', keyword);
    //     location.href = nurl;
    // });

    function quickView(product_id) {
        $.ajax({
            url: 'https://6pos.6amtech.com/admin/pos/quick-view',
            type: 'GET',
            data: {
                product_id: product_id
            },
            dataType: 'json',
            beforeSend: function() {
                $('#loading').removeClass('d-none');
            },
            success: function(data) {
                $('#quick-view').modal('show');
                $('#quick-view-modal').empty().html(data.view);
            },
            complete: function() {
                $('#loading').addClass('d-none');
            },
        });
    }

    function addToCart(form_id) {
        let productId = form_id;
        let productQty = $('#product_qty').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.post({
            url: 'https://6pos.6amtech.com/admin/pos/add-to-cart',
            data: {
                _token: 'IRlKNC2Ol9Iiy2TZJOEmjPMeOgcxOwOfiv2L6o7e',
                id: productId,
                quantity: productQty,
            },
            beforeSend: function() {
                $('#cartloader').removeClass('d-none');
            },
            success: function(data) {
                if (data.qty == 0) {
                    toastr.warning('Product quantity end!', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                } else {
                    toastr.success('Item has been added in your cart!', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }

                $('#cart').empty().html(data.view);
                if (data.user_type === 'sc') {
                    customer_Balance_Append(data.user_id);
                }
                $('#search').val('').focus();
                $('#search-box').addClass('d-none');
            },
            complete: function() {
                $('#cartloader').addClass('d-none');

            }
        });

    }

    function removeFromCart(key) {
        $.post('https://6pos.6amtech.com/admin/pos/remove-from-cart', {
            _token: 'IRlKNC2Ol9Iiy2TZJOEmjPMeOgcxOwOfiv2L6o7e',
            key: key
        }, function(data) {

            $('#cart').empty().html(data.view);
            if (data.user_type === 'sc') {
                customer_Balance_Append(data.user_id);
            }
            toastr.info('Item has been removed from cart', {
                CloseButton: true,
                ProgressBar: true
            });
            $('#search').focus();

        });
    }

    // function emptyCart() {
    //     Swal.fire({
    //         title: 'Are you sure ',
    //         text: 'You want to remove all items from cart!!',
    //         type: 'warning',
    //         showCancelButton: true,
    //         cancelButtonColor: 'default',
    //         confirmButtonColor: '#161853',
    //         cancelButtonText: 'No',
    //         confirmButtonText: 'Yes',
    //         reverseButtons: true
    //     }).then((result) => {
    //         if (result.value) {
    //             $.post('https://6pos.6amtech.com/admin/pos/empty-cart', {
    //                 _token: 'IRlKNC2Ol9Iiy2TZJOEmjPMeOgcxOwOfiv2L6o7e'
    //             }, function(data) {
    //                 $('#cart').empty().html(data.view);
    //                 $('#search').focus();
    //                 if (data.user_type === 'sc') {
    //                     customer_Balance_Append(data.user_id);
    //                 }
    //                 toastr.info('Item has been removed from cart', {
    //                     CloseButton: true,
    //                     ProgressBar: true
    //                 });
    //             });
    //         }
    //     })

    // }

    function updateCart() {
        $.post('https://6pos.6amtech.com/admin/pos/cart-items', {
            _token: 'IRlKNC2Ol9Iiy2TZJOEmjPMeOgcxOwOfiv2L6o7e'
        }, function(data) {
            $('#cart').empty().html(data);

        });
    }

    function updateQuantity(id, qty) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.post({
            url: 'https://6pos.6amtech.com/admin/pos/update-quantity',
            data: {
                _token: 'IRlKNC2Ol9Iiy2TZJOEmjPMeOgcxOwOfiv2L6o7e',
                key: id,
                quantity: qty,
            },
            beforeSend: function() {
                $('#loading').removeClass('d-none');
            },
            success: function(data) {
                if (data.qty < 0) {
                    toastr.warning('Product quantity is not enough!', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
                if (data.upQty === 'zeroNegative') {
                    toastr.warning('Product quantity can not be zero or less than zero in cart!', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }

                $('#search').focus();
                $('#cart').empty().html(data.view);
                if (data.user_type === 'sc') {
                    customer_Balance_Append(data.user_id);
                }
            },
            complete: function() {
                $('#loading').addClass('d-none');
            }
        });



    }

    $('.js-select2-custom').each(function() {
        var select2 = $.HSCore.components.HSSelect2.init($(this));
    });

    // $('.js-data-example-ajax').select2({
    //     ajax: {
    //         // url: 'https://6pos.6amtech.com/admin/pos/customers',
    //         data: function(params) {
    //             return {
    //                 q: params.term,
    //                 page: params.page
    //             };
    //         },
    //         processResults: function(data) {
    //             return {
    //                 results: data
    //             };
    //         },
    //         // __port: function(params, success, failure) {
    //         // var $request = $.ajax(params);

    //         // $request.then(success);
    //         // $request.fail(failure);

    //         // return $request;
    //     }
    // }
    // });

    jQuery(".search-bar-input").on('keyup', function() {
        $(".search-card").removeClass('d-none').show();
        let name = $(".search-bar-input").val();
        if (name.length > 0) {
            $('#search-box').removeClass('d-none').show();
            $.get({
                url: 'https://6pos.6amtech.com/admin/pos/search-products',
                dataType: 'json',
                data: {
                    name: name
                },
                beforeSend: function() {
                    $('#loading').removeClass('d-none');
                },
                success: function(data) {
                    if (data.count == 0) {
                        $('#search-box').addClass('d-none');
                    }
                    $('.search-result-box').empty().html(data.result);
                },
                complete: function() {
                    $('#loading').addClass('d-none');
                },
            });
        } else {
            $('.search-result-box').empty();
            $('#search-box').addClass('d-none');
        }
    });

    jQuery(".search-bar-input").on('keyup', delay(function() {
        $(".search-card").removeClass('d-none').show();
        let name = $(".search-bar-input").val();
        if (name.length > 0 || isNaN(name)) {
            $.get({
                url: 'https://6pos.6amtech.com/admin/pos/search-by-add',
                dataType: 'json',
                data: {
                    name: name
                },
                success: function(data) {
                    if (data.count == 1) {
                        $('#search').attr("disabled", true);
                        addToCart(data.id);
                        $('#search').attr("disabled", false);
                        $('.search-result-box').empty().html(data.result);
                        $('#search').val('');
                        $('#search-box').addClass('d-none');
                    }
                },
            });
        } else {
            $('.search-result-box').empty();
        }
    }, 1000));



    $(document).ready(function() {
        $('#dataTable').DataTable({
            "pageLength": 10, // Number of rows to display per page
            "lengthChange": false, // Disable the length change dropdown
            "pagingType": "simple_numbers", // Simplified pagination controls
            "dom": '<"top"fi>rt<"bottom"lp><"clear">' // Remove the search input
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        const dataTable = document.getElementById('dataTable');
        const detailTableBody = document.querySelector('#detailTable tbody');
        const subtotalElement = document.getElementById('subtotal');
        const totalPriceElement = document.getElementById('total_price');
        const extraDiscountElement = document.getElementById('extra_discount');
        const taxAmountElement = document.getElementById('tax_amount');
        const discountInputElement = document.getElementById('dis_amount');
        let totalPrice = 0;
        let discountAmount = 0;
        let taxPercentage = 0;

        // Function to calculate subtotal
        function calculateSubtotal() {
            let subtotal = 0;
            document.querySelectorAll('#detailTable .selling-price').forEach(function(cell) {
                subtotal += parseFloat(cell.textContent) || 0;
            });
            subtotalElement.textContent = subtotal.toFixed(2) + ' Rs.';
            return subtotal;
        }

        // Function to calculate and update total price
        function calculateTotal() {
            const subtotal = calculateSubtotal();
            const taxAmount = (subtotal * (taxPercentage / 100)).toFixed(2);
            totalPrice = subtotal - discountAmount + parseFloat(taxAmount);

            // Display total with a sign to indicate negative amounts
            totalPriceElement.textContent = totalPrice.toFixed(2);

            // Optionally display a warning if total is negative
            if (totalPrice < 0) {
                totalPriceElement.classList.add('text-danger'); // Add a class to show warning in red color
                totalPriceElement.title = 'Total amount is negative. Discount exceeds subtotal.';
            } else {
                totalPriceElement.classList.remove('text-danger'); // Remove warning class if positive
                totalPriceElement.title = ''; // Clear warning tooltip
            }
        }

        // Function to apply extra discount
        function applyDiscount(amount) {
            discountAmount = parseFloat(amount) || 0;
            calculateTotal();
            // Update the discount display directly next to the button
            const buttonTextElement = extraDiscountElement.nextElementSibling;
            if (buttonTextElement) {
                buttonTextElement.textContent = discountAmount.toFixed(2) + ' Rs.';
            }
        }

        // Initialize values on page load
        function initializeValues() {
            subtotalElement.textContent = '0.00 Rs.';
            totalPriceElement.textContent = '0.00';
            extraDiscountElement.nextElementSibling.textContent = '0.00 Rs.';
            taxAmountElement.textContent = '0 %';
        }

        initializeValues(); // Call on page load

        // Event listener for row clicks on the data table
        dataTable.addEventListener('click', function(event) {
            const row = event.target.closest('tr');
            if (row && row.dataset.id) {
                const itemName = row.dataset.name;
                const itemSellingPrice = parseFloat(row.dataset.sellingPrice); // Original selling price

                // Add new item details
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                <td>${itemName}</td>
                <td contenteditable="true" class="qty-cell">1</td>
                <td contenteditable="true" class="selling-price" data-original-price="${itemSellingPrice.toFixed(2)}">${itemSellingPrice.toFixed(2)}</td>
                <td><button class="btn btn-danger btn-sm delete-btn">Delete</button></td>
            `;
                detailTableBody.appendChild(newRow);

                // Recalculate subtotal and total price
                calculateTotal();
            }
        });

        // Event listener for delete button clicks
        detailTableBody.addEventListener('click', function(e) {
            if (e.target.classList.contains('delete-btn')) {
                e.target.closest('tr').remove();
                calculateTotal();
            }
        });

        // Event listener for quantity and selling price cell input validation and total price update
        detailTableBody.addEventListener('keydown', function(e) {
            const cell = e.target;
            if (cell.classList.contains('qty-cell') && e.key === 'Enter') {
                e.preventDefault();
                let qty = cell.textContent.trim().replace(/,/g, '');
                qty = parseInt(qty, 10);

                if (!isNaN(qty) && qty > 0) {
                    const sellingPriceCell = cell.nextElementSibling;
                    const originalSellingPrice = parseFloat(sellingPriceCell.getAttribute(
                        'data-original-price'));
                    const totalSellingPrice = (originalSellingPrice * qty).toFixed(2);
                    sellingPriceCell.textContent = totalSellingPrice;
                    cell.blur(); // Trigger blur event
                    calculateTotal();
                } else {
                    alert('Please enter a valid number.');
                    cell.textContent = '1'; // Reset to default value
                }
            } else if (cell.classList.contains('selling-price') && e.key === 'Enter') {
                e.preventDefault();
                let sellingPrice = cell.textContent.trim().replace(/,/g, '');
                sellingPrice = parseFloat(sellingPrice);

                if (!isNaN(sellingPrice) && sellingPrice >= 0) {
                    cell.setAttribute('data-original-price', sellingPrice.toFixed(2));
                    calculateTotal();
                    cell.blur(); // Trigger blur event
                } else {
                    alert('Please enter a valid number.');
                    cell.textContent = cell.getAttribute(
                        'data-original-price'); // Reset to original value
                }
            }
        }, true);

        // Event listener for quantity and selling price cell input validation on blur
        detailTableBody.addEventListener('blur', function(e) {
            const cell = e.target;
            if (cell.classList.contains('qty-cell')) {
                let qty = cell.textContent.trim().replace(/,/g, '');
                if (!/^\d+$/.test(qty)) {
                    cell.textContent = '1'; // Reset to default value
                    alert('Please enter a valid number.');
                } else {
                    const sellingPriceCell = cell.nextElementSibling;
                    const originalSellingPrice = parseFloat(sellingPriceCell.getAttribute(
                        'data-original-price'));
                    const totalSellingPrice = (originalSellingPrice * parseInt(qty, 10)).toFixed(2);
                    sellingPriceCell.textContent = totalSellingPrice;
                }
                calculateTotal();
            } else if (cell.classList.contains('selling-price')) {
                let sellingPrice = cell.textContent.trim().replace(/,/g, '');
                if (!/^\d+(\.\d{1,2})?$/.test(sellingPrice)) {
                    cell.textContent = cell.getAttribute(
                        'data-original-price'); // Reset to original value
                    alert('Please enter a valid number.');
                } else {
                    cell.setAttribute('data-original-price', sellingPrice);
                }
                calculateTotal();
            }
        }, true);

        // Event listener for the modal submit button
        document.querySelector('#add-discount .extra-discount').addEventListener('click', function() {
            const discountAmount = parseFloat(discountInputElement.value) || 0;
            applyDiscount(discountAmount);
            $('#add-discount').modal('hide');
        });

        // Event listener for tax amount input validation and update on Enter key
        taxAmountElement.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                let tax = taxAmountElement.textContent.trim().replace(/%/g, '');
                tax = parseFloat(tax);

                if (!isNaN(tax) && tax >= 0) {
                    taxPercentage = tax;
                    taxAmountElement.setAttribute('data-value', tax.toFixed(2));
                    taxAmountElement.textContent = tax % 1 === 0 ? `${tax} %` : `${tax.toFixed(2)} %`;
                    taxAmountElement.blur(); // Remove focus to hide cursor
                    calculateTotal();
                } else {
                    alert('Please enter a valid tax percentage.');
                    taxAmountElement.textContent = '0 %'; // Reset to default value
                }
            }
        });

        // Event listener for discount input to apply discount on Enter key
        discountInputElement.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault(); // Prevent default form submission
                const discountAmount = parseFloat(discountInputElement.value) || 0;
                applyDiscount(discountAmount);
                $('#add-discount').modal('hide');
            }
        });

        // Event listener to focus on the discount input when the modal is shown
        $('#add-discount').on('shown.bs.modal', function() {
            discountInputElement.focus(); // Focus on the discount input field
        });
    });
    </script>
</body>

</html>