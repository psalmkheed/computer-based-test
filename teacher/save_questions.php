<?php
session_start();
include '../connection/db_connection.php';

if (!isset($_SESSION['subject']) || !isset($_SESSION['questions'])) {
    die("Session data missing. Please set the exam first.");
}

// Get session data
$subject = $_SESSION['subject'];
$num_questions = $_SESSION['num_questions'];
$duration = $_SESSION['duration'];
$expiry_date = $_SESSION['expiry_date'];
$questions = $_SESSION['questions'];

// Generate a unique exam ID like exam_20250511-001
$datePart = date("Ymd");
$like = "exam_$datePart%";

$stmt = $conn->prepare("SELECT COUNT(*) FROM exams WHERE exam_id LIKE ?");
$stmt->bind_param("s", $like);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

$count++;
$exam_id = "exam_$datePart" . str_pad($count, 3, '0', STR_PAD_LEFT);

// Save exam details
$stmt = $conn->prepare("INSERT INTO exams (exam_id, subject, num_questions, duration, expiry_date) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssiss", $exam_id, $subject, $num_questions, $duration, $expiry_date);
if (!$stmt->execute()) {
    die("Failed to save exam: " . $stmt->error);
}
$stmt->close();

// Save questions with question_number
$stmt = $conn->prepare("INSERT INTO questions (exam_id, question_number, question, option_a, option_b, option_c, option_d, correct_option) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

$question_number = 1;
foreach ($questions as $qnum => $data) {
    $q = $data['question'];
    $a = $data['a'];
    $b = $data['b'];
    $c = $data['c'];
    $d = $data['d'];
    $correct = $data['correct'];

    $stmt->bind_param("sissssss", $exam_id, $question_number, $q, $a, $b, $c, $d, $correct);

    if (!$stmt->execute()) {
        die("Failed to save question $question_number: " . $stmt->error);
    }

    $question_number++;
}
$stmt->close();

// Clean up and redirect
$conn->close();
unset($_SESSION['subject'], $_SESSION['num_questions'], $_SESSION['duration'], $_SESSION['expiry_date'], $_SESSION['questions']);

header("Location: set_exam.php?success=1");
exit();
?>