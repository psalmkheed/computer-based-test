<?php
session_start();

$questions = $_SESSION['questions'] ?? [];
$subject = $_SESSION['subject'] ?? '';
$duration = $_SESSION['duration'] ?? '';
$expiry = $_SESSION['expiry_date'] ?? '';
?>
<!-- stil going to work here later -->
<h2>Preview for <?= htmlspecialchars($subject) ?></h2>
<p>Duration: <?= htmlspecialchars($duration) ?> minutes | Expires: <?= htmlspecialchars($expiry) ?></p>

<?php foreach ($questions as $i => $q): ?>
  <h4>Q<?= $i ?>: <?= htmlspecialchars($q['question']) ?></h4>
  <ul>
    <li>A. <?= htmlspecialchars($q['a']) ?></li>
    <li>B. <?= htmlspecialchars($q['b']) ?></li>
    <li>C. <?= htmlspecialchars($q['c']) ?></li>
    <li>D. <?= htmlspecialchars($q['d']) ?></li>
    <li><strong>Correct:</strong> <?= strtoupper($q['correct']) ?></li>
  </ul>
  <hr>
<?php endforeach; ?>

<form action="save_questions.php" method="post">
  <button type="submit" class="btn btn-success">Save Questions</button>
</form>