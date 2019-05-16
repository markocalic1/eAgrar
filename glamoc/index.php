<?php
// First we execute our common code to connection to the database and start the session
require("connection.php");


// At the top of the page we check to see whether the user is logged in or not



$query_measurement = "
select metadata.time, payload_fields.*
    FROM metadata join payload_fields on metadata.insert_id=payload_fields.insert_id 
    join device on metadata.insert_id=device.insert_id AND device.dev_id='uredjaj2' 
     order by time desc limit 1;

    ";



try {
    // These two statements run the query against your database table.
    $stmt1 = $db->prepare($query_measurement);
    $stmt1->execute();
}
catch(PDOException $ex) {
    // Note: On a production website, you should not output $ex->getMessage().
    // It may provide an attacker with helpful information about your code.
    die("Failed to run query: " . $ex->getMessage());
}


    
$last_measure = $stmt1->fetch();

$last_temperature=$last_measure['temperature'];
$last_humidity=$last_measure['humidity'];
$last_pressure=$last_measure['pressure'];
$last_soil_moisture=$last_measure['soil_moisture'];
$last_leaf_moisture=$last_measure['leaf_humidity'];



$last_date=$last_measure['time'];


?>





<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="mjerni uređaj za praćenje temperature zraka, vlažnosti zraka i tlaka zraka glamoc. Ovo je ujedno prva meteorološka postaja u Glamoču.
  -vrijednosti posljednjeg mjerenja"/>

	<title>eAgrar - vrijednosti za Glamoč
  </title>


<link rel="icon" href="img/android-icon-144x144.png" type="image/x-icon"/>
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">




<!-- Custom styles for this template-->
<link href="css/main.css" rel="stylesheet">


<link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">




</head>

<body id="page-top">

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

  <a class="navbar-brand mr-1text-center" href="#"><span><img src="img/transparent_logo_crna_2.png" class="img-responsive" style="height: 45px;" alt="logo_eagrar"></span>eAgrar</a> 
 

</nav>

<div id="wrapper">


  <div id="content-wrapper">

	<div class="container-fluid">

	  <!-- Breadcrumbs-->
	  <ol class="breadcrumb">
		<li class="breadcrumb-item">
		  <a href="#">Početna</a>
		</li>
		<li class="breadcrumb-item active">Pregled zadnjih mjerenja za Općinu Glamoč </li>
	  </ol>

		
		<!-- Icon Cards-->
		<div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-dark bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
								<i class="fas fa-fw fa-thermometer-half"></i>
						</div>
						<div class="mr-5">Temperatura zraka:<?php echo $last_temperature?>°C</div>
					</div>
					<a class="card-footer text-dark clearfix small z-1" href="#">
						<span class="float-center"><?php echo $last_date?></span>
					</a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-dark bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
								<i class="fas fa-fw fa-tint"></i>
								</div>
								<div class="mr-5">Vlažnost zraka: <?php echo $last_humidity?>%</div>
							</div>
							<a class="card-footer text-dark clearfix small z-1" href="#">
								<span class="float-center"><?php echo $last_date?></span>
							</a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-dark bg-info o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
								<i class="fas fa-fw fa-cloud-download"></i>
									</div>
									<div class="mr-5">Tlak zraka: <?php echo $last_pressure?>hPa</div>
								</div>
								<a class="card-footer text-dark clearfix small z-1" href="#">
									<span class="float-center"><?php echo $last_date?></span>
								</a>
            </div>
					</div>
				
        </div>
	  

	  
	  <div class="card mb-3">
		
		<div class="card-body">
			<canvas id="line-chartcanvas-temperatures" width="100" height="45" ></canvas>
		</div>
		<button class="btn-warning rounded mb-2 mx-auto"  id="removeDatatemp">Ukloni podatak</button>

		<div class="card-footer small text-muted">Zadnja promjena: <?php echo $last_date?></div>
	  </div>


	  <!-- Area Chart Example-->
	  <div class="card mb-3">
		
		<div class="card-body">
		<canvas id="line-chartcanvas-hum" width="100" height="45" ></canvas>

		</div>
		<button class="btn-warning rounded mb-2 mx-auto" id="removeDataHum">Ukloni podatak</button>

		<div class="card-footer small text-muted">Zadnja promjena: <?php echo $last_date?></div>
      </div>
      

      <!--table-->


      <?php





    $query_data_all = "
    select metadata.time, payload_fields.* FROM metadata 
    join payload_fields on metadata.insert_id=payload_fields.insert_id 
    join device on metadata.insert_id=device.insert_id AND device.dev_id='uredjaj2' 
    order by time desc

    ";

    $query_device_list ="SELECT dev_id FROM `user_device` WHERE id=$user_id
    "; 

    try {
        // These two statements run the query against your database table.
        $stmt4 = $db->prepare($query_data_all);
        $stmt4->execute();
       
        

    }
    catch(PDOException $ex) {
        // Note: On a production website, you should not output $ex->getMessage().
        // It may provide an attacker with helpful information about your code.
        die("Failed to run query: " . $ex->getMessage());
    }

    $data_all= array();
        
    // Finally, we can retrieve all of the found rows into an array using fetchAll
    $data_all= $stmt4->fetchAll();
    

?>
      <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
                Podatci sa uredaja uredjaj2
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="dataTable"  cellspacing="0">
                <thead>
                  <tr>
                      <th>Datum i vrijeme</th>
                      <th>Temperatura (°C)</th>
                      <th>Vlažnost zraka (%)</th>
                      <th>Pritisak zraka (hPa)</th>
                      
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                      <th>Datum i vrijeme</th>
                      <th>Temperatura (°C)</th>
                      <th>Vlažnost zraka (%)</th>
                      <th>Pritisak zraka (hPa)</th>
                      
                  </tr>
                </tfoot>
                <tbody>
                    <?php


                    // Retrieve all records and display them
                
                    // Used for row color toggle
                
                    // process every record
                    foreach( $data_all as $row  )
                    {
                       
                
                        echo '<tr class="table-info">';
                        echo '   <td>'.$row["time"].'</td>';
                        echo '   <td>'.$row["temperature"].'</td>';
                        echo '   <td>'.$row["humidity"].'</td>';
                        echo '   <td>'.$row["pressure"].'</td>';
                
                        echo '</tr>';
                    }
                
                ?>
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>


	  

	  
	</div>
	<!-- /.container-fluid -->

	

  </div>
  <!-- /.content-wrapper -->

</div>
</div>
<!-- /#wrapper -->


<footer class="page-footer  bg-dark pt-2">
  <div class="footer-copyright text-center text-white bg-dark py-3 text-light">© 2019 Copyright:
        <a class="text-white" href=""> eAgrar</a>
      </div>
	</footer>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script src="js/Chart.min.js"></script>


  <script src="js/line_chart.js"></script>

<!-- Page level plugin JavaScript-->
<script src="vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>
<script src="js/datatables-demo.js"></script>



</body>

<?php  require_once('counter.php');?>

</html>
