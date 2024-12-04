<?php
// Database connection
require("../config/db_connection.php");
session_start();


$config_id = $_POST['config_id'];
$sql = "DELETE FROM points_configuration WHERE config_id = $config_id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => $conn->error]);
}

$conn->close();
?>
