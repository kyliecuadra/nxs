<?php
require("../config/db_connection.php");
session_start();

extract($_POST);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the posted data
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $role = $_POST['role'];
    $status = $_POST['status'];
    $password = "NXS123";

    // SQL query to insert the data into the 'receptionists' table
    $sql = "INSERT INTO users (username, name, email, contact_number, password, role, status)
            VALUES ('$username', '$name', '$email', '$contact', '$password', '$role', '$status')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // Success response
        echo 'success';
    } else {
        // Error response
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);
}
?>
