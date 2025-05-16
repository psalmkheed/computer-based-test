<?php
include("../connection/db_connection.php");
session_start();
if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = htmlspecialchars(trim($_POST['username']));
        $password = htmlspecialchars(trim($_POST['password']));

        // Check Admin
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $_SESSION['username'] = $username;
            $_SESSION['loggedin'] = true;
            $_SESSION['role'] = 'admin';
            echo "admin";
            exit;
        }
        $stmt->close();

        // Check Teacher
        $stmt = $conn->prepare("SELECT * FROM staff_registration WHERE Staff_id = ? AND Staff_phone = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $row['Staff_id'];
            $_SESSION['fullname'] = $row['Staff_name'];// Store full name
            $_SESSION['loggedin'] = true;
            $_SESSION['role'] = 'teacher';
            echo "teacher";
            exit;
        }
        $stmt->close();
        // Check Student
        $stmt = $conn->prepare("SELECT * FROM student_registration WHERE Registration_Number = ? AND Surname = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $row['Registration_Number'];
            $_SESSION['student_id'] = $row['Registration_Number'];
            $_SESSION['fullname'] = $row['Surname'] . " " . $row['First_Name'] . " " . $row['Other_Name']; // Store full name
            $_SESSION['short_name'] = $row['Surname'] . " " . $row['First_Name']; // Store short name
            $_SESSION['session_id'] = $row['Session']; // Store session ID
            $_SESSION['class'] = $row['Current_Class']; // Store class
            $_SESSION['age'] = $row['DOB']; // Store age
            $_SESSION['loggedin'] = true;
            $_SESSION['role'] = 'student';
            echo "student";
            exit;
        } else {
            echo "Invalid username or password.";
        }
        $stmt->close();
        $conn->close();
    }

} else {
    header("Location: ../error_404.php");
}

