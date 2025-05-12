<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Save previous question input into session
    if (isset($_POST['question_number'])) {
        $qn = (int) $_POST['question_number'];
        $_SESSION['questions'][$qn] = $_POST['questions'][$qn];
    } else {
        // First time POST: initialize the exam setup
        $_SESSION['subject'] = $_POST['subject'] ?? '';
        $_SESSION['num_questions'] = $_POST['num_questions'] ?? 0;
        $_SESSION['duration'] = $_POST['duration'] ?? '';
        $_SESSION['expiry_date'] = $_POST['expiry_date'] ?? '';
        $_SESSION['questions'] = [];
    }
} elseif (!isset($_SESSION['subject'])) {
    // Redirect if not initialized
    header("Location: set_exam.php");
    exit();
}

// Get total number of questions and current question number
$subject = $_SESSION['subject'] ?? 'Unknown';
$num_questions = $_SESSION['num_questions'];
$current = isset($_GET['q']) ? (int) $_GET['q'] : 1;

if ($current > $num_questions) {
    header("Location: preview_questions.php");
    exit();
}

$currentData = $_SESSION['questions'][$current] ?? ['question' => '', 'a' => '', 'b' => '', 'c' => '', 'd' => '', 'correct' => ''];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Questions</title>
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
        :root {
            --bs-success: #028219 !important;
            --bs-success-subtle: #02821920 !important;
            --bs-success-border: #028219 !important;
            --bs-success-hover: #02821920 !important;
        }

        .bg-success {
            background-color: var(--bs-success) !important;
        }

        .bg-success-subtle {
            background-color: var(--bs-success-subtle) !important;
        }

        .border-success {
            border-color: var(--bs-success) !important;
        }

        .border-success-subtle {
            border-color: var(--bs-success-border) !important;
        }
    </style>
</head>

<body>
    <main class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center my-4">Set Questions for <?= htmlspecialchars($subject) ?></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form id="questionForm" action="set_questions.php?q=<?= $current + 1 ?>" method="POST">
                            <input type="hidden" name="question_number" value="<?= $current ?>">
                            <div class="mb-4">
                                <h4>Question <?= $current ?> of <?= $num_questions ?></h4>
                                <textarea name="questions[<?= $current ?>][question]" required
                                    placeholder="Enter Question"
                                    class="form-control mb-2"><?= htmlspecialchars($currentData['question']) ?></textarea>
                                <input type="text" name="questions[<?= $current ?>][a]" required placeholder="Option A"
                                    class="form-control mb-2" value="<?= htmlspecialchars($currentData['a']) ?>">
                                <input type="text" name="questions[<?= $current ?>][b]" required placeholder="Option B"
                                    class="form-control mb-2" value="<?= htmlspecialchars($currentData['b']) ?>">
                                <input type="text" name="questions[<?= $current ?>][c]" required placeholder="Option C"
                                    class="form-control mb-2" value="<?= htmlspecialchars($currentData['c']) ?>">
                                <input type="text" name="questions[<?= $current ?>][d]" required placeholder="Option D"
                                    class="form-control mb-2" value="<?= htmlspecialchars($currentData['d']) ?>">
                                <select name="questions[<?= $current ?>][correct]" required class="form-select mb-2">
                                    <option value="">Correct Option</option>
                                    <option value="a" <?= $currentData['correct'] == 'a' ? 'selected' : '' ?>>A</option>
                                    <option value="b" <?= $currentData['correct'] == 'b' ? 'selected' : '' ?>>B</option>
                                    <option value="c" <?= $currentData['correct'] == 'c' ? 'selected' : '' ?>>C</option>
                                    <option value="d" <?= $currentData['correct'] == 'd' ? 'selected' : '' ?>>D</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-between">
                                <?php if ($current > 1): ?>
                                    <a href="set_questions.php?q=<?= $current - 1 ?>" class="btn btn-secondary">Back</a>
                                <?php else: ?>
                                    <span></span> <!-- Empty space to align buttons -->
                                <?php endif; ?>

                                <button type="submit" class="btn btn-success">
                                    <?= ($current == $num_questions) ? 'Preview Questions' : 'Next' ?>
                                </button>
                            </div>

                        </form>

                    </div>
                    <!-- Preview container -->
                    <div id="previewContainer"
                        style="display:none; border: 1px solid #ccc; padding: 10px; margin-top: 20px;"></div>

                    <script>
                        function previewQuestions() {
                            const blocks = document.querySelectorAll('.question-block');
                            let html = '<h3>Preview:</h3>';
                            blocks.forEach((block, index) => {
                                const qText = block.querySelector('textarea').value;
                                const a = block.querySelector('input[name*="[a]"]').value;
                                const b = block.querySelector('input[name*="[b]"]').value;
                                const c = block.querySelector('input[name*="[c]"]').value;
                                const d = block.querySelector('input[name*="[d]"]').value;
                                const correct = block.querySelector('select').value;

                                html += `<p><b>Q${index + 1}:</b> ${qText}</p>`;
                                html += `<ul>
      <li>A. ${a}</li>
      <li>B. ${b}</li>
      <li>C. ${c}</li>
      <li>D. ${d}</li>
      <li><strong>Correct:</strong> ${correct.toUpperCase()}</li>
    </ul><hr>`;
                            });

                            const container = document.getElementById('previewContainer');
                            container.innerHTML = html;
                            container.style.display = 'block';
                        }
                    </script>