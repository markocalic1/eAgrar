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
    
    if (!empty($_POST['device'])) {

        // Define our SQL query
        $query_post = "
        INSERT INTO `user_device` (`id`, `dev_id`) VALUES ('$user_id', '$_POST[device]');
        ";
    
        // Define our query parameter values
    
        try { 
                // Execute the query
                $stmt6 = $db->prepare($query_post);
                $result6 = $stmt6->execute();
        }
        catch(PDOException $ex) {
                // Note: On a production website, you should not output $ex->getMessage().
                // It may provide an attacker with helpful information about your code.
                
                echo "<script>alert('Ne postoji u bazi taj uređaj!!! ')</script>";
        }
    }

    if (!empty($_POST['dev_id'])) {

      // Define our SQL query
      $query_delete = "
      DELETE FROM `user_device` WHERE `user_device`.`id` = $user_id AND `user_device`.`dev_id` = '".$_POST['dev_id']."'
      
      ";
  
      // Define our query parameter values
  
      try { 
              // Execute the query
              $stmt7 = $db->prepare($query_delete);
              $result7 = $stmt7->execute();

      }
      catch(PDOException $ex) {
              // Note: On a production website, you should not output $ex->getMessage().
              // It may provide an attacker with helpful information about your code.
              
              echo "<script>alert('Nije izbrisana veza!!! ')</script>";
      }
  }   

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

<?php include('navbar.php');
			include('devicelist.php');
      ?>


  <div id="wrapper">

  <?php include('sidebar.php');?>
  <div id="content-wrapper">

    <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
        <a href="#">Uredi profil</a>
        </li>
        <li class="breadcrumb-item active">Uređaji</li>
    </ol>

    <div class="row mx-auto">
    <ol class="breadcrumb">
		<li class="breadcrumb-item">          
          <form class="form-inline mx-3" action="edit_device.php" method="post">
					  <input class="form-control mr-sm-2" type="text" name="device" placeholder="Dodaj novi uređaj" aria-label="Add another device">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Add</button>
                    
          </form>
    </li>       
                
    </ol>
      </div>
      <form method="post" action="edit_device.php">
        <div class="panel-body">		
        <?php 
                      foreach( $device_list as $dev  ){					
                echo	'<ol>
                    <label for="">'.$dev["dev_id"].'</label>
                  <button class="btn btn-danger float-right"href="#" value="'.$dev["dev_id"].'" type="submit" name="dev_id" class="trash"><em class="fa fa-trash"></em></button>
                  </ol>'; 
                }
                
        ?>
                        
        </div>
      </form>
      
          
            
        
         
    </div>
</div>
</div>
</div>
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

  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/Chart.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>

	<script src="js/line_chart.js"></script>

	<script src="js/custom.js"></script>
	<script src="js/main.js"></script>                                        
</body>