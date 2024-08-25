<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
include("../../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file = $_FILES['foto']['name'];
    $nis = $_SESSION['id_user'];
    $extensi = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $errorFile;
    if (isset($_POST['upload'])) {
        // Validasi nama
        if (empty($file)) {
            $errorFile = "File harus diisi";
        } else {
            if ($extensi != 'pdf') {
                $errorFile = "File harus PDF";
            }
        }

        // Jika ada kesalahan, simpan di sesi dan kembali ke form
        if (!empty($errorFile)) {
            $_SESSION['errorFile'] = $errorFile;
            header("Location: ../tambahTugas.php");
            exit();
        } else {
            $cariSql = "SELECT * FROM tb_pkl WHERE NIS = $nis";
            $query = mysqli_query($db, $cariSql);
            if ($query->num_rows == 1) {
                $data = $query->fetch_assoc();
                $nama = $data['nama'];
                $tanggal = date("Ymdhis");
                $namaFile = $nis . "_" . $nama . "_tugas_" . $tanggal . "." . $extensi;
                $targetDirectory  = __DIR__ . '/../../asset/tugas/';
                $targetFilePath = $targetDirectory . $namaFile;

                if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFilePath)) {
                    $sql = "INSERT INTO tb_tugas(nis, file, pengumpulan) VALUES ($nis, '$namaFile', '$tanggal')";
                    $query1 = mysqli_query($db, $sql);
                    if ($query1) {
                        $_SESSION['pesan'] = "Berhasil Menambah Tugas";
                        header("Location: ../dataTugas.php");
                        exit();
                    }
                } else {
                    echo "Maaf, terjadi kesalahan saat mengunggah file.";
                }
            }
        }
    }
}
