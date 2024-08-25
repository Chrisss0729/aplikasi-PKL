<?php
session_start();
include('../config.php');
if (empty($_SESSION['csrf_token'])) {
    header("Location: ../login.php");
}

if (isset($_POST['submit'])) {
    $ip = $_POST['ip'];
    $sql = "UPDATE tb_ip SET ip = '$ip' WHERE id = 1";
    $query = mysqli_query($db, $sql);
    if ($query) {
        $_SESSION['pesan'] = "Berhasil mengganti IP wifi menjadi " . $ip;
        header("Location: gantiIP.php");
        exit();
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data PKL | Universitas Teknologi Digital Indonesia</title>
    <link rel="icon" href="../asset/image/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="min-vh-100 bg-light">
        <nav class="navbar sticky-top shadow-sm" style="background-color: #fff;">
            <div class="px-5">
                <a class="navbar-brand fw-bold" href="#"><img src="../asset/image/utdi.png" alt="" width="10%"></a>
            </div>
        </nav>
        <div class="row gx-0">
            <div class="col-sm-3 mb-3 mb-sm-0">
                <div class="card border-light shadow-sm ms-5 me-2 my-4 ">
                    <?php include('../layouts/sidebar.php') ?>
                </div>
            </div>
            <div class="col-sm-9">
                <p class="fs-3 fw-bold ps-2 pt-4">GANTI IP WIFI</p>
                <div class="card border-light me-5 ms-2">
                    <div class="card-body bs-bg-opacity-0 p-0">
                        <form class="ps-5 pt-3 pb-3 pe-5" action="gantiIP.php" method="post">
                            <?php
                            $ipAddress = gethostbyname(gethostname());
                            $sql = "SELECT * FROM tb_ip";
                            if (mysqli_query($db, $sql)->num_rows > 0) {
                                $data = mysqli_query($db, $sql)->fetch_assoc();
                            ?>
                                <p>IP Wifi untuk presensi adalah <strong><?php echo $data['ip'] ?></strong></p>
                            <?php
                            }
                            ?>
                            <p>IP Wifi yang sekarang pakai <strong><?php echo $ipAddress ?></strong></p>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Ganti IP Wifi</label>
                                <input type="text" class="form-control" name="ip">
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </form>

                    </div>
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