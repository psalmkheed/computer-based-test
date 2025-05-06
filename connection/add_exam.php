<?php
include '../connection/db_connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the form is submitted
    if (isset($_POST['subject']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['duration'])) {
        // Get the form data
        $class = htmlspecialchars($_POST['class']);
        $subject = htmlspecialchars($_POST['subject']);
        $date = htmlspecialchars($_POST['date']);
        $time = htmlspecialchars($_POST['time']);
        $duration = htmlspecialchars($_POST['duration']);
        // Insert the exam data into the database
        $stmt = $conn->prepare("INSERT INTO add_exam (Class, Subject, Date_published, Time_published, Exam_duration) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $class, $subject, $date, $time, $duration);

        if ($stmt->execute()) {
            echo "Exam added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

    
        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>