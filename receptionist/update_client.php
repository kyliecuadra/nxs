<?php
// Include database connection
include('../config/db_connection.php'); // Adjust path as needed

// Check if the necessary data is received
if (isset($_POST['client_id']) && isset($_POST['name']) && isset($_POST['contact_number'])) {
    $clientId = $_POST['client_id'];
    $name = $_POST['name'];
    $contactNumber = $_POST['contact_number'];

    // Prepare the SQL query to update client information
    $sql = "UPDATE clients SET name = ?, contact_number = ? WHERE client_id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters to the query
        $stmt->bind_param("ssi", $name, $contactNumber, $clientId);

        // Execute the query
        if ($stmt->execute()) {
            // Send a success response
            echo json_encode(['success' => true]);
        } else {
            // Send an error response
            echo json_encode(['success' => false, 'message' => 'Failed to update the client.']);
        }

        $stmt->close();
    } else {
        // Handle SQL preparation error
        echo json_encode(['success' => false, 'message' => 'Failed to prepare the query.']);
    }
} else {
    // Handle missing data
    echo json_encode(['success' => false, 'message' => 'Invalid input data.']);
}

$conn->close();
?>
