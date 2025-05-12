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
        Directory access is forbidden.
        <button class="btn btn-success mt-3" onclick="window.location.href='index.php'">Go Back</button>

    </div>

    <div class="" id="clockbox"
        style="position: fixed; bottom: 0; right: 0; background-color: #028219; color: white; padding: 10px; font-size: 20px;">
        <div class="text-center">Current Date and Time</div>
        <div class="text-center" id="clockbox"></div>
        <div class="text-center">DO-ESTDOT</div>
        <div class="text-center">All rights reserved &copy; 2023</div>
        <div class="text-center">Developed by DO-ESTDOT</div>
        <div class="text-center">Version 1.0</div>
        <div class="text-center">Contact: <a href="mailto:psalmkheed@gmail.com">
            </a> </div>

    </div>
    <script type="text/javascript">
        tday = new Array("Sun", "Mon", "Tue", "Wed", "Thur", "Fri", "Sat");
        tmonth = new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");

        function GetClock() {
            var d = new Date();
            var nday = d.getDay(), nmonth = d.getMonth(), ndate = d.getDate(), nyear = d.getYear();
            if (nyear < 1000) nyear += 1900;
            var nhour = d.getHours(), nmin = d.getMinutes(), nsec = d.getSeconds(), ap;

            document.getElementById('clockbox').innerHTML = "" + tday[nday] + ", " + tmonth[nmonth] + " " + ndate + ", " + nyear + "";
        }

        {
            GetClock();
            setInterval(GetClock, 1000);
        }
    </script>
</body>

</html>