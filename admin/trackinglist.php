<!-- php code -->
<?php
include 'database' . '.php';
    $sqla = "SELECT count(*) as schedule FROM tracking WHERE (raf_id, date) IN (SELECT raf_id, MAX(date) FROM tracking GROUP BY raf_id) and opsdone <> 'done' and detail ='Schedule for delivery' order by date desc";
    $resulta = mysqli_query($con,$sqla);
    $rowa=mysqli_fetch_assoc($resulta);
    $schedule=$rowa['schedule'];

    $sqlb = "SELECT count(*) as shipment FROM tracking WHERE (raf_id, date) IN (SELECT raf_id, MAX(date) FROM tracking GROUP BY raf_id) and opsdone <> 'done' and detail ='Shipment pick up' order by date desc";
    $resultb = mysqli_query($con,$sqlb);
    $rowb=mysqli_fetch_assoc($resultb);
    $shipment=$rowb['shipment'];

    $sqlc = "SELECT count(*) as received FROM tracking WHERE (raf_id, date) IN (SELECT raf_id, MAX(date) FROM tracking GROUP BY raf_id) and opsdone <> 'done' and detail like 'Shipment received by%' order by date desc";
    $resultc = mysqli_query($con,$sqlc);
    $rowc=mysqli_fetch_assoc($resultc);
    $received=$rowc['received'];
    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking</title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/raffeda.ico" />
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  </head>
  <body class="bg-content">
    <main class="aboutme d-flex">

      <!-- start sidebar --> 
      <?php 
            $page = 'tracking';
            include "component/sidebar" . ".php";
      ?>
      <!-- end sidebar -->
      
      <!-- start content page -->
      <div class="container-fluid px">
        
       <?php
          if($_SESSION['role'] != "admin"){
            header("Location: http://localhost/Raf/index");
          }               
        ?>

        <nav class="navbar container-fluid navbar-light bg-white position-sticky top-0">
          <div class="">
            <i class="fal fa-caret-circle-down h5 d-none d-md-block menutoggle fa-rotate-90"></i>
            <i class="fas fa-bars h4  d-md-none"></i>
          </div>
          <div class="topnav">
            <div class="topnav-right">
              <a class="h7 nav-link text-dark" href="trackinginput">Input</a>
              <a class="h7 nav-link text-dark" href="trackinglist">List</a>
              <a class="h7 nav-link text-dark" href="trackingsearch">Search</a>
              <a class="h7 nav-link text-dark" href="trackingsearchdone">Done</a>
            </div>
        </nav>

        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Detail</th>
              <th scope="col">Order</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Shipment pick up</td>
              <td><?php echo $shipment;?></td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Schedule for delivery</td>
              <td><?php echo $schedule?></td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Shipment received by</td>
              <td><?php echo $received;?></td>
            </tr>
          </tbody>
        </table>
        
        </div>
      </div>
      <!-- end contentpage -->
    </main>
    <script src="../js/script.js"></script>
    <script src="/js/bootstrap.bundle.js"></script>
  </body>
</html>