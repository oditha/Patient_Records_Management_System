<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'PRMS';

$connection = mysqli_connect('localhost', 'root', '', 'PRMS');

// Checking the connection
if (mysqli_connect_errno()) {
    die('Database connection failed ' . mysqli_connect_error());
} else {
    // echo "success";
}

?>