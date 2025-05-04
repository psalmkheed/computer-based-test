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
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_green.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables CSS and JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <style>
        :root {
            --bs-success: #028219 !important;
            --bs-success-subtle: #02821920 !important;
            --bs-success-border: #028219 !important;
            --bs-success-hover: #02821920 !important;

        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            display: none;
        }

        #customDateInput {
            cursor: pointer;
            background: url('https://cdn-icons-png.flaticon.com/512/747/747310.png') no-repeat right 10px center;
            background-size: 20px;
            padding-right: 35px;
        }

        .bg-success {
            background-color: var(--bs-success) !important;
        }

        .bg-success-subtle {
            background-color: var(--bs-success-subtle) !important;
        }

        .btn-succes {
            background-color: var(--bs-success) !important;
        }

        .border-success-subtle {
            border-color: var(--bs-success) !important;
        }

        input:focus {
            outline: none !important;
            border: 0;
            box-shadow: 0 0 0 .25rem var(--bs-success-subtle) !important;
        }

        select:focus {
            outline: none !important;
            border: 0;
            box-shadow: 0 0 0 .25rem var(--bs-success-subtle) !important;
        }

        textarea:focus {
            outline: none !important;
            border: 0;
            box-shadow: 0 0 0 .25rem var(--bs-success-subtle) !important;
        }
    </style>
</head>

