<?php
// Database connection
require("../config/db_connection.php");
session_start();

$sql = "SELECT config_id, service_name, points_redeemed FROM points_configuration WHERE points_redeemed IS NOT NULL";
$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode(['data' => $data]);

$conn->close();
?>
