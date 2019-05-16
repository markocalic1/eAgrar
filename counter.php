<?php



$user_ip=$_SERVER['REMOTE_ADDR'];
$today = date('y-m-j');
$page_name="eagrar";
$query_data = "
select userip from pageview where page='$page_name' and userip='$user_ip' and date='$today' ";


try {
    // These two statements run the query against your database table.
    $check_ip = $db->prepare($query_data);
    $check_ip->execute();
}
catch(PDOException $ex) {
    // Note: On a production website, you should not output $ex->getMessage().
    // It may provide an attacker with helpful information about your code.
    die("Failed to run query: " . $ex->getMessage());
}



if($check_ip->rowCount()>=1)
  {
	
  }
  else
  {
    $insertview = "insert into pageview values('','$page_name','$user_ip','$today'); ";
    try {
        $insertvw = $db->prepare($insertview);
        $insertvw->execute();
    }
    catch(PDOException $ex) {
        
        die("Failed to run query: " . $ex->getMessage());
    }

 

    $updateview1 = "update totalview set unique_visit = unique_visit+1 where page='$page_name' and date='$today'";
    try {
        $updatevw1 = $db->prepare($updateview1);
        $updatevw1->execute();
    }
    catch(PDOException $ex) {
        
        die("Failed to run query: " . $ex->getMessage());
    }
    
    
  }



  $check_date_query= "select date from totalview where page='$page_name' and date='$today' ";

  try {
      // These two statements run the query against your database table.
      $check_date = $db->prepare($check_date_query);
      $check_date->execute();
  }
  catch(PDOException $ex) {
      // Note: On a production website, you should not output $ex->getMessage().
      // It may provide an attacker with helpful information about your code.
      die("Failed to run query: " . $ex->getMessage());
  }
  
  
  if($check_date->rowCount()>=1){
      $updateview = "update totalview set totalvisit = totalvisit+1 where page='$page_name' and date='$today'";
      try {
          $updatevw = $db->prepare($updateview);
          $updatevw->execute();
      }
      catch(PDOException $ex) {
          
          die("Failed to run query: " . $ex->getMessage());
      }
  }
  
  
  
  else{
      $updateview = "insert into totalview values('', '$page_name','1','1','$today')";
      try {
          $updatevw = $db->prepare($updateview);
          $updatevw->execute();
      }
      catch(PDOException $ex) {
          
          die("Failed to run query: " . $ex->getMessage());
      }
  }
  
  



 
?>