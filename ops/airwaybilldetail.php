<!-- php code -->
<?php
  include 'database' . '.php';
  if (!isset($_GET['detailid'])) {
    header("Location: http://localhost/Raf/index");
  }               
  $id=addslashes($_GET['detailid']);
  $sql="select * from `airwaybill` where id_shipment='$id'";
  $result=mysqli_query($con,$sql);
  $row=mysqli_fetch_assoc($result);
  $newdate=$row['date'];
  $newdate = str_replace('-', '/', $newdate);
  $date=date("d/m/Y", strtotime($newdate));
  $courier=$row['courier'];
  $shipper=$row['shipper'];
  $consignee=$row['consignee'];
  $country=$row['country'];
  $destination=$row['destination'];
  $address=$row['address'];
  $contact=$row['contact'];
  $postcode=$row['postcode'];
  $telephone=$row['telephone'];
  $pieces=$row['pieces'];
  $weight=$row['weight'];
  $volume=$row['volume'];
  $value_invoice=$row['value_invoice'];
  $service_request=$row['service_request'];
  $details_of_shipment=$row['details_of_shipment'];
  $type_of_payment=$row['type_of_payment'];
  $description_of_good=$row['description_of_good'];
  $special_instruction=$row['special_instruction'];
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
    
    $sqld="DELETE FROM `pieces_detail` WHERE `pieces_detail`.`raf_id` = '$id'";
    $resultd = mysqli_query($con,$sqld);
    $count = count($_POST["length"]);
    $length=$_POST['length'];
    $length = array_map('addslashes', $length);
    $width = $_POST['width'];
    $width = array_map('addslashes', $width);
    $height = $_POST['height'];
    $height = array_map('addslashes', $height);

    if(!empty($_POST['id_shipment'])){
    $id_shipment=addslashes($_POST['id_shipment']);
    $sqlc="select * from `airwaybill` where id_shipment = '$id_shipment'";
    $resultc = mysqli_query($con,$sqlc);
    $cek=mysqli_num_rows($resultc);
    if ($cek == 0){
    $sqls="select * from `customer` where shipper like '%$shipper%'";
    $results = mysqli_query($con,$sqls);
    $cek=mysqli_num_rows($results);
    if($cek !=0){
    $sql="update `airwaybill` set id_shipment='$id_shipment',datetime=sysdate(),courier='$courier',shipper='$shipper',consignee='$consignee',country='$country',
    destination='$destination',address='$address',contact='$contact',postcode='$postcode',telephone='$telephone',pieces='$pieces',
    weight='$weight',volume='$volume',value_invoice='$value_invoice', service_request='$service_request',
    details_of_shipment='$details_of_shipment',type_of_payment='$type_of_payment',description_of_good='$description_of_good',
    special_instruction='$special_instruction' where id_shipment='$id'";
    $resultu=mysqli_query($con,$sql);

    $sqlt="update `tracking` set raf_id='$id_shipment' where raf_id='$id' ";
    $resultt = mysqli_query($con,$sqlt);
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
    $sql="update `airwaybill` set datetime=sysdate(),courier='$courier',shipper='$shipper',consignee='$consignee',country='$country',
    destination='$destination',address='$address',contact='$contact',postcode='$postcode',telephone='$telephone',pieces='$pieces',
    weight='$weight',volume='$volume',value_invoice='$value_invoice', service_request='$service_request',
    details_of_shipment='$details_of_shipment',type_of_payment='$type_of_payment',description_of_good='$description_of_good',
    special_instruction='$special_instruction' where id_shipment='$id'";
    $resultu=mysqli_query($con,$sql);
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
                $sqld="INSERT INTO `pieces_detail`(`raf_id`,`length`, `width`, `height`) VALUES('$id','$length[$i]','$width[$i]','$height[$i]')";
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

    if(!empty($resultu)){
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
          if($_SESSION['role'] != "operasional"){
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
                Change RAF ID?
            </label>
            <div class="form-group row">
              <label class="col-sm-1 col-form-label">RAF</label>
              <div class="col-sm-3">
                <input type="text" id="id_shipment" disabled="disabled" name="id_shipment" autocomplete="off" value="<?php echo $id;?>"/>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-1 col-form-label">COURIER</label>
              <div class="col-sm-3">
                <input type="text" id="courier"  name="courier" autocomplete="off" value="<?php echo $courier;?>"/>
              </div>
            </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Date</label>
                <input type="text" name="date" id="date" class="form-control"  autocomplete="off" value="<?php echo $date;?>"/>
              </div>
              <div class="col-sm-7">
                <label>Shipper</label>
                <input type="text" class="form-control" placeholder="Enter Shipper" id="shipper" name="shipper" autocomplete="off" list="shipperlist" value="<?php echo $shipper;?>" required/>
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
                <input type="text" class="form-control" placeholder="Enter Consignee" id="consignee" name="consignee" autocomplete="off" value="<?php echo $consignee;?>" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Country</label>
                <input type="text" class="form-control" placeholder="Enter Country" id="country" name="country" autocomplete="off"list="countrylist" value="<?php echo $country;?>" required/>
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
                <input type="text" class="form-control" placeholder="Enter Destination (3 char)" id="destination" name="destination" autocomplete="off" value="<?php echo $destination;?>">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Address</label>
                <input type="text" class="form-control" placeholder="Enter Address" id="address" name="address" autocomplete="off" value="<?php echo $address;?>">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Contact</label>
                <input type="text" class="form-control" placeholder="Enter Contact" id="contact" name="contact" autocomplete="off" value="<?php echo $contact;?>">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Postcode</label>
                <input type="text" class="form-control" placeholder="Enter Postcode" id="postcode" name="postcode" autocomplete="off" value="<?php echo $postcode;?>">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Telephone/Mobile</label>
                <input type="text" class="form-control" placeholder="Enter Telephone/Mobile" id="telephone" name="telephone" autocomplete="off" value="<?php echo $telephone;?>">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Pieces</label>
                <input type="text" class="form-control" placeholder="Enter Pieces" id="pieces" name="pieces" autocomplete="off" value="<?php echo $pieces;?>">
                <div class="table-responsive">
                  <table class="table" id="dynamic_field">
                <?php
                include 'database' . '.php';
                $id=addslashes($_GET['detailid']);
                $sqlp="select * from `pieces_detail` where raf_id='$id'";
                $resultp = mysqli_query($con,$sqlp);
                if($resultp){

                  while($row=mysqli_fetch_assoc($resultp)){
                    $length=$row['length'];
                    $width=$row['width'];
                    $height=$row['height'];
                    echo '<tr>';
                    echo '<td><input type="text" name="length[]" placeholder="Enter Length" value='.$length.'></td>';
                    echo '<td><input type="text" name="width[]" placeholder="Enter Width" value='.$width.'></td>';
                    echo '<td><input type="text" name="height[]" placeholder="Enter Height" value='.$height.'></td>';
                    echo '</tr>';

                  }
                }
                ?>
                    <tr>
                      <td><input type="text" name="length[]" placeholder="Enter Length"></td>
                      <td><input type="text" name="width[]" placeholder="Enter Width"></td>
                      <td><input type="text" name="height[]" placeholder="Enter Height"></td>
                      <td><button type="button" name="add" id="add" class="btn-success">Add More</button></td>
                    </tr>
                    </table>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Weight</label>
                <input type="text" class="form-control" placeholder="Enter Weight" id="weight" name="weight" autocomplete="off" value="<?php echo $weight;?>">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Volume</label>
                <input type="text" class="form-control" placeholder="Enter Volume" id="volume" name="volume" autocomplete="off" value="<?php echo $volume;?>">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Value Invoice</label>
                <input type="text" class="form-control" placeholder="Enter Value Invoice" id="value_invoice" name="value_invoice" autocomplete="off" value="<?php echo $value_invoice;?>">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Service Request</label>
                <select class="form-control" id="service_request" name="service_request" autocomplete="off" value="<?php echo $service_request;?>" required>
                  <option value="" >Select Service Request</option>
                  <option value="Domestic" <?= ($service_request == 'Domestic') ? 'selected' : '' ?>>Domestic</option>
                  <option value="International Courier" <?= ($service_request == 'International Courier') ? 'selected' : '' ?>>International Courier</option>
                  <option value="Import" <?= ($service_request == 'Import') ? 'selected' : '' ?>>Import</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Details of Shipment</label>
                <select class="form-control" id="details_of_shipment" name="details_of_shipment" autocomplete="off" value="<?php echo $details_of_shipment;?>" required>
                  <option value="">Select Details of Shipment</option>
                  <option value="Document" <?= ($details_of_shipment == 'Document') ? 'selected' : '' ?>>Document</option>
                  <option value="Package" <?= ($details_of_shipment == 'Package') ? 'selected' : '' ?>>Package</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Type of Payment</label>
                <select class="form-control" id="type_of_payment" name="type_of_payment" autocomplete="off" value="<?php echo $type_of_payment;?>">
                  <option value="">Select Details of Shipment</option>
                  <option value="Cash Only" <?= ($type_of_payment == 'Cash Only') ? 'selected' : '' ?>>Cash Only</option>
                  <option value="Credit" <?= ($type_of_payment == 'Credit') ? 'selected' : '' ?>>Credit</option>
                  <option value="Collect to Consignee" <?= ($type_of_payment == 'Collect to Consignee') ? 'selected' : '' ?>>Collect to Consignee</option>
                  <option value="Insurance" <?= ($type_of_payment == 'Insurance') ? 'selected' : '' ?>>Insurance</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Description of Good</label>
                <input type="text" class="form-control" placeholder="Enter Description of Good" id="description_of_good" name="description_of_good" autocomplete="off" value="<?php echo $description_of_good;?>">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-7">
                <label>Special Instruction</label>
                <input type="text" class="form-control" placeholder="Enter Special Instruction" id="special_instruction" name="special_instruction" autocomplete="off" list="speciallist" value="<?php echo $special_instruction;?>"/>
                <datalist id="speciallist">
                <option>Regular</option>
                <option>Sameday</option>
                <option>Oneday</option>
                </datalist>
              </div>
            </div>
            <div>&nbsp</div>
            <button type="button" class="btn btn-primary butgap" onclick="history.back()">Back</button>
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
                $("#date").datepicker({dateFormat:'dd/mm/yy'});
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