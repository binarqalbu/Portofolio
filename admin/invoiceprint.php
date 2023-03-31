<!-- php code -->
<?php
  include 'database' . '.php';
  if (!isset($_POST['srcshipper'])) {
	header("Location: http://localhost/Raf/index");
  }
	$from=addslashes($_POST['from_date']);
	$from = str_replace('/', '-', $from);
	$newfrom=date("Y-m-d", strtotime($from));
	$to=addslashes($_POST['to_date']);
	$to = str_replace('/', '-', $to);
	$newto=date("Y-m-d", strtotime($to));
	$srcshipper=addslashes($_POST['srcshipper']); 
	$number=addslashes($_POST['number']);
	$npwp=addslashes($_POST['npwp']);
	$tglpeng=addslashes($_POST['tglpeng']);
	
	$sql="select * from `customer` where shipper='$srcshipper'";
	$result=mysqli_query($con,$sql);
	$row=mysqli_fetch_assoc($result);
	$address=$row['address'];
	?>

<!DOCTYPE html>
<html lang="en"><head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="../assets/img/raffeda.png">
  <title>Invoice</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
  </style>
  <style type="text/css">
  	* {
      font-size: 12px;
      font-family: 'Roboto', sans-serif;
    }
    table, tr, th, td {
      border-collapse: collapse;
      padding-left: 2px;
      padding-right: 2px;
    }
    .border {
      border: 1px solid black;
    }
    .text-center {
    	text-align: center;
    }
    .text-right {
    	text-align: right;
    }
    .text-left {
    	text-align: left !important;
    }
   	.v-top {
   		vertical-align: top;
   	}
	.notbold{
    	font-weight: normal;
	}​
  	@media print{
        @page {
        margin-top: 0;
        margin-bottom: 0;
    }
    body {
        padding-top: 72px;
        padding-bottom: 72px ;
    }
      * {
	      font-size: 12px;
	      font-family: 'Roboto', sans-serif;
	    }
	    table, tr, th, td {
	      border-collapse: collapse;
	      padding-left: 2px;
	      padding-right: 2px;
	    }
	    .border {
	      border: 1px solid black;
	    }
	    .text-center {
	    	text-align: center;
	    }
	    .text-right {
	    	text-align: right;
	    }
	    .text-left {
	    	text-align: left !important;
	    }
		
	  }
  </style>
