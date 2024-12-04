<?php
require("../config/db_connection.php");
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $serviceName = $_POST['serviceId'];
    $clientId = $_POST['clientId'];
    $remainingPoints = $_POST['remainingPoints'];
    $action = $_POST['action']; // 'add' or 'redeem'

    // Validate input
    if (empty($clientId) || !is_numeric($remainingPoints)) {
        echo json_encode(['success' => false, 'message' => 'Invalid input.']);
        exit;
    }

    // Fetch the current remaining points for the client from the database
    $sql = "SELECT remaining_points, name, email, contact_number FROM clients WHERE client_id = '$clientId'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $client = mysqli_fetch_assoc($result);
        $currentPoints = $client['remaining_points'];
        $clientName = $client['name'];
        $clientEmail = $client['email'];
        $clientContact = $client['contact_number'];

        if ($action == 'add') {
            // Add points to the client's current remaining points
            $newPoints = $currentPoints + $remainingPoints;
            $pointsChange = $remainingPoints;  // Positive points added
        } elseif ($action == 'redeem') {
            // Check if the client has enough points to redeem
            if ($currentPoints < $remainingPoints) {
                echo json_encode(['success' => false, 'message' => 'Insufficient points to redeem.']);
                exit;
            }
            // Subtract points from the client's current remaining points
            $newPoints = $currentPoints - $remainingPoints;
            $pointsChange = -$remainingPoints;  // Negative points redeemed
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid action.']);
            exit;
        }

        // Update the points in the database
        $updateSql = "UPDATE clients SET remaining_points = '$newPoints' WHERE client_id = '$clientId'";
        if (mysqli_query($conn, $updateSql)) {
            // Insert record into client_activities table
            $receptionistId = 1;  // You should dynamically fetch the receptionist_id
            date_default_timezone_set('Asia/Manila');
            $activityDatetime = date('Y-m-d H:i:s');

            $activitySql = "INSERT INTO client_activities (client_id, name, email, contact_number, service, points_change, receptionist_id, activity_datetime)
                VALUES ('$clientId', '$clientName', '$clientEmail', '$clientContact', '$serviceName', '$pointsChange', '" . $_SESSION['id'] . "', '$activityDatetime')";

            if (mysqli_query($conn, $activitySql)) {
                echo json_encode(['success' => true, 'remainingPoints' => $newPoints]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to log activity.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update points.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Client not found.']);
    }

    mysqli_close($conn);
}
?>
