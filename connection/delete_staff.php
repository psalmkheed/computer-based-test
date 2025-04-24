<?php
include '../connection/db_connection.php';
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the form is submitted
    if (isset($_POST['staff_id'])) {
        $staffId = $_POST['staff_id'];

        // Prepare and execute the DELETE query
        $stmt = $conn->prepare("DELETE FROM staff_registration WHERE Staff_id = ?");
        $stmt->bind_param("s", $staffId);

        if ($stmt->execute()) {
            echo json_encode(['success' => 'Staff deleted successfully!']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to delete staff: ' . $stmt->error]);
        }

        $stmt->close();
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid staff ID.']);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Invalid request method.']);
}

$conn->close();

?>