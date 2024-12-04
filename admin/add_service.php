<?php
// Database connection
require("../config/db_connection.php");
session_start();

// Get POST data
$service_name = isset($_POST['service_name']) ? trim($_POST['service_name']) : '';
$points_acquired = isset($_POST['points_acquired']) ? (int) $_POST['points_acquired'] : 0;

// Validate input
if (empty($service_name) || $points_acquired <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid input data.']);
    exit;
}

// Escape input to prevent SQL injection
$service_name = $conn->real_escape_string($service_name);

// Insert query
$sql = "INSERT INTO points_configuration (service_name, points_acquired, points_redeemed) 
        VALUES ('$service_name', $points_acquired, NULL)";

if (mysqli_query($conn, $sql)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to add service: ' . mysqli_error($conn)]);
}

$conn->close();
?>
