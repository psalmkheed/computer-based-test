<?php
include 'db_connection.php'; // Include your database connection file
session_start();

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
                <h5 class="text-success m-0"> Add & View Uploaded Exams</h5>
                <div>

                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addExamModal">Add
                        Exam</button>
                    <!-- <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#viewExamModal">View
                        Exam</button> -->
                </div>
            </div>
            <div class="col-12 col-lg-12 mt-3 p-0">
                <table
                    class="table table-bordered table-striped table-hover table-responsive table-sm table-light table-success-subtle">
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
                        <?php
                        // Fetch exam data from the database
                        $query = "SELECT * FROM add_exam"; // Adjust the query as needed
                        $result = mysqli_query($conn, $query);
                        if (!$result) {
                            die("Query failed: " . mysqli_error($conn));
                        }
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>{$row['Exam_id']}</td>";
                            echo "<td>{$row['Exam_name']}</td>";
                            echo "<td>{$row['Subject']}</td>";
                            echo "<td>{$row['Date_published']}</td>";
                            echo "<td>{$row['Time_published']}</td>";
                            echo "<td>{$row['Exam_duration']} minutes</td>";
                            echo "<td>    <button class='btn btn-danger delete-exam-btn' data-id='{$row['Exam_id']}'><img src='images/Icons/delete.png' width='20' height='20'></button>
                            <button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#editExamModal' onclick='editExam({$row['Exam_id']})'><img src='images/Icons/edit.png' width='20' height='20'></button>
                            </td>";
                            echo "</tr>";
                        }
                        mysqli_close($conn);

                        ?>

                        <!-- Edit button script -->
                        <script>
                            function editExam(examId) {
                                // Implement the edit functionality here
                                alert("Edit exam with ID: " + examId);
                            }
                        </script>

                        < </tbody>
                </table>
            </div>
        </div>
        <!-- Modal form for adding subjects -->
        <div class="modal fade" id="addExamModal" tabindex="-1" aria-labelledby="addExamModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addExamModalLabel">Add Exam</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <input type="number" class="form-control" id="duration" name="duration" required>
                            </div>
                            <button type="submit" class="btn btn-success" id="">Add Exam</button>
                        </form>
                    </div>
                </div>
            </div>


        </div>
</body>
<script src="ajax.js"></script>

</html>