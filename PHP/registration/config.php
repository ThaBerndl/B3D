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

$servername = "free-tier13.aws-eu-central-1.cockroachlabs.cloud";
$username = "thaberndl";
$password = "1wtodMZjBifk2xXrPRIRrw";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>