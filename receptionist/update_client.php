<?php
// Include database connection
include('../config/db_connection.php'); // Adjust path as needed

// Check if the necessary data is received
if (isset($_POST['client_id']) && isset($_POST['name']) && isset($_POST['contact_number'])) {
    $clientId = $_POST['client_id'];
    $name = $_POST['name'];
    $contactNumber = $_POST['contact_number'];

    // Sanitize input to prevent SQL injection
    $clientId = $conn->real_escape_string($clientId);
    $name = $conn->real_escape_string($name);
    $contactNumber = $conn->real_escape_string($contactNumber);

    // Prepare the SQL query to update client information using mysqli_query
    $sql = "UPDATE clients SET name = '$name', contact_number = '$contactNumber' WHERE client_id = '$clientId'";
    // Execute the query
    if ($result = mysqli_query($conn, $sql)) {
        // Check if any rows were updated
        if (mysqli_affected_rows($conn) > 0) {
            // Send a success response
            echo json_encode(['success' => true]);
        } else {
            // If no rows were affected, the client ID might not exist
            echo json_encode(['success' => false, 'message' => 'No records updated, client ID may not exist.']);
        }
    } else {
        // Send an error response
        echo json_encode(['success' => false, 'message' => 'Failed to update the client.']);
    }

} else {
    // Handle missing data
    echo json_encode(['success' => false, 'message' => 'Invalid input data.']);
}

// Close the connection
$conn->close();
?>
