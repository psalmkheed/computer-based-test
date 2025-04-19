<?php
include 'db_connection.php'; // Include your database connection file
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Exam</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container-fluid m-0 p-0">
        <div class="row">
            <div class="col-12 col-lg-12 bg-success-subtle border border-1 border-success-subtle  p-3 rounded-3 d-flex justify-content-between align-items-center"
                style="background-color: rgba(209, 231, 221, 0.6) !important;">
                <h5 class="text-success m-0"> Add Exam</h5>
                <div class="">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addExamModal">Add
                        Exam</button>
                </div>
                <div class="modal fade" id="addExamModal" tabindex="-1" aria-labelledby="addExamModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addExamModalLabel">Add Exam</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="addExamForm">
                                    <div class="mb-3">
                                        <label for="examName" class="form-label">Exam Name</label>
                                        <input type="text" class="form-control" id="examName" name="examName" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="subject" class="form-label">Subject</label>
                                        <input type="text" class="form-control" id="subject" name="subject" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="date" class="form-control" id="date" name="date" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="time" class="form-label">Time</label>
                                        <input type="time" class="form-control" id="time" name="time" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="duration" class="form-label">Duration (in minutes)</label>
                                        <input type="number" class="form-control" id="duration" name="duration"
                                            required>
                                    </div>
                                    <button type="submit" class="btn btn-success" id="">Add Exam</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function () {
        // Handle form submission
        $('#addExamForm').on('submit', function (e) {
            e.preventDefault(); // Prevent the default form submission

            // Get form data
            var formData = $(this).serialize();

            // Send an AJAX request to add the exam
            $.ajax({
                url: 'add_exam.php',
                type: 'POST',
                data: formData,
                success: function (response) {
                    // Handle success response
                    alert("Exam added successfully!");
                    location.reload();
                },
                error: function (xhr, status, error) {
                    // Handle error response
                    alert("Error adding exam: " + error);
                }
            });
        });
    });
</script>

</html>