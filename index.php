<?php
$title = "Do-Estdot International School CBT Center - Login";
define("GREETING", "WELCOME TO CBT CENTER");
define("TAGLINE", "Your gateway to success");
define("INSTRUCTION", "Please Login to take Exam");
define("WARNING", "This is a CBT Center. Please
                            do not use any
                            electronic devices during the exam.");

define("EMAIL", "<p class='lead'>Any Issue? Please contact us at:</p>
                        <p class='lead'><i class='fa-solid fa-envelope'></i>&nbsp;Email: <a
                                href='mailto: admin@doestdotcbt.sch.ng'>Support CBT</a>
                        </p>");

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Check the user's role and redirect them accordingly
    if ($_SESSION['role'] === 'admin') {
        header("Location: /CBT/admin.php");
        exit();
    } elseif ($_SESSION['role'] === 'teacher') {
        header("Location: /CBT/teacher.php");
        exit();
    } elseif ($_SESSION['role'] === 'student') {
        header("Location: /CBT/student.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- external css -->
    <link rel="stylesheet" href="assets/css/loginPage.css">
    <link rel="stylesheet" href="assets/css/slideEffect.css">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/fontawesome.min.css"
        integrity="sha512-v8QQ0YQ3H4K6Ic3PJkym91KoeNT5S3PnDKvqnwqFD1oiqIl653crGZplPdU5KKtHjO0QKcQ2aUlQZYjHczkmGw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/solid.min.css"
        integrity="sha512-DzC7h7+bDlpXPDQsX/0fShhf1dLxXlHuhPBkBo/5wJWRoTU6YL7moeiNoej6q3wh5ti78C57Tu1JwTNlcgHSjg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- favicon -->
    <link rel="icon" href="images/logo.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/logo.png" type="image/x-icon">

</head>

<body>

    <div class="container-fluid">
        <div class="row d-flex justify-content-between align-items-center ">
            <!-- col-6 for information -->
            <div class="col-lg-6 col-md-6 bg-light d-flex justify-content-center align-items-center hidden "
                style="height: 100vh; padding: 20px;">
                <div class="" id="slide">
                    <div class="text-center text-danger">
                        <img src="images/logo.png" class="logo1" alt="logo">
                        <h1 class="display-4 fw-bold">
                            <?php echo GREETING ?>
                        </h1>
                        <p class="lead"><?php echo TAGLINE ?></p>
                        <p class="lead text-primary fw-bold">
                            <?php echo INSTRUCTION ?></php> <i class="fa-solid fa-arrow-right"></i>
                        </p>
                        <?php echo EMAIL ?>
                        <br>




                        <p class="lead"><i class="fa-solid fa-circle-exclamation"></i> &nbsp;Attention</p>
                        <marquee behavior="scroll" direction="left" scrollamount="5" loop="infinite"
                            style="font-size: 16px; font-weight: bold; color:brown;"><?php echo WARNING ?></marquee>

                    </div>
                </div>
            </div>

            <!-- col-6 for login area-->
            <div class="col-lg-6 col-md-6 d-flex justify-content-center align-items-center">
                <div class="loginForm wrapper" id="slideIn">
                    <div class="card p-0">
                        <div class="text-center p-3">
                            <img src=" images/logo.png" class="logo2"
                                style="width: 75px; height: 75px; margin-bottom: 10px;" alt="logo">
                        </div>
                        <div class="bg-white border-bottom border-secondary-subtle">
                            <h3 class="card-title text-center h3-hover text-success">Log IN</h3>
                        </div>
                        <div class="card-body ">
                            <!-- error validation div -->
                            <div id="errorText" style="color: red; text-align: center; font-size: 14px;"></div>
                            <form id="login_Form" method="POST" autocomplete="off">
                                <div class="form-group">
                                    <!-- <label for="username" class="text-muted lead mb-1"
                                        style="font-size: 16px;">Username</label> -->
                                    <input type="text" class="form-control mb-4" name="username" id="username"
                                        placeholder="Enter your Admission Number">
                                </div>
                                <div class="form-group">
                                    <!-- <label for="password" class="text-muted lead mb-1"
                                        style="font-size: 16px;">Password</label> -->
                                    <input type="password" class="form-control mb-4" name="password" id="password"
                                        placeholder="Enter your surname">
                                </div>
                                <div id="errorText" class="text-danger mb-3"></div>
                                <!-- To show validation errors -->
                                <button type="submit" id="loginBtn" class="btn btn-success w-100 py-2  fs-4">LOG
                                    IN</button>
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