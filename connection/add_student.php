<?php
error_reporting(E_ALL);
include '../connection/db_connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $requiredFields = [
        'registrationNumber',
        'surname',
        'firstName',
        'gender',
        'dateOfBirth',
        'stateOfOrigin',
        'joinedDate',
        'parentFullName',
        'parentPhoneNumber',
        'parentContactAddress',
        'currentClass'
    ];

    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => "$field is required."]);
            exit;
        }
    }

    // Photo Upload Handling
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $uploadDir = "../uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $photoName = time() . "_" . basename($_FILES["photo"]["name"]);
        $targetFile = $uploadDir . $photoName;

        if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Failed to upload photo.']);
            exit;
        }
    } else {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Photo is required.']);
        exit;
    }

    // Sanitize inputs
    $regNumber = htmlspecialchars($_POST['registrationNumber']);
    $surname = htmlspecialchars($_POST['surname']);
    $fname = htmlspecialchars($_POST['firstName']);
    $otherName = htmlspecialchars($_POST['otherName'] ?? '');
    $gender = htmlspecialchars($_POST['gender']);
    $dob = htmlspecialchars($_POST['dateOfBirth']);
    $state = htmlspecialchars($_POST['stateOfOrigin']);
    $joinedDate = htmlspecialchars($_POST['joinedDate']);
    $parentName = htmlspecialchars($_POST['parentFullName']);
    $parentEmail = htmlspecialchars($_POST['parentEmail'] ?? '');
    $parentPhone = htmlspecialchars($_POST['parentPhoneNumber']);
    $parentAddress = htmlspecialchars($_POST['parentContactAddress'] ?? '');
    $currentClass = htmlspecialchars($_POST['currentClass']);

    // Insert into DB
    $stmt = $conn->prepare("INSERT INTO student_registration 
        (Photo_Id, Registration_Number, Surname, First_Name, Other_Name, Gender, DOB, State_of_Origin, Joined_Date, 
        Parent_Full_Name, Parent_Email, Parent_Phone, Parent_Address, Current_Class) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]);
        exit;
    }

    $stmt->bind_param(
        "ssssssssssssss",
        $photoName,
        $regNumber,
        $surname,
        $fname,
        $otherName,
        $gender,
        $dob,
        $state,
        $joinedDate,
        $parentName,
        $parentEmail,
        $parentPhone,
        $parentAddress,
        $currentClass
    );

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Student added successfully!"]);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>