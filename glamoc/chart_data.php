<?php
include('connection.php');



$query_data = "
select  time, payload_fields.*
 FROM metadata join payload_fields on metadata.insert_id=payload_fields.insert_id 
 join device on metadata.insert_id=device.insert_id AND device.dev_id='uredjaj2' 
 order by time desc limit 150;

";


 
try {
    // These two statements run the query against your database table.
    $stmt3 = $db->prepare($query_data);
    $stmt3->execute();
}
catch(PDOException $ex) {
    // Note: On a production website, you should not output $ex->getMessage().
    // It may provide an attacker with helpful information about your code.
    die("Failed to run query: " . $ex->getMessage());
}

$data= array();
    
// Finally, we can retrieve all of the found rows into an array using fetchAll
$data= $stmt3->fetchAll();
print json_encode($data);
?>