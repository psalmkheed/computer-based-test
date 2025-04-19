<?php
include 'db_connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_exam'])) {
    $exam_id = filter_var($_POST['exam_id'], FILTER_VALIDATE_INT);

    if ($exam_id === false) {
        echo "Invalid exam ID.";
        exit;
    }

    $query = "DELETE FROM add_exam WHERE Exam_id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $exam_id);
        if ($stmt->execute()) {
            echo "Exam deleted successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Database error: " . $conn->error;
    }

    $conn->close();
}
?>