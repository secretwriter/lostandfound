<?php
$host = "localhost";
$user = "root";
$pass = "1234";
$dbname = "lost_and_found";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
