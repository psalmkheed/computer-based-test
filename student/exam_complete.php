<?php
require '../connection/db_connection.php';

$score = isset($_GET['score']) ? (int) $_GET['score'] : 0;
$total = isset($_GET['total']) ? (int) $_GET['total'] : 0;
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5 text-center">
    <h2 class="text-success">Exam Completed!</h2>
    <p class="fs-4">Your Score: <strong><?= $score ?></strong> / <?= $total ?></p>
    <p>Thank you for taking the exam. Your results have been recorded.</p>
    <a class="btn btn-primary" href="../student.php">Back to Dashboard</a>
</div>