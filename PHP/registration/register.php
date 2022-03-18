<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
<?php
//  require conconfig.php;
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


$vorname = $_POST['vorname'];
$nachname = $_POST['nachname'];
$username = $_POST['username'];
$pw = $_POST['password'];

if($conn->query("INSERT INTO User (vName,nName,nickname,passwort) values ('$vorname','$nachname','$username','$pw')"))
{
  header(dashboard.html);
}

?>
</html>