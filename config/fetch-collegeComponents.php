<?php
// Perform database connection
require("db_connection.php");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['action']) && $_GET['action'] === 'fetch_campus') {
    // Query to fetch campuses
    $query = "SELECT DISTINCT campus FROM university_structure WHERE campus != ''";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error fetching campuses: " . mysqli_error($conn));
    }

    // Fetch campuses as an associative array
    $campuses = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $campuses[] = $row['campus'];
    }

    // Send JSON response
    echo json_encode($campuses);
} elseif (isset($_GET['action']) && $_GET['action'] === 'fetch_colleges') {
    $campus = $_GET['campus'];
    // Query to fetch colleges based on selected campus
    $query = "SELECT DISTINCT colleges FROM university_structure WHERE colleges != '' AND campus = '$campus'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error fetching colleges: " . mysqli_error($conn));
    }

    // Fetch colleges as an associative array
    $colleges = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $colleges[] = $row['colleges'];
    }

    // Send JSON response
    echo json_encode($colleges);
} elseif (isset($_GET['action']) && $_GET['action'] === 'fetch_programs') {
    $campus = $_GET['campus'];
    $college = $_GET['college'];
    
    // Query to fetch programs based on selected campus and college
    $query = "SELECT DISTINCT programs FROM university_structure WHERE colleges = '$college' AND campus = '$campus' AND programs != ''";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error fetching programs: " . mysqli_error($conn));
    }

    // Fetch programs as an associative array
    $programs = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $programs[] = $row['programs'];
    }

    // Send JSON response
    echo json_encode($programs);
} else {
    // Invalid request
    echo json_encode(array('error' => 'Invalid request'));
}

// Close connection
mysqli_close($conn);
?>
