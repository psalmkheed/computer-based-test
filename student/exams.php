<?php
session_start();
require '../connection/db_connection.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: ../index.php");
    exit();
}

$student_id = $_SESSION['student_id'];

// Fetch all exams
$exams_result = $conn->query("SELECT * FROM exams ORDER BY expiry_date DESC");
$exams = [];
while ($row = $exams_result->fetch_assoc()) {
    $exams[] = $row;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Available Exams</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>

<body class="container mt-5">
    <h2 class="mb-3">Available Exams</h2>

    <table class="table table-bordered table-striped table-hover ">
        <caption>
            List of available exams
        </caption>
        <thead>
            <tr>
                <th scope="col">Subject</th>
                <th scope="col">No. of Questions</th>
                <th scope="col">Duration (minutes)</th>
                <th scope="col">Expiry Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($exams as $exam): ?>
                <?php
                $exam_id = $exam['exam_id'];
                $where_stmt = "WHERE student_id = '$student_id' AND exam_id = '$exam_id'";
                $taken = $conn->query("SELECT * FROM results $where_stmt")->num_rows > 0;
                ?>
                <tr>
                    <td><?= htmlspecialchars($exam['subject']) ?></td>
                    <td><?= $exam['num_questions'] ?></td>
                    <td><?= $exam['duration'] ?></td>
                    <td><?= $exam['expiry_date'] ?></td>
                    <td>
                        <?php
                        if (strtotime($exam['expiry_date']) >= time()): ?>
                            <?php if ($taken): ?>
                                <span class="text-muted">Taken</span>
                            <?php else: ?>
                                <a href="student/start_exam.php?exam_id=<?= urlencode($exam_id) ?>"
                                    class="btn btn-success btn-sm">Start Exam</a>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="text-danger">Expired</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>