<?php
include '../connection/db_connection.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['formSubmit'])) {
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
            $photo = $_FILES['photo']['name'];
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($_FILES["photo"]["name"]);
            move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile);
        } else {
            echo "<script>
    alert('Error: Failed to upload photo.');
    </script>";
        }

        $regNumber = $_POST['registrationNumber'];
        $surname = $_POST['surname'];
        $fname = $_POST['firstName'];
        $otherName = $_POST['otherName'];
        $gender = $_POST['gender'];
        $dob = $_POST['dateOfBirth'];
        $state = $_POST['stateOfOrigin'];
        $joinedDate = $_POST['joinedDate'];
        $parentName = $_POST['parentFullName'];
        $parentEmail = $_POST['parentEmail'];
        $parentPhone = $_POST['parentPhoneNumber'];
        $parentAddress = $_POST['parentContactAaddress'];
        $currentClass = $_POST['currentClass'];
        // Inserting the student details into the database
        $stmt = $conn->prepare("INSERT INTO student_registration (Photo_Id, Registration_Number, Surname, First_Name, Other_Name, Gender, DOB, State_of_Origin, Joined_Date, Parent_Guardian_Name, Parent_Guardian_Email, Parent_Guardian_Number, Parent_Guardian_Address, Current_Class) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssssssss", $photo, $regNumber, $surname, $fname, $otherName, $gender, $dob, $state, $joinedDate, $parentName, $parentEmail, $parentPhone, $parentAddress, $currentClass);
        if ($stmt->execute()) {
            // Redirecting to the admin page
            header("Location: ../admin.php");
            echo "<sript>
            alert('Student registered successfully!');
            </script>";
            exit();
        } else if ($stmt->error) {
            echo "<script>
            alert('Error: " . $stmt->error . "');
            </script>";
        } else {
            echo "<script>
            alert('Error: Failed to register student.');
            </script>";
        }
        $stmt->close();
        $conn->close();
    }
}
?>