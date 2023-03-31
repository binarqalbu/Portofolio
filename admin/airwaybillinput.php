<!-- php code -->

<?php
  include 'database' . '.php';
  if(isset($_POST['submit'])){
    $date=addslashes($_POST['date']);
    $date = str_replace('/', '-', $date);
    $newdate=date("Y-m-d", strtotime($date));
    $courier=addslashes($_POST['courier']);
    $shipper=strtoupper(addslashes($_POST['shipper']));
    $consignee=strtoupper(addslashes($_POST['consignee']));
    $country=strtoupper(addslashes($_POST['country']));
    $destination=strtoupper(addslashes($_POST['destination']));
    $address=strtoupper(addslashes($_POST['address']));
    $contact=strtoupper(addslashes($_POST['contact']));
    $postcode=str_replace(',','.',$_POST['postcode']);
    $postcode=(double)addslashes($postcode);
    $telephone=strtoupper(addslashes($_POST['telephone']));
    $pieces=str_replace(',','.',$_POST['pieces']);
    $pieces=(double)addslashes($pieces);
    $weight=str_replace(',','.',$_POST['weight']);
    $weight=(double)addslashes($weight);
    $volume=str_replace(',','.',$_POST['volume']);
    $volume=(double)addslashes($volume);
    $value_invoice=strtoupper(addslashes($_POST['value_invoice']));
    $service_request=addslashes($_POST['service_request']);
    $details_of_shipment=addslashes($_POST['details_of_shipment']);
    $type_of_payment=addslashes($_POST['type_of_payment']);
    $description_of_good=strtoupper(addslashes($_POST['description_of_good']));
    $special_instruction=strtoupper(addslashes($_POST['special_instruction']));

    if($weight==""){
      $weight="1.00";
    }
    if($pieces==""){
      $pieces="1";
    }
    
    if (!empty($_POST['id_shipment'])) {
      $id_shipment=addslashes($_POST['id_shipment']);
      $sqlc="select * from `airwaybill` where id_shipment = '$id_shipment'";
      $resultc = mysqli_query($con,$sqlc);
      $cek=mysqli_num_rows($resultc);
      if ($cek == 0){
      $sqls="select * from `customer` where shipper like '%$shipper%'";
      $results = mysqli_query($con,$sqls);
      $cek=mysqli_num_rows($results);
      if($cek !=0){
      $sql="INSERT INTO `airwaybill`(`date`,`courier`,`shipper`, `consignee`, `country`, `destination`, `address`, `contact`, `postcode`, `telephone`, 
      `pieces`, `weight`, `volume`, `value_invoice`, `service_request`, `details_of_shipment`, `type_of_payment`, 
      `description_of_good`, `special_instruction`) VALUES ('$newdate','$courier','$shipper','$consignee','$country','$destination','$address','$contact',
      '$postcode','$telephone','$pieces','$weight','$volume','$value_invoice','$service_request','$details_of_shipment','$type_of_payment',
      '$description_of_good','$special_instruction')";
      $result=mysqli_query($con,$sql);
  
      $sqlg="select * from `airwaybill` order by id desc";
      $resultg = mysqli_query($con,$sqlg);
      $row=mysqli_fetch_assoc($resultg);
      $raf_id=$row['id'];

      $sqlu="update `airwaybill` set id_shipment='$id_shipment' where id='$raf_id'";
      $resultu = mysqli_query($con,$sqlu);
      $sqlt="INSERT INTO `tracking`(`raf_id`,`shipper`) VALUES ('$id_shipment','$shipper')";
      $resultt = mysqli_query($con,$sqlt);
      $length=$_POST['length'];
      $length = array_map('addslashes', $length);
      $width = $_POST['width'];
      $width = array_map('addslashes', $width);
      $height = $_POST['height'];
      $height = array_map('addslashes', $height);
      if($count > 0)
      {
          for($i=0; $i<$count; $i++)
          {   if($length[$i]!="" && $width[$i]!="" && $height[$i]!="")
              {   
                  $length[$i]=str_replace(',','.',length[$i]);
                  $length[$i] = (double) $length[$i];
                  $width[$i]=str_replace(',','.',$width[$i]);
                  $width[$i] = (double) $width[$i];
                  $height[$i]=str_replace(',','.',$height[$i]);
                  $height[$i] = (double) $height[$i];
                  $sqld="INSERT INTO `pieces_detail`(`raf_id`,`length`, `width`, `height`) VALUES('$id_shipment','$length[$i]','$width[$i]','$height[$i]')";
                  $resultd=mysqli_query($con,$sqld);	  
              }
          }
      }
      }else{
        echo '<script language="javascript">';
        echo 'alert("Shipper tidak tersedia, harap masukkan customer baru")';
        echo '</script>';
      }
      }else{
        echo '<script language="javascript">';
        echo 'alert("RAF ID sudah ada")';
        echo '</script>';
      }
      }else{
      $sqls="select * from `customer` where shipper like '%$shipper%'";
      $results = mysqli_query($con,$sqls);
      $cek=mysqli_num_rows($results);
      if($cek !=0){
      $sql="INSERT INTO `airwaybill`(`date`,`courier`,`shipper`, `consignee`, `country`, `destination`, `address`, `contact`, `postcode`, `telephone`, 
      `pieces`, `weight`, `volume`, `value_invoice`, `service_request`, `details_of_shipment`, `type_of_payment`, 
      `description_of_good`, `special_instruction`) VALUES ('$newdate','$courier','$shipper','$consignee','$country','$destination','$address','$contact',
      '$postcode','$telephone','$pieces','$weight','$volume','$value_invoice','$service_request','$details_of_shipment','$type_of_payment',
      '$description_of_good','$special_instruction')";
        $result=mysqli_query($con,$sql);
  
      $sqlg="select * from `airwaybill` order by id desc";
      $resultg = mysqli_query($con,$sqlg);
      $row=mysqli_fetch_assoc($resultg);
      $raf_id=$row['id'];

      $sqlu="update `airwaybill` set id_shipment='$raf_id' where id='$raf_id'";
      $resultu = mysqli_query($con,$sqlu);
      $sqlt="INSERT INTO `tracking`(`raf_id`,`shipper`) VALUES ('$raf_id','$shipper')";
      $resultt = mysqli_query($con,$sqlt);
      $count = count($_POST['length']);
      $length=$_POST['length'];
      $length = array_map('addslashes', $length);
      $width = $_POST['width'];
      $width = array_map('addslashes', $width);
      $height = $_POST['height'];
      $height = array_map('addslashes', $height);
      if($count > 0)
      {
          for($i=0; $i<$count; $i++)
          {   if($length[$i]!="" && $width[$i]!="" && $height[$i]!="")
              {   
                  $length[$i]=str_replace(',','.',length[$i]);
                  $length[$i] = (double) $length[$i];
                  $width[$i]=str_replace(',','.',$width[$i]);
                  $width[$i] = (double) $width[$i];
                  $height[$i]=str_replace(',','.',$height[$i]);
                  $height[$i] = (double) $height[$i];
                  $sqld="INSERT INTO `pieces_detail`(`raf_id`,`length`, `width`, `height`) VALUES('$raf_id','$length[$i]','$width[$i]','$height[$i]')";
                  $resultd=mysqli_query($con,$sqld);	  
              }
          }
      }
    }else{
      echo '<script language="javascript">';
      echo 'alert("Shipper tidak tersedia, harap masukkan customer baru")';
      echo '</script>';
    }
    }
    if(!empty($result)){
      header('location:http://localhost/Raf/admin/airwaybillsearch');
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airwaybill</title>
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
          if($_SESSION['role'] != "admin"){
            header("Location: http://localhost/Raf/index");
          }               
        ?>
        
        <nav class="navbar container-fluid navbar-light bg-white position-sticky top-0">
          <div class="">
            <i class="fal fa-caret-circle-down h5 d-none d-md-block menutoggle fa-rotate-90"></i>
            <i class="fas fa-bars h4  d-md-none"></i>
          </div>
          <div class="topnav-right">
            <a class="h7 nav-link text-dark" href="airwaybillinput">Input</a>
            <a class="h7 nav-link text-dark" href="airwaybillsearch">Search</a>
          </div>
        </nav>
        <div class="header">
            <h5 class="title">Input Airwaybill Details</h5>
        </div>
        <form action ="" method="post">
          <div class="form-group">
          <label for="chkRafid">
              <input type="checkbox" id="chkRafid" onclick="EnableDisableTextBox(this)" />
              Existing Airwaybill?
          </label>
            <div class="form-group row">
              <label class="col-sm-1 col-form-label">RAF</label>
              <div class="col-sm-3">
                <input type="text" id="id_shipment" disabled="disabled" name="id_shipment" autocomplete="off" />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-1 col-form-label">COURIER</label>
              <div class="col-sm-3">
                <input type="text" id="courier"  name="courier" autocomplete="off" />
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                  <label>Date</label>
                  <input type="text" name="date" id="date" class="form-control"  autocomplete="off"/>
              </div>
            <div class="form-group">
              <div class="col-sm-7">
                  <label>Shipper</label>
                  <input type="text" class="form-control" placeholder="Enter Shipper" id="shipper" name="shipper" autocomplete="off" list="shipperlist" required/>
                  <datalist id="shipperlist">
                    <?php
                    include 'database' . '.php';
                      $sql="select * from `customer`";
                      $result = mysqli_query($con,$sql);
                      while($row=mysqli_fetch_assoc($result)){
                        echo '<option>'.$row['shipper'].'</option>';
                      }
                    ?>
                  </datalist>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Consignee</label>
                <input type="text" class="form-control" placeholder="Enter Consignee" id="consignee" name="consignee" autocomplete="off" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Country</label>
                <input type="text" class="form-control" placeholder="Enter Country" id="country" name="country" autocomplete="off"list="countrylist" required/>
                <datalist id="countrylist">
                  <?php
                  include 'database' . '.php';
                    $sql="select * from `country`";
                    $result = mysqli_query($con,$sql);
                    while($row=mysqli_fetch_assoc($result)){
                      echo '<option>'.$row['name'].'</option>';
                    }
                  ?>
                </datalist>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Destination (3 char)</label>
                <input type="text" class="form-control" placeholder="Enter Destination (3 char)" id="destination" name="destination" autocomplete="off">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Address</label>
                <input type="text" class="form-control" placeholder="Enter Address" id="address" name="address" autocomplete="off">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Contact</label>
                <input type="text" class="form-control" placeholder="Enter Contact" id="contact" name="contact" autocomplete="off">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Postcode</label>
                <input type="text" class="form-control" placeholder="Enter Postcode" id="postcode" name="postcode" autocomplete="off">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Telephone/Mobile</label>
                <input type="text" class="form-control" placeholder="Enter Telephone/Mobile" id="telephone" name="telephone" autocomplete="off">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Pieces</label>
                <input type="text" class="form-control" placeholder="Enter Pieces" id="pieces" name="pieces" autocomplete="off">
                <div class="table-responsive">
                <table class="table" id="dynamic_field">
                <tr>
                <td><input type="text" name="length[]" placeholder="Enter Length"></td>
                <td><input type="text" name="width[]" placeholder="Enter Width"></td>
                <td><input type="text" name="height[]" placeholder="Enter Height"></td>
                <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                </tr>
                </table>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Weight</label>
                <input type="text" class="form-control" placeholder="Enter Weight" id="weight" name="weight" autocomplete="off">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Volume</label>
                <input type="text" class="form-control" placeholder="Enter Volume" id="volume" name="volume" autocomplete="off">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Value Invoice</label>
                <input type="text" class="form-control" placeholder="Enter Value Invoice" id="value_invoice" name="value_invoice" autocomplete="off">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Service Request</label>
                <select class="form-control" id="service_request" name="service_request" autocomplete="off" required>
                  <option value="">Select Service Request</option>
                  <option value="Domestic">Domestic</option>
                  <option value="International Courier">International Courier</option>
                  <option value="Import">Import</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Details of Shipment</label>
                <select class="form-control" id="details_of_shipment" name="details_of_shipment" autocomplete="off" required>
                  <option value="">Select Details of Shipment</option>
                  <option value="Document">Document</option>
                  <option value="Package">Package</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Type of Payment</label>
                <select class="form-control" id="type_of_payment" name="type_of_payment" autocomplete="off">
                  <option value="">Select Details of Shipment</option>
                  <option value="Cash Only">Cash Only</option>
                  <option value="Credit">Credit</option>
                  <option value="Collect to Consignee">Collect to Consignee</option>
                  <option value="Insurance">Insurance</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Description of Good</label>
                <input type="text" class="form-control" placeholder="Enter Description of Good" id="description_of_good" name="description_of_good" autocomplete="off">
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Special Instruction</label>
                <input type="text" class="form-control" placeholder="Enter Special Instruction" id="special_instruction" name="special_instruction" autocomplete="off" list="speciallist"/>
                <datalist id="speciallist">
                <option>Regular</option>
                <option>Sameday</option>
                <option>Oneday</option>
                </datalist>
              </div>
             </div>
            <div>&nbsp</div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
      <!-- end contentpage -->
    </main>
    <script src="../js/script.js"></script>
    <script src="/js/bootstrap.bundle.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>   
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script>
      $(document).ready(function(){ 
           $(function(){ 
                $("#date").datepicker({dateFormat:'dd/mm/yy'}).datepicker("setDate", 'now');
           });  
      });
    </script> 
    <script>
    $(document).ready(function(){
        var i=1;
        $('#add').click(function(){
        i++;
        $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="length[]" placeholder="Enter Length"></td><td><input type="text" name="width[]" placeholder="Enter Width"></td><td><input type="text" name="height[]" placeholder="Enter Height"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
        });
        
    $(document).on('click', '.btn_remove', function(){
    var button_id = $(this).attr("id"); 
    $('#row'+button_id+'').remove();
        });
    });
    </script>
    <script type="text/javascript">
        function EnableDisableTextBox(chkRafid) {
            var id_shipment = document.getElementById("id_shipment");
            id_shipment.disabled = chkRafid.checked ? false : true;
            if (!id_shipment.disabled) {
                id_shipment.focus();
            }
        }
    </script>
  </body>
</html>