<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "cbt_center");
if (!$conn) {
    exit("Connection failed: " . mysqli_connect_error());
}

?>