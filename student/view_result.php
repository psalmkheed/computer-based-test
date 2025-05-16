<?php
require '../connection/db_connection.php';
session_start();

if (!isset($_SESSION['student_id'], $_GET['exam_id'])) {
    header('Location: ../student.php');
}

$student_id = $_SESSION['student_id'];
$exam_id = $_GET['exam_id'];

// Get exam info
$exam = $conn->query("SELECT * FROM exams WHERE exam_id = '$exam_id'")->fetch_assoc();

// Get questions
$qResult = $conn->query("SELECT * FROM questions WHERE exam_id = '$exam_id' ORDER BY question_number");
$questions = [];
while ($q = $qResult->fetch_assoc()) {
    $questions[] = $q;
}

// Get student answers
$answers = [];
$res = $conn->query("SELECT * FROM results WHERE exam_id = '$exam_id' AND student_id = '$student_id'");

// Rebuild answers from POST data (you should store them later)
$student_answers_result = $conn->query("SELECT question_number, selected_option FROM student_answers WHERE exam_id = '$exam_id' AND student_id = '$student_id'");
$answers = [];
while ($row = $student_answers_result->fetch_assoc()) {
    $answers[(int) $row['question_number']] = strtolower(trim($row['selected_option']));
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Exam Result: <?= $exam['subject'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .correct {
            background-color: #d4edda;
        }

        .wrong {
            background-color: #f8d7da;
        }
    </style>
</head>

<body class="container mt-4">
    <h2>Result for <?= $exam['subject'] ?></h2>
    <?php
    if ($res && $res->num_rows > 0) {
        // Optionally show score
        while ($r = $res->fetch_assoc()) {
            $score = $r['score'];
            $total = $r['total'];
            $percentage = round(($score / $total) * 100, 2);
            echo "<h3>Your Score: $score / $total ($percentage%)</h3>";
        }
    } else {
        // Not yet submitted (fallback or redirect)
        die("No result found for this exam.");
    }
    ?>

    <?php foreach ($questions as $q):
        $qn = $q['question_number'];
        $correct = strtolower(trim($q['correct_option']));
        $student_answer = $answers[$qn] ?? '';
        ?>
        <div class="card mb-3 <?= ($student_answer === $correct) ? 'correct' : 'wrong' ?>">
            <div class="card-body">
                <h5>Q<?= $q['question_number'] ?>: <?= $q['question'] ?></h5>
                <ul class="list-unstyled">
                    <li <?= ($correct == 'a') ? 'style="font-weight:bold;"' : '' ?>>A. <?= $q['option_a'] ?></li>
                    <li <?= ($correct == 'b') ? 'style="font-weight:bold;"' : '' ?>>B. <?= $q['option_b'] ?></li>
                    <li <?= ($correct == 'c') ? 'style="font-weight:bold;"' : '' ?>>C. <?= $q['option_c'] ?></li>
                    <li <?= ($correct == 'd') ? 'style="font-weight:bold;"' : '' ?>>D. <?= $q['option_d'] ?></li>
                </ul>
                <p><strong>Your Answer:</strong> <?= strtoupper($student_answer) ?: 'Not Answered' ?></p>
                <p><strong>Correct Answer:</strong> <?= strtoupper($correct) ?></p>
            </div>
        </div>
    <?php endforeach; ?>

    <a href="../student.php" class="btn btn-success">Back to Dashboard</a>
</body>

</html>