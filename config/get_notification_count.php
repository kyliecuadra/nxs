<?php
require("db_connection.php");
session_start();

// Assume user ID is 6 (you might want to get this dynamically)
$userId = $_SESSION["id"];

// Get the count of unread notifications
$sql = "SELECT COUNT(*) FROM notifications WHERE recipient_user_id = $userId AND is_read = 0";
$result = mysqli_query($conn, $sql);

$count = mysqli_fetch_array($result)[0];

// Return count as plain text
echo $count;

// Close the connection
mysqli_close($conn);
?>