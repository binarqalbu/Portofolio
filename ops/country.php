<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Country</title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/raffeda.ico" />
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>
<body class="bg-content">
    <main class="dashboard d-flex">
        <!-- start sidebar -->
        <?php 
            $page = 'country';
            include "component/sidebar" . ".php";
        ?>
        <!-- end sidebar -->

        <!-- start content page -->
        <div class="container-fluid px-4">

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
            
          <!-- start add country -->
          <div class="button-search">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">add Country</button>
            
            <!-- start serachbar -->
            <form method="post" class="float-end">
              <input type="text" class =""placeholder="Search Data" name="search"></input>
              <button class="btn btn-dark btn-sm" name="submitsrc">Submit</button>
            </form>
            <!-- end serachbar -->

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Country</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action ="" method="post">
                      <div class="form-group">
                        <label>Country</label>
                        <input type="text" class="form-control" placeholder="Enter Country" id="name" name="name" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                        <label>Code (3 char)</label>
                        <input type="text" class="form-control" placeholder="Enter Country Code (3 char)" id="code" name="code" autocomplete="off">
                      </div>
                      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- php code -->
          <?php
              include 'database' . '.php';
              if(isset($_POST['submit'])){
                $name=strtoupper(addslashes($_POST['name']));
                $code=strtoupper(addslashes($_POST['code']));

                $sql="insert into `country` (name,code)
                values('$name','$code')";
                $result=mysqli_query($con,$sql);
                if($result){
                  echo '<script language="javascript">';
                  echo 'alert("Data Created Successfully")';
                  echo '</script>';
                }else{
                  die(mysqli_error($con));
                }
                
                
              }
              ?>
          <!-- end add country -->

          <!-- start country list-->    
          <div class="country">
              <table class="table table-responsive" style="width:100%">
                  <thead>
                      <th style="width:60%">Country</th>
                      <th style="width:20%">Code</th>
                      <th>Action</th>
                  </thead>
                  <tbody>
                  <?php include 'database' . '.php';                           
                          //if search condition
                          if(isset($_POST['submitsrc'])){
                            $search=addslashes($_POST['search']);
                            $sql ="Select * from `country` where name like '%$search%' or code like '%$search%'";
                            $result = mysqli_query($con,$sql);
                          }
                          //not search condition
                          else{
                            $sql = "SELECT * FROM country";
                            $result = mysqli_query($con,$sql);
                          }
                          if($result){
                          while($row=mysqli_fetch_assoc($result)){
                            $id=$row['id'];
                            $name=$row['name'];
                            $code=$row['code'];
                            echo'<tr>'; 
                            echo'<td>'.$name.'</td>';
                            echo'<td>'.$code.'</td>';
                            echo'<td>';
                            echo'<button type="button" class="btn btn-success btn-sm"><a href="countryedit?editid='.$id.'" style="text-decoration:none;" class="text-light">Edit</a></button>';
                            echo'<button type="button" class ="btn btn-danger btn-sm"><a href="countrydelete?deleteid='.$id.'" onclick="javascript:confirmationDelete($(this));return false;" style="text-decoration:none;" class="text-light">Delete</a></button>';
                            echo'</td>'; 
                            echo'</tr>';
                          
                          }
                          }
                      ?> 
                  </tbody>
              </table>
          </div>
          <!-- end country list -->
        
        </div>
               
        </div>
        <!-- end content page -->
    </main>

    <script src="../js/script.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
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