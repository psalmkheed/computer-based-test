<?php
include '../connection/db_connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['student_id']) && filter_var($_POST['student_id'], FILTER_VALIDATE_INT)) {
        $studentId = intval($_POST['student_id']);

        // Prepare and execute the DELETE query
        $stmt = $conn->prepare("DELETE FROM student_registration WHERE Id = ?");
        $stmt->bind_param("i", $studentId);

        if ($stmt->execute()) {
            echo json_encode(['success' => 'Student deleted successfully!']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to delete student: ' . $stmt->error]);
        }

        $stmt->close();
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid student ID.']);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Invalid request method.']);
}
$conn->close();
?>