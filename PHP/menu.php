<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
</head>
<body>
    <?<php>
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
    </php>
</body>
</html>