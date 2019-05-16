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
		  <a href="#">Prognoza</a>
		</li>
		<li class="breadcrumb-item active">Overview</li>
	  </ol>

	  <!-- Area Chart Example-->
	  <div class="card mb-3">
          
          <div class="card-body">
          <a class="weatherwidget-io" href="https://forecast7.com/hr/43d5116d44/split/" data-label_1="SPLIT" data-label_2="WEATHER" data-theme="original" >SPLIT WEATHER</a>
            <script>
            !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
            </script>            
          </div>
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


<!-- Demo scripts for this page-->

  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/Chart.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>

	<script src="js/line_chart.js"></script>

	<script src="js/custom.js"></script>


</body>
</html>