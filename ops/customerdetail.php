<!-- php code -->
<?php
        include 'database' . '.php';
        if (!isset($_GET['detailid'])) {
          header("Location: http://localhost/Raf/index");
        }    
        $id=addslashes($_GET['detailid']);
        $sql="select * from `customer` where id='$id'";
        $result=mysqli_query($con,$sql);
        $row=mysqli_fetch_assoc($result);
        $shipper=$row['shipper'];
        $address=$row['address'];
        $contact=$row['contact'];
        $telephone=$row['telephone'];
        $country=$row['country'];
        $origin=$row['origin'];
        $postcode=$row['postcode'];
        if(isset($_POST['submit'])){
            $shipper=strtoupper(addslashes($_POST['shipper']));
            $address=strtoupper(addslashes($_POST['address']));
            $contact=strtoupper(addslashes($_POST['contact']));
            $telephone=addslashes($_POST['telephone']);
            $country=strtoupper(addslashes($_POST['country']));
            $origin=strtoupper(addslashes($_POST['origin']));
            $postcode=addslashes($_POST['postcode']);

          $sqlup="update `customer` set shipper='$shipper',address='$address',contact='$contact',telephone='$telephone',country='$country',origin='$origin',postcode='$postcode' where id='$id'";
          $result=mysqli_query($con,$sqlup);
          if($result){
            header('location:http://localhost/Raf/ops/customerlist');
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
    <title>Customer</title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/raffeda.ico" />
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  </head>
  <body class="bg-content">
    <main class="aboutme d-flex">

      <!-- start sidebar --> 
      <?php 
            $page = 'customer';
            include "component/sidebar" . ".php";
        ?>
      <!-- end sidebar -->

      <!-- start content page -->
      <div class="container-fluid px">

        <?php
          if($_SESSION['role'] != "operasional"){
            header("Location: http://localhost/Raf/index");
          }               
        ?>

        <!-- start top navigation -->
        <nav class="navbar container-fluid navbar-light bg-white position-sticky top-0">
          <div class="">
            <i class="fal fa-caret-circle-down h5 d-none d-md-block menutoggle fa-rotate-90"></i>
            <i class="fas fa-bars h4  d-md-none"></i>
          </div>
          <div class="topnav">
            <div class="topnav-right">
              <a class="h7 nav-link text-dark" href="customerlist">List</a>
              <a class="h7 nav-link text-dark" href="customerinput">Input</a>
            </div>
        </nav>
        <!-- end top navigation -->

        <!-- start customer form -->
        <div class="header">
                      <h5 class="title">Customer Details</h5>
                    </div>
        <form action ="" method="post">
            <div class="form-group">
              <div class="col-sm-7">
                <label>Shipper</label>
                <input type="text" class="form-control" placeholder="Enter Shipper" id="shipper" name="shipper" autocomplete="off" value="<?php echo $shipper;?>">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Address</label>
                <input type="text" class="form-control" placeholder="Enter Address" id="address" name="address" autocomplete="off" value="<?php echo $address;?>">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Contact</label>
                <input type="text" class="form-control" placeholder="Enter Contact" id="contact" name="contact" autocomplete="off" value="<?php echo $contact;?>">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Telephone/Mobile</label>
                <input type="text" class="form-control" placeholder="Enter Telephone/Mobile" id="telephone" name="telephone" autocomplete="off" value="<?php echo $telephone;?>">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Country</label>
                <input type="text" class="form-control" placeholder="Enter Country" id="country" name="country" autocomplete="off"list="countrylist" value="<?php echo $country;?>"/>
                <datalist id="countrylist">
                  <option><?php echo $country;?></option>
                  <?php
                  include 'database' . '.php';
                    $sql="select * from `country`";
                    $result = mysqli_query($con,$sql);
                    while($row=mysqli_fetch_assoc($result)){
                      echo '<option>'.$row['name'].'</option>';
                    }
                  ?>
                </datalist>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Origin (3 char)</label>
                <input type="text" class="form-control" placeholder="Enter Origin (3 char)" id="origin" name="origin" autocomplete="off" value="<?php echo $origin;?>">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Postcode</label>
                <input type="text" class="form-control" placeholder="Enter Postcode" id="postcode" name="postcode" autocomplete="off" value="<?php echo $postcode;?>">
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