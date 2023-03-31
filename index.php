<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="http://localhost/Raf/assets/img/raffeda.ico" />
    <title>sing-in</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
   <main class="bg-sign-in d-flex justify-content-center align-items-center">
      <div class=" form-sign-in bg-white mt-2 h-auto mb-2 text-center pt-2 pe-4 ps-4 d-flex flex-column">
        <div>
          <h2 class=" sign-in text-uppercase">sign in</h2>
        <p>Enter your credentials to access your account</p>
        </div>
        <?php
          if(isset($_GET['error'])){
            if($_GET['error'] == "please enter your  or password"){
              echo '<div sclass="alert alert-danger" role="alert">
            please enter your username or password
          </div>';
            }
            elseif($_GET['error'] == "username or password not found"){
              echo '<div class="alert alert-danger" role="alert">
              username or password not found
          </div>';
            }
          }    
        ?>
        <form method="POST" action="login">
          <div class="mb-3 mt-3 text-start">
            <label for="username">username:</label>
            <input type="username" class="form-control" id="username" placeholder="Enter username" name="username" value="<?php  if(isset($_COOKIE['username'])){echo $_COOKIE['username']; }?>">
          </div>
          <div class="mb-3 text-start">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pass" value="<?php  if(isset($_COOKIE['password'])){echo $_COOKIE['password']; }?>" autocomplete="on">
          </div>
          <div class="mb-3 form-check d-flex gap-2">
  </div>
          <button type="submit" name="submit" class="btn text-white w-100 text-uppercase">sign in</button>
          <p class="mt-4"></p>
          
        </form>
     </div>

   </main>

   <script src="/js/bootstrap.bundle.js"></script>
   <script src="./js/validation.js"></script>
</body>
</html>