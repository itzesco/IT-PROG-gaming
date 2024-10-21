<?php

$servername = ""; // add our server name
$username = ""; // add our database username
$password = ""; // add our database pw
$dbname = ""; // add our dbname

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
