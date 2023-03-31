<!-- php code -->
<?php
        include 'database' . '.php';
        if (!isset($_GET['accountid'])) {
          header("Location: http://localhost/Raf/index");
        }    
        $id=addslashes($_GET['accountid']);
        $sql="select * from `customer` where id='$id'";
        $result=mysqli_query($con,$sql);
        $row=mysqli_fetch_assoc($result);
        $shipper=$row['shipper'];
        ?>

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
              <a class="h7 nav-link text-dark"><?php echo $shipper;?></a>
            </div>
        </nav>
        <!-- end top navigation -->
        
        <!-- start add country -->
        <div class="button-search">
          <button type="button" class="btn btn-success butgap" onclick="history.back()">Back</button>
          <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Add Account</button>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action ="" method="post">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" placeholder="Enter Username" id="username" name="username" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" placeholder="Enter Email" id="email" name="email" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                        <label>Password</label>
                        <input type="text" class="form-control" placeholder="Enter Password" id="password" name="password" autocomplete="off" required>
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
              $username=addslashes($_POST['username']);
              $email=addslashes($_POST['email']);
              $password=addslashes($_POST['password']);
              $role='customer';

              $sql="INSERT INTO `users`(`username`, `email`, `password`, `role`, `shipper`) VALUES ('$username','$email','$password','$role','$shipper')";
              $result=mysqli_query($con,$sql);
              if($result){
                echo '<script language="javascript">';
                echo 'alert("Account Created Successfully")';
                echo '</script>';
              }else{
                die(mysqli_error($con));
              }
            }
            if(isset($_POST['submitdtl'])){
              $idusers=addslashes($_POST['idusers']);
              $usernamedtl=addslashes($_POST['usernamedtl']);
              $emaildtl=addslashes($_POST['emaildtl']);
              $passworddtl=addslashes($_POST['passworddtl']);

              $sql="UPDATE `users` SET `username`='$usernamedtl',`email`='$emaildtl',`password`='$passworddtl' WHERE id = '$idusers'";
              $result=mysqli_query($con,$sql);
              if($result){
                echo '<script language="javascript">';
                echo 'alert("Account Updated Successfully")';
                echo '</script>';
              }else{
                die(mysqli_error($con));
              }
            }
          ?>
        
        <!-- start customer list--> 
        <div class="customer">
            <table class="table table-responsive">
                <thead>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th style="width:15%">Action</th>
                </thead>
                <tbody>
                <?php include 'database' . '.php'; 
                            $sql = "SELECT * FROM users where shipper ='$shipper'";
                            $result = mysqli_query($con,$sql);  
                          
                          if($result){
                            while($row=mysqli_fetch_assoc($result)){
                              $idusers=$row['id'];
                              $username=$row['username'];
                              $email=$row['email'];
                              $password=$row['password'];
                              echo'<tr>'; 
                              echo'<td>'.$username.'</td>';
                              echo'<td>'.$email.'</td>';
                              echo'<td>'.$password.'</td>';
                              echo'<td>';
                              echo'<button type="button" class="btn btn-success btn-sm"><a  data-bs-toggle="modal" data-bs-target="#detailModal'.$idusers.'" data-id='.$idusers.'  style="text-decoration:none;" class="text-light">Detail</a></button>';
                              echo'<button type="button" class ="btn btn-danger btn-sm"><a href="customerdelete?cusdeleteid='.$idusers.'&accountid='.$id.'" onclick="javascript:confirmationDelete($(this));return false;" style="text-decoration:none;" class="text-light">Delete</a></button>';
                              echo'</td>'; 
                              echo'</tr>';
                              echo'<div class="modal fade" id="detailModal'.$idusers.'" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">';
                              echo'<div class="modal-dialog">';
                                echo'<div class="modal-content">';
                                  echo'<div class="modal-header">';
                                    echo'<h5 class="modal-title" id="detailModalLabel">Add Account</h5>';
                                    echo'<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                                  echo'</div>';
                                  echo'<div class="modal-body">';
                                    echo'<form action ="" method="post">';
                                      echo'<div class="form-group">';
                                        echo'<label>Username</label>';
                                        echo'<input type="text" class="form-control" placeholder="Enter Username" id="usernamedtl" name="usernamedtl" autocomplete="off" value="'.$username.'" required>';
                                      echo'</div>';
                                      echo'<div class="form-group">';
                                        echo'<label>Email</label>';
                                        echo'<input type="text" class="form-control" placeholder="Enter Email" id="emaildtl" name="emaildtl" autocomplete="off" value="'.$email.'" required>';
                                      echo'</div>';
                                      echo'<div class="form-group">';
                                        echo'<label>Password</label>';
                                        echo'<input type="text" class="form-control" placeholder="Enter Password" id="passworddtl" name="passworddtl" autocomplete="off" value="'.$password.'" required>';
                                      echo'</div>';
                                      echo'<div class="form-group">';
                                      echo'<input type="hidden" class="form-control" id="idusers" name="idusers" value="'.$idusers.'">';
                                    echo'</div>';
                                      echo'<button type="submitdtl" name="submitdtl" class="btn btn-primary">Submit</button>';
                                    echo'</form>';
                                  echo'</div>';
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
        <!-- end customer list -->

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