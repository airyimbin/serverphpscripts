<?php

$conn = mysqli_connect("projectlassodb.c6sx0lhoptoj.us-west-2.rds.amazonaws.com","projectlasso", "TeamLasso1");
    
  if (mysqli_connect_errno())            #Check to see if connection failed.      
  { 
     printf("Connect failed: %s\n", mysqli_connect_error());
     exit(1);
  } 
    
  if ( ! mysqli_select_db($conn, "projectlassoDB") )# Select the proper database.
  { 
     printf("Error: %s\n", mysqli_error($conn));
     exit(1);
  } 
 $username = $_GET['username'];
  
  # Create a generic query that is for when all the fields are left blank.
  $query = "select groupID from users where username = \"$username\"";
  
  if ( ! ( $result = mysqli_query($conn, $query)) )      # Execute query
  { 
     printf("Error: %s\n", mysqli_error($conn));
     exit(1);
  } 
  $row = mysqli_fetch_assoc($result);
  $groupID = $row['groupID'];  
  
  if($groupID == null){
	$noresponse = array();
	$noresponse["users"] = array();
	$noresponse["success"] = 0;
	echo json_encode($noresponse);
	exit(1);

}	 
  
 $query = "select * from statuses where groupID = $groupID";
    
 if ( ! ( $result = mysqli_query($conn, $query)) )      # Execute query
 { 
    printf("Error: %s\n", mysqli_error($conn));
    exit(1);
 }
 $responce = array();
 $responce["users"] = array();
 while( $row = mysqli_fetch_assoc( $result )){
	$temp = array();
	$temp["username"] = $row["username"];
	$temp["timestamp"] = $row["timestamp"];
	$temp["status"] = $row["status"];

	array_push( $responce["users"], $temp);
 }
 $responce["success"] = 1;
 echo json_encode($responce);

  mysqli_free_result($result); #Close
    
  mysqli_close($conn);
  ?>

