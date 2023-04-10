<?php

$hostname="savespotnow.com";
$username="admin1";
$password="admin";
$dbname="savespotnow_db";

$con = mysqli_connect($hostname, $username, $password, $dbname);

if(mysqli_connect_errno()){
  echo "Failed to connect".mysqli_connect_errno();
}

if(mysqli_ping($con)){
  echo "The connection to your database ".$dbname." is working!";
  echo "</br>User: ".$username;
}
else{
  echo "Error: ". mysqli_error($con);
}

mysqli_close($con);

?>
