<!-- php code -->
<?php
    include 'database' . '.php';
    if (!isset($_GET['sellingid'])) {
      header("Location: http://localhost/Raf/index");
      }
    $id=addslashes($_GET['sellingid']);
    $sql="select * from `airwaybill` where id_shipment='$id'";
    $result=mysqli_query($con,$sql);
    $row=mysqli_fetch_assoc($result);
    $id=$row['id_shipment'];
    $date=$row['date'];
    $newdate=date("d/m/Y", strtotime($date)); 
    $courier=$row['courier'];
    $destination=$row['country'];
    $weight=$row['weight'];
    $details_of_shipment=substr(strtoupper($row['details_of_shipment']),0,3);
    $price=$row['price'];
    $emergency_fee=$row['emergency_fee'];
    $fuel_surcharges=$row['fuel_surcharges'];
    $additional_fee=$row['additional_fee'];
    if(isset($_POST['submit'])){
        $price=addslashes($_POST['price']);
        $emergency_fee=addslashes($_POST['emergency_fee']);
        $fuel_surcharges=addslashes($_POST['fuel_surcharges']);
        $additional_fee=addslashes($_POST['additional_fee']);

        $sqlup="update `airwaybill` set price='$price',emergency_fee='$emergency_fee',fuel_surcharges='$fuel_surcharges',additional_fee='$additional_fee' where id_shipment='$id'";
        $result=mysqli_query($con,$sqlup);
        if($result){
        header('location:http://localhost/Raf/admin/selling');
        }else{
        die(mysqli_error($con));
        }
        
        
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selling</title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/raffeda.ico" />
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  </head>
  <body class="bg-content">
    <main class="aboutme d-flex">

      <!-- start sidebar --> 
      <?php 
            $page = 'selling';
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
          <div class="topnav-right">
            <a class="h7 nav-link text-dark">Selling</a>
          </div>
        </nav>

        <!-- start customer form -->
        <div class="header">
                      <h5 class="title">Selling Details</h5>
                    </div>
        <form action ="" method="post">
            <div class="form-group">
              <div class="col-sm-7">
                <label>Raffeda</label>
                <input type="text" class="form-control" value="RAF<?php echo $id;?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>DHL</label>
                <input type="text" class="form-control" value="<?php echo $courier;?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Destination</label>
                <input type="text" class="form-control" value="<?php echo $destination;?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Weight</label>
                <input type="text" class="form-control" value="<?php echo $weight;?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Details</label>
                <input type="text" class="form-control" value="<?php echo substr(strtoupper($details_of_shipment),0,3);?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Price</label>
                <input type="type" class="form-control" placeholder="Enter Price" id="price" name="price" autocomplete="off" value="<?php if($price!=0){echo $price;}?>" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Emergency Fee</label>
                <input type="type" class="form-control" placeholder="Enter Emergency Fee" id="emergency_fee" name="emergency_fee" autocomplete="off" value="<?php if($emergency_fee!=0){echo $emergency_fee;}?>">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Fuel Surcharges</label>
                <input type="type" class="form-control" placeholder="Enter Fuel Surcharges" id="fuel_surcharges" name="fuel_surcharges" autocomplete="off" value="<?php if($fuel_surcharges!=0){echo $fuel_surcharges;}?>">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Additional Fee</label>
                <input type="type" class="form-control" placeholder="Enter Additional Fee" id="additional_fee" name="additional_fee" autocomplete="off" value="<?php if($additional_fee!=0){echo $additional_fee;}?>">
              </div>
            </div>
            <div>&nbsp</div>
            <button type="button" class="btn btn-primary butgap" onclick="history.back()">Back</button>
            <button type="submit" name="submit" class="btn btn-primary butgap">Submit</button>
        </form>
        <!-- start customer form -->
      </div>
      <!-- end contentpage -->
    </main>
    <script src="../js/script.js"></script>
    <script src="/js/bootstrap.bundle.js"></script>
  </body>
</html>