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
                <h5 class="text-success m-0"> Uploaded Exams</h5>
                <div>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#viewExamModal">View
                        Exam</button>
                </div>
            </div>
            <div class="col-12 col-lg-12 mt-3 p-0">
                <table class="table table-bordered table-striped table-hover table-responsive">
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
                            echo "<td>    <button class='btn btn-danger delete-exam-btn' data-id='{$row['Exam_id']}'>Delete</button>
                            <button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editExamModal' onclick='editExam({$row['Exam_id']})'>Edit</button>
                            </td>";
                            echo "</tr>";
                        }
                        mysqli_close($conn);

                        ?>
                        <!-- Example of a delete button for each exam -->

                        <script>
                            $(document).ready(function () {
                                $('.delete-exam-btn').on('click', function (e) {
                                    e.preventDefault();

                                    if (!confirm('Are you sure you want to delete this exam?')) return;

                                    const button = $(this);
                                    const examId = button.data('id');

                                    $.ajax({
                                        url: 'delete_exam.php',
                                        type: 'POST',
                                        data: {
                                            delete_exam: true,
                                            exam_id: examId
                                        },
                                        success: function (response) {
                                            alert(response);
                                            button.closest('tr').fadeOut(); // remove row on success
                                        },
                                        error: function () {
                                            alert('An error occurred while deleting the exam.');
                                        }
                                    });
                                });
                            });
                        </script>



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
</body>

</html>