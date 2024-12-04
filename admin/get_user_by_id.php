<?php
// get_user_by_id.php
header('Content-Type: application/json');

// Database connection
require("../config/db_connection.php");

// Get the user_id from the request
$user_id = $_GET['user_id'];

// SQL query to fetch the user by ID
$sql = "SELECT user_id, username, name, email, contact_number, status FROM users WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);

// Check if the user exists
if (mysqli_num_rows($result) > 0) {
    // Fetch the user data
    $user = mysqli_fetch_assoc($result);

    // Return the data as JSON
    echo json_encode(array('data' => $user));
} else {
    // Return an error if the user is not found
    echo json_encode(array('data' => null));
}

// Close the database connection
mysqli_close($conn);
?>
