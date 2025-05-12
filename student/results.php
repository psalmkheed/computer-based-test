<?php
session_start();
require '../connection/db_connection.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: ../index.php");
    exit();
}

$student_id = $_SESSION['student_id'];

$results = $conn->query("SELECT r.*, e.subject 
                         FROM results r 
                         JOIN exams e ON r.exam_id = e.exam_id 
                         WHERE r.student_id = '$student_id' 
                         ORDER BY r.taken_at DESC");
?>

<h2>Your Past Exam Results</h2>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Subject</th>
            <th>Score</th>
            <th>Total</th>
            <th>Percentage</th>
            <th>Date Taken</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $results->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['subject']) ?></td>
                <td><?= $row['score'] ?></td>
                <td><?= $row['total'] ?></td>
                <td><?= round(($row['score'] / $row['total']) * 100, 2) ?>%</td>
                <td><?= date("d M Y, h:i A", strtotime($row['taken_at'])) ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
