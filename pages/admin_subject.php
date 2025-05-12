<?php
include '../connection/db_connection.php';
session_start()

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Subject</title>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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

        .dataTables_wrapper .dataTables_filter,
.dataTables_length {
  margin-bottom: 10px !important;
}
.dataTables_wrapper .dataTables_paginate {
  margin-top: 20px !important;
}

.dataTables_wrapper .dataTables_info {
  margin-top: 20px !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button {
  padding: 0.5rem 1rem !important;
  margin: 0 0.1rem !important;
  border-radius: 0.25rem !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
  background-color: var(--bs-success-subtle) !important;
  color: #fff !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current {
  background-color: var(--bs-success) !important;
  color: #fff !important;
}


    </style>

</head>

<body>
    <div class="container-fluid m-0 p-0">
        <div class="row">
            <div
                class="col-12 col-lg-12 bg-success-subtle border border-1 border-success-subtle  p-3 rounded-3 d-flex justify-content-between align-items-center">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSubjectModal">Create New
                    Subject</button>
            </div>
        </div>
        <div class="container-fluid p-0 mt-3">
            <?php
            include '../connection/db_connection.php';
            $sql = "SELECT * FROM subjects";
            $result = $conn->query($sql);
            echo "<table id='subjectTable' class='table table-bordered  table-striped table-hover table-responsive table-sm table-light table-success-subtle'>";
            echo "<thead><tr>
    <th>S/N</th>
        <th>Subject</th>
        <th>Class</th>
        <th>Category</th>
        <th></th>
      </tr></thead><tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
        <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['class']}</td>
            <td>{$row['category']}</td>
            <td><button class='btn btn-success btn-sm'> Edit </button></td>
          </tr>";
            }
            echo "</tbody></table>";
            ?>
        </div>
        <!-- Modal form for adding exams -->
        <div class="row mt-3">
            <div class="modal fade" id="addSubjectModal" tabindex="-1" aria-labelledby="addExamModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-success-subtle">
                            <h5 class="modal-title text-success" id="addExamModalLabel">Create New Subject
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="subjectForm" method="POST">
                                <div class="col mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="subject_Name" required>
                                </div>
                                <div class="col mb-3">
                                    <label for="class" class="form-label">Class</label>
                                    <select class="form-control" name="class" required>
                                        <option value="" selected disabled>Select Class</option>
                                        <option value="SS 1"> SS 1</option>
                                        <option value="SS 2"> SS 2</option>
                                        <option value="SS 3"> SS 3</option>
                                        <option value="JSS 1">JSS 1</option>
                                        <option value="JSS 2">JSS 2</option>
                                        <option value="JSS 3">JSS 3</option>
                                    </select>
                                </div>
                                <div class="col mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-control" name="category" required>
                                        <option value="" selected disabled>Select Category</option>
                                        <option value="Art"> Art</option>
                                        <option value="Commercial"> Commercial</option>
                                        <option value="Science"> Science</option>
                                        <option value="General">General</option>
                                    </select>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Create Subject</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $("#subjectForm").on("submit", function (e) {
                    e.preventDefault();
                    var formData = $(this).serialize();
                    $.ajax({
                        url: "/CBT/connection/add_subject.php",
                        type: "POST",
                        data: formData,
                        success: function (response) {
                            alert("Subject created successfully!");
                            location.reload();
                        },
                        error: function (xhr, status, error) {
                            alert("Error creating subject: " + error);
                        },
                    });
                });
            })
        </script>

        <script>
            $(document).ready(function () {
                $('#subjectTable').DataTable({
                    "pageLength": 10,  // Number of rows per page
                    "lengthMenu": [10, 25, 50],
                    "order": [[0, "asc"]], // Sort by first column descending
                });
            });

        </script>
</body>

</html>