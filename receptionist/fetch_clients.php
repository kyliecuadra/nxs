<?php
require_once '../config/db_connection.php';

$query = "SELECT client_id, username, name, email, contact_number, remaining_points, qr_code_path FROM clients";
$result = mysqli_query($conn, $query);

$clients = [];
while ($row = mysqli_fetch_assoc($result)) {
    $clients[] = $row;
}

echo json_encode($clients);  // Return the data in JSON format
mysqli_close($conn);
?>
