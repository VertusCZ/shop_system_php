<?php
$servername = "localhost";
$username = "spravazbozi8ucz";
$password = "3Eu0s23g";
$dbname = "spravazbozi";

$conn = new mysqli($servername, $username, $password,$dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?> 