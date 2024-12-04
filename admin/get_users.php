<?php
header('Content-Type: application/json');

// Database connection
require("../config/db_connection.php");

// Initialize the data array
$data = array();

// SQL query to fetch users
$sql = "SELECT user_id, username, name, email, contact_number, status FROM users WHERE role = 'receptionist'"; // Adjust table name and columns as needed

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    // Fetch each row and add to the data array
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

// Return the data as JSON (only once)
echo json_encode(array('data' => $data));

// Close the database connection
mysqli_close($conn);
?>
