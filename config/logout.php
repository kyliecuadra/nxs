<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    // Redirect to the login page if not logged in
    echo $_SESSION['id'];
    header("Location: ../index.php");
    exit();
}

// Logout logic
if (isset($_GET['logout'])) {
    echo "logout";
    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header("Location: ../index.php");
    exit();
}
?>