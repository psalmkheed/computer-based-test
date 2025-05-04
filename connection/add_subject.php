<?php
include("../connection/db_connection.php");
session_start();
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if (isset($_POST['subject_Name']) && isset($_POST['class']) && isset($_POST['category'])) {
        $subject_Name = htmlspecialchars($_POST['subject_Name']);
        $class = htmlspecialchars($_POST['class']);
        $category = htmlspecialchars($_POST['category']);

        $stmt = $conn->prepare("INSERT INTO subjects (name, class, category) VALUES(?,?,?)");
        $stmt->bind_param("sss", $subject_Name, $class, $category);
        if ($stmt->execute()) {
            echo "Subject added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>