<style class="automa-element-selector">@font-face { font-family: "Inter var"; font-weight: 100 900; font-display: swap; font-style: normal; font-named-instance: "Regular"; src: url("chrome-extension://infppggnoaenmfagbfknfkancpbljcca/Inter-roman-latin.var.woff2") format("woff2") }
.automa-element-selector { direction: ltr } 
 [automa-isDragging] { user-select: none } 
 [automa-el-list] {outline: 2px dashed #6366f1;}</style></head>
<body>
<?php
		session_start();
          if($_SESSION['role'] != "admin"){
            header("Location: http://localhost/Raf/index");
          }               
?>
<div class="row">
	<table class="border" width="100%">
		<thead class="thead-dark border">
			<tr>
				<!-- <th colspan="12"><img src="../assets/img/logo_mini.png" height="56" width="150"></th> -->
				<th colspan="12">N,P,W,P :<?php echo $npwp?></th>
			</tr>
			<tr>
				<!-- <th colspan="12"><img src="../assets/img/logo_mini.png" height="56" width="150"></th> -->
				<th colspan="12">TGL,PENG :<?php echo $tglpeng?></th>
			</tr>
			<tr>
				<th colspan="8">&nbsp;</th>
			</tr>
			<tr>
				<th colspan="8" class="text-left v-top" style="padding-left:10px; padding-right:20px;">Bill To :</th>
			</tr>
			<tr>
				<th colspan="6" class="text-left v-top" style="padding-left:10px; padding-right:20px;"><?php echo $srcshipper?></th>
				<th colspan="4" class="text-left v-top">Invoice : <?php echo $number?></th>
			</tr>
			<tr>
				<th colspan="5" class="text-left v-top" style="padding-left:10px; padding-right:20px;"><?php echo $address?></th>
				<th colspan="1" class="text-left v-top"></th>
				<th colspan="4" class="text-left v-top">Date. : <?php echo date("d/m/Y")?></th>
			</tr>
			<tr>
				<th colspan="8" class="text-left v-top" style="padding-left:10px; padding-right:20px;"></th>
			</tr>
			<tr>
				<th colspan="8">&nbsp;</th>
			</tr>
			<tr>
				<th width="3%" class="text-center border">No</th>
				<th width="10%" class="text-center border">Date</th>
				<th width="10%" class="text-center border">Raffeda</th>
				<th width="10%" class="text-center border">DHL</th>
				<th width="10%" class="text-center border">Dest,</th>
				<th width="6%" class="text-center border">Weight</th>
				<th width="10%" class="text-center border" colspan="3">Description</th>
				<th width="12%" class="text-center border" colspan="2">Amount&nbsp;(IDR)</th>
			</tr>
		</thead>
		<tbody>
		
		<?php include 'database' . '.php'; 
			$sql ="Select * from `airwaybill` where date between '$newfrom' and '$newto' and shipper = '$srcshipper'";
			$result = mysqli_query($con,$sql);
			$i=0;
			$sumtotal=0;
			if($result){
			while($row=mysqli_fetch_assoc($result)){
				$id=$row['id_shipment'];
				$date=$row['date'];
				$newdate=date("d/m/Y", strtotime($date)); 
				$courier=$row['courier'];
				$shipper=$row['shipper'];
				$destination=$row['country'];
				$weight=$row['weight'];
				$details_of_shipment=substr(strtoupper($row['details_of_shipment']),0,3);
				$price=number_format($row['price'],0,',','.');
				$emergency_fee=number_format($row['emergency_fee'],0,',','.');
				$fuel_surcharges=number_format($row['fuel_surcharges'],0,',','.');
				$additional_fee=number_format($row['additional_fee'],0,',','.');
				$total=$row['total'];
				$sumtotal=$sumtotal+$total;

				echo'<tr>'; 
				echo'<td class="text-center border">'.++$i.'</td>';
				echo'<td class="text-center border">'.$newdate.'</td>';
				echo'<td class="text-center border">'.$id.'</td>';
				echo'<td class="text-center border">'.$courier.'</td>';
				echo'<td class="text-center border">'.$destination.'</td>';
				echo'<td class="text-center border">'.$weight.'</td>';
				echo'<td class="text-center border">'.$details_of_shipment.'</td>';
				echo'<td class="text-center border">IDR</td>';
				echo'<td class="text-right border">'.$price.'</td>';
				echo'<td class="text-center border">IDR</td>';
				echo'<td class="text-right border">'.$price.'</td>';
				echo'</tr>';

				if($emergency_fee!=0){
					echo'<tr>'; 
					echo'<td class="text-center border"></td>';
					echo'<td class="text-center border" colspan="8">EMERGENCY FEE SITUATION</td>';
					echo'<td class="text-center border">IDR</td>';
					echo'<td class="text-right border">'.$emergency_fee.'</td>';
					echo'</tr>'; 
				}
				if($fuel_surcharges!=0){
					echo'<tr>'; 
					echo'<td class="text-center border"></td>';
					echo'<td class="text-center border" colspan="8">FUEL SURCHARGES</td>';
					echo'<td class="text-center border">IDR</td>';
					echo'<td class="text-right border">'.$fuel_surcharges.'</td>';
					echo'</tr>';
				}
				if($additional_fee!=0){
					echo'<tr>'; 
					echo'<td class="text-center border"></td>';
					echo'<td class="text-center border" colspan="8">ADDITIONAL FEE</td>';
					echo'<td class="text-center border">IDR</td>';
					echo'<td class="text-right border">'.$additional_fee.'</td>';
					echo'</tr>';
				}
			}
			$sumtotal=number_format($sumtotal,0,',','.');
			$vat=$sumtotal * 1.1/100;
			$grandtotal=$sumtotal+$vat;
			}
        ?>
		<tr>
			<td colspan="10" class="text-right border" style="padding-right: 10px;">TOTAL BEFORE VAT</td>
			<td class="text-right border"><?php echo $sumtotal;?></td>
		</tr>
		<tr>
			<td colspan="10" class="text-right border" style="padding-right: 10px;">VAT 1,1%</td>
			<td class="text-right border"><?php echo $vat;?></td>
		</tr>
		<tr>
			<td colspan="10" class="text-right border" style="padding-right: 10px;">GRAND TOTAL</td>
			<td class="text-right border"><?php echo $grandtotal;?></td>
		</tr></tbody>
		<tr>
			<th colspan="8" class="text-left v-top notbold" style="padding-left:10px; padding-right:20px;">Payment by cheque/giro bilyet to be</th>
		</tr>
		<tr>
			<th colspan="5" class="text-left v-top notbold" style="padding-left:10px; padding-right:20px;">deemed 7 days from receipt of</th>
			<th colspan="4" class="text-left v-top"> [ Please pay in FULL AMOUNT ]</th>
		</tr>
		<tr>
			<th colspan="5" class="text-left v-top notbold" style="padding-left:10px; padding-right:20px;">invoice and should be made to</th>
			<th colspan="3" class="text-left v-top"></th>
		</tr>
		<tr>
			<th colspan="6" class="text-left v-top" style="padding-left:10px; padding-right:20px;">PT. RAFFA EDA MARASOKI</th>
			<th colspan="5" class="text-left v-top notbold">Jakarta, <?php echo date("d F Y")?></th>
		</tr>
		<tr>
			<th colspan="5" class="text-left v-top" style="padding-left:10px; padding-right:20px;">MANDIRI BANK  IDR 166-00-0244689-6</th>
			<th colspan="3" class="text-left v-top"></th>
		</tr>
		<tr>
			<th colspan="8" class="text-left v-top" style="padding-left:10px; padding-right:20px;"></th>
		</tr>
		<tr>
			<th colspan="8">&nbsp;</th>
		</tr>
	</table>
			</div><script>window.print();</script>

<div id="automa-palette"></div></body></html>