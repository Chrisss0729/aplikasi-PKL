<?php
session_start();
include("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nisn = $_POST['nisn'];
    $namaRegister = $_POST['namaRegister'];
    $sekolah = $_POST['sekolah'];
    $jurusan = $_POST['jurusan'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $errorNisn;
    $errornamaRegister;
    $errorSekolah;
    $errorJurusan;
    $errorUsername;
    $errorPassword;

    if (isset($_POST['register'])) {
        // Validasi NISN
        if (empty($nisn)) {
            $errorNisn = "NISN harus diisi";
        } else {
            $nisn = htmlspecialchars(trim($nisn));

            if (preg_match("/^[0-9]$/", $nisn)) {
                $errorNisn = "NISN hanya boleh berisi angka";
            }
            $sql = "SELECT * FROM tb_siswa WHERE NIS = $nisn";
            $query = mysqli_query($db, $sql);
            if (!$query->num_rows < 1) {
                $errorNisn = "NISN sudah terdaftar";
            }
        }

        // Validasi nama
        if (empty($namaRegister)) {
            $errornamaRegister = "Nama harus diisi";
        } else {
            $namaRegister = htmlspecialchars(trim($namaRegister));
            if (!preg_match("/^[a-zA-Z-' ]*$/", $namaRegister)) {
                $errornamaRegister = "Nama hanya boleh berisi huruf";
            }
        }

        // Validasi Sekolah
        if (empty($sekolah)) {
            $errorSekolah = "Sekolah harus diisi";
        } else {
            $sekolah = htmlspecialchars(trim($sekolah));
            if (!preg_match("/^[0-9A-Za-z]{10,15}$/", $sekolah)) {
                $error = "Sekolah hanya boleh berisi huruf dan angka";
            }
        }

        // Validasi Jurusan
        if (empty($jurusan)) {
            $errorJurusan = "Jurusan harus diisi";
        } else {
            $jurusan = htmlspecialchars(trim($jurusan));
            if (!preg_match("/^[0-9A-Za-z]{10,15}$/", $jurusan)) {
                $error = "Jurusan hanya boleh berisi huruf dan angka";
            }
        }

        // Validasi Username
        if (empty($username)) {
            $errorUsername = "Username harus diisi";
        } else {
            $username = htmlspecialchars(trim($username));
            if (!preg_match("/^[0-9A-Za-z]{10,15}$/", $username)) {
                $error = "Jurusan hanya boleh berisi huruf dan angka";
            }
        }

        // Validasi password
        if (empty($password)) {
            $errorPassword = "Password harus diisi";
        } else {
            $password = htmlspecialchars(trim($password));
            if (strlen($password) < 3) {
                $errorPassword = "Password harus lebih dari 3";
            }
        }

        // Jika ada kesalahan, simpan di sesi dan kembali ke form
        if (!empty($errorNama) or !empty($errorPass) or !empty($errorNisn) or !empty($errorSekolah) or !empty($errorJurusan) or !empty($errorUsername)) {
            $_SESSION['errorNisn'] = $errorNisn;
            $_SESSION['errornamaRegister'] = $errornamaRegister;
            $_SESSION['errorSekolah'] = $errorSekolah;
            $_SESSION['errorJurusan'] = $errorJurusan;
            $_SESSION['errorUsername'] = $errorUsername;
            $_SESSION['errorPassword'] = $errorPassword;

            $_SESSION['nisn'] = $nisn;
            $_SESSION['namaRegister'] = $namaRegister;
            $_SESSION['sekolah'] = $sekolah;
            $_SESSION['jurusan'] = $jurusan;
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['active'] = "Berhasil Membuat akun";
            header("Location: ../login.php");
            exit();
        } else {
            $md5 = md5($password);
            $sql = "INSERT INTO tb_siswa(NIS, username, password, nama, jurusan, asal_sekolah) VALUES ('$nisn', '$username', '$md5', '$namaRegister', '$jurusan', '$sekolah')";
            $query = mysqli_query($db, $sql);
            if ($query) {
                $_SESSION['pesanSignIn'] = "Berhasil Membuat akun";
                header("Location: ../login.php");
                exit();
            }
        }
    }
}
