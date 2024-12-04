<?php
// update_user.php
header('Content-Type: application/json');

// Database connection
require("../config/db_connection.php");

// Get the updated user data from the request
$user_id = $_POST['user_id'];
$name = $_POST['name'];
$contact_number = $_POST['contact_number'];
$status = $_POST['status'];

// SQL query to update the user information
$sql = "UPDATE users SET name = '$name', contact_number = '$contact_number', status = '$status' WHERE user_id = $user_id";
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
