<!DOCTYPE html>
<html>
<head>
  <title>Partner_Queue_Management</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<?php
// Connect to MySQL database --------------------------------------------
$servername = "72.167.58.111";
$username = "admin1";
$password = "admin";
$dbname = "savespotnow_db";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the data from the Queue table in the database----------------
$sql = "SELECT @rank := @rank + 1 AS spot,
        name, phone_number, number_of_user
        FROM Queue, (SELECT @rank := 0) t
        ORDER BY JoinTime";
$result = $conn->query($sql);
$data = $result->fetch_all(MYSQLI_ASSOC);

// If the delete button is clicked
  if (isset($_POST["delete"])) {
    // Delete the row with the lowest spot value
    $sql_delete = "DELETE FROM Queue ORDER BY JoinTime ASC LIMIT 1";
    if (mysqli_query($conn, $sql_delete)) {
      echo "Record deleted successfully";
    } else {
      echo "Error deleting record: " . mysqli_error($conn);
    }
  }
// Close the database connection
$conn->close();
?>
<!-- Output table -->--------------------------------------------------
<table>
  <thead>
    <tr>
      <th>Spot</th>
      <th>Name</th>
      <th>Phone Number</th>
      <th>Number of User</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $row): ?>
      <tr>
        <td><?php echo $row['spot']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['phone_number']; ?></td>
        <td><?php echo $row['number_of_user']; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>


<form method="post">
  <input type="submit" name="delete" value="next customer">
</form>
-------------------------------------------------------------------------


<!-- Use JavaScript to retrieve the data every 1 minute -->
<script type="text/javascript">
  setInterval(function() {
    // Use AJAX to retrieve the data from the server
    $.ajax({
      url: 'Queue_data_for_Partner.php',
      type: 'POST',
      success: function(data) {
        // Replace the table body with the new data
        $('tbody').html(data);
      }
    });
  }, 3000); // 1 minute = 60,000 milliseconds therefore 5 second = 5000 ms
</script>
