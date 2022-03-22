<?php

    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD','raspberry');
    define('DB_NAME', 'B3D');
    $port = 3306;
  
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
   
    // Check connection
    if($mysqli === false){
        die("ERROR: Could not connect. " . $mysqli->connect_error);
    }
  
    $nickname = $_POST['nickname'];

    if($result = $mysqli->query("SELECT * FROM User"))
    {
        if($result->num_rows) //min 1 eintrag bekommen
        {
            while($row = $result->fetch_assoc())
            {
                echo $row['user_id'] . ' ' . $row['vName'] . ' ' . $row['nName'] . '<br>';
            }
        }
    }
?>
