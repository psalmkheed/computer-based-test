<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "cbt_center", "4060");
if (!$conn) {
    exit("Connection failed: " . mysqli_connect_error());
}

?>