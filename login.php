<?php
include 'db.php';
session_start();
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $position = $_POST['position'];

    if ($position == 'admin') {
        $sql = "SELECT * FROM admin WHERE Name = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $password2 = $row['password'];

                // Note: Here you should use password_verify() if passwords are hashed
                if ($password == $password2) {
                    $_SESSION['position'] = "admin";
                    header('location:index.php');
                } else {
                    $message = "Password Incorrect!";
                }
            } else {
                $message = "Admin not Found!";
            }

            $stmt->close();
        } else {
            $message = "Error preparing the statement!";
        }

    } else if ($position == 'cashier') {
        $sql = "SELECT * FROM employee WHERE Name = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $password2 = $row['password'];

                // Note: Here you should use password_verify() if passwords are hashed
                if ($password == $password2) {
                    $_SESSION['position'] = "cashier";
                    header('location:index.php');
                    exit();
                } else {
                    $message = "Password Incorrect!";
                }
            } else {
                $message = "Cashier not Found!";
            }

            $stmt->close();
        } else {
            $message = "Error preparing the statement!";
        }
    }
}
?>

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
    <link href="css/styles.css" rel="stylesheet">
    <style>
form {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  border-radius: 5px;
}

.form-group {
  margin-bottom: 15px;
}

.form-label-group {
  position: relative;
  margin-bottom: 1rem;
}

.form-label-group input {
  border-radius: 0.25rem;
  padding: 0.75rem 1.25rem;
  border: 1px solid #ccc;
}

.form-label-group select {
  border-radius: 0.25rem;
  padding: 0.75rem 1.25rem;
  border: 1px solid #ccc;
  width: 100%;
}

.form-label-group label {
  position: absolute;
  top: 0;
  left: 0;
  padding: 0.75rem 1.25rem;
  pointer-events: none;
  transition: all 0.2s ease-in-out;
  color: #6c757d;
}

.form-control:focus {
  border-color: #80bdff;
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
}

.submit {
  margin-top: 20px;
}

.message {
  margin-top: 10px;
}

/* Responsive styling */
@media (max-width: 768px) {
  form {
    padding: 15px;
  }

  .form-label-group input,
  .form-label-group select {
    width: 100%;
  }
}

@media (max-width: 576px) {
  .form-group {
    margin-bottom: 10px;
  }

  .form-label-group input,
  .form-label-group select {
    padding: 0.5rem;
  }
}

</style>
  </head>
  <body class="bg-dark">
    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header bg-primary text-white">Login to account</div>
        <div class="card-body">

          <form action="" method="post">
          <div class="form-group">
              <div class="form-label-group">
                <select name="position" id="">
                  <option value="admin">Admin</option>
                  <option value="employee">Cashier</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="username" name="username" class="form-control" placeholder="username" required="required" autofocus="autofocus">
                <label for="username">Enter username</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="required">
                <label for="inputPassword">Password</label>
              </div>
            </div>
            <div class="message" style="color:red;"><?php echo isset($message)? $message : '' ; ?></div>
            <button class="submit btn btn-primary btn-block"  type="submit">Login</button>
            <!-- <a class="btn btn-primary btn-block" type="submit">Login</a> -->
          </f>
          </form>
        </div>
      </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
  </body>
</html>
