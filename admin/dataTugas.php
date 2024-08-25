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
    <title>Data Tugas | Universitas Teknologi Digital Indonesia</title>
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
                            <img src="../asset/image/logo.png" class="rounded me-2" alt="..." width="5%">
                            <strong class="me-auto">File Tugas</strong>
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
                    <p class="fs-3 fw-bold ps-2 pt-4">DATA TUGAS</p>
                </div>

                <div class="card border-light me-5 ms-2">
                    <div class="card-body bs-bg-opacity-0 p-0">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get" class="ps-5 pt-3 pb-3">
                            <div class="row">
                                <div class="col-10">
                                    <input type="text" class="form-control form-control-sm" placeholder="Cari Tugas" name="cari" id="cari">
                                </div>
                                <div class="col-auto">
                                    <input type="submit" value="Cari Tugas" class="btn btn-primary btn-sm">
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
                                        <p class="pt-3 ">Nama File</p>
                                    </td>
                                    <td class="fw-medium align-middle text-center">
                                        <p class="pt-3 ">Pengumpulan</p>
                                    </td>
                                    <td class="fw-medium align-middle text-center">
                                        <p class="pt-3 ">Action</p>
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
                                if (isset($_GET['cari'])) {
                                    $cari = $_GET['cari'];
                                    $data = mysqli_query($db, "SELECT * FROM tb_tugas INNER JOIN tb_siswa ON tb_tugas.nis = tb_siswa.NIS WHERE tb_siswa.nama LIKE '%$cari%'");
                                    $jumlah_data = mysqli_num_rows($data);
                                    $total_halaman = ceil($jumlah_data / $batas);
                                    $data_pegawai = mysqli_query($db, "SELECT * FROM tb_tugas INNER JOIN tb_siswa ON tb_tugas.nis = tb_siswa.NIS WHERE tb_siswa.nama LIKE '%$cari%' ORDER BY tb_tugas.id_tugas DESC limit $halaman_awal, $batas ");
                                    $nomor = $halaman_awal + 1;
                                } else {
                                    $data = mysqli_query($db, "SELECT * FROM tb_tugas");
                                    $jumlah_data = mysqli_num_rows($data);
                                    $total_halaman = ceil($jumlah_data / $batas);
                                    $data_pegawai = mysqli_query($db, "SELECT * FROM tb_tugas INNER JOIN tb_siswa ON tb_tugas.nis = tb_siswa.NIS ORDER BY tb_tugas.id_tugas DESC limit $halaman_awal, $batas ");
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
                                            <p class="pt-3"><?php echo $d['file'] ?></p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="pt-3"><?php echo $d['pengumpulan'] ?></p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-<?php echo $d['id_tugas'] ?>">
                                                Lihat
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal-<?php echo $d['id_tugas'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo $d['file'] ?></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <embed src="../asset/tugas/<?php echo $d['file'] ?>" class="img-preview" type="application/pdf" width="100%" height="550px" frameborder="0">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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