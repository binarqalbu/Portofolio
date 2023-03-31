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
        
        <!-- start serachbar -->
        <form method="post" class="float-end">
          <input type="text" class =""placeholder="Search Data" name="search"></input>
          <button class="btn btn-dark btn-sm" name="submitsrc">Submit</button>
        </form>
        <!-- end searchbar -->

        <!-- start tracking list--> 
        <div class="tracking">
            <table class="table table-responsive">
                <thead>
                    <th style="width:25%">Airwaybill</th>
                    <th style="width:25%">Date</th>
                    <th style="width:25%">Detail</th>
                    <th style="width:25%">Action</th>
                </thead>
                <tbody>
                <?php include 'database' . '.php'; 
                          //if search condition
                            if(isset($_POST['submitsrc'])){
                              $search=addslashes($_POST['search']);
                              $sql ="SELECT * FROM tracking WHERE (raf_id, date) IN (SELECT raf_id, MAX(date) FROM tracking GROUP BY raf_id) and raf_id like '%$search%' and opsdone = 'done' order by date desc";
                              $result = mysqli_query($con,$sql);
                            }
                            //not search condition
                            else{
                              $sql = "SELECT * FROM tracking WHERE (raf_id, date) IN (SELECT raf_id, MAX(date) FROM tracking GROUP BY raf_id) and opsdone = 'done' order by date desc";
                              $result = mysqli_query($con,$sql);  
                            }
                          if($result){
                            while($row=mysqli_fetch_assoc($result)){
                              $id=$row['id'];
                              $raf_id=$row['raf_id'];
                              $date=$row['date'];
                              $detail=$row['detail'];
                              echo'<tr>'; 
                              echo'<td>'.$raf_id.'</td>';
                              echo'<td>'.$date.'</td>';
                              echo'<td>'.$detail.'</td>';
                              echo'<td>';
                              echo'<button type="button" class ="btn btn-info btn-sm"><a data-bs-toggle="modal" data-bs-target="#exampleModal'.$raf_id.'" data-id='.$raf_id.' style="text-decoration:none;" class="text-light">Detail</a></button>';
                              echo'<button type="button" class ="btn btn-success btn-sm"><a href="trackingdone?undoneid='.$raf_id.'" style="text-decoration:none;" onclick="javascript:confirmationDelete($(this));return false;" class="text-light">UnDone</a></button>';
                              echo'</td>'; 
                              echo'</tr>';
                              echo'<div class="modal fade" id="exampleModal'.$raf_id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                                echo'<div class="modal-dialog">';
                                  echo'<div class="modal-content">';
                                    echo'<div class="modal-header">';
                                      echo'<h5 class="modal-title" id="exampleModalLabel">Tracking Detail</h5>';
                                      echo'<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                                    echo'</div>';
                                    echo'<div class="modal-body">';
                                      $sqld ="SELECT * FROM tracking WHERE raf_id like '%$raf_id%' and opsdone = 'done' order by date asc";
                                      $resultd = mysqli_query($con,$sqld);
                                      echo'<div class="d-flex flex-column align-items-center text-center gap-2">';
                                        echo'<ul class="list-group">';
                                        if($resultd){
                                        while($rowd=mysqli_fetch_assoc($resultd)){
                                          $date=$rowd['date'];
                                          $detail=$rowd['detail'];
                                          echo'<li class="list-group-item">'.$detail.' at '.$date.'</li>';
                                        }
                                        }
                                        echo'</ul>';
                                      echo'</div>';
                                    echo'</div>';
                                    echo'<div class="modal-footer">';
                                      echo'<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
                                    echo'</div>';
                                  echo'</div>';
                                echo'</div>';
                              echo'</div>';
                            }
                            }
                      ?>
                </tbody>
            </table>
        </div>
        <!-- end tracking list -->

      </div>
      <!-- end contentpage -->
    </main>
    <script src="../js/script.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>   
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script>
    function confirmationDelete(anchor)
    {
      var conf = confirm('Are you sure want to undone this shipment?');
      if(conf)
          window.location=anchor.attr("href");
    }
  </script>
  </body>
</html>