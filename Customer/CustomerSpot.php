<!DOCTYPE html>
<html>
<head>
  <title>Customer Spot</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<p id="spot">Your spot is:</p>
<?php
// Connect to MySQL database
$servername = "72.167.58.111";
$username = "admin1";
$password = "admin";
$dbname = "savespotnow_db";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Collect values of input fields
$Name = $_POST['name'];
$Phone = $_POST['phone'];
$User_Number = $_POST['user#'];

// The SQL to insert the new record
$sql_insert = "INSERT INTO Queue (name, phone_number, number_of_user)
VALUES ('$Name', '$Phone', '$User_Number')";

// Execute the INSERT statement
if (mysqli_query($conn, $sql_insert)) {
  echo "oh yeah";
  }
else {
  echo "Error inserting record: " . mysqli_error($conn);
}
// Close the MySQL connection
mysqli_close($conn);

//----------------------------------------------------------------------




// Retrieve the data from the table every 5 seconds and store it in $incoming_data



?>

<script>
$(document).ready(function() {
    setInterval(function() {
        $.ajax({
            url: 'Queue_data_for_Customer.php',
            type: 'POST',
            data: {functionName: 'getQueueData'},
            success: function(response) {
                // check the console for the entire queue
                console.log(response);
                // here is where the magic happen!
                var incoming_data = JSON.parse(response);
                var key = incoming_data.findIndex(item => item.phone_number === "<?php echo $Phone; ?>");
                var The_Spot = incoming_data[key].spot;
                $("#spot").text("Your spot is: " + The_Spot);

            }
        });
    }, 5000); // 5000 = 5s
});
</script>
