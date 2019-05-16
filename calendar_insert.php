<?php



require('connection.php');
$user_id=$_SESSION['user']['id'];

if(isset($_POST["title"]))
{
 $query = "
 INSERT INTO events 
 (user_id ,title, start_event, end_event) 
 VALUES ( :user_id, :title, :start_event, :end_event)
 ";
 $statement = $db->prepare($query);
 $statement->execute(
  array(
    ':user_id' => $user_id,
   ':title'  => $_POST['title'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end']
  )
 );
}


?>
