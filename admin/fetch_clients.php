<?php
require_once '../config/db_connection.php';

$query = "SELECT 
            c.client_id, 
            c.username, 
            c.name AS client_name, 
            c.email, 
            c.contact_number, 
            c.remaining_points, 
            c.qr_code_path, 
            c.registration_date, 
            u.name AS registered_by
        FROM clients c
        INNER JOIN users u";
        
$result = mysqli_query($conn, $query);

$clients = [];
while ($row = mysqli_fetch_assoc($result)) {
    $clients[] = $row;
}

echo json_encode($clients);  // Return the data in JSON format
mysqli_close($conn);
?>
