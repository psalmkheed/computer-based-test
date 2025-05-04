<?php
include '../connection/db_connection.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add New Question</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

<body class="bg-light">
    <div class="container mt-5">
        <h3 class="mb-4">Add New Question</h3>
        <form action="submit_question.php" method="POST">
            <div class="mb-3">
                <label for="exam_id" class="form-label">Select Exam</label>
                <select name="exam_id" id="exam_id" class="form-select" required>
                    <option value="" disabled selected>Select an exam</option>
                    <?php
                    $result = $conn->query("SELECT Subject FROM add_exam");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='htmlspecialchars({$row['name']})'>" . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="question_text" class="form-label">Question</label>
                <textarea name="question_text" id="question_text" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Options</label>
                <input type="text" name="option_a" class="form-control mb-2" placeholder="Option A" required>
                <input type="text" name="option_b" class="form-control mb-2" placeholder="Option B" required>
                <input type="text" name="option_c" class="form-control mb-2" placeholder="Option C" required>
                <input type="text" name="option_d" class="form-control mb-2" placeholder="Option D" required>
            </div>

            <div class="mb-3">
                <label for="correct_option" class="form-label">Correct Option</label>
                <select name="correct_option" id="correct_option" class="form-select" required>
                    <option value="A">Option A</option>
                    <option value="B">Option B</option>
                    <option value="C">Option C</option>
                    <option value="D">Option D</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Save Question</button>
        </form>
    </div>
</body>

</html>