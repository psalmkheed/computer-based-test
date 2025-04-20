<?php
include 'db_connection.php'; // Include your database connection file
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['formSubmit'])) {
        // Get the form data
        // Handle file upload if needed
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
            $photo = $_FILES['photo']['name']; // Or move the file to a directory
            $targetDir = "uploads/"; // Directory to save the uploaded file
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


        // Insert the exam data into the database
        $stmt = $conn->prepare("INSERT INTO student_registration (Photo_Id, Registration_Number, Surname, First_Name, Other_Name, Gender, DOB, State_of_Origin, Joined_Date, Parent_Guardian_Name, Parent_Guardian_Email, Parent_Guardian_Number, Parent_Guardian_Address, Current_Class) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Use "ssssssssssssss" for string types and "i" for integer types in the bind_param function
        $stmt->bind_param("ssssssssssssss", $photo, $regNumber, $surname, $fname, $otherName, $gender, $dob, $state, $joinedDate, $parentName, $parentEmail, $parentPhone, $parentAddress, $currentClass);

        if ($stmt->execute()) {
            echo "<sript>
            alert('Student registered successfully!');
            </script>";

            // Redirect to the view students page or any other page
            header("Location: admin.php"); // Adjust the URL as needed
            exit(); // Ensure no further code is executed after the redirect
        } else if ($stmt->error) {
            echo "<script>
            alert('Error: " . $stmt->error . "');
            </script>";
        }
        // Handle the case where the form submission fails
        else {
            echo "<script>
            alert('Error: Failed to register student.');
            </script>";
        }


        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>