<?php


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Exams</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container-fluid m-0 p-0">
        <div class="row">
            <div class="col-12 col-lg-12 bg-success-subtle border border-1 border-success-subtle  p-3 rounded-3 d-flex justify-content-between align-items-center"
                style="background-color: rgba(209, 231, 221, 0.6) !important;">
                <h5 class="text-success m-0"> Uploaded Exams</h5>
                <div>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addExamModal">Add
                        Exam</button>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#viewExamModal">View
                        Exam</button>
                </div>
            </div>
            <div class="col-12 col-lg-12 mt-3 p-0" id="">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Exam ID</th>
                            <th>Exam Name</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Duration</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="examTableBody">
                        <!-- Exam data will be populated here -->
                    </tbody>
                </table>
            </div>
        </div>
</body>

</html>