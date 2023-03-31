<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
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
          if($_SESSION['role'] != "operasional"){
            header("Location: http://localhost/Raf/index");
          }else{
            include 'database' . '.php';
            if(isset($_GET['doneid'])){
              $id=addslashes($_GET['doneid']);
              $sql="update `tracking` set opsdone='done' where raf_id='$id'";
              $result=mysqli_query($con,$sql);
              $sqlg="select * from `tracking` where raf_id='$id' order by id asc";
              $resultg=mysqli_query($con,$sqlg);
              $rowg=mysqli_fetch_assoc($resultg);
              $shipper=$rowg['shipper'];
              $cusdone=$rowg['cusdone'];
              $sqlt="INSERT INTO `tracking`(`raf_id`, `shipper`,`detail`, `opsdone`,`cusdone`) VALUES ('$id','$shipper','Done','done','$cusdone')";
              $resultt=mysqli_query($con,$sqlt);
              if($result){
                  header('location:http://localhost/Raf/ops/trackingsearchdone');
              }else{
                  die(mysqli_error($con));
              }
            }elseif(isset($_GET['undoneid'])){
              $idu=addslashes($_GET['undoneid']);
              $sql="update `tracking` set opsdone='not' where raf_id='$idu'";
              $sqlt="delete from `tracking` where raf_id='$idu' and detail='Done'";
              $resultt=mysqli_query($con,$sqlt);
              $result=mysqli_query($con,$sql);
              if($result){
                  header('location:http://localhost/Raf/ops/trackingsearch');
              }else{
                  die(mysqli_error($con));
              }
            }            
          }               
        ?>

        <!-- start customer form -->
        
      </div>
      <!-- end contentpage -->
      
    </main>
    <script src="../js/script.js"></script>
    <script src="/js/bootstrap.bundle.js"></script>
  </body>
</html>