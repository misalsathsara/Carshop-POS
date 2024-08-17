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
    <style>
        .navbar {
            background-color: #ffffff; /* White background for the header */
            border-bottom: 1px solid #ddd; /* Optional: Add a subtle border at the bottom */
        }
        .navbar-brand img {
            max-width: 150px;
            height: auto;
        }
        .navbar-nav .nav-item {
            margin-left: 1rem;
        }
        .btn-logout {
            margin-top: 0.3rem;
            font-weight: bold;
            letter-spacing: 1px;
            color: #fff; /* White text color for logout button */
            background-color: #dc3545; /* Red background color for logout button */
            border: none; /* Remove border */
            text-decoration: none; /* Remove underline */
            padding: 0.5rem 1rem; /* Adjust padding to look like a button */
            border-radius: 0.25rem; /* Rounded corners for the button */
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-logout:hover {
            background-color: #c82333; /* Darker red on hover */
        }
        .btn-logout i {
            margin-right: 0.5rem; /* Space between icon and text */
        }
    </style>
</head>

<body id="page-top">
    <nav class="navbar navbar-expand navbar-light static-top">
        <a class="navbar-brand mr-1" href="index.php">
            <img src="logo.png" alt="AUTO LANKA CAR AUDIO">
        </a>
        <button class="btn btn-link btn-sm text-dark order-1 order-sm-0" id="sidebarToggle" href="#">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Navbar Search -->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" style="width: 100%; display: flex; text-align: center;">
            <a href="pos.php" class="btn btn-primary" target="_blank" style="width: 20%; letter-spacing: 10px; font-weight: bolder;">
                POS
            </a>
        </form>

        <!-- Navbar -->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item">
                <a class="btn btn-logout" href="https://autolankacaraudiopersonalpos.cc/login.php">
                    <i class="fa fa-power-off"></i> Logout
                </a>
            </li>
        </ul>
    </nav>

    <!-- Page Content -->
    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Your content goes here -->
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="js/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>