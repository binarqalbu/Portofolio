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
            $page = 'customer';
            include "component/sidebar" . ".php";
        ?>
      <!-- end sidebar -->

      <!-- start content page -->
      <div class="container-fluid px">

        <?php
          if($_SESSION['role'] != "admin"){
            header("Location: http://localhost/Raf/index");
          }else{
            include 'database' . '.php';
            if(isset($_GET['deleteid'])){
                    $id=addslashes($_GET['deleteid']);
                    $sql="delete from  `customer` where id='$id'";
                    $result=mysqli_query($con,$sql);
                    if($result){
                    header('location:http://localhost/Raf/admin/customerlist');

                    }else{
                      die(mysqli_error($con));
                    }
                  }elseif(isset($_GET['cusdeleteid'])){
                    $id=addslashes($_GET['cusdeleteid']);
                    $ida=addslashes($_GET['accountid']);
                    $sql="delete from  `users` where id='$id'";
                    $result=mysqli_query($con,$sql);
                    if($result){
                    header('location:http://localhost/Raf/admin/customeraccount?accountid='.$ida.'');

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