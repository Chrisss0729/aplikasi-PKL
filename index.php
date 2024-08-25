<?php
session_start();
include('config.php');

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Website | Aplikasi PKL Rpl</title>
    <link rel="icon" href="asset/image/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="min-vh-100 bg-light">
        <nav class="navbar navbar-expand-lg sticky-top shadow-sm z-3 position-absolute" style="background-color: #fff;">
            <div class="container-fluid px-5">
                <a class="navbar-brand fw-bold" href="#"><img src="asset/image/rpl2.png" alt="" width="20%"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                        <li class="nav-item ms-4 me-4 fw-medium">
                            <a class="nav-link" aria-current="page" href="index.php">Home</a>
                        </li>
                        <?php
                        if (isset($_SESSION['id_user'])) {
                            $id = $_SESSION['id_user'];
                            $sqlAdmin = "SELECT * FROM tb_admin WHERE id = $id";
                            $sqlUser = "SELECT * FROM tb_pkl WHERE NIS = $id";
                            if (mysqli_num_rows(mysqli_query($db, $sqlAdmin)) > 0) {
                        ?>
                                <li class="nav-item ms-4 me-4 fw-medium">
                                    <a class="nav-link" href="admin/dashboard.php">Admin</a>
                                </li>
                            <?php
                            } else if (mysqli_num_rows(mysqli_query($db, $sqlUser)) > 0) {
                            ?>
                                <li class="nav-item ms-4 me-4 fw-medium">
                                    <a class="nav-link" href="user/dashboard.php">Siswa</a>
                                </li>
                            <?php
                            } else {
                            ?>
                                <li class="nav-item ms-4 me-4 fw-medium">
                                    <a class="nav-link" href="">None</a>
                                </li>
                            <?php
                            }
                        } else {
                            ?>
                            <li class="nav-item ms-4 me-4 fw-medium">
                                <a class="nav-link" href="login.php">Login</a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="min-vh-100 d-flex align-content-center flex-wrap">
            <div class="row gx-0 ps-5">
                <div class="col-6">
                    <img src="asset/image/rpl2.png" alt="" width="80%">
                </div>
                <div class="col-6 pe-5 d-flex align-content-center flex-wrap">
                    <p class="fs-3 fw-medium">Sistem Informasi Manajemen PKL</p>
                    <p class="fs-5 fw-normal">Aplikasi presensi online terbaiki untuk memantau kehadiaran siswa PKL.
                        Membuat laporan data presennsi menjadi lebih mudah cukup dengan smartphone.</p>
                </div>
            </div>
        </div>
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