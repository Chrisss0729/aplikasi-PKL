<?php
session_start();
include('../config.php');

if (empty($_SESSION['csrf_token'])) {
    header("Location: ../login.php");
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | Universitas Teknologi Digital Indonesia</title>
    <link rel="icon" href="../asset/image/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="card mb-12 align-middle border-0">
        <div class="row g-0">
            <div class="col-md-1">
                <img src="../asset/image/logo.png" class="img-fluid rounded-start align-middle" alt="...">
            </div>
            <div class="col-md-10">
                <div class="card-body text-center">
                    <p class="card-text">YAYASAN PENDIDIKAN WIDYA BAKTI YOGYAKARTA</p>
                    <h5 class="card-title">UNIVERSITAS TEKNOLOGI DIGITAL INDONESIA</h5>
                    <p class="card-text">Jl. Raya Janti Jl. Majapahit No.143, Jaranan, Banguntapan, Kec. Banguntapan, Kabupaten Bantul, Daerah Istimewa Yogyakarta 55198</p>
                </div>
            </div>
            <div class="col-md-1 text-end">
                <img src="../asset/image/icon.png" class="img-fluid rounded-start text-end" alt="...">
            </div>
        </div>
        <hr class="border border-warning border-2 opacity-50">
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            var toastTrigger = $('#liveToast');
            var toast = new bootstrap.Toast(toastTrigger);

            // Show the toast if it exists
            if (toastTrigger.length) {
                toast.show();
            }
        });
    </script>
</body>

</html>