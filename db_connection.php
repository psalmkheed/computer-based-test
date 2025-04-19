<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "cbt_center");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>