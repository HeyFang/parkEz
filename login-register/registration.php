<?php
  session_start();
  if (isset($_SESSION["user"])) {
    header("Location: index.php");
    die();
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="registration.css">
</head>
<body>
<h1>Online Parking Reservation</h1>
  <div class="container" id="registration-form">
    <?php
      if (isset($_POST["submit"])) {
        $full_Name = $_POST["full_name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $passwordRepeat = $_POST["confirm_password"];

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $errors = array();

        if (empty($full_Name) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
          array_push($errors, "full_name is required");
        }
        if ($password != $passwordRepeat) {
          array_push($errors, "password do not match");
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
          array_push($errors, "invalid email");
        }
        if (strlen($password) < 8) {
          array_push($errors, "password must be at least 8 characters");
        }
        require_once "database.php";
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($result);
        if ($rowCount > 0) {
          array_push($errors, "email already exists");
        }

        if (count($errors) > 0) {
          foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
          }
        } else {
          //we will insert the data into the database
          
          $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
          $stmt = mysqli_stmt_init($conn);
          $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
          if ($prepareStmt) {
            mysqli_stmt_bind_param($stmt, "sss", $full_Name, $email, $passwordHash);
            mysqli_stmt_execute($stmt);
            echo "<div class='alert alert-success'>Registration successful</div>";
          } else {
            die("Error: " . mysqli_error($conn));
          }
        }
      }
    ?>
    <form action="registration.php" method="post">
      <div class="form-group">
        <label for="full_name">full_name</label>
        <input type="text" class="form-control" name="full_name" placeholder="full_name">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" placeholder="email">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" placeholder="password">
      </div>
      <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" class="form-control" name="confirm_password" placeholder="confirm password">
      </div>
      <div class="form-btn">
        <input type="submit" class="btn btn-success" value="register" name="submit">
      </div>
    </form>
    <div id="reg">
      <p>alredy registered?</p><a href="login.php">Login</a>
  </div>
</body>
</html>
