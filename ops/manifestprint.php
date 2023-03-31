<!-- php code -->
<?php
  include 'database' . '.php';
	$from=addslashes($_POST['from_date']);
	$from = str_replace('/', '-', $from);
	$newfrom=date("Y-m-d", strtotime($from));
	$to=addslashes($_POST['to_date']);
	$to = str_replace('/', '-', $to);
	$newto=date("Y-m-d", strtotime($to));
	if(!empty($_POST['type'])){
	$type=addslashes($_POST['type']);
	}elseif(!empty($_POST['shipper'])){
		$shipper=addslashes($_POST['shipper']);
	}else{
		header("Location: http://localhost/Raf/index");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="../assets/img/raffeda.png">
  <title>Manifest</title>
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
      border: 1px solid black;
      padding-left: 2px;
      padding-right: 2px;
    }
    .text-center {
    	text-align: center;
    }
    .text-right {
    	text-align: right;
    }
  	@media print {
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
	      border: 1px solid black;
	      padding-left: 2px;
	      padding-right: 2px;
	    }
	    .text-center {
	    	text-align: center;
	    }
	    .text-right {
	    	text-align: right;
	    }
	  }
  </style>
</head>
<body>
<?php
		  session_start();
          if($_SESSION['role'] != "operasional"){
            header("Location: http://localhost/Raf/index");
          }               
?>
<div class="row">
	<table class="" width="100%">
		<thead class="thead-dark">
			<tr>
				<th colspan="12"><p class="text-center"><strong>Manifest <?php if(!empty($type)){echo $type;}?></strong></p></th>
			</tr>
			<tr>
				<th width="3%" class="text-center">No</th>
				<th width="8%" class="text-center">Date</th>
				<th width="8%" class="text-center">Airwaybill</th>
				<th width="8%" class="text-center">Courier</th>
				<th class="text-center">Shipper</th>
				<th class="text-center">Consignee</th>
				<th class="text-center">Destination</th>
				<th class="text-center">Postcode</th>
				<th width="5%" class="text-center">Product</th>
				<th width="5%" class="text-center">Pieces</th>
				<th width="5%" class="text-center">Weight</th>
				<th class="text-center">Dimension</th>
			</tr>
		</thead>
		<tbody>
			<?php include 'database' . '.php';
				if(!empty($type)){
					$sql ="Select * from `airwaybill` where date between '$newfrom' and '$newto' and service_request like'%$type%' order by date asc";
					$result = mysqli_query($con,$sql);
				}elseif(!empty($shipper)){
					$sql ="Select * from `airwaybill` where date between '$newfrom' and '$newto' and shipper like'%$shipper%' order by date asc";
					$result = mysqli_query($con,$sql);
				}
				$i=0;
				if($result){
				while($row=mysqli_fetch_assoc($result)){
					$id=$row['id_shipment'];
					$date=$row['date'];
					$date = str_replace('-', '/', $date);
					$newdate=date("d/m/Y", strtotime($date));
					$courier=$row['courier'];
					$shipper=$row['shipper'];
					$consignee=$row['consignee'];
					$destination=$row['country'];
					$postcode=$row['postcode'];
					$product=$row['details_of_shipment'];
					$pieces=$row['pieces'];
					$weight=$row['weight'];

					if($product =='Document'){
						$product = 'DOC';
					}elseif($product =='Package'){
						$product = 'WPX';
					}

					echo'<tr>'; 
					echo'<td class="text-center">'.++$i.'</td>';
					echo'<td class="text-center">'.$newdate.'</td>';
					echo'<td class="text-center">RAF'.$id.'</td>';
					echo'<td class="text-center">'.$courier.'</td>';
					echo'<td>'.$shipper.'</td>';
					echo'<td>'.$consignee.'</td>';
					echo'<td class="text-center">'.$destination.'</td>';
					echo'<td class="text-center">'.$postcode.'</td>';
					echo'<td class="text-center">'.$product.'</td>';
					echo'<td class="text-center">'.$pieces.'</td>';
					echo'<td class="text-center">'.$weight.'</td>';
					echo'<td class="text-center">';
					$sqlp="select * from `pieces_detail` where raf_id='$id'";
                	$resultp = mysqli_query($con,$sqlp);
                	if($resultp){
                  	while($rowp=mysqli_fetch_assoc($resultp)){
                    $dimension=$rowp['dimension'];
                    echo $dimension;
                    echo '<br>';

                  }
                }
					echo '</td>';
					echo '</tr>';
				}
				}
            ?>
		</tbody>
	</table>
</div><script>window.print();</script>
</body>
</html>