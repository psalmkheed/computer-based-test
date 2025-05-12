<?php
session_start();
require '../connection/db_connection.php';

// ✅ Validate required data
if (
    !isset($_SESSION['student_id']) ||
    !isset($_POST['exam_id']) ||
    !isset($_POST['answers']) ||
    !is_array($_POST['answers'])
) {
    die("Invalid request.");
}

$student_id = $_SESSION['student_id'];
$exam_id = $_POST['exam_id'];
$answers = $_POST['answers'];
$score = 0;

// ✅ Step 1: Fetch correct answers securely
$correct_answers = [];
$stmt = $conn->prepare("SELECT question_number, correct_option FROM questions WHERE exam_id = ?");
$stmt->bind_param("s", $exam_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $correct_answers[(int) $row['question_number']] = strtolower(trim($row['correct_option']));
}
$stmt->close();

// ✅ Step 2: Compare submitted answers
foreach ($answers as $qn => $selected) {
    $qn = (int) $qn; // Ensure it's an integer
    $selected = strtolower(trim($selected)); // Normalize
    if (isset($correct_answers[$qn]) && $selected === $correct_answers[$qn]) {
        $score++;
    }
}

$total_questions = count($correct_answers);

// ✅ Step 3: Save result to DB
$stmt = $conn->prepare("INSERT INTO results (exam_id, student_id, score, total) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssii", $exam_id, $student_id, $score, $total_questions);
$stmt->execute();
$stmt->close();

// Save each answer
$stmtAns = $conn->prepare("INSERT INTO student_answers (student_id, exam_id, question_number, selected_option) VALUES (?, ?, ?, ?)");
foreach ($answers as $qn => $selected) {
    $stmtAns->bind_param("ssis", $student_id, $exam_id, $qn, $selected);
    $stmtAns->execute();
}
$stmtAns->close();

$conn->close();

// ✅ Redirect to result page
header("Location: view_result.php?exam_id=$exam_id");
exit();

?>