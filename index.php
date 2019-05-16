<?php
// First we execute our common code to connection to the database and start the session
require("connection.php");

// At the top of the page we check to see whether the user is logged in or not
if (empty($_SESSION['user'])) { 
    // If they are not, we redirect them to the login page.
    header("Location: home.php");

    // Remember that this die statement is absolutely critical.  Without it,
    // people can view your members-only content without logging in.
    die("Redirecting to home.php");
}
$user_id=$_SESSION['user']['id'];




?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>eAgrar</title>


<link rel="icon" href="img/android-icon-144x144.png" type="image/x-icon"/>
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<!-- Page level plugin CSS-->
<link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>


<!-- Custom styles for this template-->
<link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

<?php include('navbar.php');
			include('devicelist.php');
			include('last_measure.php');

?>

<div id="wrapper">

  <!-- Sidebar -->
  <?php include('sidebar.php');?>

  <div id="content-wrapper">

	<div class="container-fluid">

	  <!-- Breadcrumbs-->
	  <ol class="breadcrumb">
		<li class="breadcrumb-item">
		  <a href="#">Početna</a>
		</li>
		<li class="breadcrumb-item active">Pregled</li>
	  </ol>

		<div class="row my-2 justify-content-between">
				<div class="dropdown mx-3 mb-1">
						<span>Izaberi uređaj: </span>
						<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<?php echo $tbname; ?>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<?php

										foreach( $device_list as $dev  ){
												echo '<a class="dropdown-item" href="index.php?name='.$dev["dev_id"].'">'.$dev["dev_id"].'</a>';
												}?>
						</div>
					</div>

					
				</div>
				
		<!-- Icon Cards-->
		<div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
								<i class="fas fa-fw fa-thermometer-half"></i>
						</div>
						<div class="mr-5">Temperatura zraka:<?php echo $last_temperature?>°C</div>
					</div>
					<a class="card-footer text-white clearfix small z-1" href="#">
						<span class="float-center"><?php echo $last_date?></span>
					</a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
								<i class="fas fa-fw fa-tint"></i>
								</div>
								<div class="mr-5">Vlažnost zraka: <?php echo $last_humidity?>%</div>
							</div>
							<a class="card-footer text-white clearfix small z-1" href="#">
								<span class="float-center"><?php echo $last_date?></span>
							</a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-info o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
								<i class="fas fa-fw fa-cloud-download"></i>
									</div>
									<div class="mr-5">Tlak zraka: <?php echo $last_pressure?>hPa</div>
								</div>
								<a class="card-footer text-white clearfix small z-1" href="#">
									<span class="float-center"><?php echo $last_date?></span>
								</a>
            </div>
					</div>
					<div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
								<i class="fas fa-fw fa-globe"></i>
									</div>
									<div class="mr-5">Vlažnost tla:<?php echo $last_soil_moisture?>%</div>
								</div>
								<a class="card-footer text-white clearfix small z-1" href="#">
									<span class="float-center"><?php echo $last_date?></span>
								</a>
            </div>
					</div>
					<div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
								<i class="fas fa-fw fa-shower"></i>
									</div>
									<div class="mr-5">Vlažnost lista:<?php echo $last_leaf_moisture?>%</div>
								</div>
								<a class="card-footer text-white clearfix small z-1" href="#">
									<span class="float-center"><?php echo $last_date?></span>
								</a>
            </div>
          </div>
        </div>
	  

	  
	  <div class="card mb-3">
		
		<div class="card-body">
			<canvas id="line-chartcanvas-temperatures" width="100%" height="45px" ></canvas>
		</div>
		<button class="btn-warning rounded mb-2 mx-auto"  id="removeDatatemp">Ukloni podatak</button>

		<div class="card-footer small text-muted">Zadnja promjena: <?php echo $last_date?></div>
	  </div>


	  <!-- Area Chart Example-->
	  <div class="card mb-3">
		
		<div class="card-body">
		<canvas id="line-chartcanvas-hum" width="100%" ></canvas>

		</div>
		<button class="btn-warning rounded mb-2 mx-auto" id="removeDataHum">Ukloni podatak</button>

		<div class="card-footer small text-muted">Zadnja promjena: <?php echo $last_date?></div>
	  </div>

	  

	  
	</div>
	<!-- /.container-fluid -->

	<!-- Sticky Footer -->
	<footer class="sticky-footer">
	  <div class="container my-auto">
		<div class="copyright text-center my-auto">
		  <span>Copyright © eAgrar 2019</span>
		</div>
	  </div>
	</footer>

  </div>
  <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>


<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugin JavaScript-->
<script src="vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin.min.js"></script>
<script src="js/easypiechart.js"></script>


<!-- Demo scripts for this page-->

  <script src="js/bootstrap.min.js"></script>
  <script src="js/Chart.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>

	<script src="js/line_chart.js"></script>

	<script src="js/custom.js"></script>


		

</body>
</html>