<!-- php code -->
<?php
  include 'database' . '.php';
  if (!isset($_GET['printid'])) {
    header("Location: http://localhost/Raf/index");
  }    
  $id=addslashes($_GET['printid']);
  $sql="select * from `airwaybill` where id_shipment='$id'";
  $result=mysqli_query($con,$sql);
  $row=mysqli_fetch_assoc($result);
  $date=$row['date'];
  $newdate=date("d/m/Y", strtotime($date));
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

  $sqlc="select * from `customer` where shipper='$shipper'";
  $resultc=mysqli_query($con,$sqlc);
  $row=mysqli_fetch_assoc($resultc);
  $addresscus=$row['address'];
  $contactcus=$row['contact'];
  $telephonecus=$row['telephone'];
  $countrycus=$row['country'];
  $origincus=$row['origin'];
  $postcodecus=$row['postcode'];
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../assets/img/raffeda.png">
    <title>Airwaybill RAF<?php echo $id;?></title>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
    </style>
    <style type="text/css">
      @media print {
        @page {
          margin: 0cm 0.5cm;
          size: A4 portrait;
        }
        * {
          font-size: 10px;
          font-family: 'Roboto', sans-serif;
        }
        table {
          border-collapse: collapse;
        }
        td {
          color: black;
          font: 10px;
          padding-left: 2px;
          /*height: 20px;*/
        }
        .b-all {
          border: 1px solid black;
        }
        .b-x {
          border-left: 1px solid black;
          border-right: 1px solid black;
        }
        .b-y {
          border-top: 1px solid black;
          border-bottom: 1px solid black;
        }
        .b-l {
          border-left: 1px solid black;
        }
        .b-r {
          border-right: 1px solid black;
        }
        .b-t {
          border-top: 1px solid black;
        }
        .b-b {
          border-bottom: 1px solid black;
        }
        .bbg-all {
          background-color: lavender;
          border: 1px solid black;
        }
        .text-center {
          text-align: center;
        }
        .va-top {
          vertical-align: top;
        } 
      }

      * {
        font-size: 10px;
        font-family: 'Roboto', sans-serif;
      }
      table {
        border-collapse: collapse;
      }
      td {
        color: black;
        font: 10px;
        padding-left: 2px;
        /*height: 20px;*/
      }
      .b-all {
        border: 2px solid black;
      }
      .b-x {
        border-left: 2px solid black;
        border-right: 2px solid black;
      }
      .b-y {
        border-top: 2px solid black;
        border-bottom: 2px solid black;
      }
      .b-l {
        border-left: 2px solid black;
      }
      .b-r {
        border-right: 2px solid black;
      }
      .b-t {
        border-top: 2px solid black;
      }
      .b-b {
        border-bottom: 2px solid black;
      }
      .bbg-all {
        background-color: lavender;
        border: 2px solid black;
      }
      .text-center {
        text-align: center;
      }
      .va-top {
        vertical-align: top;
      }
    </style>
