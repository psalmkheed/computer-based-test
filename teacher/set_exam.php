<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Questions</title>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- DataTables CSS and JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="assets/css/dashboard.css">

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

        .border-success {
            border-color: var(--bs-success) !important;
        }

        .border-success-subtle {
            border-color: var(--bs-success-border) !important;
        }
    </style>
</head>

<body>
    <main class="container-fluid">

        <form action="teacher/set_questions.php" method="POST" class="form">
            <input type="text" name="subject" required placeholder="Subject" class="form-control my-3">
            <input type="number" name="num_questions" required placeholder="Number of Questions"
                class="form-control mb-3">
            <input type="number" name="duration" required placeholder="Duration (in minutes)" class="form-control mb-3">
            <input type="date" name="expiry_date" required class="form-control mb-3">
            <button type="submit" class="btn btn-success form-control mb-3">Next</button>
        </form>
    </main>
</body>

</html>