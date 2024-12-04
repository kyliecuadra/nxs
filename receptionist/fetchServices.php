<?php
require("../config/db_connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $clientId = $_POST['clientId'];
    $action = $_POST['action']; // 'add' or 'redeem'

    // Based on the action, fetch the appropriate services
    if ($action === 'add') {
        $sql = "SELECT * FROM points_configuration WHERE points_acquired IS NOT NULL";
    } elseif ($action === 'redeem') {
        $sql = "SELECT * FROM points_configuration WHERE points_redeemed IS NOT NULL";
    }

    $result = mysqli_query($conn, $sql);
    $services = [];

    if ($result && mysqli_num_rows($result) > 0) {
        while ($service = mysqli_fetch_assoc($result)) {
            $services[] = $service;
        }

        echo json_encode(['success' => true, 'services' => $services]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No services found']);
    }

    mysqli_close($conn);
}
?>
