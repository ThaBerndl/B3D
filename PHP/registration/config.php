<?php
    // /* Database credentials. Assuming you are running MySQL
    // server with default setting (user 'root' with no password) */
    // define('DB_SERVER', 'free-tier13.aws-eu-central-1.cockroachlabs.cloud');
    // define('DB_USERNAME', 'thaberndl');
    // define('DB_PASSWORD', '1wtodMZjBifk2xXrPRIRrw');
    // define('DB_NAME', 'defaultdb');
    
    // /* Attempt to connect to MySQL database */
    // $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // // Check connection
    // if($link === false){
    //     die("ERROR: Could not connect. " . mysqli_connect_error());
    // }

$servername = "localhost";
$username = "root";
$password = "raspberry";
$dbname = "B3D";
$port = 3306;

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname,$port);

// Check connection
if ($conn->connect_errno) {
  printf("Connection failed: " . $conn->connect_error);
  exit();
}

if($conn->ping()){
  printf("Our connection is ok!\n");
} else {
  printf("Error: %s\n", $mysqli->error);
}

$tiere = $conn->query("SELECT bez from Tier");

echo"Tiere: \n";
for ($row_no = $tiere->num_rows-1; $row_no >= 0; $row_no--) { 
  $tiere->data_seek($row_no);
  $row = $tiere->fetch_assoc();
  echo"bez = " . $row['bez'] . "\n";
}
echo "Result set order...\n";
foreach ($result as $row) {
    echo " id = " . $row['id'] . "\n";
}
?>