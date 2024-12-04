<?php
// Example of fetching client information from the database using mysqli_query
// Example database connection
require("../config/db_connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $clientId = $_POST['clientId'];

    // Query the database to retrieve client information based on the client ID
    $sql = "SELECT * FROM clients WHERE client_id = '$clientId'"; // Using mysqli_query
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $client = mysqli_fetch_assoc($result);

        // Return the client data in JSON format
        echo json_encode([
            'success' => true,
            'id' => $client['id'],
            'clientId' => $client['client_id'],
            'username' => $client['username'],
            'name' => $client['name'],
            'email' => $client['email'],
            'contactNumber' => $client['contact_number'],
            'remainingPoints' => $client['remaining_points'],
            'qrCodeUrl' => $client['qr_code_path']
        ]);
    } else {
        echo json_encode(['success' => false]);
    }

    mysqli_close($conn);
}

?>
