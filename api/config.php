<?php

    define('DB_SERVER', 'box5912.bluehost.com');
    define('DB_USERNAME', 'haldoorv_admin');
    define('DB_PASSWORD', 'c#bCI#IcvRw*');
    define('DB_NAME', 'haldoorv_db');
    
    /* Attempt to connect to MySQL database */
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $connection2 = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    // Check connection
    if(mysqli_connect_error()){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
?>