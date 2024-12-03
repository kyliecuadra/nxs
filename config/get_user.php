<?php
// Perform database connection
require("db_connection.php");

// Get the user ID from the request
$id = $_GET['id'];

// Prepare and execute the statement
$query = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    echo json_encode(['success' => true, 'user' => $user]);
} else {
    echo json_encode(['success' => false, 'message' => 'User not found']);
}

// Close connection
mysqli_close($conn);
?>