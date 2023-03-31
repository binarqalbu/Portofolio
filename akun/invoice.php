<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/raffeda.ico" />
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  </head>
  <body class="bg-content">
    <main class="aboutme d-flex">
        
      <!-- start sidebar --> 
      <?php 
            $page = 'invoice';
            include "component/sidebar" . ".php";
      ?>
      <!-- end sidebar -->

      <!-- start content page -->
      <div class="container-fluid px">

        <?php
          if($_SESSION['role'] != "akuntan"){
            header("Location: http://localhost/Raf/index");
          }               
        ?>

        <nav class="navbar container-fluid navbar-light bg-white position-sticky top-0">
          <div class="">
            <i class="fal fa-caret-circle-down h5 d-none d-md-block menutoggle fa-rotate-90"></i>
            <i class="fas fa-bars h4  d-md-none"></i>
          </div>
          <div class="topnav-right">
            <a class="h7 nav-link text-dark">Invoice</a>
          </div>
        </nav>
        <form action ="invoiceprint" method="post" target="_blank">
          <div class="form-group row">
              <label class="col-sm-2 col-form-label">Shipper</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" placeholder="Enter Shipper" name="srcshipper" list="shipperlist" autocomplete="off" required></input>  
                <datalist id="shipperlist">
                    <?php
                    include 'database' . '.php';
                      $sqls="select * from `customer`";
                      $results = mysqli_query($con,$sqls);
                      while($row=mysqli_fetch_assoc($results)){
                        echo '<option>'.$row['shipper'].'</option>';
                      }
                    ?>
                </datalist>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">From</label>
              <div class="col-sm-5">
                <input type="text" name="from_date" id="from_date" class="form-control"/>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">To</label>
              <div class="col-sm-5">
                <input type="text" name="to_date" id="to_date" class="form-control"/>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Invoice</label>
              <div class="col-sm-5">
                <input type="text" placeholder="Invoice Number" name="number" id="number" class="form-control" required/>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">N,P,W,P</label>
              <div class="col-sm-5">
                <input type="text" placeholder="Enter NPWP" name="npwp" id="npwp" class="form-control"/>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">TGL,PENG</label>
              <div class="col-sm-5">
                <input type="text" placeholder="Enter TGL,PENG" name="tglpeng" id="tglpeng" class="form-control"/>
              </div>
            </div>
            <div>&nbsp</div>
            <button type="submit" name="submit" class ="btn btn-primary btn-sm mb-2"><a style="text-decoration:none;" class="text-light">Print</a></button>
        </form>
      </div>
      <!-- end contentpage -->
    </main>
    <script src="../js/script.js"></script>
    <script src="/js/bootstrap.bundle.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>   
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script>
      $(document).ready(function(){ 
           $(function(){ 
            var d = new Date();
            var currMonth = d.getMonth();
            var currYear = d.getFullYear();
            var startDate = new Date(currYear, currMonth, 1); 
                $("#from_date").datepicker({dateFormat:'dd/mm/yy'}).datepicker("setDate", startDate);
                $("#to_date").datepicker({dateFormat:'dd/mm/yy'}).datepicker("setDate",'now');
           });  

      });  
    </script>
  </body>
</html>