<?php
include '../connection/db_connection.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate exam_id
    if (!isset($_POST['exam_id']) || !filter_var($_POST['exam_id'], FILTER_VALIDATE_INT)) {
        http_response_code(400); // Bad Request
        echo "Invalid exam ID.";
        exit;
    }

    $exam_id = intval($_POST['exam_id']); // Sanitize input

    // Prepare and execute the DELETE query
    $query = "DELETE FROM add_exam WHERE Exam_id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $exam_id);
        if ($stmt->execute()) {
            echo "Exam deleted successfully!";
        } else {
            http_response_code(500); // Internal Server Error
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        http_response_code(500); // Internal Server Error
        echo "Database error: " . $conn->error;
    }
    $conn->close();
} else {
    http_response_code(405); // Method Not Allowed
    echo "Invalid request method.";
    exit;
}
?>