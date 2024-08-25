<?php
session_start();
include('../config.php');
date_default_timezone_set('Asia/Jakarta');
if (empty($_SESSION['csrf_token'])) {
    header("Location: ../login.php");
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Presensi | Universitas Teknologi Digital Indonesia</title>
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
            <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                <?php
                if (isset($_SESSION['pesan'])) {
                ?>
                    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <img src="logo.png" class="rounded me-2" alt="..." width="5%">
                            <strong class="me-auto">Login</strong>
                            <small>Just now</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            <?php echo $_SESSION['pesan']  ?>
                        </div>
                    </div>
                <?php
                    unset($_SESSION['pesan']);
                }
                ?>
            </div>

            <div class="col-sm-3 mb-3 mb-sm-0">
                <div class="card border-light shadow-sm ms-5 me-2 my-4 ">
                    <?php include('../layouts/sidebar.php') ?>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="fs-3 fw-bold ps-2 pt-4">DATA PRESENSI</p>
                    <a href="dataPresensiCetak.php" target="blank" class="btn btn-info btn-sm me-5 d-flex justify-content-between align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
                            <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1" />
                        </svg>
                        &nbsp;Cetak PDF</a>
                </div>

                <div class="card border-light me-5 ms-2">
                    <div class="card-body bs-bg-opacity-0 p-0">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get" class="ps-5 pt-3 pb-3">
                            <div class="row text-center">
                                <div class="col-10">
                                    <input type="text" class="form-control form-control-sm" placeholder="Cari Data Presensi" name="cari" id="cari">
                                </div>
                                <div class="col-auto">
                                    <input type="submit" value="Cari Data Presensi" class="btn btn-primary btn-sm">
                                </div>
                            </div>
                        </form>
                        <table class="table">
                            <thead>
                                <tr class="table-info m-2">
                                    <td class="fw-medium align-middle">
                                        <p class="pt-3  ps-3">No</p>
                                    </td>
                                    <td class="fw-medium align-middle">
                                        <p class="pt-3 ">NIS</p>
                                    </td>
                                    <td class="fw-medium align-middle">
                                        <p class="pt-3 ">Nama</p>
                                    </td>
                                    <td class="fw-medium align-middle">
                                        <p class="pt-3 ">Asal Sekolah</p>
                                    </td>
                                    <td class="fw-medium align-middle text-center">
                                        <p class="pt-3 ">Tanggal</p>
                                    </td>
                                    <td class="fw-medium align-middle text-center">
                                        <p class="pt-3 ">Jam Masuk</p>
                                    </td>
                                    <td class="fw-medium align-middle text-center">
                                        <p class="pt-3 ">Jam Keluar</p>
                                    </td>
                                    <td class="fw-medium align-middle">
                                        <p class="pt-3 ">Status</p>
                                    </td>
                                    <td class="fw-medium align-middle">
                                        <p class="pt-3 ">Status Pulang</p>
                                    </td>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php
                                $batas = 5;
                                $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                                $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                                $previous = $halaman - 1;
                                $next = $halaman + 1;
                                $data_pegawai = "";
                                if (isset($_GET['cari'])) {
                                    $cari = $_GET['cari'];
                                    $data = mysqli_query($db, "SELECT * FROM tb_presensi INNER JOIN tb_siswa ON tb_presensi.nis = tb_siwa.NIS WHERE tb_siswa.nama LIKE '%$cari%'");
                                    $jumlah_data = mysqli_num_rows($data);
                                    $total_halaman = ceil($jumlah_data / $batas);
                                    $data_pegawai = mysqli_query($db, "SELECT * FROM tb_presensi INNER JOIN tb_siswa ON tb_presensi.nis = tb_siswa.NIS WHERE tb_siswa.nama LIKE '%$cari%' ORDER BY tb_presensi.id_presensi DESC limit $halaman_awal, $batas ");
                                    $nomor = $halaman_awal + 1;
                                } else {
                                    $data = mysqli_query($db, "select * from tb_presensi");
                                    $jumlah_data = mysqli_num_rows($data);
                                    $total_halaman = ceil($jumlah_data / $batas);
                                    $data_pegawai = mysqli_query($db, "SELECT * FROM tb_presensi INNER JOIN tb_siswa ON tb_presensi.nis = tb_siswa.NIS ORDER BY tb_presensi.id_presensi DESC limit $halaman_awal, $batas ");
                                    $nomor = $halaman_awal + 1;
                                }
                                while ($d = mysqli_fetch_array($data_pegawai)) {
                                ?>
                                    <tr class="m-5">
                                        <th class="align-middle" scope="row">
                                            <p class="pt-3 ps-3"><?php echo $nomor++ ?></p>
                                        </th>
                                        <td class="align-middle">
                                            <p class="pt-3"><?php echo $d['NIS'] ?></p>
                                        </td>
                                        <td class="align-middle">
                                            <p class="pt-3"><?php echo $d['nama'] ?></p>
                                        </td>
                                        <td class="align-middle">
                                            <p class="pt-3"><?php echo $d['asal_sekolah'] ?></p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="pt-3"><?php echo date("Y-m-d", strtotime($d['masuk'])) ?></p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="pt-3"><?php echo date("H:i", strtotime($d['masuk'])) ?></p>
                                        </td>
                                        <?php
                                        if ($d['keluar']) {
                                        ?>
                                            <td class="align-middle text-center">
                                                <p class="pt-3"><?php echo date("H:i", strtotime($d['keluar'])) ?></p>
                                            </td>
                                        <?php
                                        } else {
                                        ?>
                                            <td></td>
                                        <?php
                                        } ?>
                                        <td class="align-middle">
                                            <p class="pt-3 text-capitalize"><?php echo $d['status'] ?></p>
                                        </td>
                                        <td class="align-middle">
                                            <p class="pt-3 text-capitalize">
                                                <?php
                                                $cek = date("H:m:s", strtotime($d['keluar']));
                                                if ($d['keluar'] == NULL) {
                                                    echo "";
                                                } elseif (!$d['keluar'] == NULL && $cek < '16:00:00') {
                                                    echo "Pulang lebih cepat";
                                                } elseif (!$d['keluar'] == NULL && $cek >= '16:00:00') {
                                                    echo "Pulang";
                                                }
                                                ?>
                                            </p>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php
                        if ($total_halaman > 1) {
                        ?>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end pe-3">
                                    <li class="page-item">
                                        <a class="page-link" <?php if ($halaman >= 1) {
                                                                    echo "href='?halaman=$previous'";
                                                                } ?>>Previous</a>
                                    </li>
                                    <?php
                                    for ($x = 1; $x <= $total_halaman; $x++) {
                                    ?>
                                        <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                                    <?php
                                    }
                                    ?>
                                    <li class="page-item">
                                        <a class="page-link" <?php if ($halaman <= $total_halaman) {
                                                                    echo "href='?halaman=$next'";
                                                                } ?>>Next</a>
                                    </li>
                                </ul>
                            </nav>
                        <?php } ?>
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