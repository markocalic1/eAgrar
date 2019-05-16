<?php
include('connection.php');
$user_id=$_SESSION['user']['id'];
include('devicelist.php');


$query_measurement = "
select metadata.time, payload_fields.*
    FROM metadata join payload_fields on metadata.insert_id=payload_fields.insert_id 
    join device on metadata.insert_id=device.insert_id AND device.dev_id='$tbname' 
    join user_device on device.dev_id=user_device.dev_id 
    and user_device.id=$user_id order by time desc limit 1;

    ";



try {
    // These two statements run the query against your database table.
    $stmt1 = $db->prepare($query_measurement);
    $stmt1->execute();
}
catch(PDOException $ex) {
    // Note: On a production website, you should not output $ex->getMessage().
    // It may provide an attacker with helpful information about your code.
    die("Failed to run query: " . $ex->getMessage());
}


    
$last_measure = $stmt1->fetch();

$last_temperature=$last_measure['temperature'];
$last_humidity=$last_measure['humidity'];
$last_pressure=$last_measure['pressure'];
$last_soil_moisture=$last_measure['soil_moisture'];
$last_leaf_moisture=$last_measure['leaf_humidity'];



$last_date=$last_measure['time'];


?>