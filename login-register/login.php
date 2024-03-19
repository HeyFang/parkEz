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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="registration.css">
  
    <title>Login</title>
</head>
<body>
<h1>Online Parking Reservation</h1>
    <div class="container" id="registration-form">
        <?php
        if (isset($_POST["login"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                   header("Location: index.php");
                   die();
                }else {
                    echo "<div class='alert alert-danger'>Invalid password</div>";
                }
            }else {
                echo "<div class='alert alert-danger'>Invalid email</div>";
            }
        }
        ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="enter email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="enter password" id="password" class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit" name="login" value="Login" class="btn btn-success">
            </div>
        </form>
        <div id="reg"><p>Don't have an account?</p>
        <a href="registration.php">Register</a>
        </div>
    </div>
</body>
</html>