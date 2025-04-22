<?php
include '../connection/db_connection.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // check if required fields are set
    $requiredFields = ['staffId', 'staffName', 'staffEmail', 'staffPhone'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            http_response_code(400);
            echo json_encode(['error' => "$field is required."]);
            exit;
        }
    }
    // Check if the form is submitted
    if (isset($_POST['staffId']) && isset($_POST['staffName']) && isset($_POST['staffEmail']) && isset($_POST['staffPhone'])) {
        // Get the form data
        $staffId = htmlspecialchars($_POST['staffId']);
        $staffName = htmlspecialchars($_POST['staffName']);
        $staffEmail = htmlspecialchars($_POST['staffEmail']);
        $staffPhone = htmlspecialchars($_POST['staffPhone']);

        // Insert the exam data into the database
        $stmt = $conn->prepare("INSERT INTO staff_registration (Staff_id, Staff_name, Staff_email, Staff_phone) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $staffId, $staffName, $staffEmail, $staffPhone);

        if ($stmt->execute()) {
            echo "Staff added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>