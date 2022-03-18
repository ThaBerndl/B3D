<?
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

$conn->query("INSERT INTO User (vName,nName,nickname,passwort) values ('$vorname','$nachname','$username','$pw')");

header("http://b3d.sytes.net/pages/dashboard.html");

?>