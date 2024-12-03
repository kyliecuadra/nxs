<?php
require("db_connection.php");
session_start();

// mark_notification_read.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $notificationId = $_POST['id'];
    
    // Mark the notification as read in the database
    $query = "UPDATE notifications SET is_read = '1' WHERE id = $notificationId";
    mysqli_query($conn, $query);
    
    echo json_encode(['success' => true]);
}

?>