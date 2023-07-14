<?php
$servername = 'localhost'; // or 127.0.0.1
$username = 'root'; // default username for XAMPP
$password = ''; // default password is empty

// If we would like to use InfinityFree phpMyAdmin
//$hostname = 'sql206.infinityfree.com';
//$username = 'epiz_34278333';
//$password = 'eTE4Be6jqBIQ';
//$database = 'epiz_34278333_myDatabase';
//$con = mysqli_connect($hostname, $username, $password, $database);

// Create a connection
$con = new mysqli($servername, $username, $password);
if ($con->connect_error) {
    die('Connection ERROR:');
    echo 'Connection Failed';
}

?>
