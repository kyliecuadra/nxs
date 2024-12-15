<?php
// Include the necessary files from the PHP QR Code library
require_once '../config/phpqrcode/qrlib.php';  // Adjust the path to where the phpqrcode directory is located
session_start();
// Function to generate the client ID
function generateClientID($conn) {
    $currentYear = date("Y");
    $query = "SELECT client_id FROM clients WHERE client_id LIKE 'NXS-$currentYear%' ORDER BY client_id DESC LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $lastClient = mysqli_fetch_assoc($result);
        $lastId = explode("-", $lastClient['client_id']);
        $increment = (int)$lastId[2] + 1;
        return "NXS-$currentYear-" . str_pad($increment, 6, "0", STR_PAD_LEFT);
    } else {
        return "NXS-$currentYear-000001";
    }
}

// Function to generate AES-encrypted QR code
function generateQRCode($clientID) {
    // Secret key and initialization vector (you can generate a better key for production)
    $secretKey = 'NjI3ZDgyOTQwM2FkNzNjYzFkYjI5M2M1NzQzNjMwZDBmYmI0NjU5NTYwZmJlYzdlYmNhZTQ5NmNjMmRhMjMzMjY=';  // Use a secure key
    $iv = openssl_random_pseudo_bytes(16);  // Generate a random 16-byte IV

    // AES encryption (AES-256-CBC)
    $encryptedClientID = openssl_encrypt($clientID, 'AES-256-CBC', $secretKey, 0, $iv);
    
    // Combine the encrypted data and IV (necessary for decryption)
    $encryptedDataWithIV = base64_encode($encryptedClientID . '::' . base64_encode($iv));

    // Set the path to save the generated QR code
    $qrCodeDir = '../assets/img/qrcodes/';
    $qrCodePath = $qrCodeDir . $clientID . '.png';

    // Check if the directory exists and is writable
    if (!is_dir($qrCodeDir)) {
        mkdir($qrCodeDir, 0777, true);  // Create directory if it doesn't exist
    }

    if (!is_writable($qrCodeDir)) {
        return 'Error: QR code directory is not writable.';
    }

    // Generate the QR code and save it as a PNG image
    try {
        QRcode::png($encryptedDataWithIV, $qrCodePath, QR_ECLEVEL_L, 10);  // 10 is the size, you can adjust it
        return $qrCodePath;  // Return the path to the generated QR code image
    } catch (Exception $e) {
        return 'Error generating QR code: ' . $e->getMessage();  // Catch and return any error
    }
}


require("../config/db_connection.php");

// Check if the data is sent via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $contactNumber = isset($_POST['contactNumber']) ? $_POST['contactNumber'] : '';

    if (empty($username) || empty($name)) {
        echo json_encode(['status' => 'error', 'message' => 'Username, name, and email are required.']);
        exit;
    }

    // Generate client ID
    $clientID = generateClientID($conn);
    // Generate the QR code
    $qrCodePath = generateQRCode($clientID);

    // Insert client data into the database
    $query = "INSERT INTO clients (client_id, username, name, email, contact_number, qr_code_path, registered_by, registration_date) 
    VALUES ('$clientID', '$username', '$name', '$email', '$contactNumber', '$qrCodePath', '" . $_SESSION['id'] . "', NOW())";


    if (mysqli_query($conn, $query)) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Client added successfully!',
            'clientID' => $clientID,  // Include the client ID in the response
            'qrCodePath' => $qrCodePath
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add client.']);
    }

    // Close database connection
    mysqli_close($conn);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}

?>
