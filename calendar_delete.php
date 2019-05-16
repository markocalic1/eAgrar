<?php

require('connection.php');

if(isset($_POST["event_id"]))
{
 $query = "
 DELETE from events WHERE event_id=:event_id
 ";
 $statement = $db->prepare($query);
 $statement->execute(
  array(
   ':event_id' => $_POST['event_id']
  )
 );
}

?>