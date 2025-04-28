<?php
include '../connection/db_connection.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Exams</title>
    <script src="/CBT/assets/scripts/date_picker.js"></script>
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <style>
        input[type="date"]::-webkit-calendar-picker-indicator {
            display: none;
        }

        #customDateInput {
            cursor: pointer;
            background: url('https://cdn-icons-png.flaticon.com/512/747/747310.png') no-repeat right 10px center;
            background-size: 20px;
            padding-right: 35px;
        }


        .border-success-subtle {
            border-color: #b00020 !important;
        }
    </style>


</head>

<body>
    <div class="container-fluid m-0 p-0">
        <div class="row">
            <div class="col-12 col-lg-12 bg-success-subtle border border-1 border-success-subtle p-3 rounded-3 d-flex justify-content-between align-items-center"
                style="background-color:  #b0002020 !important;">
                <h5 class="text-success m-0"> Add & View Uploaded Exams</h5>
                <div>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addExamModal">Add
                        Exam</button>
                </div>
            </div>

            <!-- table for populating registered exams from the database -->
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
                        <?php
                        $stmt = $conn->prepare("SELECT * FROM add_exam");
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if (!$result) {
                            echo "<tr><td colspan='7'>No exams found.</td></tr>";
                        } else {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>{$row['Exam_id']}</td>";
                                echo "<td>{$row['Exam_name']}</td>";
                                echo "<td>{$row['Subject']}</td>";
                                echo "<td>{$row['Date_published']}</td>";
                                echo "<td>{$row['Time_published']}</td>";
                                echo "<td>{$row['Exam_duration']} minutes</td>";
                                echo "<td>
                                    <button class='btn btn-danger btn-sm delete-exam-btn' data-id='{$row['Exam_id']}'><img src='images/Icons/delete.png' width='20' height='20'></button>
                                    <button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editExamModal' onclick='editExam({$row['Exam_id']})'><img src='images/Icons/edit.png' width='20' height='20'></button>
                                </td>";
                                echo "</tr>";
                            }
                        }
                        $stmt->close();
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal form for adding exams -->
        <div class="modal fade" id="addExamModal" tabindex="-1" aria-labelledby="addExamModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-success-subtle border border-1 border-success-subtle">
                        <h5 class="modal-title text-success" id="addExamModalLabel">Add Exam</h5>
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
                                <input type="text" class="form-control" id="customDateInput" name="date"
                                    placeholder="Select a date" readonly onclick="showCustomDatePicker()">

                            </div>
                            <div class="mb-3">
                                <label for="time" class="form-label">Time</label>
                                <input type="time" class="form-control" id="time" name="time" required>
                            </div>
                            <div class="mb-3">
                                <label for="duration" class="form-label">Duration (in minutes)</label>
                                <input type="number" class="form-control" id="duration" name="duration" required>
                            </div>
                            <button type="submit" class="btn btn-success">Add Exam</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Handle form submission for adding exams
        $("#addExamForm").on("submit", function (e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "/CBT/connection/add_exam.php",
                type: "POST",
                data: formData,
                success: function (response) {
                    alert("Exam added successfully!");
                    location.reload();
                },
                error: function (xhr, status, error) {
                    alert("Error adding exam: " + error);
                },
            });
        });

        // Handle delete exam button click
        $(".delete-exam-btn").on("click", function () {
            if (!confirm("Are you sure you want to delete this exam?")) return;
            const button = $(this);
            const examId = button.data("id");
            $.ajax({
                url: "/CBT/connection/delete_exam.php",
                type: "POST",
                data: { exam_id: examId },
                success: function (response) {
                    alert(response);
                    button.closest("tr").fadeOut();
                },
                error: function () {
                    alert("An error occurred while deleting the exam.");
                },
            });
        });

        // Edit exam functionality
        function editExam(examId) {
            alert("Edit exam with ID: " + examId);
            // Implement the edit functionality here
        }
    </script>
</body>

</html>