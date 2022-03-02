<?php
    /* Database credentials. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
    define('DB_SERVER', 'free-tier13.aws-eu-central-1.cockroachlabs.cloud');
    define('DB_USERNAME', 'thaberndl');
    define('DB_PASSWORD', '1wtodMZjBifk2xXrPRIRrw');
    define('DB_NAME', 'defaultdb');
    
    /* Attempt to connect to MySQL database */
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
?>