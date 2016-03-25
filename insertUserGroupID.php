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
  $query = "insert into groups (groupName) values ('$username Group'); select last_insert_id();";
  
  if ( ! ( $result = mysqli_query($conn, $query)) )      # Execute query
  { 
     printf("Error: %s\n", mysqli_error($conn));
     exit(1);
  } 
$row = mysqli_fetch_assoc($result);
$groupID = $row['last_insert_id()'];
  
 $query = "update users set groupID=$groupID where username=$username;";
    
 if ( ! ( $result = mysqli_query($conn, $query)) )      # Execute query
 { 
    printf("Error: %s\n", mysqli_error($conn));
    exit(1);
 }


  mysqli_free_result($result); #Close
    
  mysqli_close($conn);
  ?>

