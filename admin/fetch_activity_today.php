<?php
// Database connection 
require("../config/db_connection.php");

// Get today's date in PHT timezone
date_default_timezone_set('Asia/Manila');
$today = date('Y-m-d');

// Query to fetch the data from the client_activities, clients, and users tables for today only
$sql = "
    SELECT 
        ca.client_id,
        c.username,
        c.name AS client_name,
        c.email AS client_email,
        c.contact_number AS client_contact_number,
        ca.service,
        ca.points_change AS points_acquired,
        u.name AS receptionist_name,
        DATE_FORMAT(ca.activity_datetime, '%h:%i %p') AS time
    FROM 
        client_activities ca
    JOIN 
        clients c ON ca.client_id = c.client_id
    JOIN 
        users u ON ca.receptionist_id = u.user_id
    WHERE 
        DATE(ca.activity_datetime) = '$today'
";

// Execute the query
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Fetch the results and prepare the data
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            "client_id" => $row['client_id'],
            "username" => $row['username'],
            "name" => $row['client_name'],
            "email" => $row['client_email'],
            "contact_number" => $row['client_contact_number'],
            "service" => $row['service'],
            "points_acquired" => $row['points_acquired'],
            "receptionist" => $row['receptionist_name'],
            "time" => $row['time']  // This will contain the formatted time with AM/PM
        );
    }
    
    // Return the data as JSON
    echo json_encode($data);
} else {
    // If no results, return an empty array
    echo json_encode([]);
}

// Close the connection
$conn->close();
?>
