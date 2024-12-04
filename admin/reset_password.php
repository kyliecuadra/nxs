<?php
// reset_password.php
header('Content-Type: application/json');

// Database connection
require("../config/db_connection.php");

// Get user ID and new password from the request
$user_id = $_POST['user_id'];
$new_password = "NXS123";  // This will be "NXS123"


// SQL query to update the user's password
$sql = "UPDATE users SET password = '$new_password' WHERE user_id = $user_id";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the update was successful
if ($result) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('success' => false));
}

// Close the database connection
mysqli_close($conn);
?>
