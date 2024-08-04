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
            <li class="breadcrumb-item active">404 Error</li>
          </ol>
          <!-- Page Content -->
          <h1 class="display-1">404</h1>
          <p class="lead">Page not found. You can
            <a href="javascript:history.back()">go back</a>
            to the previous page, or
            <a href="index.php">return home</a>.</p>
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
    <script src="js/rc-pos.min.js"></script>
  </body>
</html>
