<?php
session_start();
include("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $pass = $_POST['pass'];
    $remember = isset($_POST['remember']);
    $errorNama;
    $errorPass;

    if (isset($_POST['login'])) {
        // Validasi nama
        if (empty($_POST['nama'])) {
            $errorNama = "Nama harus diisi";
        } else {
            $nama = htmlspecialchars(trim($_POST['nama']));
            $sql = "SELECT * FROM tb_admin WHERE username = '$nama'";
            $query = mysqli_query($db, $sql);
            if ($query->num_rows == 0) {
                $sql = "SELECT * FROM tb_siswa WHERE username = '$nama'";
                $query = mysqli_query($db, $sql);
                if ($query->num_rows == 0) {
                    $sql = "SELECT * FROM tb_siswa WHERE NIS = '$nama'";
                    $query = mysqli_query($db, $sql);
                    if ($query->num_rows == 0) {
                        $errorNama = "Username tidak terdaftar";
                    }
                }
            }
        }

        // Validasi password
        if (empty($_POST['pass'])) {
            $errorPass = "Password harus diisi";
        }

        // Jika ada kesalahan, simpan di sesi dan kembali ke form
        if (!empty($errorNama) or !empty($errorPass)) {
            $_SESSION['errorNama'] = $errorNama;
            $_SESSION['errorPass'] = $errorPass;
            header("Location: ../login.php");
            exit();
        } else {
            $md5 = md5($pass);
            $sql = "SELECT * FROM tb_admin WHERE username = '$nama' AND password = '$md5'";
            $query = mysqli_query($db, $sql);
            if ($query->num_rows == 1) {
                if ($remember) {
                    setcookie('nama', $nama, time() + 3600, '/');
                } else {
                    setcookie("nama", "", time() - (86400 * 30), "/");
                    setcookie("pass", "", time() - (86400 * 30), "/");
                }
                $data = $query->fetch_assoc();
                $_SESSION['id_user'] = $data['id'];
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                $_SESSION['pesan'] = "Berhasil Login";
                header("Location: ../admin/dashboard.php");
                exit();
            } else {
                $sql = "SELECT * FROM tb_siswa WHERE NIS = '$nama' AND password = '$md5'";
                $query = mysqli_query($db, $sql);
                if ($query->num_rows == 1) {
                    if ($remember) {
                        setcookie('nama', $nama, time() + 3600, '/');
                    } else {
                        setcookie("nama", "", time() - (86400 * 30), "/");
                        setcookie("pass", "", time() - (86400 * 30), "/");
                    }
                    $data = $query->fetch_assoc();
                    $_SESSION['id_user'] = $data['NIS'];
                    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                    $_SESSION['pesan'] = "Berhasil Login";
                    header("Location: ../user/dashboard.php");
                    exit();
                } else {
                    $sql = "SELECT * FROM tb_siswa WHERE username = '$nama' AND password = '$md5'";
                    $query = mysqli_query($db, $sql);
                    if ($query->num_rows == 1) {
                        if ($remember) {
                            setcookie('nama', $nama, time() + 3600, '/');
                        } else {
                            setcookie("nama", "", time() - (86400 * 30), "/");
                            setcookie("pass", "", time() - (86400 * 30), "/");
                        }
                        $data = $query->fetch_assoc();
                        $_SESSION['id_user'] = $data['NIS'];
                        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                        $_SESSION['pesan'] = "Berhasil Login";
                        header("Location: ../user/dashboard.php");
                        exit();
                    } else {
                        $_SESSION['pesan'] = "Gagal Login";
                        header("Location: ../login.php");
                        exit();
                    }
                }
            }
        }
    }
}
