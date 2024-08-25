<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
include("../../config.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM tb_siswa WHERE NIS = $id";
    $result = mysqli_query($db, $sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(['name' => '']);
    }
}


if (isset($_POST['submit'])) {
    $nis = $_POST['nis'];
    $alasan = $_POST['alasan'];
    $tanggal = $_POST['tanggal'];
    $sql = "INSERT INTO tb_ijin(NIS, alasan, tanggal) VALUES ($nis, '$alasan', '$tanggal')";
    $query = mysqli_query($db, $sql);
    if ($query) {
        $_SESSION['pesan'] = "Berhasil Menambah IJIN";
        header("Location: ../dataIjin.php");
        exit();
    }
}
