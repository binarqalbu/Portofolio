<!-- php code -->
<?php
  include 'database' . '.php';
  if (!isset($_GET['editid'])) {
    header("Location: http://localhost/Raf/index");
  }     
  $id=addslashes($_GET['editid']);
  $sql="select * from `country` where id='$id'";
  $result=mysqli_query($con,$sql);
  $row=mysqli_fetch_assoc($result);
  $name=$row['name'];
  $code=$row['code'];
  if(isset($_POST['submit'])){
    $name=strtoupper(addslashes($_POST['name']));
    $code=strtoupper(addslashes($_POST['code']));

    $sql="update `country` set id='$id',name='$name',code='$code' where id='$id'";
    $result=mysqli_query($con,$sql);
    if($result){
      header('location:http://localhost/Raf/ops/country');
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
            $page = 'country';
            include "component/sidebar" . ".php"
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
              <a class="h7 nav-link text-dark" href="country">Country</a>
            </div>
        </nav>
        <!-- end top navigation -->
        
        <!-- start edit form -->
        <div class="header">
          <h5 class="title">Input Customer Details</h5>
        </div>
        <form action ="" method="post">
          <div class="form-group">
            <div class="col-sm-7">
              <label>Country</label>
              <input type="text" class="form-control" placeholder="Enter Country" id="name" name="name" autocomplete="off" value="<?php echo $name;?>" required>
          </div>
            </div>
          <div class="form-group">
            <div class="col-sm-7">
              <label>Code (3 char)</label>
              <input type="text" class="form-control" placeholder="Enter Country Code (3 char)" id="code" name="code" autocomplete="off" value="<?php echo $code;?>">
          </div>
            </div>
            <div>&nbsp</div>
            <button type="button" class="btn btn-primary butgap" onclick="history.back()">Back</button>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
        <!-- end edit form -->

      </div>
      <!-- end contentpage -->

    </main>
    <script src="../js/script.js"></script>
    <script src="/js/bootstrap.bundle.js"></script>
  </body>
</html>