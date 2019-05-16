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
		  <a href="#">Calendar</a>
		</li>
		<li class="breadcrumb-item active">Overview</li>
	  </ol>

     
				
		<!-- Icon Cards-->
		<div class="row">
          
        </div>
	  

	  
	

	  <!-- Area Chart Example-->
	  <div class="card mb-3">
          
          <div class="card-body">
          <br />
            <div class="container">
            <div id="calendar"></div>
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
<script src="js/easypiechart.js"></script>


<!-- Demo scripts for this page-->

  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/Chart.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>

	<script src="js/line_chart.js"></script>

	<script src="js/custom.js"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script>
   
  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
    events: 'calendar_load.php',
    selectable:true,
    selectHelper:true,
    select: function(start, end, allDay)
    {
     var title = prompt("Unesi naziv događaja");
     if(title)
     {
      var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
      $.ajax({
       url:"calendar_insert.php",
       type:"POST",
       data:{title:title, start:start, end:end},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Dodan uspješno");
       }
      })
     }
    },
    editable:true,
    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var event_id = event.event_id;
     $.ajax({
      url:"calendar_update.php",
      type:"POST",
      data:{title:title, start:start, end:end, event_id:event_id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       alert('Promjena događaja');
      }
     })
    },

    eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var event_id = event.event_id;
     $.ajax({
      url:"calendar_update.php",
      type:"POST",
      data:{title:title, start:start, end:end, event_id:event_id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Događaj promijenjen");
      }
     });
    },

    eventClick:function(event)
    {
     if(confirm("Jeste li sigurni da želite izbrisati događaj?"))
     {
      var event_id = event.event_id;
      $.ajax({
       url:"calendar_delete.php",
       type:"POST",
       data:{event_id:event_id},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Događaj izbrisan");
       }
      })
     }
    },

   });
  });
   
  </script>
		
      <style>
        .table-condensed{
          display: none;
        }
      </style>

</body>
</html>