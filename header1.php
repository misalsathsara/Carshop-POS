<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>AUTO LANKA CAR AUDIO</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>

<body id="page-top">
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
        <a class="navbar-brand mr-1" href="index.php">AUTO LANKA CAR AUDIO</a>
        <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Navbar Search -->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <a href="pos.php" class="btn btn-primary">
                POS
            </a>
        </form>


        <!-- Navbar -->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-plus fa-fw"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addSaleModal"> <i
                            class="fa fa-money"></i> New Sale</a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addProductModal"> <i
                            class="fa fa-tag"></i> New Product</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addProductTypeModal"> <i
                            class="fa fa-tags"></i> New Product Type</a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addProductVendorModal"> <i
                            class="fa fa-user"></i> New Product Vendor</a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addProductBrandModal"> <i
                            class="fa fa-industry"></i> New Product Brand</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addExpenseAccountModal"> <i
                            class="fa fa-dollar"></i> New Expense Account</a>
                </div>
            </li>
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-flash fa-fw"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
                    <a class="dropdown-item" href="products.php"> <i class="fa fa-tag"></i> All Products</a>
                    <a class="dropdown-item" href="product-types.php"> <i class="fa fa-tags"></i> Product Types</a>
                    <a class="dropdown-item" href="product-vendors.php"> <i class="fa fa-user"></i> Product
                        Vendors</a>
                    <a class="dropdown-item" href="product-brands.php"> <i class="fa fa-industry"></i> Product
                        Brands</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="revenue.php"> <i class="fa fa-money"></i> Revenue</a>
                    <a class="dropdown-item" href="improvements.php"> <i class="fa fa-rocket"></i> Improvements</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="accounts.php"> <i class="fa fa-dollar"></i> Accounts</a>
                </div>
            </li>
            <li class="nav-item dropdown no-arrow ml-3">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="badge badge-warning">9+</span>
                    <i class="fa fa-fw fa-bell"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
                    <a class="dropdown-item text-danger no-text-decorations" href="#"> <i class="fa fa-info-circle"></i>
                        You've few blocked products</a>
                    <a class="dropdown-item text-danger no-text-decorations" href="#"> <i class="fa fa-info-circle"></i>
                        Another new notification</a>
                    <a class="dropdown-item text-danger no-text-decorations" href="#"> <i class="fa fa-info-circle"></i>
                        Another new notification</a>
                    <a class="dropdown-item text-danger no-text-decorations" href="#"> <i class="fa fa-info-circle"></i>
                        Another new notification</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="notifications.php">See more notifications</a>
                </div>
            </li>
            <li class="nav-item dropdown no-arrow ml-3">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user-circle fa-fw"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <div class="dropdown-header">Rao Ahmed</div>
                    <a class="dropdown-item" href="profile.php"> <i class="fa fa-user"></i> Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"> <i class="fa fa-cog"></i> Settings</a>
                    <a class="dropdown-item" href="history.php"> <i class="fa fa-line-chart"></i> Activity Log</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"> <i
                            class="fa fa-power-off"></i> Logout</a>
                </div>
            </li>
        </ul>
    </nav>