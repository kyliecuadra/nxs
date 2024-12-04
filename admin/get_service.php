<?php
// Database connection
require("../config/db_connection.php");
session_start();


$config_id = $_POST['config_id'];
$sql = "SELECT * FROM points_configuration WHERE config_id = $config_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(['success' => false, 'message' => 'Service not found.']);
}
$conn->close();
?>
