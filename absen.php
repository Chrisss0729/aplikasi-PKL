<?php
include 'config.php';

$api_key = 'AIzaSyAAQifKDNpwU9biFCwBwCdC_ms0sYHpPpw'; // Ganti dengan API key Google Maps
$radius = 3 * 1000; // 3 km in meters

// Function to calculate distance between two lat/lng points
function getDistance($lat1, $lng1, $lat2, $lng2) {
    $earth_radius = 6371000; // Earth radius in meters
    $lat1 = deg2rad($lat1);
    $lng1 = deg2rad($lng1);
    $lat2 = deg2rad($lat2);
    $lng2 = deg2rad($lng2);

    $dlat = $lat2 - $lat1;
    $dlng = $lng2 - $lng1;
    
    $a = sin($dlat/2) * sin($dlat/2) + cos($lat1) * cos($lat2) * sin($dlng/2) * sin($dlng/2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    
    return $earth_radius * $c;
}

// Get user ID and current location from POST data
$user_id = $_POST['user_id'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$status = $_POST['status']; // 'masuk' or 'pulang'

// Center of the office (example coordinates)
$office_lat = -7.7854641934878375;
$office_lng = 110.36590079410458;

$distance = getDistance($lat, $lng, $office_lat, $office_lng);

if ($distance <= $radius) {
    $today = date('Y-m-d');
    $waktu_absen = new DateTime();
    $waktu_absen->setTimezone(new DateTimeZone('Asia/Jakarta'));
    $waktu_absen_formatted = $waktu_absen->format('Y-m-d H:i:s');
    
    // Check if user has already checked in today
    $stmt = $mysqli->prepare("SELECT COUNT(*) AS count FROM absensi WHERE user_id = ? AND DATE(waktu_absen) = ? AND status = ?");
    $stmt->bind_param("iss", $user_id, $today, $status);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = $result->fetch_assoc()['count'];
    $stmt->close();

    if ($count > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Anda sudah melakukan absensi hari ini.']);
    } else {
        $terlambat = false;
        $message = 'Absensi berhasil!';
        
        if ($status == 'masuk') {
            // Check if user is late
            // For example, assume work starts at 09:00 AM
            $work_start_time = new DateTime($today . ' 09:00:00');
            $work_start_time->setTimezone(new DateTimeZone('Asia/Jakarta'));
            if ($waktu_absen > $work_start_time) {
                $terlambat = true;
                $message = 'Anda terlambat!';
            }
        }

        $stmt = $mysqli->prepare("INSERT INTO absensi (user_id, waktu_absen, status, lat, lng, terlambat) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issdsi", $user_id, $waktu_absen_formatted, $status, $lat, $lng, $terlambat);
        $stmt->execute();
        $stmt->close();
        
        echo json_encode(['status' => 'success', 'message' => $message]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Anda berada di luar radius!']);
}

$mysqli->close();
?>