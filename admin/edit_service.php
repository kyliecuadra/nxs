<?php
// Database connection
require("../config/db_connection.php");
session_start();


$config_id = $_POST['config_id'];
$service_name = $_POST['service_name'];
$points = $_POST['points'];

$sql = "UPDATE points_configuration 
        SET service_name = '$service_name', 
            points_acquired = IF(points_acquired IS NOT NULL, $points, NULL), 
            points_redeemed = IF(points_redeemed IS NOT NULL, $points, NULL) 
        WHERE config_id = $config_id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => $conn->error]);
}

$conn->close();
?>
