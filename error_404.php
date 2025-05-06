<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>page not accessible please login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --bs-success: #028219 !important;
            --bs-success-subtle: #02821920 !important;
            --bs-success-border: #028219 !important;
            --bs-success-hover: #02821920 !important;
        }

        .bg-success {
            background-color: var(--bs-success) !important;
        }

        .bg-success-subtle {
            background-color: var(--bs-success-subtle) !important;
        }

        .text-success {
            color: var(--bs-success) !important;
        }

        .btn-success {
            background-color: var(--bs-success) !important;
        }

        .border-success {
            border-color: var(--bs-success) !important;
        }

        .border-success-subtle {
            border-color: var(--bs-success-border) !important;
        }
    </style>
</head>

<body>
    <img src="images/logo.png" alt="logo" class="position-absolute top-0 start-0"
        style="width: 100px; height: 100px; margin: 20px;">
    <div
        class="container-fluid d-flex justify-content-center align-items-center vh-100 bg-light display-6 fw-bolder text-danger flex-column">
        <h1 class="m-0 text-success" style="font-size: 300px;">404</h1><br>
        <div class="text-center text-danger" style="font-size: 50px;">Invalid Request</div><br>
        YOU ARE NOT ALLOWED TO ACCESS THIS PAGE
        <button class="btn btn-success mt-3" onclick="window.location.href='index.php'">Go Back</button>

    </div>

</body>

</html>