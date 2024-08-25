<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
include("../../config.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM tb_siswa WHERE nama LIKE '%$id%';";
    $result = mysqli_query($db, $sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(['name' => '']);
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['hapus'];
    $sql = "DELETE FROM tb_siswa WHERE NIS = $id";
    if (mysqli_query($db, $sql)) {
        $_SESSION['pesan'] = "Berhasil Menghapus data";
        header("Location: ../dataPkl.php");
        exit();
    }
}
