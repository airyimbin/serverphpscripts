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
 $searchTerm = $_GET['search'];
  
  # Create a generic query that is for when all the fields are left blank.
  $query = "select * from users where username like \"$searchTerm%\"";
   

  if ( ! ( $result = mysqli_query($conn, $query)) )      # Execute query
  { 
     printf("Error: %s\n", mysqli_error($conn));
     exit(1);
  } 
 
    
 $responce = array();
 $responce["users"] = array();
 while( $row = mysqli_fetch_assoc( $result )){
	$temp = array();
	$temp["name"] = $row["name"];
	$temp["imageID"] = $row["imageID"];
	$temp["email"] = $row["email"];
	$temp["phonenumber"] = $row["phonenumber"];
	$temp["username"] = $row["username"];
	$temp["groupID"] = $row["groupID"];

	array_push( $responce["users"], $temp);
 }
 $responce["success"] = 1;
 echo json_encode($responce);

  mysqli_free_result($result); #Close
    
  mysqli_close($conn);
  ?>

