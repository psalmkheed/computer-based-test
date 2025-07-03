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
    <title>Student - Dashboard</title>
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
        <div class="container-fluid bg-success-subtle">
            <div class="row">
                <!-- div col-lg-2 for the sideBar with sticky position-->
                <div class="col-lg-2 p-0 sidebar sticky-lg-top bg-success">
                    <div class="brand p-3">
                        <h3 class="text-warning" id="">DO-ESTDOT</h3>
                    </div>
                    <div class=" px-3">
                        <hr>
                        <ul class="list-group">
                            <li class="" id="startExam"><img src="images/icons/exam.png" loading="lazy" class="icon"
                                    width="30" height="30">Take
                                Exam
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- div col-lg-10 for the sticky header and mainContent div for loading pages dynamically-->
                <div class="col-lg-10 ">
                    <!-- this is the sticky page header -->
                    <div class="row ps-3 position-sticky top-0 bg-body z-3 shadow-sm rounded-5  m-2">
                        <div class="col-lg-8 col-6 mb-0 d-flex align-items-center justify-content-between p-0">
                            <p class="text-success m-0">Student Dashboard <span class="glyphicon glyphicon-search"
                                    aria-hidden="true"></span>
                            </p>
                        </div>
                        <div class="col-lg-4 col-6 d-flex justify-content-evenly align-items-center p-0">
                            <?php
                            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['username']) && isset($_SESSION['short_name']) && isset($_SESSION['fullname']) && isset($_SESSION['age'])) {
                                // Fetch Session_id from student_registration table
                                $stmt = $conn->prepare("SELECT * FROM classes WHERE session = ?");
                                $stmt->bind_param("s", $session);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $stmt->close();
                                $session = $_SESSION['session_id'];
                                $username = $_SESSION['username'];
                                $shortname = $_SESSION['short_name'];
                                $fullname = $_SESSION['fullname'];
                                $class = $_SESSION['class'];
                                $age = $_SESSION['age'];
                                $today = new DateTime(); // current date
                                $dob = new DateTime($age);
                                $age = $dob->diff($today)->y;

                                // Assuming students are logged in and using Registration_number
                                $stmt = $conn->prepare("SELECT Photo_Id FROM student_registration WHERE Registration_number = ?");
                                $stmt->bind_param("s", $username);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result && $row = $result->fetch_assoc()) {
                                    $photoPath = $row['Photo_Id']; // This should be the relative path to the image
                                } else {
                                    echo "Photo not found.";
                                }
                                $stmt->close();
                                echo "<h6 class='text-danger m-0'>Welcome, " . htmlspecialchars((strtoupper($shortname))) . "</h6>";
                                echo "<div class='dropdown'>
                                <button class='btn btn-body border-0 dropdown-toggle' type='button' id='dropdownMenuButton'
                                    data-bs-toggle='dropdown' aria-expanded='false'>
                                    <img src='/CBT/uploads/$photoPath' loading='lazy' alt='Student Photo' style='width:30px;height:30px;border-radius:50%;'>
                                </button>
                                <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                    <li><a class='dropdown-item' href='#'>Profile</a></li>
                                    <li><a class='dropdown-item' href='#'>Settings</a></li>
                                    <li><a class='dropdown-item' href='connection/logout.php'>Logout</a></li>
                                </ul>
                            </div>";
                                $conn->close();
                            } else {
                                header("Location: ../index.php");
                                exit;
                            }
                            ?>
                        </div>
                    </div>

                    <!-- this is the div for loading pages dynamically using AJAX -->
                    <div class="container-fluid my-3" id="mainContentStudent" style="height: auto;">
                        <div class="row card shadow-sm ">
                            <div class="card card-header border-0 border-bottom-1">
                                <?php
                                echo "<h5 class='text-dark m-0'>" . htmlspecialchars((strtoupper($fullname))) . "</h5>";
                                ?>
                            </div>
                            <div class="col-lg-12 card-body d-flex flex-row align-items-center">
                                <div class="col-lg-1 me-5">
                                    <?= "<img src='/CBT/uploads/$photoPath' loading='lazy' class='shadow-md' alt='Student Photo' style='width:120px;height:120px;border-radius:50%;'>";
                                    ?>
                                </div>
                                <!-- left column -->
                                <div class="col-lg-11">
                                    <?php
                                    $cosine = cos(75);
                                    ?>
                                    <h3 class="text-danger ">Welcome to the CBT Dashboard</h3>
                                    <?php
                                    if (isset($_SESSION['session_id']) && isset($_SESSION['class'])) {
                                        echo "<p class='text-success mb-1'>Admission Number: " . htmlspecialchars(strtoupper($username)) . "</p>";
                                        echo "<p class='text-success mb-1'>Session: " . htmlspecialchars(strtoupper($session)) . "</p>";
                                        echo "<p class='text-success mb-1'>Class: " . htmlspecialchars(strtoupper($class)) . "</p>";
                                        echo "<p class='text-success mb-1'>Age: " . htmlspecialchars($age) . " years" . "</p>";
                                    } else {
                                        echo "<p class='text-danger'>Session and Class not set</p>";
                                    }
                                    ?>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
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