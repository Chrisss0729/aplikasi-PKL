<?php
session_start();
include('../config.php');
if (empty($_SESSION['csrf_token'])) {
    header("Location: ../login.php");
}
require_once __DIR__ . '/../vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => 'A4', // Format kertas
    'orientation' => 'L' // 'P' untuk Portrait, 'L' untuk Landscape
]);
$html =
    '
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
    <div class="card mb-12 align-middle border-0">
        <div class="row g-0">
            <div class="col-md-10">
                <div class="card-body text-center">
                    <p class="card-text">YAYASAN PENDIDIKAN WIDYA BAKTI YOGYAKARTA</p>
                    <h5 class="card-title">UNIVERSITAS TEKNOLOGI DIGITAL INDONESIA</h5>
                    <p class="card-text">Jl. Raya Janti Jl. Majapahit No.143, Jaranan, Banguntapan, Kec. Banguntapan, Kabupaten Bantul, Daerah Istimewa Yogyakarta 55198</p>
                </div>
            </div>
        </div>
        <hr class="border border-warning border-2 opacity-50">
    </div>
    <table class="table table-bordered">
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
                <td class="fw-medium align-middle text-end">
                    <p class="pt-3 ">Tanggal</p>
                </td>
                <td class="fw-medium align-middle text-end">
                    <p class="pt-3 ">Jam Masuk</p>
                </td>
                <td class="fw-medium align-middle text-end">
                    <p class="pt-3 ">Jam Keluar</p>
                </td>
                <td class="fw-medium align-middle text-center">
                    <p class="pt-3 ">Status</p>
                </td>
            </tr>
        </thead>
        <tbody class="table-group-divider">';
$data_pegawai = mysqli_query($db, "SELECT * FROM tb_presensi INNER JOIN tb_pkl ON tb_presensi.nis = tb_pkl.NIS ORDER BY tb_presensi.id_presensi DESC ");
$nomor = 1;
while ($d = mysqli_fetch_array($data_pegawai)) {

    $html .= '
        <tr class="m-5">
            <td class="align-middle" scope="row">
                <p class="pt-3 ps-3">' . $nomor++ . '</p>
            </td>
            <td class="align-middle">
                <p class="pt-3">' . $d['NIS'] . '</p>
            </td>
            <td class="align-middle">
                <p class="pt-3">' . $d['nama'] . '</p>
            </td>
            <td class="align-middle">
                <p class="pt-3">' . $d['asal_sekolah'] . '</p>
            </td>
            <td class="align-middle text-end">
                <p class="pt-3">' . date("Y-m-d", strtotime($d['masuk'])) . '</p>
            </td>
            <td class="align-middle text-end">
                <p class="pt-3">' . date("H:i", strtotime($d['masuk'])) . '</p>
            </td>';
    if ($d['keluar']) {
        $html .= '
            <td class="align-middle text-end">
                <p class="pt-3">' . date("H:i", strtotime($d['keluar'])) . '</p>
            </td>';
    } else {
        $html .= '<td></td>';
    }
    $html .= '<td class="align-middle text-center">
            <p class="pt-3">';
    if ($d['status'] == 'M') {
        $html .= 'Masuk';
    } else if ($d['status'] == 'T') {
        $html .= 'Telat';
    } else if ($d['status'] == 'S') {
        $html .= 'Skip';
    } else {
        $html .= 'Tidak ada status';
    }
    $html .= '
        </p>
    </td>';
    $html .= '</tr>';
}
$html .= '
        </table>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>

</body>

</html>
';
$mpdf->WriteHTML($html);
$mpdf->Output('cetak_pkl.pdf', \Mpdf\Output\Destination::INLINE);
