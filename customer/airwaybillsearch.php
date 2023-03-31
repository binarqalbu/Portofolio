<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airwaybill</title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/raffeda.ico" />
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  </head>
  <body class="bg-content">
    <main class="aboutme d-flex">
        
      <!-- start sidebar --> 
      <?php 
            $page = 'airwaybill';
            include "component/sidebar" . ".php";
      ?>
      <!-- end sidebar -->

      <!-- start content page -->
      <div class="container-fluid px">
        <?php
          if($_SESSION['role'] != "customer"){
            header("Location: http://localhost/Raf/index");
          } 
          $shippers=strtoupper($_SESSION['shipper']);               
        ?>
        <nav class="navbar container-fluid navbar-light bg-white position-sticky top-0">
          <div class="">
            <i class="fal fa-caret-circle-down h5 d-none d-md-block menutoggle fa-rotate-90"></i>
            <i class="fas fa-bars h4  d-md-none"></i>
          </div>
          <div class="topnav-right">
            <a class="h7 nav-link text-dark" href="airwaybillinput">Input</a>
            <a class="h7 nav-link text-dark" href="airwaybillsearch">Search</a>
          </div>
        </nav>

        <!-- start filter -->
          <form method="post" class="float-end">
              <input type="text" name="from_date" id="from_date" class=""/>    
              <input type="text" name="to_date" id="to_date" class=""/>  
              <input type="text" class =""placeholder="Search Data" name="search"></input>
            <button class="btn btn-dark btn-sm" name="submitsrc">Submit</button>
          </form>
        <!-- end filter -->
        
        <!-- start airwaybill list--> 
        <div class="customer">
            <table class="table table-responsive">
                <thead>
                    <th style="width:10%">Date</th>
                    <th style="width:10%">Airwaybill</th>
                    <th style="width:18%">Shipper</th>
                    <th style="width:18%">Consignee</th>
                    <th style="width:10%">Attention</th>
                    <th style="width:10%">Destination</th>
                    <th style="width:6%">Weight</th>
                    <th style="width:13%">Action</th>
                </thead>
                <tbody>
                <?php include 'database' . '.php'; 
                          
                  //if search condition
                  if(isset($_POST['submitsrc'])){
                    $search=addslashes($_POST['search']);
                    $from=addslashes($_POST['from_date']);
                    $newfrom=date("Y-m-d", strtotime($from));
                    $to=addslashes($_POST['to_date']);
                    $to = str_replace('/', '-', $to);
                    $newto=date("Y-m-d", strtotime($to));
                    if( $search!=""){
                      $sql ="Select * from `airwaybill` where date between '$newfrom' and '$newto' and shipper like '%$shippers%' and (id_shipment like '%$search%' or consignee like '%$search%' or contact like '%$search%'or country like '%$search%') order by datetime desc";
                      $result = mysqli_query($con,$sql);
                    }else{
                      $sql ="Select * from `airwaybill` where date between '$newfrom ' and '$newto' and shipper like '%$shippers%' order by datetime desc";
                      $result = mysqli_query($con,$sql);
                    } 
                  }
                  // not search condition
                  else{
                    $sql = "SELECT * FROM airwaybill where shipper like '%$shippers%' order by datetime desc";
                    $result = mysqli_query($con,$sql);
                  }
                  
                  if($result){
                    while($row=mysqli_fetch_assoc($result)){
                      $id=$row['id_shipment'];
                      $date=$row['date'];
                      $newdate=date("d/m/Y", strtotime($date)); 
                      $shipper=$row['shipper'];
                      $consignee=$row['consignee'];
                      $attention=$row['contact'];
                      $destination=$row['country'];
                      $weight=$row['weight'];
                      echo'<tr>'; 
                      echo'<td>'.$newdate.'</td>';
                      echo'<td>RAF'.$id.'</td>';
                      echo'<td>'.$shipper.'</td>';
                      echo'<td>'.$consignee.'</td>';
                      echo'<td>'.$attention.'</td>';
                      echo'<td>'.$destination.'</td>';
                      echo'<td>'.$weight.'</td>';
                      echo'<td>';
                      echo'<button type="button" class="btn btn-success btn-sm"><a href="airwaybilldetail?detailid='.$id.'" style="text-decoration:none;" class="text-light">Detail</a></button>';
                      echo'<button type="button" class ="btn btn-dark btn-sm"><a href="airwaybillprint?printid='.$id.'" target="_blank" style="text-decoration:none;" class="text-light">Print</a></button>';
                      echo'</td>'; 
                      echo'</tr>';
                    
                    }
                    }
                  ?>
                </tbody>
            </table>
        </div>
        <!-- end airwaybill list -->
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
    <script>
      function confirmationDelete(anchor)
      {
        var conf = confirm('Are you sure want to delete this record?');
        if(conf)
            window.location=anchor.attr("href");
      }
    </script>
  </body>
</html>