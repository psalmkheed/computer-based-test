<?php


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CBT CENTER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/fontawesome.min.css"
        integrity="sha512-v8QQ0YQ3H4K6Ic3PJkym91KoeNT5S3PnDKvqnwqFD1oiqIl653crGZplPdU5KKtHjO0QKcQ2aUlQZYjHczkmGw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/solid.min.css"
        integrity="sha512-DzC7h7+bDlpXPDQsX/0fShhf1dLxXlHuhPBkBo/5wJWRoTU6YL7moeiNoej6q3wh5ti78C57Tu1JwTNlcgHSjg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --primary: #b00020 !important;
        }

        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        *,
        html,
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-size: 18px;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            overflow: hidden;
            height: 100vh;
        }

        .container-fluid {
            background-image: linear-gradient(to right bottom, #eee, var(--primary), #fff), url(images/schoolbg.jpg);
            background-repeat: no-repeat, no-repeat;
            background-size: cover, cover;
            background-position: center, center;
            background-blend-mode: darken;
            height: 100vh;
        }

        .loginForm {
            /* background-color: #eee; */
            padding: 20px;
            min-width: 65%;
            border: 2px dotted #fff;
            border-radius: 5px;
            backdrop-filter: blur(10px);
        }

        .btn,
        .btn-success {
            background-color: var(--primary) !important;
            border: 1px solid var(--primary) !important;
        }

        .a,
        a {
            color: var(--primary) !important;
            text-decoration: underline dotted !important;
        }

        .text-danger {
            color: var(--primary) !important;
        }

        .card {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        @media only screen and (max-width: 600px) {
            .hidden {
                display: none !important;
            }

            .container-fluid {
                padding: 20px;
            }
        }

        @media only screen and (max-width: 728px) {
            .hidden {
                display: none !important;
            }

            .container-fluid {
                padding: 20px;
            }
        }

        @media only screen and (max-width: 767.33px) {
            .hidden {
                display: none !important;
            }

            .container-fluid {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row d-flex justify-content-between align-items-center ">
            <!-- col-6 for information -->
            <div class="col-lg-6 col-md-6 bg-light  d-flex justify-content-center align-items-center hidden"
                style="height: 100vh; padding: 20px;">
                <div class="text-center text-danger">
                    <img src="images/logo.png" style="width: 75px; height: 75px; margin-bottom: 20px;" alt="logo">
                    <h1 class="display-4 fw-bold">WELCOME TO CBT CENTER</h1>
                    <p class="lead">Your gateway to success</p>
                    <p class="lead text-primary fw-bold">Please Login to take Exam <i
                            class="fa-solid fa-arrow-right"></i></p>
                    <p class="lead">Any Issue? Please contact us at:</p>
                    <p class="lead"><i class="fa-solid fa-envelope"></i>&nbsp;Email: <a
                            href="mailto: admin@doestdotcbt.sch.ng">Support CBT</a>
                    </p>
                    <br>
                    <p class="lead"><i class="fa-solid fa-circle-exclamation"></i> &nbsp;Attention</p>
                    <marquee class="text-dark" behavior="scroll" direction="left" scrollamount="5" loop="infinite"
                        style="font-size: 16px; font-weight: bold;">This is a CBT Center. Please do not use any
                        electronic devices during the exam.</marquee>
                </div>
            </div>
            <!-- col-6 for login -->
            <div class="col-lg-6 col-md-6 d-flex justify-content-center align-items-center">
                <div class="loginForm">
                    <div class="card">

                        <div class="card-img-top text-center p-3">

                        </div>
                        <div class="card-header">
                            <h3 class="card-title text-center h3-hover text-danger">Login Here</h3>
                        </div>
                        <div class="card-body ">
                            <!-- error validation div -->
                            <div class="bg-white  text-danger text-center" id="errorText">
                                <h6 id="errorText"></h6>
                            </div>
                            <form class="" action="" method="POST" onsubmit="return validateForm()">
                                <div class="form-group">
                                    <label for="username" class="text-muted lead mb-2">Username</label>
                                    <input type="text" class="form-control mb-4" name="username" id="username"
                                        placeholder="Enter your Admission Number">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="text-muted lead mb-2">Password</label>
                                    <input type="password" class="form-control mb-4" name="password" id="password"
                                        placeholder="Password">
                                </div>

                                <button type="submit" class="btn btn-success w-100" name="submit">Login</button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Bootstrap Popper Js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>

    <script src="/CBT/assets/scripts/login_validation.js"></script>
</body>

</html>