<body>
    <div class="container-fluid m-0 p-0">
        <!-- row for the page title and butons -->
        <div class="row mb-3">
            <div
                class="col-12 col-lg-12 bg-success-subtle border border-1 border-success-subtle p-3 rounded-3 d-flex justify-content-between align-items-center">
                <h5 class="text-success m-0"> Add & View Uploaded Exams</h5>
                <div>
                    <button class="btn btn-success " data-bs-toggle="modal" data-bs-target="#addExamModal">Add
                        Exam</button>
                    <button class="btn btn-success " data-bs-toggle="modal" data-bs-target="#viewExamModal">View
                        Exam</button>

                    <button class="btn btn-success " data-bs-toggle="modal" data-bs-target="#addQuestionModal">Add
                        Question</button>
                </div>
            </div>
        </div>
        <!-- table for populating registered exams from the database -->
        <div class="modal fade" id="viewExamModal" tabindex="-1" aria-labelledby="viewExamModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-success-subtle">
                        <h5 class="modal-title text-success" id="viewExamModalLabel">Add Exam</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table
                            class="table table-bordered table-striped table-hover table-responsive table-sm table-light table-success-subtle">
                            <thead>
                                <tr>
                                    <th>Exam ID</th>
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
                                    echo "<tr><td colspan='5'>No exams found.</td></tr>";
                                } else {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>{$row['Exam_id']}</td>";
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
            </div>
        </div>
        <!-- Modal form for adding exams -->
        <div class="modal fade" id="addExamModal" tabindex="-1" aria-labelledby="addExamModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-success-subtle">
                        <h5 class="modal-title text-success" id="addExamModalLabel">Add Exam</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addExamForm">
                            <div class="mb-3">
                                <label for="Class" class="form-label">Class</label>
                                <select class="form-select mb-3" id="currentClass" name="class">
                                    <option value="" disabled selected>Select Class</option>
                                    <option value="SS1">SS1</option>
                                    <option value="SS2">SS2</option>
                                    <option value="SS3">SS3</option>
                                    <option value="JSS1">JSS1</option>
                                    <option value="JSS2">JSS2</option>
                                    <option value="JSS3">JSS3</option>
                                    <option value="Year 1">Year 1</option>
                                    <option value="Year 2">Year 2</option>
                                    <option value="Year 3">Year 3</option>
                                    <option value="Year 4">Year 4</option>
                                    <option value="Year 5">Year 5</option>
                                </select>

                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <select name="subject" id="subject" class="form-select mb-3" required>
                                    <option value="" disabled selected>Select an exam</option>
                                    <?php
                                    include '../connection/db_connection.php';
                                    $result = $conn->query("SELECT name, class FROM subjects");
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='{$row['name']}'>" . htmlspecialchars($row['name']) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="text" class="form-control" id="customDateInput" name="date"
                                    placeholder="YYYY-MM-DD" onclick="showCustomDatePicker()" readonly>

                            </div>
                            <div class="mb-3">
                                <label for="time" class="form-label">Time</label>
                                <input type="text" class="form-control" id="customTimeInput" name="time"
                                    placeholder="Select a time" onclick="showCustomTimePicker()" required readonly>
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
        <!-- i guess this feature should be for teacher.php -->
        <!-- Modal for adding question -->
        <div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-success-subtle">
                        <h5 class="modal-title text-success" id="addQuestionModalLabel">Upload Questions
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="questionForm" method="POST">
                            <select name="subject" id="subject" class="form-select mb-3">
                                <option value="" disabled selected>Select a subject</option>
                                <?php
                                include '../connection/db_connection.php';
                                $result = $conn->query("SELECT Subject FROM add_exam");
                                while ($row = $result->fetch_assoc()) {
                                    // Display the subject name inside the <option> tag
                                    echo "<option value='" . htmlspecialchars($row['Subject']) . "'>" . htmlspecialchars($row['Subject']) . "</option>";
                                }
                                ?>
                            </select>
                            <div class="mb-3">
                                <label class="form-label">Question</label>
                                <textarea name="question_text" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label>Option A</label>
                                    <input type="text" name="option_a" class="form-control">
                                </div>
                                <div class="col">
                                    <label>Option B</label>
                                    <input type="text" name="option_b" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col">
                                    <label>Option C</label>
                                    <input type="text" name="option_c" class="form-control">
                                </div>
                                <div class="col">
                                    <label>Option D</label>
                                    <input type="text" name="option_d" class="form-control">
                                </div>
                            </div>

                            <div class="mt-3">
                                <label>Correct Option</label>
                                <select name="correct_option" class="form-select">
                                    <option value="" disabled selected>Select correct option</option>
                                    <option value="A">Option A</option>
                                    <option value="B">Option B</option>
                                    <option value="C">Option C</option>
                                    <option value="D">Option D</option>
                                </select>
                            </div>

                            <div class="mt-4 d-flex justify-content-between align-items-center">
                                <div id="questionCounter" class="text-muted">Question 1 of 40</div>
                                <button type="submit" class="btn btn-success">Next Question</button>
                            </div>

                            <div id="statusMessage" class="mt-3 text-center"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- this is the table that populate uploaded questions from the database -->
    <!-- <div class="text-success mt-3">
        <h4>EXAMS</h4>
    </div> -->
    <?php
    include '../connection/db_connection.php';

    $sql = "SELECT * FROM add_exam";

    $result = $conn->query($sql);

    echo "<table id='examTable' class='table table-bordered table-striped table-hover table-responsive table-sm table-light table-success-subtle'>";
    echo "<thead><tr>
        <th>S/N</th>
        <th>Class</th>
        <th>Subject</th>
        <th>Date Published</th>
        <th>Time Published</th>
        <th>Exam Duration</th>
        <th>Action</th>
        
      </tr></thead><tbody>";
    while ($row = $result->fetch_assoc()) {
        echo
            "<tr>
                <td>{$row['Exam_id']}</td>
                <td>{$row['Class']}</td>
                <td>{$row['Subject']}</td>
                <td>{$row['Date_published']}</td>
                <td>{$row['Time_published']}</td>
                <td>{$row['Exam_duration']}</td>
                <td>
                
                <button class='btn btn-warning btn-sm' onclick='editExam({$row['Exam_id']})'><img src='images/Icons/edit.png' width='20' height='20'></button>
                <buton class='btn btn-danger btn-sm delete-exam-btn' data-id='{$row['Exam_id']}'><img src='images/Icons/delete.png' width='20' height='20'></button>
                </td>

          </tr>";
    }
    echo "</tbody></table>";
    ?>

    <!-- AJAX -->
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

        $("#addQuestionForm").on("submit", function (e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "/CBT/connection/add_question.php",
                type: "POST",
                data: formData,
                success: function (response) {
                    alert("Question added successfully!");
                    location.reload();
                },
                error: function (xhr, status, error) {
                    alert("Error adding exam: " + error);
                },
            });
        });
        // Edit exam functionality
        function editExam(examId) {
            alert("Edit exam with ID: " + examId);
            // Implement the edit functionality here
        }
    </script>
    <!-- date picker script -->
    <script src="/CBT/assets/scripts/date_picker.js"></script>
    <script>
        // Initialize the time picker for time input
        let time;
        function showCustomTimePicker() {
            if (!time) {
                time = flatpickr("#customTimeInput", {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i", // MySQL time format (e.g., "13:45")
                    defaultDate: new Date(),
                    onChange: function (selectedDates, dateStr, instance) {
                        document.getElementById("customTimeInput").value = dateStr;
                        console.log("Time picked:", dateStr); // Log the picked time
                    },
                });
            }
            time.open();
        }
    </script>
    <!-- add question script -->
    <script>
        let currentQuestion = 1;
        const totalQuestions = 40;

        document.getElementById("questionForm").addEventListener("submit", function (e) {
            e.preventDefault();

            const form = this;
            const formData = new FormData(form);

            fetch("/CBT/connection/add_question.php", {
                method: "POST",
                body: formData,
            })
                .then(res => res.json())
                .then(data => {
                    const msg = document.getElementById("statusMessage");
                    if (data.status === 'success') {
                        msg.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                        if (currentQuestion < totalQuestions) {
                            currentQuestion++;
                            form.reset();
                            document.getElementById("questionCounter").innerText = `Question ${currentQuestion} of ${totalQuestions}`;
                        } else {
                            msg.innerHTML += `<div class="alert alert-info">All ${totalQuestions} questions submitted.</div>`;
                            form.querySelector("button[type='submit']").disabled = true;
                        }
                    } else {
                        msg.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
                    }
                })
                .catch(error => {
                    document.getElementById("statusMessage").innerHTML = `<div class="alert alert-danger">Error: ${error}</div>`;
                });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#examTable').DataTable({
                "order": [], // Disable default ordering
                "pageLength": 10, // Set default page length
                "lengthMenu": [10, 25, 50], // Custom page length options
                "language": {
                    "emptyTable": "No exams available",
                    "zeroRecords": "No matching records found",
                },
            });
        });
    </script>
</body>

</html>