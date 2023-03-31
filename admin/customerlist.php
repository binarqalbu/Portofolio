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
          if($_SESSION['role'] != "admin"){
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
        
        <!-- start serachbar -->
        <form method="post" class="float-end">
          <input type="text" class =""placeholder="Search Data" name="search"></input>
          <button class="btn btn-dark btn-sm" name="submitsrc">Submit</button>
        </form>
        <!-- end searchbar -->
        
        <!-- start customer list--> 
        <div class="customer">
            <table class="table table-responsive">
                <thead>
                    <th style="width:20%">Shipper</th>
                    <th>Adress</th>
                    <th style="width:10%">Contact</th>
                    <th style="width:10%">Telephone</th>
                    <th style="width:17%">Action</th>
                </thead>
                <tbody>
                <?php include 'database' . '.php'; 
                          //if search condition
                          if(isset($_POST['submitsrc'])){
                            $search=addslashes($_POST['search']);
                            $sql ="Select * from `customer` where shipper like '%$search%' or address like '%$search%' or contact like '%$search%' or telephone like '%$search%'";
                            $result = mysqli_query($con,$sql);
                          }
                          //not search condition
                          else{
                            $sql = "SELECT * FROM customer";
                            $result = mysqli_query($con,$sql);  
                          }
                          if($result){
                            while($row=mysqli_fetch_assoc($result)){
                              $id=$row['id'];
                              $shipper=$row['shipper'];
                              $address=$row['address'];
                              $contact=$row['contact'];
                              $telephone=$row['telephone'];
                              echo'<tr>'; 
                              echo'<td>'.$shipper.'</td>';
                              echo'<td>'.$address.'</td>';
                              echo'<td>'.$contact.'</td>';
                              echo'<td>'.$telephone.'</td>';
                              echo'<td>';
                              echo'<button type="button" class="btn btn-success btn-sm"><a href="customerdetail?detailid='.$id.'" style="text-decoration:none;" class="text-light">Detail</a></button>';
                              echo'<button type="button" class="btn btn-primary btn-sm"><a href="customeraccount?accountid='.$id.'" style="text-decoration:none;" class="text-light">Account</a></button>';
                              echo'<button type="button" class ="btn btn-danger btn-sm"><a href="customerdelete?deleteid='.$id.'" onclick="javascript:confirmationDelete($(this));return false;" style="text-decoration:none;" class="text-light">Delete</a></button>';
                              echo'</td>'; 
                              echo'</tr>';
                            
                            }
                            }
                      ?>
                </tbody>
            </table>
        </div>
        <!-- end customer list -->

      </div>
      <!-- end content page -->
    </main>
    <script src="../js/script.js"></script>
    <script src="/js/bootstrap.bundle.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>   
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
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