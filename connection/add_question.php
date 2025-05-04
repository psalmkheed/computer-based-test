<?php
include("../connection/db_connection.php");
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $required = ['subject', 'question_text', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_option'];

    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            echo json_encode(['status' => 'error', 'message' => "Missing field: $field"]);
            exit;
        }
    }

    $subject = htmlspecialchars(trim($_POST['subject']));
    $question_text = htmlspecialchars(trim($_POST['question_text']));
    $option_a = htmlspecialchars(trim($_POST['option_a']));
    $option_b = htmlspecialchars(trim($_POST['option_b']));
    $option_c = htmlspecialchars(trim($_POST['option_c']));
    $option_d = htmlspecialchars(trim($_POST['option_d']));
    $correct_option = htmlspecialchars(trim($_POST['correct_option']));

    // Insert into DB
    $stmt = $conn->prepare("INSERT INTO add_questions (subject, question_text, option_a, option_b, option_c, option_d, correct_option) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $subject, $question_text, $option_a, $option_b, $option_c, $option_d, $correct_option);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Question submitted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>