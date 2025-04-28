<?php
// include 'connection/db_connection.php';
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <title>Admin - Dashboard</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- FONT AWESOME CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/fontawesome.min.css"
        integrity="sha512-v8QQ0YQ3H4K6Ic3PJkym91KoeNT5S3PnDKvqnwqFD1oiqIl653crGZplPdU5KKtHjO0QKcQ2aUlQZYjHczkmGw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/solid.min.css"
        integrity="sha512-DzC7h7+bDlpXPDQsX/0fShhf1dLxXlHuhPBkBo/5wJWRoTU6YL7moeiNoej6q3wh5ti78C57Tu1JwTNlcgHSjg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- AJAX CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap");

        *,
        body,
        html {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scrollbar-width: thin;
            scrollbar-color: #198754 #fff;
            scroll-behavior: smooth;
        }

        body {
            font-family: "Poppins", sans-serif;
            font-size: 16px;
            font-weight: 500;
            height: 100vh;
            overflow-X: hidden;
        }

        /* media query */
        @media only screen and (max-width: 600px) {
            .loginForm {
                width: 80%;
            }
        }

        .h3-hover:hover {
            color: #198754;
            cursor: default;
            transition: all 0.3s ease-in-out;
        }

        .icon {
            margin-right: 5px;
        }

        .sidebar {
            max-height: 100vh;
            font-size: inherit;
        }

        @media screen and (max-width: 768px) {
            .sidebar {
                height: auto;
                font-size: 14px;
            }

        }

        @media screen and (max-width: 991.33px) {
            .sidebar {
                height: auto;
            }


        }

        .main {
            height: 50vh;
        }

        .sidebar ul li {
            font-size: 16px;
            list-style-type: none;
            color: #fff;
            padding: 10px;
            padding-left: 5px;
            margin: 0;
        }

        .sidebar ul li:hover {
            background-color: #f0002020;
            cursor: pointer;
        }

        .dashboardData {
            min-height: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 1em;
        }

        .searchBar:focus {
            outline: none !important;
            border: 0;
            box-shadow: 0 0 0 .25rem rgba(30, 126, 52, 0.25) !important;
        }

        .bg-success {
            background-color: #b00020 !important;
        }

        .bg-success-subtle {
            background-color: #b0002020 !important;
        }



        .btn-success {
            background-color: #b00020 !important;
            border-color: #b00020 !important;
        }

        .text-success {
            color: #b00020 !important;
        }

        table,
        .table {
            font-size: 14px !important;
        }

        table th {
            font-weight: 500;
        }

        table td {
            font-weight: normal !important;
        }


        i {
            font-size: 30px;
            color: #b00020
        }

        .icon {
            font-size: 90px;
            color: #b00020;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <main>
        <div class="container-fluid">
            <div class="row">
                <!-- div col-lg-2 for the sideBar with sticky position-->
                <div class="col-lg-2 p-0 sidebar sticky-lg-top " style="background-color: #b00020;">
                    <div class="brand p-3">
                        <h3 class="text-warning" id="brand">DO-ESTDOT</h3>
                    </div>
                    <ul class="list-group">
                        <li class="" id="manageStudent"><img src="images/icons/add_student.png" class="icon" width="30"
                                height="30">Manage
                            Student </li>
                        <li class="" id="addStaff"><img src="images/icons/staff.png" class="icon" width="30"
                                height="30">Staff</li>
                        <!-- <li class="" id="addExam"><img src="images/icons/Plus.svg" class="icon" width="30" height="30">
                            Add Exam</li> -->
                        <li class="" id="viewExam"><img src="images/icons/exam.png" class="icon" width="30"
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
                    <div class="row p-3 position-sticky top-0 bg-body shadow-sm ">
                        <div class="col-lg-10 col-10 mb-0 d-flex align-items-center justify-content-between">
                            <h4 class="text-success">Admin Dashboard</h4>
                            <form class="d-flex" action="" method="GET">
                                <input type="search" class="form-control me-2 searchBar" placeholder="Search"
                                    name="search">
                                <button type="submit" class="btn btn-success">Search</button>
                            </form>
                        </div>
                        <div class="col-lg-2 col-2 d-flex justify-content-end align-items-center">
                            <i class="fa-solid fa-user"></i>
                        </div>
                    </div>

                    <!-- this is the div for loading pages dynamically using AJAX -->
                    <div class="container-fluid my-3" id="mainContent" style="height: auto;">
                        <div class=" row row-cols-1 row-cols-sm-1 row-cols-lg-4 g-2 g-lg-3">
                            <div class="col">
                                <div class="p-2 dashboardData rounded bg-success-subtle text-success"><i
                                        class="fa-solid fa-user icon"></i>
                                    <h4>STUDENTS</h4>
                                </div>
                            </div>
                            <div class="col">
                                <div class="p-2 dashboardData rounded bg-success-subtle text-success"><i
                                        class="fa-solid fa-users icon"></i>
                                    <h4>STAFF</h4>
                                </div>
                            </div>
                            <div class="col">
                                <div class="p-2 dashboardData rounded bg-success-subtle text-success">COL 3</div>
                            </div>
                            <div class="col">
                                <div class="p-2 dashboardData rounded bg-success-subtle text-success">COL 4</div>
                            </div>

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