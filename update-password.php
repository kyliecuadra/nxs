<?php
require("config/db_connection.php");
session_start();

$response = ['success' => false, 'message' => 'An error occurred.']; // Default response

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data
    $id = $_SESSION['id'];
    $role = $_SESSION['role']; // Ensure role is stored in session
    $currentPassword = $_SESSION['password']; // Current password stored in session
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Validate input
    if ($password !== $cpassword) {
        $response['message'] = 'Passwords do not match!';
    } elseif ($password === $currentPassword) {
        $response['message'] = 'This password is default! Use another password.';
    } else {
        // Update password in the database
        $query = "UPDATE users SET password = ? WHERE user_id = ?";
        $stmt = $conn->prepare($query);

        // Bind parameters
        $stmt->bind_param('si', $password, $id);

        if ($stmt->execute()) {
            // Update session and return success
            $_SESSION['password'] = $password; // Update session password
            $response = [
                'success' => true,
                'role' => $role
            ];
        } else {
            $response['message'] = 'Failed to update password. Please try again.';
        }

        $stmt->close();
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
