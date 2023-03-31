<?php 
$con = new mysqli('localhost','root','','raffeda');
      
if($con){
}else{
  die(mysqli_error($con));
}
?>