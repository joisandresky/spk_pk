<?php
// include('./server/session.php');
// if (!isset($_SESSION['login_user'])){
//   header("Location:login.php");
// }
?>

<!DOCTYPE html>
<html lang="en" ng-app="myApp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Load Assets -->
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="./assets/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/sweetalert.css">
    <link rel="stylesheet" href="./assets/css/font-awesome.min.css">

    <!-- Load JS FIle -->
    <script src="./assets/pembulat.js"></script>
    <script src="./assets/jquery-3.2.0.min.js"></script>

    <!-- Load AngularJS Module -->
    <script src="./assets/ng/angular.min.js"></script>
    <script src="./assets/ng/angular-route.js"></script>
    <script src="./assets/ng/angular-animate.js"></script>
    <script src="./assets/ng/dirPagination.js"></script>
    <script src="./app.js"></script>

    <!-- Load Controllers -->
    <script src="./controllers/ProdVarController.js"></script>
    <script src="./controllers/PKVController.js"></script>
    <script src="./controllers/HomeController.js"></script>
    <script src="./controllers/CacatController.js"></script>
    <script src="./controllers/THController.js"></script>
    <script src="./controllers/ProdukController.js"></script>
    <script src="./controllers/PController.js"></script>
    <script src="./controllers/FMEAController.js">

    </script>

    <!-- Load JS Assets -->
    <script src="./assets/sweetalert.min.js"></script>
    <script src="./assets/highchart.src.js"></script>

    <script src="./assets/bootstrap.min.js"></script>
    <title>Sistem Pengendali Kualitas</title>
</head>
<body>
<!-- Navigation Bar -->
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Sistem Pengendali Kualitas</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
                <li><a href="#/"><i class="fa fa-home"></i> Home</a></li>
                <li class="dropdown myClass">
                    <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-dashboard"></i> Dashboard <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#/dashboard/produksi"><i class="fa fa-inbox"></i>  Produksi Atribut</a></li>
                        <li><a href="#/dashboard/produksi-variable"><i class="fa fa-inbox"></i> Produksi Variable</a></li>
                        <li><a href="#/dashboard/peta-kendali"><i class="fa fa-check-square-o"></i>  Peta Kendali Atribut</a></li>
                        <li><a href="#/dashboard/peta-kendali-variable"><i class="fa fa-check-square-o"></i>  Peta Kendali Variable</a></li>
                        <li><a href="#/dashboard/fmea"><i class="fa fa-remove"></i> FMEA</a></li>
                    </ul>
                </li>
                <li class="dropdown myClass">
                    <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-industry"></i> Master Data <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#/master/produk"><i class="fa fa-database"></i>  Product</a></li>
                        <li><a href="#/master/cacat"><i class="fa fa-database"></i>  Cacat</a></li>
                    </ul>
                </li>
                <li><a href="./server/logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                <li><a href="#/"><img src="./assets/logo.png" style="height: 25px"></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <!-- Main View App -->
    <div class="container">
        <div id="main" ng-view></div>
    </div>
</body>
</html>
