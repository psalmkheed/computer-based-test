<?php
require '../connection/db_connection.php';
$exam_id = $_GET['exam_id'];
$questions = $conn->query("SELECT * FROM questions WHERE exam_id = '$exam_id'");
?>

<!DOCTYPE html>
<html>
<head>
  <title>View Questions</title>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>
<body class="bg-light p-4">

<div class="container">
  <h2 class="mb-4">Questions for Exam ID: <?= $exam_id ?></h2>

  <table class="table table-bordered table-hover bg-white shadow-sm">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Question</th>
        <th>Correct</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($q = $questions->fetch_assoc()): ?>
        <tr>
          <td><?= $q['question_number'] ?></td>
          <td><?= htmlspecialchars($q['question']) ?></td>
          <td><span class="badge bg-success"><?= strtoupper($q['correct_option']) ?></span></td>
          <td>
            <a href="edit_question.php?id=<?= $q['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

</body>
</html>
