<?php

require('connection.php');


if(isset($_POST["event_id"]))
{
 $query = "
 UPDATE events 
 SET title=:title, start_event=:start_event, end_event=:end_event 
 WHERE event_id=:event_id
 ";
 $statement = $db->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end'],

   ':event_id'   => $_POST['event_id']
  )
 );
}

?>
