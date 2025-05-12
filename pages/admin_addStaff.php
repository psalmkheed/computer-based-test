<?php
include '../connection/db_connection.php';
session_start()

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Student</title>
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
                <h5 class="text-success m-0"> Manage Staff</h5>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addStaffModal">Add
                    Staff</button>

            </div>
            <div class="col-12 col-lg-12 mt-3 p-0">
                <table id="staffTable"
                    class="table  table-bordered table-striped table-hover table-responsive table-sm table-light table-success-subtle">
                    <thead>
                        <tr>
                            <th>S/N </th>
                            <th>Staff ID</th>
                            <th>Staff Name</th>
                            <th>Staff Email</th>
                            <th>Staff Phone</th>
                            <th> Action</th>
                        </tr>
                    </thead>
                    <tbody id="staffTableBody">
                        <?php
                        $stmt = $conn->prepare("SELECT * FROM staff_registration");
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if (!$result) {
                            echo "<tr><td colspan='6'>No staff found.</td></tr>";
                        } else {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>{$row['Id']}</td>";
                                echo "<td>{$row['Staff_id']}</td>";
                                echo "<td>{$row['Staff_name']}</td>";
                                echo "<td>{$row['Staff_email']}</td>";
                                echo "<td>{$row['Staff_phone']}</td>";
                                echo "<td>
                                    <button class='btn btn-danger btn-sm delete-staff-btn' data-id='{$row['Staff_id']}'><img src='images/Icons/delete.png' width='20' height='20'></button>
                                    <button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editStaffModal' onclick='editStaff({$row['Staff_id']})'><img src='images/Icons/edit.png' width='20' height='20'></button>
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
        <div class="modal fade" id="addStaffModal" tabindex="-1" aria-labelledby="addStaffModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-success-subtle">
                        <h5 class="modal-title text-success" id="addStaffModalLabel">Add Staff</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addStaffForm" method="POST" action="/CBT/connection/add_staff.php"
                            enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="staffId" class="form-label">Staff ID</label>
                                <input type="text" class="form-control" id="staffId" name="staffId">
                            </div>
                            <div class="mb-3">
                                <label for="staffName" class="form-label">Staff Name</label>
                                <input type="text" class="form-control" id="staffName" name="staffName">
                            </div>
                            <div class="mb-3">
                                <label for="staffEmail" class="form-label">Staff Email</label>
                                <input type="email" class="form-control" id="staffEmail" name="staffEmail">
                            </div>
                            <div class="mb-3">
                                <label for="staffPhone" class="form-label">Staff Phone</label>
                                <input type="text" class="form-control" id="staffPhone" name="staffPhone">
                            </div>
                            <button type="submit" class="btn btn-success">Add Staff</button>
                        </form>
                    </div>
</body>
<script>
    $(document).ready(function () {
        $('#addStaffForm').on('submit', function (e) {
            e.preventDefault(); // Prevent the default form submission

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'), // Use the form's action attribute
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function (response) {
                    alert(response); // Show success message
                    location.reload(); // Reload the page to see the updated staff list
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText); // Show error message
                }
            });
        });
    });

    // Delete staff
    $(document).on('click', '.delete-staff-btn', function () {
        var staffId = $(this).data('id');
        if (confirm('Are you sure you want to delete this staff?')) {
            $.ajax({
                url: '/CBT/connection/delete_staff.php',
                type: 'POST',
                data: { staff_id: staffId },
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        alert(response.success);
                        // Optionally remove the staff row from the table
                    } else {
                        alert(response.error);
                    }
                },
                error: function (xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });

        }
    });

</script>

<script>
    $(document).ready(function () {
        $('#staffTable').DataTable({
            "pageLength": 10,  // Number of rows per page
            "lengthMenu": [10, 25, 50],
            "order": [[0, "asc"]], // Sort by first column descending
        });
    });

</script>

</html>