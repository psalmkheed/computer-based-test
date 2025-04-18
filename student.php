<?php

?>

<!doctype html>
<html lang="en">

<head>
    <title>Student - Dashboard</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap");

        *,
        body,
        html {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Poppins", sans-serif;
            font-size: 18px;
            font-weight: 500;
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
            height: 100vh;
        }

        .main {
            height: 100vh;
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
            background-color: #1e7e34;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <main>
        <div class="container-fluid">
            <div class="row">
                <!-- div col-lg-2 -->
                <div class="col-lg-2 bg-success p-0 sidebar">
                    <div class="brand p-3">
                        <h3 class="text-warning">DO-ESTDOT</h3>
                    </div>
                    <ul class="list-group">
                        <li class="" id="manageStudent"><img src="images/icons/Edit.svg" class="icon" width="30"
                                height="30">Manage
                            Student </li>
                        <li class="" id="addStaff"><img src="images/icons/staff.png" class="icon" width="30"
                                height="30">Staff</li>
                        <li class="" id="addExam"><img src="images/icons/Plus.svg" class="icon" width="30" height="30">
                            Add Exam</li>
                        <li class="" id="viewExam"><img src="images/icons/Book.svg" class="icon" width="30"
                                height="30">View Exam
                        </li>
                        <li class="" id="result"><img src="images/icons/result.png" class="icon" width="30"
                                height="30">Result</li>
                        <li class=""><img src="images/icons/logout.png" class="icon" width="30" height="30">Logout</li>
                    </ul>
                </div>

                <!-- div col-lg-10 -->
                <div class="col-lg-10 bg-body pt-0">

                    <div class="row border-bottom border-2 border-success p-3">
                        <div class="col-lg-10 mb-0 ">
                            <form class="d-flex" action="" method="GET">
                                <input type="search" class="form-control w-50 me-2" placeholder="Search" name="search">
                                <button type="submit" class="btn btn-success">Search</button>
                            </form>
                        </div>
                        <div class="col-lg-2 d-flex justify-content-end align-items-center">
                            <img src="images/icons/user.png" width="30" height="30">
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

</html>