<?php
  session_start(); // Start the session
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

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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

    .dropdown-menu {
        display: none;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .dropdown-menu.show {
        display: block;
        opacity: 1;
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
                    <!-- Logout Button -->
                    <li class="nav-item">
                        <a class="btn btn-danger rounded" href="logout.php">
                            <i class="fa fa-power-off"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Modal for Add GPS -->
    <div class="modal fade" id="addGpsModal" tabindex="-1" role="dialog" aria-labelledby="addGpsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addGpsModalLabel">Add GPS Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="myForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="appName">App Name</label>
                            <input type="text" class="form-control" id="appName" name="app_name" value="">
                        </div>
                        <div class="form-group">
                            <label for="server">Server</label>
                            <input type="text" class="form-control" id="server" name="server" value="">
                        </div>
                        <div class="form-group">
                            <label for="username">UserName</label>
                            <input type="text" class="form-control" id="username" name="username" value="">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="password" name="password" value="">
                        </div>
                        <div class="form-group">
                            <label for="simNo">Sim No</label>
                            <input type="number" class="form-control" id="simNo" name="sim_no" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="submitForm()"
                            data-dismiss="modal">Close</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
    <script>
    function submitForm() {
        var form = document.getElementById('myForm');
        var formData = new FormData(form);

        fetch('process_form.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                console.log('Form data processed:', result);

            })
            .catch(error => console.error('Error:', error));
    }
    </script>

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
                                            <th>Stock</th>
                                            <th>Item Price</th>
                                            <th>Wholesale Price</th>
                                            <th>Selling Price</th>
                                            <th>Warranty</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Category</th>
                                            <th>Name</th>
                                            <th>Stock</th>
                                            <th>Item Price</th>
                                            <th>Wholesale Price</th>
                                            <th>Selling Price</th>
                                            <th>Warranty</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($products as $index => $product) : ?>
                                        <tr data-id="<?php echo $index + 1; ?>"
                                            data-category="<?php echo htmlspecialchars($product['category']); ?>"
                                            data-name="<?php echo htmlspecialchars($product['name']); ?>"
                                            data-stock="<?php echo htmlspecialchars($product['stock']); ?>"
                                            data-price="<?php echo htmlspecialchars($product['price']); ?>"
                                            data-selling-price="<?php echo htmlspecialchars($product['selling_price']); ?>">
                                            <td><?php echo $index + 1; ?></td>
                                            <td><?php echo htmlspecialchars($product['category']); ?></td>
                                            <td><?php echo htmlspecialchars($product['name']); ?></td>
                                            <td><?php echo htmlspecialchars($product['stock']); ?></td>
                                            <td><?php echo htmlspecialchars($product['price']); ?></td>
                                            <td><?php echo htmlspecialchars($product['wholesale_price']); ?></td>
                                            <td><?php echo htmlspecialchars($product['selling_price']); ?></td>
                                            <td><?php echo htmlspecialchars($product['warranty']); ?></td>
                                            <td><button class="btn btn-primary add-to-cart-btn"
                                                    style="font-size: 1.2rem;">+</button></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                                <script>
                                document.addEventListener('DOMContentLoaded', () => {
                                    // Initialize DataTables
                                    const dataTable = $('#dataTable').DataTable({
                                        "pageLength": 10,
                                        "lengthChange": false,
                                        "pagingType": "simple_numbers",
                                        "dom": '<"top"fi>rt<"bottom"lp><"clear">',
                                    });

                                    // Custom search input
                                    const searchInput = document.getElementById('search');
                                    searchInput.addEventListener('input', () => {
                                        dataTable.search(searchInput.value).draw();
                                    });
                                });
                                </script>
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
                                    <div class="d-flex gap-2 flex-wrap align-items-center mb-3">
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
                                        <div>
                                            <a class="w-i6 d-inline-block btn btn-warning rounded" href="#"
                                                data-toggle="modal" data-target="#addGpsModal">
                                                Add GPS
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
                                                    <th>ID</th>
                                                    <th>Item</th>
                                                    <th>Qty</th>
                                                    <th>Selling Price</th>
                                                    <th style="display: none;">Old Selling Price</th>
                                                    <th style="display: none;">Customer Profit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="box p-3">
                                    <dl class="row">
                                        <dt class="col-6">Sub total :</dt>
                                        <dd class="col-6 text-right" id="subtotal">0 Rs.</dd>

                                        <dt class="col-6">Extra discount :</dt>
                                        <dd class="col-6 text-right">
                                            <button id="extra_discount" class="btn btn-sm" type="button"
                                                data-toggle="modal" data-target="#add-discount">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                            <span id="discount_amount">0.00 Rs.</span>
                                        </dd>

                                        <dt class="col-6">Total :</dt>
                                        <dd class="col-6 text-right h4 b">
                                            <span id="total_price">0</span> Rs.
                                        </dd>
                                        <style>
                                        #paid_amount {
                                            text-align: right;
                                            padding: 5px 10px;
                                            border: 1px solid #ccc;
                                            border-radius: 8px;
                                            font-size: 16px;
                                            font-weight: bold;
                                            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                                            transition: border-color 0.3s ease, box-shadow 0.3s ease;
                                            width: 100% !important;
                                        }
                                        </style>
                                        <dt class="col-6">Paid Amount :</dt>
                                        <dd class="col-6 text-right">
                                            <input type="number" id="paid_amount" data-value="0" required
                                                style="width: 75px;" />
                                        </dd>

                                        <dt class="col-6">Balance :</dt>
                                        <dd class="col-6 text-right" style="font-size: 22px; font-weight: bold;">
                                            <span id="balance" contenteditable="true" data-value="0">0 Rs.</span>
                                        </dd>
                                    </dl>
                                    <br>
                                    <div class="row g-2">
                                        <a href="save_sale.php" id="placeOrder" class="btn btn-success btn-block">
                                            <i class="fa fa-shopping-bag"></i>
                                            Place Order
                                        </a>
                                    </div>
                                </div>

                                <div class="modal fade" id="add-discount" tabindex="-1" data-dismiss="modal">
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
                                                    <button class="btn btn-sm btn-primary extra-discount" type="button"
                                                        data-dismiss="modal">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
        <style>
        .custom-alert {
            font-size: 1.4rem;
            font-weight: bold;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 22px;
            background-color: #dd5a5a;
            color: #ffffff;
            border: 1px solid #ffffff;
            border-radius: 12px;
            z-index: 1000;
            box-shadow: 2px 2px 10px 1000px rgba(0, 0, 0, 0.356);
        }

        .input-section input {
            width: 80%;
            /* Full width within the container */
            padding: 5px 10px;
            /* Add padding inside the input field */
            border: 1px solid #ccc;
            /* Light border color */
            border-radius: 8px;
            /* Rounded corners */
            font-size: 16px;
            /* Increase font size for readability */
            font-weight: bold;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Subtle shadow for depth */
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            /* Smooth transitions */
        }

        .input-section input:focus {
            border-color: #007bff;
            /* Change border color on focus */
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
            /* Enhanced shadow on focus */
            outline: none;
            /* Remove default outline */
        }

        .input-section input::placeholder {
            color: #888;
            /* Lighter color for placeholder text */
            opacity: 1;
            /* Ensure placeholder is fully opaque */
        }

        /* Optional: Additional styling for disabled state */
        .input-section input:disabled {
            background-color: #f0f0f0;
            /* Light background for disabled state */
            border-color: #ddd;
            /* Light border color for disabled state */
            cursor: not-allowed;
            /* Change cursor to indicate disabled state */
        }
        </style>
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


    document.addEventListener('DOMContentLoaded', function() {
        const dataTable = document.getElementById('dataTable');
        const detailTableBody = document.querySelector('#detailTable tbody');
        const subtotalElement = document.getElementById('subtotal');
        const totalPriceElement = document.getElementById('total_price');
        const extraDiscountElement = document.getElementById('extra_discount');
        const discountInputElement = document.getElementById('dis_amount');
        const paidAmountElement = document.getElementById('paid_amount');
        const balanceElement = document.getElementById('balance');
        let totalPrice = 0;
        let discountAmount = 0;
        let itemIdCounter = 1;

        function applyDiscount(amount) {
            discountAmount = parseFloat(amount) || 0;
            const buttonTextElement = extraDiscountElement.nextElementSibling;
            if (buttonTextElement) {
                buttonTextElement.textContent = discountAmount.toFixed(2) + ' Rs.';
            }
            calculateTotal();
        }

        function clearTables() {
            detailTableBody.innerHTML = ''; // Clear rows in detail table
            subtotalElement.textContent = '0.00 Rs.'; // Reset subtotal
            totalPriceElement.textContent = '0.00'; // Reset total price
            balanceElement.textContent = '0.00';
            discountAmount = 0; // Reset discount amount
            extraDiscountElement.nextElementSibling.textContent = '0.00 Rs.'; // Reset extra discount display
            itemIdCounter = 1; // Reset item ID counter
            paidAmountElement.textContent = '0.00'; // Reset paid amount
            paidAmountElement.value = ''; // Ensure paid amount input field is also cleared
        }

        function calculateTotal() {
            let subtotal = 0;
            let discount = 0;
            let paidAmount = 0;

            // Calculate subtotal
            detailTableBody.querySelectorAll('tr').forEach(row => {
                const price = parseFloat(row.querySelector('.selling-price').textContent) || 0;
                const quantity = parseInt(row.querySelector('.qty-input').value, 10) || 0;
                subtotal += price * quantity;
            });


            const discountText = extraDiscountElement.nextElementSibling.textContent.trim();
            discount = parseFloat(discountText) || 0;

            const totalPrice = subtotal - discount;

            const paidAmountText = paidAmountElement.value.trim();
            paidAmount = parseFloat(paidAmountText) || 0;

            const balance = totalPrice - paidAmount;

            subtotalElement.textContent = `${subtotal.toFixed(2)}`;
            totalPriceElement.textContent = `${totalPrice.toFixed(2)}`;
            balanceElement.textContent = `${balance.toFixed(2)}`;

            //     console.log(`Subtotal: ${subtotal.toFixed(2)}`);
            // console.log(`Discount: ${discount.toFixed(2)}`);
            // console.log(`Total Price: ${totalPrice.toFixed(2)}`);
            // console.log(`Paid Amount: ${paidAmount.toFixed(2)}`);
            // console.log(`Balance: ${balance.toFixed(2)}`);
        }


        dataTable.addEventListener('click', function(event) {
            if (event.target.closest('tr')) {
                const row = event.target.closest('tr');
                const id = row.getAttribute('data-id');
                const name = row.getAttribute('data-name');
                const stock = row.getAttribute('data-stock');
                const c_profit = 0.0;
                const sellingPrice = parseFloat(row.getAttribute('data-selling-price'));

                const existingRow = Array.from(detailTableBody.querySelectorAll('tr'))
                    .find(row => row.getAttribute('data-id') === id);

                if (existingRow) {
                    const qtyInput = existingRow.querySelector('.qty-input');
                    qtyInput.value = parseInt(qtyInput.value, 10) + 1;
                } else {
                    const newRow = document.createElement('tr');
                    newRow.setAttribute('data-id', id);
                    newRow.innerHTML = `
                    <td>${itemIdCounter++}</td>
                    <td class="product">${name}</td>
                    <td class="input-section"><input type="number" class="qty-input" value="1" min="1" data-stock="${stock}" /></td>
                    <td contenteditable="true" class="selling-price" data-original-price="${sellingPrice.toFixed(2)}">${sellingPrice.toFixed(2)}</td>
                    <td contenteditable="true" class="old-selling-price" style="display: none;">${sellingPrice.toFixed(2)}</td>
                    <td style="display: none;"><p class="customer_profit">${c_profit}</p></td>
                    <td><button class="btn btn-danger btn-sm delete-btn">Delete</button></td>
                `;
                    detailTableBody.appendChild(newRow);
                }

                calculateTotal(); // Update total price after adding or updating an item
            }
        });

        // Custom alert function
        function showCustomAlert(message) {
            const alertDiv = document.createElement('div');
            alertDiv.className = 'custom-alert';
            alertDiv.textContent = message;

            document.body.appendChild(alertDiv);

            // Remove alert after a few seconds
            setTimeout(() => {
                document.body.removeChild(alertDiv);
            }, 3000);
        }

        // Event listener for quantity input change
        detailTableBody.addEventListener('input', function(event) {
            if (event.target.classList.contains('qty-input')) {
                const inputField = event.target;
                const currentQuantity = parseInt(inputField.value, 10);
                const stock = parseInt(inputField.getAttribute('data-stock'), 10);

                if (currentQuantity > stock) {
                    showCustomAlert('Quantity exceeds available stock!');
                    inputField.value = ''; // Clear input
                } else {
                    const row = inputField.closest('tr');
                    const productName = row.querySelector('.product').textContent;

                    // Recalculate total price when quantity changes
                    calculateTotal();

                    // Update selling price and customer profit on quantity change
                    updateSellingPrice(row, productName, currentQuantity)
                        .then(() => {
                            // Ensure updateCustomerProfit is called after updateSellingPrice
                            updateCustomerProfit(row);
                        })
                        .catch(error => {
                            console.error('Error updating selling price:', error);
                        });
                }
            }
        });

        // Event listener for paid amount input change
        document.getElementById('paid_amount').addEventListener('input', function() {
            calculateTotal();
        });





        function updateCustomerProfit(row) {
            console.log('updateCustomerProfit stated'); // Debug: Check if function is called

            // Ensure row is passed as a parameter to the function
            if (!row) {
                console.error('Row parameter is required');
                return;
            }

            // Fetch the new selling price
            const sellingPriceElement = row.querySelector('.selling-price');
            const newSellingPrice = parseFloat(sellingPriceElement.textContent) || 0;

            // Fetch the old selling price
            const oldSellingPriceElement = row.querySelector('.old-selling-price');
            const oldSellingPrice = parseFloat(oldSellingPriceElement.textContent) || 0;

            // Calculate customer profit
            const customerProfit = oldSellingPrice - newSellingPrice;

            if (newSellingPrice == "") {
                customerProfit = 0.00;
            }

            // Update the customer profit display
            const customerPriceElement = row.querySelector('.customer_profit');
            if (customerPriceElement) {
                customerPriceElement.textContent = customerProfit.toFixed(2);
            } else {
                console.error('Customer profit element not found');
            }

            console.log(`Customer Profit: ${customerProfit.toFixed(2)}`);
        }



        function updateSellingPrice(row, productName, quantity) {
            console.log(
                `Fetching new selling price for ${productName} with quantity ${quantity}`
            ); // Debug: Output fetch request details

            return fetchSellingPrice(productName, quantity) // Ensure this returns a Promise
                .then(newPrice => {
                    if (isNaN(newPrice)) {
                        throw new Error('Invalid selling price received');
                    }
                    console.log(
                        `New selling price received: ${newPrice}`); // Debug: Output new selling price
                    const sellingPriceElement = row.querySelector('.selling-price');
                    if (sellingPriceElement) {
                        sellingPriceElement.textContent = newPrice.toFixed(2); // Ensure correct formatting
                    } else {
                        console.error('Selling price element not found');
                    }
                    // Return a resolved Promise to allow chaining
                    return Promise.resolve();
                });
        }



        function fetchSellingPrice(productName, quantity) {
            return new Promise((resolve, reject) => {
                console.log(
                    `Sending AJAX request for product: ${productName}, Quantity: ${quantity}`
                ); // Debug: Output AJAX request info

                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'fetch_selling_price.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        try {
                            const cleanedResponse = xhr.responseText.replace(/,/g, '').trim();
                            const response = parseFloat(cleanedResponse);
                            if (isNaN(response)) {
                                throw new Error('Invalid response format');
                            }
                            console.log(
                                `AJAX response: ${xhr.responseText}`
                            ); // Debug: Output AJAX response
                            resolve(response);
                        } catch (error) {
                            console.error('Error processing response:', error.message);
                            reject('Error processing response');
                        }
                    } else {
                        console.error('AJAX request failed with status:', xhr.status);
                        reject('Failed to fetch selling price');
                    }
                };
                xhr.onerror = function() {
                    console.error('AJAX request error');
                    reject('Request error');
                };
                xhr.send(`product_name=${encodeURIComponent(productName)}&quantity=${quantity}`);
            });
        }



        discountInputElement.addEventListener('input', function() {
            applyDiscount(this.value, 10);
        });

        detailTableBody.addEventListener('click', function(event) {
            if (event.target.classList.contains('delete-btn')) {
                const row = event.target.closest('tr');
                row.remove();
                calculateTotal(); // Recalculate total price after deleting a row
            }
        });

        document.querySelector('#add-discount .extra-discount').addEventListener('click', function() {
            const discountAmount = discountInputElement.value;
            applyDiscount(discountAmount); // Apply the discount
            $('#add-discount').modal('hide'); // Hide the modal
        });

        function calculateCustomerProfit() {
            let totalCustomerProfit = 0;

            detailTableBody.querySelectorAll('tr').forEach(row => {
                const cProfitElement = row.querySelector('.customer_profit');
                const qtyInputElement = row.querySelector('.qty-input');

                // Ensure the elements exist and fetch their values
                if (cProfitElement && qtyInputElement) {
                    const cProfit = parseFloat(cProfitElement.textContent) || 0;
                    const qty = parseFloat(qtyInputElement.value) || 0; // Use value of the input field

                    // Calculate customer profit for this row
                    const rowCustomerProfit = cProfit * qty;
                    totalCustomerProfit += rowCustomerProfit;

                    // Log values for debugging
                    console.log(
                        `Row data - cProfit: ${cProfit}, qty: ${qty}, rowCustomerProfit: ${rowCustomerProfit}`
                    );
                }
            });

            const discountText = extraDiscountElement.nextElementSibling.textContent.trim();
            const discount = parseFloat(discountText) || 0;

            const finalCustomerProfit = totalCustomerProfit + discount;

            // Log final values for debugging
            console.log(`Total Customer Profit: ${totalCustomerProfit}`);
            console.log(`Discount: ${discount}`);
            console.log(`Final Customer Profit: ${finalCustomerProfit}`);

            return finalCustomerProfit;
        }


        document.querySelector('a[href="save_sale.php"]').addEventListener('click', function(event) {
            event.preventDefault();

            console.log('sahsahsuhas');
            const rows = document.querySelectorAll('#detailTable tbody tr');
            const numberOfItem = rows.length;

            // Calculate total quantity
            const totalQty = Array.from(rows).reduce((acc, row) => {
                const qtyInput = row.querySelector('.qty-input');
                return acc + (parseInt(qtyInput.value, 10) || 0);
            }, 0);

            // Calculate total price
            const total = parseFloat(totalPriceElement.textContent) || 0;

            // Calculate total discount
            const totalDiscount = parseFloat(document.getElementById('discount_amount')
                    .textContent) ||
                0;

            // Calculate paid amount
            const paidAmount = parseFloat(paidAmountElement.value) || 0;

            // Calculate customer profit
            const customerProfit = calculateCustomerProfit();

            // Check if paid amount is zero
            if (paidAmount <= 0) {
                alert('Please enter a valid paid amount.');
                return;
            }

            // Collect all product data
            const products = Array.from(rows).map(row => {
                return {
                    productName: row.querySelector('.product').textContent.trim(),
                    qty: parseInt(row.querySelector('.qty-input').value, 10) || 0,
                    sellPrice: parseFloat(row.querySelector('.selling-price')
                        .textContent) || 0,
                    totalPrice: parseFloat(row.querySelector('.selling-price')
                        .textContent) * (
                        parseInt(row.querySelector('.qty-input').value, 10) || 0)
                };
            });

            // Send data to the server
            fetch('save_sale.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({
                        numberOfItem: numberOfItem,
                        totalQty: totalQty,
                        total: total,
                        totalDiscount: totalDiscount,
                        customerProfit: customerProfit,
                        subTotal: parseFloat(subtotalElement.textContent) || 0,
                        paidAmount: paidAmount,
                        balance: paidAmount - total,
                        items: JSON.stringify(products) // Send products data as JSON
                    })
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    if (data.includes('Sale saved successfully!')) {
                        clearTables(); // Clear tables and reset variables
                    }
                })
                .catch(error => console.error('Error:', error));
        });


    });
    </script>

</body>

</html>