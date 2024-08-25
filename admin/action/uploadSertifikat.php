<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
include("../../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_admin = $_SESSION['id_user'];
    $nis = $_POST['nis'];

    $file = $_FILES['foto']['name'];
    $extensi = strtolower(pathinfo($file, PATHINFO_EXTENSION));

    if (isset($_POST['submit'])) {

        $tanggal = date("Ymdhis");
        $namaFile = $nis . "_sertifikat_" . $tanggal . "." . $extensi;
        $targetDirectory  = __DIR__ . '/../../asset/sertifikat/';
        $targetFilePath = $targetDirectory . $namaFile;

        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFilePath)) {
            $sql = "INSERT INTO tb_sertifikat(id_admin, id_pkl, file, tanggal) VALUES ($id_admin, $nis, '$namaFile', '$tanggal')";
            $query = mysqli_query($db, $sql);
            if ($query) {
                $_SESSION['pesan'] = "Berhasil Menambah Sertifikat";
                header("Location: ../dataSertifikat.php");
                exit();
            }
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file.";
        }
    }
}
