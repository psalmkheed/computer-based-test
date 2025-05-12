<?php
require '../connection/db_connection.php';

$id = $_POST['id'];
$question = $_POST['question'];
$a = $_POST['a'];
$b = $_POST['b'];
$c = $_POST['c'];
$d = $_POST['d'];
$correct = $_POST['correct'];

$conn->query("UPDATE questions SET question='$question', option_a='$a', option_b='$b', option_c='$c', option_d='$d', correct_option='$correct' WHERE id='$id'");

echo "Question updated! <a href='view_questions.php?exam_id=...'>Go back</a>";
