<?php


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Student</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
    input[type="date"]::-webkit-calendar-picker-indicator {
        display: none;
    }

    select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background: none;
    }

    input[type="date"] {
        cursor: text !important;
        text-transform: uppercase;
    }
</style>

<body>
    <div class="container-fluid m-0 p-0">
        <div class="row">
            <div class="col-12 col-lg-12 bg-success-subtle border border-1 border-success-subtle  p-3 rounded-3"
                style="background-color: rgba(209, 231, 221, 0.6) !important;">
                <h5 class="text-success m-0"> Registered Students</h5>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addStudentModal">Add
                    Student</button>
                <!-- div form for student registration -->
                <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addStudentModalLabel">Create New Student</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="addStudentForm" method="POST" action="add_student.php"
                                    enctype="multipart/form-data">
                                    <div class="formPhoto d-flex mb-3 flex-column">
                                    </div>
                                    <label for="photo" class="form-label">Upload Photo</label>
                                    <input type="file" class="form-control mb-3" id="photo" name="photo"
                                        accept="image/*" required>
                                    <label for="registrationNumber" class="form-label">Registration Number</label>
                                    <input type="text" class="form-control mb-3" id="registrationNumber"
                                        name="registrationNumber" required>
                                    <label for="surname" class="form-label">Surname</label>
                                    <input type="text" class="form-control mb-3" id="surname" name="surname" required>
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control mb-3" id="firstName" name="firstName"
                                        required>
                                    <label for="otherName" class="form-label">Other Name</label>
                                    <input type="text" class="form-control mb-3" id="otherName" name="otherName"
                                        required>
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select mb-3" id="gender" name="gender" required>
                                        <option value="" disabled selected>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <label for="dateOfBirth" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control mb-3" id="dateOfBirth" name="dateOfBirth"
                                        onclick="this.showPicker()" required>
                                    <label for="stateOfOrigin" class="form-label">State of Origin</label>
                                    <input type="text" class="form-control mb-3" id="stateOfOrigin" name="stateOfOrigin"
                                        required>
                                    <label for="joinedDate" class="form-label">Joined Date</label>
                                    <input type="date" class="form-control mb-3" id="joinedDate" name="joinedDate"
                                        onclick="this.showPicker()" required>
                                    <label for="parentFullName" class="form-label">Parent/Guardian Full Name</label>
                                    <input type="text" class="form-control mb-3" id="parentFullName"
                                        name="parentFullName" required>
                                    <label for="parentPhoneNumber" class="form-label">Parent/Guardian Phone
                                        Number</label>
                                    <input type="text" class="form-control mb-3" id="parentPhoneNumber"
                                        name="parentPhoneNumber" required>
                                    <label for="parentEmail" class="form-label">Parent/Guardian Email</label>
                                    <input type="email" class="form-control mb-3" id="parentEmail" name="parentEmail">
                                    <label for="parentContactAaddress" class="form-label">Parent/Guardian Contact
                                        Address</label>
                                    <input type="text" class="form-control mb-3" id="parentContactAaddress"
                                        name="parentContactAaddress" required>
                                    <label for="currentClass" class="form-label">Current Class</label>
                                    <input type="text" class="form-control mb-3" id="currentClass" name="currentClass"
                                        required>
                                    <button type="reset" class="btn btn-warning" id="">Reset</button>
                                    <button type="submit" class="btn btn-success" id="" name="formSubmit">Create
                                        Student</button>
                            </div>
                            </form>










                        </div>
</body>

</html>