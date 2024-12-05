<?php
// Include SimpleXLSXGen library
require_once '../config/simplexlsxgen/src/SimpleXLSXGen.php';  // Adjust path if necessary

use Shuchkin\SimpleXLSXGen;

require("../config/db_connection.php");

if (isset($_GET['report_type'])) {
    $reportType = $_GET['report_type'];

    // Initialize query and filename
    $query = "";
    $filename = "";

    switch ($reportType) {
        case 'today':
            // For "By Today" report
            $today = $_GET['date'];  // The date passed from the jQuery
            $formattedToday = date("m-d-Y", strtotime($today)); // MM-DD-YYYY format
            $query = "SELECT * FROM client_activities WHERE DATE(activity_datetime) = '$today'";  // Use DATE() to match the day only
            $filename = "Client_Activities_" . $formattedToday . ".xlsx";  // Set filename as today's date
            break;

        case 'week':
            $startDate = $_GET['start_date'];
            $endDate = $_GET['end_date'];
            $formattedStartDate = date("m-d-Y", strtotime($startDate)); // MM-DD-YYYY format
            $formattedEndDate = date("m-d-Y", strtotime($endDate)); // MM-DD-YYYY format
            $query = "SELECT * FROM client_activities WHERE activity_datetime BETWEEN '$startDate' AND '$endDate'";
            $filename = "Client_Activities_" . $formattedStartDate . "-" . $formattedEndDate . ".xlsx";
            break;

        case 'month':
            $monthYear = $_GET['month_year'];
            $startDate = $monthYear . "-01";
            $endDate = date("Y-m-t", strtotime($startDate));
            $formattedMonthYear = date("m-Y", strtotime($monthYear)); // MM-YYYY format
            $query = "SELECT * FROM client_activities WHERE activity_datetime BETWEEN '$startDate' AND '$endDate'";
            $filename = "Client_Activities_" . $formattedMonthYear . ".xlsx";
            break;

        case 'date_range':
            $startDate = $_GET['start_date'];
            $endDate = $_GET['end_date'];
            $formattedStartDate = date("m-d-Y", strtotime($startDate)); // MM-DD-YYYY format
            $formattedEndDate = date("m-d-Y", strtotime($endDate)); // MM-DD-YYYY format
            $query = "SELECT * FROM client_activities WHERE activity_datetime BETWEEN '$startDate' AND '$endDate'";
            $filename = "Client_Activities_" . $formattedStartDate . "-" . $formattedEndDate . ".xlsx";
            break;

        case 'year':
            $year = $_GET['year'];
            $startDate = $year . "-01-01";
            $endDate = $year . "-12-31";
            $filename = "Client_Activities_" . $year . ".xlsx"; // Year-only format (YYYY)
            $query = "SELECT * FROM client_activities WHERE activity_datetime BETWEEN '$startDate' AND '$endDate'";
            break;

        default:
            echo json_encode(['error' => 'Invalid report type']);
            exit;
    }

    try {
        echo $query;
        // Execute the query and generate the Excel report
        $result = mysqli_query($conn, $query);

        // Check if the query execution was successful
        if (!$result) {
            throw new Exception("Error executing query: " . mysqli_error($conn));
        }

        // Initialize the rows for the Excel file
        $rows = [
            ['Client ID', 'Name', 'Email', 'Contact Number', 'Service', 'Points', 'Receptionist', 'Date & Time']
        ];

        // Check if any data is returned
        if (mysqli_num_rows($result) == 0) {
            // No data found, set a message instead of creating an empty file
            $rows = [
                ['No data found for the given report type.']
            ];
        } else {
            // Write data rows
            while ($row = mysqli_fetch_assoc($result)) {
                $formattedDate = date("F j, Y g:i A", strtotime($row['activity_datetime'])); // MM-DD-YYYY format
                $rows[] = [
                    $row['client_id'],
                    $row['name'],
                    $row['email'],
                    $row['contact_number'],
                    $row['service'],
                    $row['points'],
                    $row['receptionist'],
                    $formattedDate
                ];
            }
        }

        // Create the Excel file using SimpleXLSXGen
        $xlsx = SimpleXLSXGen::fromArray($rows);

        // Set headers to force file download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Output the file to the browser
        $xlsx->downloadAs($filename);

        // Stop further script execution
        exit;

    } catch (Exception $e) {
        // Catch any errors and return a JSON response with the error message
        echo json_encode(['error' => $e->getMessage()]);
        exit;
    }
} else {
    // If no report_type is set, return an error message
    echo json_encode(['error' => 'Report type is required']);
    exit;
}
?>
