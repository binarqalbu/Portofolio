<?php
        session_start();

        if(isset($_POST['submit'])){
          include './admin/conixion' . '.php';
          $username = addslashes($_POST['username']);
          $password = addslashes($_POST['pass']);

          $requete = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
          $statment = $con -> prepare($requete);
          $statment -> execute();
          $result = $statment -> fetch();
          if($result['username'] === $username && $result['password'] === $password){
            $_SESSION['username'] = $result['username'];
            $_SESSION['email'] = $result['email'];
            $_SESSION['password'] = $result['password'];
            $_SESSION['role'] = $result['role'];
            if(isset($_POST['check'])){
                setcookie('username',$_SESSION['username'],time() + 3600);
                setcookie('password',$_SESSION['password'],time() + 3600);
            }
            if($_SESSION['role'] =='admin'){
            header("location:./admin/aboutme");
            }elseif($_SESSION['role'] =='operasional'){
                header("location:./ops/aboutme");
            }elseif($_SESSION['role'] =='akuntan'){
                header("location:./akun/aboutme");
            }elseif($_SESSION['role'] =='customer'){
                header("location:./customer/aboutme");
                $_SESSION['shipper'] = $result['shipper'];
            }
            
            }
            else if(empty($username) || empty($password)){
                header("location:index?error=please enter your username or password");
            }
            else
            {
                header("location:index?error=username or password not found");
            }
      }?>