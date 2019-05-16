<?php


require('connection.php');
$user_id=$_SESSION['user']['id'];

$data = array();

$query = "SELECT * FROM events where user_id=$user_id ORDER BY event_id";

$statement = $db->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'event_id'   => $row["event_id"],
  'title'   => $row["title"],
  'start'   => $row["start_event"],
  'end'   => $row["end_event"]
 );
}

echo json_encode($data);

?>