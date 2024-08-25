<?php
include 'config.php';

// Set timezone to WIB
date_default_timezone_set('Asia/Jakarta');

// Get user ID
$user_id = $_GET['user_id'];

// Fetch total absences
$result = $mysqli->query("
    SELECT COUNT(*) AS total_absences 
    FROM absensi 
    WHERE user_id = $user_id AND status = 'masuk'
");
$total_absences = $result->fetch_assoc()['total_absences'];

// Fetch total lateness
$result = $mysqli->query("
    SELECT COUNT(*) AS total_lateness 
    FROM absensi 
    WHERE user_id = $user_id AND terlambat = TRUE
");
$total_lateness = $result->fetch_assoc()['total_lateness'];

// Fetch attendance per day
$result = $mysqli->query("
    SELECT DATE(waktu_absen) AS tanggal, status, waktu_absen, terlambat 
    FROM absensi 
    WHERE user_id = $user_id 
    ORDER BY waktu_absen DESC
");

// Calculate days with attendance
$days_with_attendance = $mysqli->query("
    SELECT COUNT(DISTINCT DATE(waktu_absen)) AS days_attended 
    FROM absensi 
    WHERE user_id = $user_id AND status = 'masuk'
")->fetch_assoc()['days_attended'];

// Calculate total days from starting day to current day
$start_date = new DateTime($starting_day);
$end_date = new DateTime();
$end_date->modify('today');
$total_days = $end_date->diff($start_date)->days + 1;

$days_absent = $total_days - $days_with_attendance;

echo "<h2>Riwayat Absensi</h2>";
echo "<p>Total Absensi: $total_absences</p>";
echo "<p>Total Keterlambatan: $total_lateness</p>";
echo "<p>Hari Hadir: $days_with_attendance</p>";
echo "<p>Hari Tidak Hadir: $days_absent</p>";

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Waktu Absensi</th>
                <th>Terlambat</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        $terlambat = $row['terlambat'] ? 'Ya' : 'Tidak';
        // Convert to WIB time format
        $waktu_absen_wib = new DateTime($row['waktu_absen']);
        $waktu_absen_wib->setTimezone(new DateTimeZone('Asia/Jakarta'));
        echo "<tr>
                <td>{$row['tanggal']}</td>
                <td>{$row['status']}</td>
                <td>" . $waktu_absen_wib->format('Y-m-d H:i:s') . "</td>
                <td>{$terlambat}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Belum ada riwayat absensi.";
}

$mysqli->close();
?>
