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
    <link rel="stylesheet" href="style.css">
    <style>
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
        }

        .container-fluid {
            background-image: linear-gradient(to right bottom, #198754, #8db600, #fff), url(images/schoolbg.jpg);
            background-repeat: no-repeat, no-repeat;
            background-size: cover, cover;
            background-position: center, center;
            background-blend-mode: darken;
            height: 100vh;
        }

        .loginForm {
            /* background-color: #eee; */
            padding: 20px;
            width: 35%;
            border: 2px dotted #fff;
            border-radius: 5px;
            backdrop-filter: blur(10px);
        }

        .card {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>

    <div class="container-fluid d-flex align-items-center justify-content-center">
        <div class="loginForm">
            <div class="card">

                <div class="card-img-top text-center p-3">
                    <img src="images/logo.png" style="width: 75px; height: 75px;">
                </div>
                <div class="card-header">
                    <h3 class="card-title text-center h3-hover">LOGIN</h3>
                </div>
                <div class="card-body ">
                    <!-- error validation div -->
                    <div class="bg-white  text-danger text-center" id="errorText">
                        <p id="errorText">*Incorrect username</p>
                    </div>
                    <form class="" action="" method="POST">
                        <div class="form-group">
                            <label for="username" class="text-muted">Username</label>
                            <input type="text" class="form-control mb-4" name="username" placeholder="Username"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-muted">Password</label>
                            <input type="password" class="form-control mb-4" name="password" placeholder="Password"
                                required>
                        </div>

                        <button type="submit" class="btn btn-success w-100" name="submit">Login</button>
                    </form>

                </div>

            </div>
        </div>






        <!-- Bootstrap Popper Js -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
            crossorigin="anonymous"></script>
</body>

</html>