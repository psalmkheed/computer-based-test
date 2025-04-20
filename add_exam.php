<?php
include 'db_connection.php'; // Include your database connection file
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the form is submitted
    if (isset($_POST['examName']) && isset($_POST['subject']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['duration'])) {
        // Get the form data
        $examName = $_POST['examName'];
        $subject = $_POST['subject'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $duration = $_POST['duration'];

        // Insert the exam data into the database
        $stmt = $conn->prepare("INSERT INTO add_exam (Exam_name, subject, Date_published, Time_published, Exam_duration) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $examName, $subject, $date, $time, $duration);

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