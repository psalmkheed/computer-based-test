<?php
include("../connection/db_connection.php");
session_start();
session_unset();
session_destroy();
header("Location: /CBT/index.php");
exit;
?>