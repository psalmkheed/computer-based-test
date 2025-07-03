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

               th, td {
        vertical-align: middle !important;
    }

    td{
        text-align: left;
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

    <table class="table table-bordered text-center">
    <thead class="table-dark">
        <tr>
            <th>Q.No</th>
            <th>Question</th>
            <th>A</th>
            <th>B</th>
            <th>C</th>
            <th>D</th>
            <th>Your Answer</th>
            <th>Correct Answer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($questions as $q):
            $qn = $q['question_number'];
            $correct = strtolower(trim($q['correct_option']));
            $student_answer = $answers[$qn] ?? '';
            $options = ['a' => $q['option_a'], 'b' => $q['option_b'], 'c' => $q['option_c'], 'd' => $q['option_d']];
        ?>
                            <tr>
                                <td><?= $qn ?></td>
                            <td class="text-start"><?= htmlspecialchars($q['question']) ?></td>
                            <?php foreach ($options as $key => $value):
                                $class = '';

                                if ($key === $correct && $key === $student_answer) {
                                    $class = 'table-success'; // correct and selected
                                } elseif ($key === $student_answer && $key !== $correct) {
                                    $class = 'table-danger'; // selected but wrong
                                } elseif ($key === $correct) {
                                    $class = 'table-success'; // correct but not selected
                                }

                                echo "<td class='$class'>" . htmlspecialchars($value) . "</td>";
                            endforeach; ?>
                            <td><?= strtoupper($student_answer ?: 'N/A') ?></td>
                            <td><?= strtoupper($correct) ?></td>
                        </tr>
                        <?php endforeach; ?>
    </tbody>
    </table>
    
    
    <a href="../student.php" class="btn btn-success">Back to Dashboard</a> <button class="btn btn-primary my-3"
        onclick="window.print()">🖨️ Print Result</button>

</body>

</html>