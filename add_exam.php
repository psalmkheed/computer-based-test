<?php
include 'db_connection.php'; // Include your database connection file
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Fetch exam data from the database
    $subject = $_GET['subject'] ?? 'Subject'; // Default to 'Subject' if not provided
    $conn = mysqli_connect("localhost", "root", "", "cbt_center");
    $result = mysqli_query($conn, "SELECT * FROM add_exam WHERE subject = '$subject'"); // Adjust the query as needed
    if (mysqli_connect_errno()) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $query = "SELECT * FROM add_exam WHERE subject = ?"; // Adjust the query as needed
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $subject);
    $stmt->execute();
    $stmt->store_result();
    $stmt->close();
    $conn->close();
    // Check if the query was successful
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
}


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