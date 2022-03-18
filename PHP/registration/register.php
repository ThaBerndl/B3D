<?php
  $servername = "localhost";
  $username = "root";
  $password = "raspberry";
  $dbname = "B3D";
  $port = 3306;

  $user = $_POST('user');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO User (vName, nickname)
VALUES ($user, 'NaluTest')";    

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>