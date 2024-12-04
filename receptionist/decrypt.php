<?php
// Get the encrypted data from the POST request
$encryptedDataWithIV = $_POST['encryptedData'];

// Secret key used for AES encryption (same as the one used for generating QR code)
$secretKey = 'NjI3ZDgyOTQwM2FkNzNjYzFkYjI5M2M1NzQzNjMwZDBmYmI0NjU5NTYwZmJlYzdlYmNhZTQ5NmNjMmRhMjMzMjY=';  // Replace with your actual secret key

// Function to decrypt the AES-encrypted client ID
function decryptClientID($encryptedDataWithIV, $secretKey) {
    // Base64 decode the encrypted data
    $decodedData = base64_decode($encryptedDataWithIV);
    
    // Split the data into encrypted client ID and IV
    list($encryptedClientID, $encodedIV) = explode('::', $decodedData);
    
    // Decode the IV
    $iv = base64_decode($encodedIV);

    // AES decryption (AES-256-CBC)
    $decryptedClientID = openssl_decrypt($encryptedClientID, 'AES-256-CBC', $secretKey, 0, $iv);

    return $decryptedClientID;  // Return the decrypted client ID
}

// Decrypt the client ID and return it
$decryptedClientID = decryptClientID($encryptedDataWithIV, $secretKey);

// Send the decrypted client ID back to the client
echo $decryptedClientID;
?>
