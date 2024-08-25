<?php
include 'config.php';

// Fetch user ID
$user_id = $_GET['user_id'];

// Total absensi
$result = $mysqli->query("SELECT COUNT(*) AS total_absensi FROM absensi WHERE user_id = $user_id AND status = 'masuk'");
$total_absensi = $result->fetch_assoc()['total_absensi'];

// Hadir per hari
$date_today = date('Y-m-d');
$result = $mysqli->query("SELECT COUNT(*) AS hadir FROM absensi WHERE user_id = $user_id AND DATE(waktu_absen) = '$date_today' AND status = 'masuk'");
$hadir_today = $result->fetch_assoc()['hadir'];

// Keterlambatan
$result = $mysqli->query("SELECT COUNT(*) AS terlambat FROM absensi WHERE user_id = $user_id AND terlambat = TRUE");
$terlambat = $result->fetch_assoc()['terlambat'];

// Tidak hadir
$result = $mysqli->query("SELECT COUNT(DISTINCT DATE(waktu_absen)) AS total_days FROM absensi WHERE user_id = $user_id AND status = 'masuk'");
$days_with_absence = $result->fetch_assoc()['total_days'];

$total_days = (int)date('z') + 1; // Total days in current month
$tidak_hadir = $total_days - $days_with_absence;

echo "Total Absensi: $total_absensi<br>";
echo "Hadir Hari Ini: $hadir_today<br>";
echo "Terlambat: $terlambat<br>";
echo "Tidak Hadir: $tidak_hadir<br>";

$mysqli->close();
?>
