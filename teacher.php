<?php
include 'connection/db_connection.php';
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: /CBT/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Teacher - Dashboard</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- external cascading stylesheet -->
    <link rel="stylesheet" href="assets/css/dashboard.css">

    <!-- FONT AWESOME CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/fontawesome.min.css"
        integrity="sha512-v8QQ0YQ3H4K6Ic3PJkym91KoeNT5S3PnDKvqnwqFD1oiqIl653crGZplPdU5KKtHjO0QKcQ2aUlQZYjHczkmGw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/solid.min.css"
        integrity="sha512-DzC7h7+bDlpXPDQsX/0fShhf1dLxXlHuhPBkBo/5wJWRoTU6YL7moeiNoej6q3wh5ti78C57Tu1JwTNlcgHSjg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- favicon -->
    <link rel="icon" href="images/logo.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/logo.png" type="image/x-icon">
    <!-- AJAX CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <main>
        <div class="container-fluid">
            <div class="row">
                <!-- div col-lg-2 for the sideBar with sticky position-->
                <div class="col-lg-2 p-0 sidebar sticky-lg-top  bg-success">
                    <div class="brand p-3">
                        <h3 class="text-warning" id="brandTeacher">DO-ESTDOT</h3>
                    </div>
                    <ul class="list-group">
                        <!-- <li class="" id="addExam"><img src="images/icons/Plus.svg" class="icon" width="30" height="30">
                            Add Exam</li> -->
                        <li class="" id="addExamT"><img src="images/icons/exam.png" class="icon" width="30"
                                height="30">Add & View Exam
                        </li>
                        <li class="" id="result"><img src="images/icons/result.png" class="icon" width="30"
                                height="30">Result</li>
                        <li class="" id="manageAccount"><img src="images/icons/manage_accounts.png" class="icon"
                                width="30" height="30">Manage Account</li>
                        <li class="" id="logout"><img src="images/icons/logout.png" class="icon" width="30"
                                height="30">Logout</li>
                    </ul>
                </div>

                <!-- div col-lg-10 for the sticky header and mainContent div for loading pages dynamically-->
                <div class="col-lg-10 bg-body">
                    <!-- this is the sticky page header -->
                    <div class="row p-3 position-sticky top-0 bg-body z-3 shadow-sm ">
                        <div class="col-lg-8 col-6 mb-0 d-flex align-items-center justify-content-between">
                            <h5 class="text-success">Teacher's Dashboard</h5>

                        </div>
                        <div class="col-lg-4 col-6 d-flex justify-content-evenly align-items-center">
                            <?php
                            if (isset($_SESSION['username']) && isset($_SESSION['loggedin']) && isset($_SESSION['fullname'])) {
                                $username = $_SESSION['username'];
                                $fullname = $_SESSION['fullname'];
                                echo "<h6 class='text-danger'>Welcome, " . htmlspecialchars(ucwords(strtolower($fullname))) . "</h6>";
                                echo "<div class='dropdown'>
                                <button class='btn btn-success dropdown-toggle' type='button' id='dropdownMenuButton'
                                    data-bs-toggle='dropdown' aria-expanded='false'>
                                    <i class='fa-solid fa-user'></i>
                                </button>
                                <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                    <li><a class='dropdown-item' href='#'>Profile</a></li>
                                    <li><a class='dropdown-item' href='#'>Settings</a></li>
                                    <li><a class='dropdown-item' href='connection/logout.php'>Logout</a></li>
                                </ul>
                            </div>";
                            } else {
                                header("Location: ../index.php");
                                exit;
                            }

                            ?>
                        </div>
                    </div>

                    <!-- this is the div for loading pages dynamically using AJAX -->
                    <div class="row p-4 " id="mainContentTeacher" style="height: auto;">

                        <form action="teacher/set_questions.php" method="POST" class="form">
                            <input type="text" name="subject" required placeholder="Subject" class="form-control my-3">
                            <input type="number" name="num_questions" required placeholder="Number of Questions"
                                class="form-control mb-3">
                            <input type="number" name="duration" required placeholder="Duration (in minutes)"
                                class="form-control mb-3">
                            <input type="date" name="expiry_date" required class="form-control mb-3">
                            <button type="submit" class="btn btn-success form-control mb-3">Next</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
        </script>
</body>
<script src="assets/scripts/script.js"></script>

</html>