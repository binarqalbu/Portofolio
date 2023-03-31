<!-- php code -->
<?php
  include 'database' . '.php';
  if(isset($_POST['submit'])){
    $id=addslashes($_POST['raf_id']);
    $detail=addslashes($_POST['detail']);
    $date=addslashes($_POST['date']);
    $date = str_replace('/', '-', $date);
    $newdate=date("Y-m-d", strtotime($date));
    $time=addslashes($_POST['time']);
    
    if(empty($_POST['receiver'])){
        $receiver="";
    }else{
        $receiver=$_POST['receiver'];
    }

    $sql="INSERT INTO `tracking`(`raf_id`, `date`, `detail`) VALUES ('$id','$newdate $time:00','$detail $receiver')";
    $result=mysqli_query($con,$sql);
    if($result){
        header('location:http://localhost/Raf/admin/trackingsearch');
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

        <form action ="" method="post">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Airwaybill</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" placeholder="Enter Airwaybill" name="raf_id" list="raflist" value="<?php if(!empty($_GET['inputid'])){echo addslashes($_GET['inputid']);}?>" autocomplete="off" required></input>  
                <datalist id="raflist">
                  <?php
                  include 'database' . '.php';
                    $sqls="select distinct raf_id from `tracking` where opsdone <> 'done'";
                    $results = mysqli_query($con,$sqls);
                    while($row=mysqli_fetch_assoc($results)){
                      echo '<option>'.$row['raf_id'].'</option>';
                    }
                  ?>
                </datalist>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Detail</label>
              <div class="col-sm-5">
                <select name="detail" id="detail" class="form-control">
                  <option value="Shipment pick up">Shipment pick up</option>
                  <option value="Schedule for delivery">Schedule for delivery</option>
                  <option value="Shipment received by :">Shipment received by:</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Receiver Name</label>
              <div class="col-sm-5">
                  <input type="text" disabled="disabled" name="receiver" id="receiver" class="form-control"/>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Date</label>
              <div class="col-sm-5">
                <input type="text" name="date" id="date" class="form-control"/>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Time</label>
              <div class="col-sm-5">
                <input type="time" name="time" id="time" class="form-control" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date('H:i') ?>"/>
              </div>
            </div>
            <div>&nbsp</div>
            <button type="submit" name="submit" class ="btn btn-primary btn-sm mb-2"><a style="text-decoration:none;" class="text-light">Submit</a></button>
        </form>
      </div>
      <!-- end contentpage -->
    </main>
    <script src="../js/script.js"></script>
    <script src="/js/bootstrap.bundle.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>   
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script>
      $(document).ready(function(){ 
           $(function(){ 
                $("#date").datepicker({dateFormat:'dd/mm/yy'}).datepicker("setDate", 'now');
                $("#time").timepicker({ timeFormat: 'h:mm p'});
           });  


      });
    </script> 
    <script>
    $('#detail').on('change', function(){
      if ($(this).val() == 'Shipment received by :') { //check the selected option etc.
          $("#receiver").prop('disabled', false);
      } else {
          $("#receiver").prop('disabled', true);
      }
    });
    </script> 
  </body>
</html>