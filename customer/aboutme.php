<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Me</title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/raffeda.ico" />
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  </head>
  <body class="bg-content">
    <main class="aboutme d-flex">

      <!-- start sidebar --> 
      <?php 
            $page = 'aboutme';
            include "component/sidebar" . ".php";
        ?>
      <!-- end sidebar -->

      <!-- start content page -->
      <div class="container-fluid px">
      <?php
        if($_SESSION['role'] != "customer"){
          header("Location: http://localhost/Raf/index");
        }               
      ?>
        <nav class="navbar container-fluid navbar-light bg-white position-sticky top-0">
          <div class="">
            <i class="fal fa-caret-circle-down h5 d-none d-md-block menutoggle fa-rotate-90"></i>
            <i class="fas fa-bars h4  d-md-none"></i>
          </div>
          <div class="topnav-right">
            <a class="h7 nav-link text-dark">About Me</a>
          </div>
        </nav>
        <div class="d-flex flex-column align-items-center text-center gap-2">
          <ul class="list-group">
            <li class="list-group-item">Username : <?php echo $_SESSION['username']; ?></li>
            <li class="list-group-item"><?php echo $_SESSION['shipper']; ?></li>
          </ul>
        </div>
      </div>
      <!-- end contentpage -->
    </main>
    <script src="../js/script.js"></script>
    <script src="/js/bootstrap.bundle.js"></script>
  </body>
</html>