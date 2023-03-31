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
            $page = 'airwaybill';
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
            if(isset($_GET['deleteid'])){
              $id=addslashes($_GET['deleteid']);
              $sql="delete from  `airwaybill` where id_shipment='$id'";
              $result=mysqli_query($con,$sql);
              $sqlt="delete from  `tracking` where raf_id='$id'";
              $resultt=mysqli_query($con,$sqlt);
              $sqlp="delete from  `pieces_detail` where raf_id='$id'";
              $resultp=mysqli_query($con,$sqlp);
              if($result && $resultt){
              header('location:http://localhost/Raf/ops/airwaybillsearch');
            
              }else{
                die(mysqli_error($con));
              }
            }else{
              header('location:http://localhost/Raf/ops/airwaybillsearch');
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