</head>
<body>
  <?php
    session_start();
    if($_SESSION['role'] != "customer"){
      header("Location: http://localhost/Raf/index");
    }
    if($shipper != $_SESSION['shipper']){
      die(mysqli_error($con));
    }                 
  ?>
    <div style="height: 33.3333%;">
      <table cellspacing="0" border="0" width="100%">
        <tr>
          <td height="10px"></td>
          <td rowspan="4"><img src="../assets/img/logo_mini.png" width="150px" height="56px"></td>
          <td></td>
          <td colspan="4"><strong>SHIPMENT AIRWAYBILL</strong></td>
          <td class="text-center"><b><?php echo $newdate;?></b></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td></td>
          <td colspan="4"><strong>RAF<?php echo $id;?></strong></td>
          <td class="text-center"><b><?php echo $courier;?></b></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x b-t">No Account:</td>
          <td colspan="3" class="bbg-all">Service Request</td>
          <td class="bbg-all text-center">Origin</td>
          <td class="bbg-all text-center">Destination</td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x"></td>
          <td class="b-all text-center"><?php if($service_request=="Domestic"){echo "X";}?></td>
          <td colspan="2" class="b-x b-t">Domestic</td>
          <td rowspan="2" class="b-all text-center"><?php echo $origincus;?></td>
          <td rowspan="2" class="b-all text-center"><?php echo $destination;?></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td colspan="2" class="bbg-all">SHIPPER :</td>
          <?php
          if($service_request=='International Courier'){
            echo'<td class="b-all text-center">X</td>';
            echo'<td colspan="2" class="b-x b-b">International Courier</td>';
          }elseif($service_request=='Import'){
            echo'<td class="b-all text-center">X</td>';
            echo'<td colspan="2" class="b-x b-b">Import</td>';
          }else{
            echo'<td class="b-all text-center"></td>';
            echo'<td colspan="2" class="b-x b-b">International Courier</td>';
          }
          ?>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td colspan="2" rowspan="4" class="b-all va-top">
            <?php echo $shipper;?><br>
            <?php echo $addresscus;?><br>
          </td>
          <td colspan="3" class="bbg-all">Details of Shipment of Package</td>
          <td class="bbg-all text-center">Qty</td>
          <td class="bbg-all text-center">Weight</td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-all text-center"><?php if($details_of_shipment=="Document"){echo "X";}?></td>
          <td colspan="2" class="b-x b-t">Document</td>
          <td rowspan="2" class="b-all text-center"><?php echo $pieces;?></td>
          <td rowspan="2" class="b-all text-center"><?php echo $weight;?></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-all text-center"><?php if($details_of_shipment=="Package"){echo "X";}?></td>
          <td colspan="2" class="b-x b-b">Package</td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td colspan="4" class="b-all">Description of Goods</td>
          <td class="b-all text-center">Value Invoice</td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x b-t">Contact Person :</td>
          <td class="b-x b-t">Postcode :</td>
          <td colspan="4" rowspan="2" class="b-all va-top"><?php echo $description_of_good;?></td>
          <td rowspan="2" class="b-all text-center"><?php echo $value_invoice;?></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x b-b text-center"><?php echo $contactcus;?></td>
          <td class="b-x b-b text-center"><?php echo $postcodecus;?></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x b-t">No.Tel/HP :</td>
          <td class="b-x b-t">Country :</td>
          <td colspan="5" class="b-l b-y">Dimensions</td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x b-b text-center"><?php echo $telephonecus;?></td>
          <td class="b-x b-b text-center"><?php echo $countrycus;?></td>
          <td colspan="4" rowspan="4" class="b-all va-top">
          <?php
                include 'database' . '.php';
                $id=addslashes($_GET['printid']);
                $sqlp="select * from `pieces_detail` where raf_id='$id'";
                $resultp = mysqli_query($con,$sqlp);
                if($resultp){

                  while($row=mysqli_fetch_assoc($resultp)){
                    $dimension=$row['dimension'];
                    echo $dimension;
                    echo '<br>';

                  }
                }
                ?>
          </td>
          <td class="b-all text-center">Vol. Weight</td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td colspan="2" class="bbg-all">CONSIGNEE :</td>
          <td rowspan="3" class="b-all text-center"><?php echo $volume;?></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td colspan="2" rowspan="6" class="b-all  va-top">
            <?php echo $consignee;?><br>
            <?php echo $address;?><br>
          </td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td colspan="4" class="b-all">Type of Payment</td>
          <td class="b-l b-t"></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-all text-center"><?php if($type_of_payment=="Cash Only"){echo "X";}?></td>
          <td class="b-x b-t">Cash Only</td>
          <td class="b-all text-center"><?php if($type_of_payment=="Insurance"){echo "X";}?></td>
          <td class="b-l b-t">Insurance</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-all text-center"><?php if($type_of_payment=="Credit"){echo "X";}?></td>
          <td class="b-l">Credit</td>
          <td class="b-t"></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-all text-center"><?php if($type_of_payment=="Collect to Consignee"){echo "X";}?></td>
          <td colspan="3" class="b-l b-b">Collect to Consignee</td>
          <td class="b-b"></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x b-t">Contact Person :</td>
          <td class="b-x b-t">Postcode :</td>
          <td colspan="5" class="bbg-all">Special Instruction</td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x b-b text-center"><?php echo $contact;?></td>
          <td class="b-x b-b text-center"><?php echo $postcode;?></td>
          <td colspan="5" rowspan="3" class="b-all va-top"><?php echo $special_instruction;?></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x b-t">No.Tel/HP :</td>
          <td class="b-x b-t">Country :</td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x b-b text-center"><?php echo $telephone;?></td>
          <td class="b-x b-b text-center"><?php echo $country;?></td>
          <td></td>
        </tr>
        <tr>
          <td width="1%"></td>
          <td width="25%"></td>
          <td width="25%"></td>
          <td width="3%"></td>
          <td width="22"></td>
          <td width="3%"></td>
          <td width="12%"></td>
          <td width="10%"></td>
          <td width="1%"></td>
        </tr>
      </table>
    </div>

    <hr style="margin-top: 1rem; margin-bottom: 1rem;">

    <div style="height: 33.333%;">
      <table cellspacing="0" border="0" width="100%">
        <tr>
          <td height="10px"></td>
          <td rowspan="4"><img src="../assets/img/logo_mini.png" width="150px" height="56px"></td>
          <td></td>
          <td colspan="4"><strong>SHIPMENT AIRWAYBILL</strong></td>
          <td class="text-center"><b><?php echo $newdate;?></b></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td></td>
          <td colspan="4"><strong>RAF<?php echo $id;?></strong></td>
          <td class="text-center"><b><?php echo $courier;?></b></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x b-t">No Account:</td>
          <td colspan="3" class="bbg-all">Service Request</td>
          <td class="bbg-all text-center">Origin</td>
          <td class="bbg-all text-center">Destination</td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x"></td>
          <td class="b-all text-center"><?php if($service_request=="Domestic"){echo "X";}?></td>
          <td colspan="2" class="b-x b-t">Domestic</td>
          <td rowspan="2" class="b-all text-center"><?php echo $origincus;?></td>
          <td rowspan="2" class="b-all text-center"><?php echo $destination;?></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td colspan="2" class="bbg-all">SHIPPER :</td>
          <?php
          if($service_request=='International Courier'){
            echo'<td class="b-all text-center">X</td>';
            echo'<td colspan="2" class="b-x b-b">International Courier</td>';
          }elseif($service_request=='Import'){
            echo'<td class="b-all text-center">X</td>';
            echo'<td colspan="2" class="b-x b-b">Import</td>';
          }else{
            echo'<td class="b-all text-center"></td>';
            echo'<td colspan="2" class="b-x b-b">International Courier</td>';
          }
          ?>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td colspan="2" rowspan="4" class="b-all va-top">
          <?php echo $shipper;?><br>
          <?php echo $addresscus;?><br>
          </td>
          <td colspan="3" class="bbg-all">Details of Shipment of Package</td>
          <td class="bbg-all text-center">Qty</td>
          <td class="bbg-all text-center">Weight</td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-all text-center"><?php if($details_of_shipment=="Document"){echo "X";}?></td>
          <td colspan="2" class="b-x b-t">Document</td>
          <td rowspan="2" class="b-all text-center"><?php echo $pieces;?></td>
          <td rowspan="2" class="b-all text-center"><?php echo $weight;?></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-all text-center"><?php if($details_of_shipment=="Package"){echo "X";}?></td>
          <td colspan="2" class="b-x b-b">Package</td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td colspan="4" class="b-all">Description of Goods</td>
          <td class="b-all text-center">Value Invoice</td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x b-t">Contact Person :</td>
          <td class="b-x b-t">Postcode :</td>
          <td colspan="4" rowspan="2" class="b-all va-top"><?php echo $description_of_good;?></td>
          <td rowspan="2" class="b-all text-center"><?php echo $value_invoice;?></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x b-b text-center"><?php echo $contactcus;?></td>
          <td class="b-x b-b text-center"><?php echo $postcodecus;?></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x b-t">No.Tel/HP :</td>
          <td class="b-x b-t">Country :</td>
          <td colspan="5" class="b-l b-y">Dimensions</td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x b-b text-center"><?php echo $telephonecus;?></td>
          <td class="b-x b-b text-center"><?php echo $countrycus;?></td>
          <td colspan="4" rowspan="4" class="b-all va-top">
          <?php
                include 'database' . '.php';
                $id=addslashes($_GET['printid']);
                $sqlp="select * from `pieces_detail` where raf_id='$id'";
                $resultp = mysqli_query($con,$sqlp);
                if($resultp){

                  while($row=mysqli_fetch_assoc($resultp)){
                    $dimension=$row['dimension'];
                    echo $dimension;
                    echo '<br>';

                  }
                }
                ?>
          </td>
          <td class="b-all text-center">Vol. Weight</td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td colspan="2" class="bbg-all">CONSIGNEE :</td>
          <td rowspan="3" class="b-all text-center"><?php echo $volume;?></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td colspan="2" rowspan="6" class="b-all  va-top">
            <?php echo $consignee;?><br>
            <?php echo $address;?><br>
          </td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td colspan="4" class="b-all">Type of Payment</td>
          <td class="b-l b-t"></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-all text-center"><?php if($type_of_payment=="Cash Only"){echo "X";}?></td>
          <td class="b-x b-t">Cash Only</td>
          <td class="b-all text-center"><?php if($type_of_payment=="Insurance"){echo "X";}?></td>
          <td class="b-l b-t">Insurance</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-all text-center"><?php if($type_of_payment=="Credit"){echo "X";}?></td>
          <td class="b-l">Credit</td>
          <td class="b-t"></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-all text-center"><?php if($type_of_payment=="Collect to Consignee"){echo "X";}?></td>
          <td colspan="3" class="b-l b-b">Collect to Consignee</td>
          <td class="b-b"></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x b-t">Contact Person :</td>
          <td class="b-x b-t">Postcode :</td>
          <td colspan="5" class="bbg-all">Special Instruction</td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x b-b text-center"><?php echo $contact;?></td>
          <td class="b-x b-b text-center"><?php echo $postcode;?></td>
          <td colspan="5" rowspan="3" class="b-all va-top"><?php echo $special_instruction;?></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x b-t">No.Tel/HP :</td>
          <td class="b-x b-t">Country :</td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x b-b text-center"><?php echo $telephone;?></td>
          <td class="b-x b-b text-center"><?php echo $country;?></td>
          <td></td>
        </tr>
        <tr>
          <td width="1%"></td>
          <td width="25%"></td>
          <td width="25%"></td>
          <td width="3%"></td>
          <td width="22"></td>
          <td width="3%"></td>
          <td width="12%"></td>
          <td width="10%"></td>
          <td width="1%"></td>
        </tr>
      </table>
    </div>

    <hr style="margin-top: 1rem; margin-bottom: 1rem;">

    <div style="height: 33.333%;">
      <table cellspacing="0" border="0" width="100%">
        <tr>
          <td height="10px"></td>
          <td rowspan="4"><img src="../assets/img/logo_mini.png" width="150px" height="56px"></td>
          <td></td>
          <td colspan="4"><strong>SHIPMENT AIRWAYBILL</strong></td>
          <td class="text-center"><b><?php echo $newdate;?></b></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td></td>
          <td colspan="4"><strong>RAF<?php echo $id;?></strong></td>
          <td class="text-center"><b><?php echo $courier;?></b></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x b-t">No Account:</td>
          <td colspan="3" class="bbg-all">Service Request</td>
          <td class="bbg-all text-center">Origin</td>
          <td class="bbg-all text-center">Destination</td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x"></td>
          <td class="b-all text-center"><?php if($service_request=="Domestic"){echo "X";}?></td>
          <td colspan="2" class="b-x b-t">Domestic</td>
          <td rowspan="2" class="b-all text-center"><?php echo $origincus;?></td>
          <td rowspan="2" class="b-all text-center"><?php echo $destination;?></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td colspan="2" class="bbg-all">SHIPPER :</td>
          <?php
          if($service_request=='International Courier'){
            echo'<td class="b-all text-center">X</td>';
            echo'<td colspan="2" class="b-x b-b">International Courier</td>';
          }elseif($service_request=='Import'){
            echo'<td class="b-all text-center">X</td>';
            echo'<td colspan="2" class="b-x b-b">Import</td>';
          }else{
            echo'<td class="b-all text-center"></td>';
            echo'<td colspan="2" class="b-x b-b">International Courier</td>';
          }
          ?>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td colspan="2" rowspan="4" class="b-all va-top">
          <?php echo $shipper;?><br>
          <?php echo $addresscus;?><br>
          </td>
          <td colspan="3" class="bbg-all">Details of Shipment of Package</td>
          <td class="bbg-all text-center">Qty</td>
          <td class="bbg-all text-center">Weight</td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-all text-center"><?php if($details_of_shipment=="Document"){echo "X";}?></td>
          <td colspan="2" class="b-x b-t">Document</td>
          <td rowspan="2" class="b-all text-center"><?php echo $pieces;?></td>
          <td rowspan="2" class="b-all text-center"><?php echo $weight;?></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-all text-center"><?php if($details_of_shipment=="Package"){echo "X";}?></td>
          <td colspan="2" class="b-x b-b">Package</td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td colspan="4" class="b-all">Description of Goods</td>
          <td class="b-all text-center">Value Invoice</td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x b-t">Contact Person :</td>
          <td class="b-x b-t">Postcode :</td>
          <td colspan="4" rowspan="2" class="b-all va-top"><?php echo $description_of_good;?></td>
          <td rowspan="2" class="b-all text-center"><?php echo $value_invoice;?></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x b-b text-center"><?php echo $contactcus;?></td>
          <td class="b-x b-b text-center"><?php echo $postcodecus;?></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x b-t">No.Tel/HP :</td>
          <td class="b-x b-t">Country :</td>
          <td colspan="5" class="b-l b-y">Dimensions</td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x b-b text-center"><?php echo $telephonecus;?></td>
          <td class="b-x b-b text-center"><?php echo $countrycus;?></td>
          <td colspan="4" rowspan="4" class="b-all va-top">
          <?php
                include 'database' . '.php';
                $id=addslashes($_GET['printid']);
                $sqlp="select * from `pieces_detail` where raf_id='$id'";
                $resultp = mysqli_query($con,$sqlp);
                if($resultp){

                  while($row=mysqli_fetch_assoc($resultp)){
                    $dimension=$row['dimension'];
                    echo $dimension;
                    echo '<br>';

                  }
                }
                ?>
          </td>
          <td class="b-all text-center">Vol. Weight</td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td colspan="2" class="bbg-all">CONSIGNEE :</td>
          <td rowspan="3" class="b-all text-center"><?php echo $volume;?></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td colspan="2" rowspan="6" class="b-all  va-top">
            <?php echo $consignee;?><br>
            <?php echo $address;?><br>
          </td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td colspan="4" class="b-all">Type of Payment</td>
          <td class="b-l b-t"></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-all text-center"><?php if($type_of_payment=="Cash Only"){echo "X";}?></td>
          <td class="b-x b-t">Cash Only</td>
          <td class="b-all text-center"><?php if($type_of_payment=="Insurance"){echo "X";}?></td>
          <td class="b-l b-t">Insurance</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-all text-center"><?php if($type_of_payment=="Credit"){echo "X";}?></td>
          <td class="b-l">Credit</td>
          <td class="b-t"></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-all text-center"><?php if($type_of_payment=="Collect to Consignee"){echo "X";}?></td>
          <td colspan="3" class="b-l b-b">Collect to Consignee</td>
          <td class="b-b"></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x b-t">Contact Person :</td>
          <td class="b-x b-t">Postcode :</td>
          <td colspan="5" class="bbg-all">Special Instruction</td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x b-b text-center"><?php echo $contact;?></td>
          <td class="b-x b-b text-center"><?php echo $postcode;?></td>
          <td colspan="5" rowspan="3" class="b-all va-top"><?php echo $special_instruction;?></td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x b-t">No.Tel/HP :</td>
          <td class="b-x b-t">Country :</td>
          <td></td>
        </tr>
        <tr>
          <td height="10px"></td>
          <td class="b-x b-b text-center"><?php echo $telephone;?></td>
          <td class="b-x b-b text-center"><?php echo $country;?></td>
          <td></td>
        </tr>
        <tr>
          <td width="1%"></td>
          <td width="25%"></td>
          <td width="25%"></td>
          <td width="3%"></td>
          <td width="22"></td>
          <td width="3%"></td>
          <td width="12%"></td>
          <td width="10%"></td>
          <td width="1%"></td>
        </tr>
      </table>
    </div>
    <script>window.print();</script>
</body>
</html>
