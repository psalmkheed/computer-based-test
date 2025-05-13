<?php
require '../connection/db_connection.php';
$id = $_GET['id'];
$q = $conn->query("SELECT * FROM questions WHERE id = '$id'")->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>
  <title>Edit Question</title>
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body class="bg-light p-4">

  <div class="container">
    <h2 class="mb-4">Edit Question</h2>

    <form action="update_question.php" method="POST" class="bg-white p-4 rounded shadow-sm">
      <input type="hidden" name="id" value="<?= $q['id'] ?>">

      <div class="mb-3">
        <label class="form-label">Question</label>
        <textarea class="form-control" name="question" required><?= $q['question'] ?></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Option A</label>
        <input class="form-control" type="text" name="a" value="<?= $q['option_a'] ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Option B</label>
        <input class="form-control" type="text" name="b" value="<?= $q['option_b'] ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Option C</label>
        <input class="form-control" type="text" name="c" value="<?= $q['option_c'] ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Option D</label>
        <input class="form-control" type="text" name="d" value="<?= $q['option_d'] ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Correct Option</label>
        <select class="form-select" name="correct" required>
          <option value="a" <?= $q['correct_option'] == 'a' ? 'selected' : '' ?>>A</option>
          <option value="b" <?= $q['correct_option'] == 'b' ? 'selected' : '' ?>>B</option>
          <option value="c" <?= $q['correct_option'] == 'c' ? 'selected' : '' ?>>C</option>
          <option value="d" <?= $q['correct_option'] == 'd' ? 'selected' : '' ?>>D</option>
        </select>
      </div>

      <button type="submit" class="btn btn-success">Update Question</button>
      <a href="view_questions.php?exam_id=<?= $q['exam_id'] ?>" class="btn btn-secondary">Back</a>
    </form>
  </div>

</body>

</html>