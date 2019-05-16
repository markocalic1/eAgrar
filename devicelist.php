<?php
$query_device_list ="SELECT dev_id FROM `user_device` WHERE id=$user_id
    "; 

    try {
        // These two statements run the query against your database table.
      
        $stmt5 = $db->prepare($query_device_list);
        $stmt5->execute();
        
        

    }
    catch(PDOException $ex) {
        // Note: On a production website, you should not output $ex->getMessage().
        // It may provide an attacker with helpful information about your code.
        die("Failed to run query: " . $ex->getMessage());
    }

    $device_list=array();
        
    // Finally, we can retrieve all of the found rows into an array using fetchAll
    $device_list=$stmt5->fetchAll();
       
        $tbname=$device_list[0]["dev_id"];

   

   if (!empty($_GET)) {
    // no data passed by get
    $_SESSION['selected_dev']= $_GET['name'];

    }
    if(!empty($_SESSION['selected_dev'])){
    $tbname=$_SESSION['selected_dev'];
    }
    ?>