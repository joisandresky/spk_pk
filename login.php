<?php
include('./server/koneksi.php');
include('./server/login.php');
if(isset($_SESSION['login_user'])){
    header("location:./");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./assets/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/sweetalert.css">
    <link rel="stylesheet" href="./assets/signin.css">
    <link rel="stylesheet" href="./assets/css/font-awesome.min.css">
    <title>Login</title>

    <script src="./assets/sweetalert.min.js"></script>
</head>
<body>
    <div class="container">
        <form class="form-signin" method="POST" action="./server/login.php">
            <h2 class="form-signin-heading text-center"><i class="fa fa-user"></i> Login</h2>
                <label for="username" class="sr-only">Email address</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="username" required autofocus>
                <label for="password" class="sr-only">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="password" required>
            <button class="btn btn-lg btn-info btn-block" name="submit" type="submit">Sign in</button>
          </form>
          <div id="logo" class="text-center">
            <img src="./assets/logo.png" style="height: 100px">
        </div>
    </div>
</body>
</html>