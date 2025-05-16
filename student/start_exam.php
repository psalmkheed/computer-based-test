<?php
require '../connection/db_connection.php';
session_start();

if (!isset($_GET['exam_id'])) {

  echo "<br><button class='btn btn-success'><a href='../student.php' >Go back to exams</a></button><br>";
  die("Error: No exam selected. Please go back and choose an exam."
  );

}
if (!isset($_SESSION['student_id'])) {
  header("Location: ../index.php");
  exit();
}

$student_id = $_SESSION['student_id'];
$exam_id = $_GET['exam_id'];

$exam = $conn->query("SELECT * FROM exams WHERE exam_id = '$exam_id'")->fetch_assoc();
$questions = $conn->query("SELECT * FROM questions WHERE exam_id = '$exam_id' ORDER BY question_number ASC");

$question_data = [];
while ($q = $questions->fetch_assoc()) {
  $question_data[] = $q;
}
?>

<head>
  <script>
    window.onbeforeunload = () => "You will lose your answers if you leave this page.";
  </script>
  <title>Exam: <?= $exam['subject'] ?></title>
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <!-- DataTables CSS and JS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="assets/css/dashboard.css">

  <style>
    body {
      background-color: #f8f9fa;
      padding: 20px;
    }

    h3 {
      color: #343a40;
    }

    p {
      font-size: 1.2em;
    }
  </style>
</head>

<h3>Exam: <?= $exam['subject'] ?> (<?= $exam['duration'] ?> minutes)</h3>
<div id="timer" style="color:red;font-weight:bold;"></div>

<form id="examForm" action="submit_exam.php" method="POST" target="_blank">
  <input type="hidden" name="exam_id" value="<?= $exam_id ?>">

  <div id="questionContainer"></div>

  <button type="button" class="btn btn-success" onclick="showNextQuestion()">Next</button>
  <button type="button" class="btn btn-success" id="submitBtn" onclick="submitLast()">Submit</button>

  <script>
    function submitLast() {
      const selected = container.querySelector("input[type=radio]:checked");
      if (selected) {
        const qn = questions[current].question_number;
        const answer = selected.value;

        let hidden = document.querySelector(`input[name='answers[${qn}]']`);
        if (hidden) {
          hidden.value = answer;
        } else {
          hidden = document.createElement("input");
          hidden.type = "hidden";
          hidden.name = `answers[${qn}]`;
          hidden.value = answer;
          document.getElementById("examForm").appendChild(hidden);
        }
      }

      // ✅ Double check all answers have hidden inputs
      questions.forEach(q => {
        const qn = q.question_number;
        const existingInput = document.querySelector(`input[name='answers[${qn}]']`);
        if (!existingInput) {
          // Student skipped this question
          const hidden = document.createElement("input");
          hidden.type = "hidden";
          hidden.name = `answers[${qn}]`;
          hidden.value = "";  // Empty string for unanswered
          document.getElementById("examForm").appendChild(hidden);
        }
      });
      console.log("Submitting form with data:", new FormData(document.getElementById("examForm")));

      document.getElementById("examForm").submit();
    }

  </script>

</form>

<script>
  const questions = <?= json_encode($question_data) ?>;
  let current = 0;
  const container = document.getElementById("questionContainer");

  function showQuestion(index) {
    const q = questions[index];
    container.innerHTML = `
    <p><b>Q${q.question_number}: ${q.question}</b></p>
    <input type="radio" name="option" value="a" required> A. ${q.option_a}<br>
    <input type="radio" name="option" value="b"> B. ${q.option_b}<br>
    <input type="radio" name="option" value="c"> C. ${q.option_c}<br>
    <input type="radio" name="option" value="d"> D. ${q.option_d}<br>
  `;

    // Toggle button visibility
    document.querySelector("button[onclick='showNextQuestion()']").style.display =
      index === questions.length - 1 ? "none" : "inline-block";
    document.getElementById("submitBtn").style.display =
      index === questions.length - 1 ? "inline-block" : "none";
  }

  function showNextQuestion() {
    const selected = container.querySelector("input[type=radio]:checked");
    if (!selected) {
      alert("Please select an answer before proceeding.");
      return;
    }

    const qn = questions[current].question_number;
    const answer = selected.value;

    // Add or update hidden input
    let existing = document.querySelector(`input[name='answers[${qn}]']`);
    if (existing) {
      existing.value = answer;
    } else {
      const hidden = document.createElement("input");
      hidden.type = "hidden";
      hidden.name = `answers[${qn}]`;
      hidden.value = answer;
      document.getElementById("examForm").appendChild(hidden);
    }

    console.log("Saved answer for Q" + qn + " = " + answer); // debug line
    current++;
    if (current < questions.length) {
      showQuestion(current);
    }
  }


  showQuestion(current);

  // Countdown Timer
  let totalSeconds = <?= $exam['duration'] * 60 ?>;
  const timerDiv = document.getElementById("timer");

  function updateTimer() {
    let minutes = Math.floor(totalSeconds / 60);
    let seconds = totalSeconds % 60;
    timerDiv.innerHTML = "Time Left: " + minutes + "m " + seconds + "s";
    totalSeconds--;

    if (totalSeconds < 0) {
      clearInterval(timer);
      alert("Time is up! Submitting your answers.");
      document.getElementById("examForm").submit();
    }
  }

  const timer = setInterval(updateTimer, 1000);
  updateTimer();
</script>