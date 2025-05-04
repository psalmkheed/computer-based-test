<?php
include("../connection/db_connection.php");
session_start();
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if (isset($_POST['class']) && isset($_POST['session']) && isset($_POST['teacher']) && isset($_POST['category'])) {
        $class = htmlspecialchars($_POST['class']);
        $session = htmlspecialchars($_POST['session']);
        $teacher = htmlspecialchars($_POST['teacher']);
        $category = htmlspecialchars($_POST['category']);

        $stmt = $conn->prepare("INSERT INTO classes (class, session, teacher_name, category) VALUES(?,?,?,?)");
        $stmt->bind_param("ssss", $class, $session, $teacher, $category);
        if ($stmt->execute()) {
            echo "Class created successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>