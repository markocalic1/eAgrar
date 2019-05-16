<?php
// First we execute our common code to connection to the database and start the session
include("connection.php");




// At the top of the page we check to see whether the user is logged in or not
$user_id=$_SESSION['user']['id'];

    	include('devicelist.php');




    $query_data_all = "
    select metadata.time, payload_fields.* FROM metadata 
    join payload_fields on metadata.insert_id=payload_fields.insert_id 
    join device on metadata.insert_id=device.insert_id AND device.dev_id='$tbname' 
    join user_device on device.dev_id=user_device.dev_id and user_device.id=$user_id 
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
<!DOCTYPE html>
<html lang="en">

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

<?php include('navbar.php');?>


  <div id="wrapper">

  <?php include('sidebar.php');?>


    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Tables</li>
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
												echo '<a class="dropdown-item" href="table_data.php?name='.$dev["dev_id"].'">'.$dev["dev_id"].'</a>';
												}?>
						</div>
          </div>
        </div>
        
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Podatci sa uređaja : <?php echo $_SESSION['selected_dev']?></div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="dataTable"  cellspacing="0">
                <thead>
                  <tr>
                      <th>Datum i vrijeme</th>
                      <th>Temperatura (°C)</th>
                      <th>Vlažnost zraka (%)</th>
                      <th>Pritisak zraka (hPa)</th>
                      <th>Vlažnost tla (%)</th>
                      <th>Vlažnost lista (%)</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                      <th>Datum i vrijeme</th>
                      <th>Temperatura (°C)</th>
                      <th>Vlažnost zraka (%)</th>
                      <th>Pritisak zraka (hPa)</th>
                      <th>Vlažnost tla (%)</th>
                      <th>Vlažnost lista (%)</th>
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
                        echo '   <td>'.$row["soil_moisture"].'</td>';
                        echo '   <td>'.$row["leaf_humidity"].'</td>';
                
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
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
