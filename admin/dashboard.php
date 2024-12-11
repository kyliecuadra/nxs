<?php
require("../config/db_connection.php");

session_start();
require("../config/session_timeout.php");

if (!isset($_SESSION['id'])) {
    header("location: ../config/not_login-error.html");
} else {
    if ($_SESSION['role'] != "admin") {
        header("location: ../config/user_level-error.html");
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr"
    data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Admin Dashboard</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/icon.png" />
    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <!-- Icons -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="../assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="../assets/vendor/fonts/flag-icons.css" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/typeahead-js/typeahead.css" />
    <!-- Include jQuery -->
    <script type="text/javascript" src="../assets/js/jquery.min.js"></script>

    <!-- Include DataTables CSS and JS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/datatable.min.css">
    <script src="../assets/js/datatable.min.js"></script>
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/buttons.dataTables.min.css">
    <!-- DataTables Buttons JS (for Excel, PDF, etc.) -->
    <script type="text/javascript" charset="utf8" src="../assets/js/dataTables.buttons.min.js"></script>

    <!-- JSZip (required for Excel export) -->
    <script type="text/javascript" charset="utf8" src="../assets/js/jszip.min.js"></script>

    <!-- Excel export (from DataTables Buttons) -->
    <script type="text/javascript" charset="utf8" src="../assets/js/buttons.html5.min.js"></script>
    <!-- Script for QR Code Scanner -->
    <script src="../assets/js/jsQR.min.js"></script>
    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
    <script src="assets/js/register.js"></script>
    <script src="../assets/js/toastr.min.js"></script>
    <link rel="stylesheet" href="../assets/css/toastr.css" />
    <script type="text/javascript" src="../config/toastr_config.js"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo ">
                    <a href="dashboard.php" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src="../assets/img/icon.png" alt="" width="50">
                        </span>
                        <span class="app-brand-text menu-text fw-bold ms-2" style="font-size: 14px;">NXS Spa</span>
                    </a>
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>
                <div class="menu-inner-shadow"></div>
                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item active open">
                        <a href="dashboard.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div class="text-truncate" data-i18n="Dashboard">Dashboard</div>
                        </a>
                    </li>
                    <!-- Receptionists -->
                    <li class="menu-item">
                        <a href="receptionist.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div class="text-truncate" data-i18n="Receptionists">Receptionists</div>
                        </a>
                    </li>
                    <!-- Client Records -->
                    <li class="menu-item">
                        <a href="client-records.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-clipboard"></i>
                            <div class="text-truncate" data-i18n="Client Records">Client Records</div>
                        </a>
                    </li>
                    <!-- Client Activity Summary -->
                    <li class="menu-item">
                        <a href="client-activity.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-food-menu"></i>
                            <div class="text-truncate" data-i18n="Client Activities">Client Activities</div>
                        </a>
                    </li>
                    <!-- Points Configuration -->
                    <li class="menu-item">
                        <a href="points-configuration.php" class="menu-link">
                            <i class="menu-icon tf-icons fa-solid fa-list-ol"></i>
                            <div class="text-truncate" data-i18n="Points Configuration">Points Configuration</div>
                        </a>
                    </li>
                    <!-- Logout -->
                    <li class="menu-item">
                        <a href="../config/logout.php?logout=true" class="menu-link">
                            <i class='menu-icon tf-icons bx bx-log-out'></i>
                            <div class="text-truncate" data-i18n="Logout">Logout</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>
                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="../assets/img/profiles/default.png" alt
                                            class="w-px-40 h-auto rounded-circle">
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="../assets/img/profiles/default.png"
                                                            alt class="w-px-40 h-auto rounded-circle">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span
                                                        class="fw-medium d-block"><?php echo $_SESSION['username']; ?></span>
                                                    <small class="text-muted">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                            </li>
                        </ul>
                        </li>
                        </ul>
                    </div>
                </nav>
                <!-- / Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-lg-6 mb-4 order-0">
                                <!-- Card for Scan QR -->
                                <a href="documents/campus.php" class="card card-hover text-decoration-none" data-bs-toggle="modal" data-bs-target="#qrScannerModal">
                                    <div class="d-flex align-items-end row" style="height: 152px;">
                                        <div class="card-body" style="padding: 15px;">
                                            <div class="row d-flex px-4">
                                                <div class="col d-flex flex-column justify-content-center align-items-center">
                                                    <i class="bx bx-qr-scan" style="font-size: 75px;"></i> <!-- Icon for qr -->
                                                    <span class="label h2">Scan QR Code</span> <!-- Label for the card -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-6 mb-4 order-0">
                                <!-- Card for CAN -->
                                <a href="javascript:void(0);" class="card card-hover text-decoration-none" data-bs-toggle="modal" data-bs-target="#clientIdModal">
                                    <div class="d-flex align-items-end row" style="height: 152px;">
                                        <div class="card-body" style="padding: 15px;">
                                            <div class="row d-flex px-4">
                                                <div class="col d-flex flex-column justify-content-center align-items-center">
                                                    <i class="bx bx-hash" style="font-size: 75px;"></i> <!-- Icon for hash -->
                                                    <span class="label h2">Client ID</span> <!-- Label for the card -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- TODAY'S ACTIVITY TABLE -->
                        <div class="card px-4 py-4">
                            <h4 for="">Today's Activity</h4>
                            <table id="activityTable" class="mr-2 table table-hover table-bordered table-responsive display">
                                <thead>
                                    <tr>
                                        <th><strong>Client ID</strong></th>
                                        <th><strong>Name</strong></th>
                                        <th><strong>Email</strong></th>
                                        <th><strong>Contact Number</strong></th>
                                        <th width='10%'><strong>Service</strong></th>
                                        <th><strong>Points Acquired</strong></th>
                                        <th><strong>Attending Receptionist</strong></th>
                                        <th width='10%'><strong>Time</strong></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- QR SCANNER MODAL START -->
                    <!-- Modal Structure -->
                    <div class="modal fade" id="qrScannerModal" tabindex="-1" aria-labelledby="qrScannerModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="qrScannerModalLabel">Scan QR</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- QR Code Scanner -->
                                    <video id="preview" width="100%" height="auto" style="border: 1px solid black;"></video>
                                    <!-- Input for Client ID (Fallback) -->
                                    <input type="hidden" id="clientQRId" class="form-control mb-3" placeholder="Enter Client ID" autofocus />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- QR SCANNER MODAL END -->


                    <!-- CLIENT ID MODAL START -->
                    <!-- Modal Structure -->
                    <div class="modal fade" id="clientIdModal" tabindex="-1" aria-labelledby="clientModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="clientModalLabel">Enter Client ID</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Input for Client ID -->
                                    <input type="text" id="clientIdInput" class="form-control mb-3" placeholder="Enter Client ID" autofocus />
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="submitClientId()">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- CLIENT ID MODAL END -->


                    <!-- VIEW CLIENT MODAL START -->
                    <div class="modal fade" id="clientInfoModal" tabindex="-1" aria-labelledby="clientInfoModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="clientInfoModalLabel">Client Information</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <!-- Left side: Client Information Form -->
                                        <div class="col-md-6">
                                            <form>
                                                <div class="mb-3">
                                                    <label for="clientId" class="form-label">Account Number</label>
                                                    <input type="text" class="form-control" id="clientId" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Username</label>
                                                    <input type="text" class="form-control" id="username" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="name" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="contactNumber" class="form-label">Contact Number <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="contactNumber" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="remainingPoints" class="form-label">Remaining Points</label>
                                                    <input type="text" class="form-control" id="remainingPoints" disabled>
                                                </div>
                                            </form>
                                        </div>

                                        <!-- Right side: QR Code -->
                                        <div class="col-md-6 text-center d-flex flex-column align-items-center justify-content-center">
                                            <img src="" alt="QR Code" id="qrCodeImage" class="img-fluid mb-3">
                                            <button type="button" class="btn btn-primary" id="downloadQRBtn">Download QR Code</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <!-- Add Points Button -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPointsModal">Add Points</button>

                                    <!-- Redeem Points Button -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#redeemPointsModal">Redeem Points</button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- VIEW CLIENT MODAL END -->

                    <!-- Add Points Modal -->
                    <div class="modal fade" id="addPointsModal" tabindex="-1" aria-labelledby="addPointsModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addPointsModalLabel">Add Points</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="addPointsForm">
                                        <div class="mb-3">
                                            <label for="serviceName" class="form-label">Service</label>
                                            <select class="form-select" id="serviceName" required>
                                                <!-- Options will be populated via JavaScript -->
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pointsToAdd" class="form-label">Points to Add</label>
                                            <input type="text" class="form-control" id="pointsToAdd" disabled> <!-- Read-only field -->
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="addPointsBtn">Add Points</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Redeem Points Modal -->
                    <div class="modal fade" id="redeemPointsModal" tabindex="-1" aria-labelledby="redeemPointsModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="redeemPointsModalLabel">Redeem Points</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="redeemPointsForm">
                                        <div class="mb-3">
                                            <label for="serviceName" class="form-label">Service</label>
                                            <select class="form-select" id="redeemServiceName" required>
                                                <!-- Options will be populated via JavaScript -->
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pointsToRedeem" class="form-label">Points to Redeem</label>
                                            <input type="text" class="form-control" id="pointsToRedeem" disabled> <!-- Read-only field -->
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="redeemPointsBtn">Redeem Points</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- / Layout page -->
                </div>
                <!-- Overlay -->
                <div class="layout-overlay layout-menu-toggle"></div>
                <!-- Drag Target Area To SlideIn Menu On Small Screens -->
                <div class="drag-target"></div>
            </div>
            <!-- / Layout wrapper -->
            <!-- Core JS -->
            <!-- build:js assets/vendor/js/core.js -->
            <script src="../assets/bootstrap/js/popper.min.js"></script>
            <script src="../assets/vendor/js/bootstrap.js"></script>
            <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
            <script src="../assets/vendor/libs/hammer/hammer.js"></script>
            <script src="../assets/vendor/libs/i18n/i18n.js"></script>
            <script src="../assets/vendor/libs/typeahead-js/typeahead.js"></script>
            <script src="../assets/vendor/js/menu.js"></script>

            <!-- endbuild -->
            <!-- Main JS -->
            <script src="../assets/js/main.js"></script>
            <!-- Page JS -->
            <script>
                $(document).ready(function() {
                    var today = new Date();

                    // Get the date components
                    var day = today.getDate().toString().padStart(2, '0'); // Ensure two-digit day
                    var month = (today.getMonth() + 1).toString().padStart(2, '0'); // Ensure two-digit month
                    var year = today.getFullYear();

                    // Format the date as "December 2, 2024" (for display)
                    var formattedDate = today.toLocaleString('default', {
                        month: 'long'
                    }) + ' ' + day + ', ' + year;

                    // Format date for filename as "12_02_2024" (with underscores)
                    var noDashesDate = month + '_' + day + '_' + year;
                    $('#activityTable').DataTable({
                        "ajax": {
                            "url": "fetch_activity_today.php", // Fetch client data from the PHP file
                            "type": "GET",
                            "dataSrc": function(json) {
                                return json; // Return the data for DataTables
                            }
                        },
                        "columns": [{
                                "data": "client_id"
                            },
                            {
                                "data": "name"
                            },
                            {
                                "data": "email"
                            },
                            {
                                "data": "contact_number"
                            },
                            {
                                "data": "service"
                            },
                            {
                                "data": "points_acquired"
                            },
                            {
                                "data": "receptionist"
                            },
                            {
                                "data": "time"
                            }
                        ],
                        dom: 'Bfrtip', // This enables the buttons toolbar
                        buttons: [{
                            extend: 'excelHtml5', // Excel export button
                            title: 'ACTIVITY AS OF ' + formattedDate.toUpperCase(), // Set the title for the Excel sheet
                            filename: function() {
                                // Generate filename using the formatted date with underscores
                                return "Activity_as_of_" + noDashesDate; // Returns the formatted filename
                            },
                            customize: function(xlsx) {
                                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                // Optionally, add any sheet customization here (e.g., style or header)
                            }
                        }],
                        paging: true, // Enable pagination
                        searching: true, // Enable search functionality
                        ordering: true, // Enable column ordering
                        responsive: true, // Make the table responsive
                        "order": [
                            [7, 'desc']
                        ],
                        "createdRow": function(row, data, dataIndex) {
                            if (parseFloat(data.points_acquired) < 0) {
                                // Apply style to each cell in the row
                                $(row).find('td').each(function() {
                                    $(this).css('color', 'red'); // Add red font color
                                });
                            }
                        }
                    });


                    // Show the Add Points modal
                    $('#addPointsModal').on('show.bs.modal', function() {
                        let clientId = $('#clientId').val();

                        // Fetch services for adding points
                        $.ajax({
                            url: 'fetchServices.php', // PHP script to fetch services for adding points
                            type: 'POST',
                            data: {
                                clientId: clientId,
                                action: 'add'
                            }, // action 'add' to get services for adding points
                            success: function(response) {
                                let data = JSON.parse(response);

                                if (data.success) {
                                    let serviceSelect = $('#serviceName');
                                    serviceSelect.empty();
                                    serviceSelect.append('<option value="" disabled selected>Select a service</option>');

                                    data.services.forEach(function(service) {
                                        serviceSelect.append('<option value="' + service.service_name + '" data-acquired="' + service.points_acquired + '">' + service.service_name + '</option>');
                                    });
                                } else {
                                    toastr.error('Failed to fetch services for adding points');
                                }
                            },
                            error: function() {
                                toastr.error('Error fetching services for adding points');
                            }
                        });
                    });

                    // Show the Redeem Points modal
                    $('#redeemPointsModal').on('show.bs.modal', function() {
                        let clientId = $('#clientId').val();

                        // Fetch services for redeeming points
                        $.ajax({
                            url: 'fetchServices.php', // PHP script to fetch services for redeeming points
                            type: 'POST',
                            data: {
                                clientId: clientId,
                                action: 'redeem'
                            }, // action 'redeem' to get services for redeeming points
                            success: function(response) {
                                let data = JSON.parse(response);

                                if (data.success) {
                                    let serviceSelect = $('#redeemServiceName');
                                    serviceSelect.empty();
                                    serviceSelect.append('<option value="" disabled selected>Select a service</option>');

                                    data.services.forEach(function(service) {
                                        serviceSelect.append('<option value="' + service.service_name + '" data-redeemed="' + service.points_redeemed + '">' + service.service_name + '</option>');
                                    });
                                } else {
                                    toastr.error('Failed to fetch services for redeeming points');
                                }
                            },
                            error: function() {
                                toastr.error('Error fetching services for redeeming points');
                            }
                        });
                    });

                    // Update the points display when a service is selected (Add Points)
                    $('#serviceName').on('change', function() {
                        const points = $(this).find(':selected').data('acquired');
                        $('#pointsToAdd').val(points); // Display points for adding
                    });

                    // Update the points display when a service is selected (Redeem Points)
                    $('#redeemServiceName').on('change', function() {
                        const points = $(this).find(':selected').data('redeemed');
                        $('#pointsToRedeem').val(points); // Display points for redeeming
                    });

                    // Confirm Add Points
                    $('#addPointsBtn').on('click', function() {
                        let serviceId = $('#serviceName').val();
                        let points = parseInt($('#pointsToAdd').val());
                        let clientId = $('#clientId').val(); // Assuming you have the clientId stored in a hidden field

                        if (!serviceId || isNaN(points) || points <= 0) {
                            toastr.error('Please select a service and enter valid points.');
                            return;
                        }

                        // Add points
                        let updatedPoints = points; // Since we directly take points for adding
                        $('#remainingPoints').val(updatedPoints); // Update UI

                        // Optionally, send the updated points to the backend
                        $.ajax({
                            url: 'updatePoints.php',
                            type: 'POST',
                            data: {
                                serviceId: serviceId,
                                clientId: clientId,
                                remainingPoints: updatedPoints,
                                action: 'add' // Indicate that points are being added
                            },
                            success: function(response) {
                                toastr.success('Points added successfully');
                                // Optionally handle response
                                $('#activityTable').DataTable().ajax.reload();
                            },
                            error: function() {
                                toastr.error('Failed to add points.');
                            }
                        });

                        $('#addPointsModal').modal('hide');
                    });

                    // Confirm Redeem Points
                    $('#redeemPointsBtn').on('click', function() {
                        let serviceId = $('#redeemServiceName').val();
                        let points = parseInt($('#pointsToRedeem').val());
                        let clientId = $('#clientId').val(); // Assuming you have the clientId stored in a hidden field
                        let remainingPoints = parseInt($('#remainingPoints').val());

                        if (!serviceId || isNaN(points) || points <= 0) {
                            toastr.error('Please select a service and enter valid points.');
                            return;
                        }

                        if (points > remainingPoints) {
                            toastr.error('Insufficient points to redeem.');
                            return;
                        }

                        // Subtract points for redeeming
                        let updatedPoints = points;
                        $('#remainingPoints').val(updatedPoints); // Update UI

                        // Optionally, send the updated points to the backend
                        $.ajax({
                            url: 'updatePoints.php',
                            type: 'POST',
                            data: {
                                serviceId: serviceId,
                                clientId: clientId,
                                remainingPoints: updatedPoints,
                                action: 'redeem' // Indicate that points are being redeemed
                            },
                            success: function(response) {
                                toastr.success('Points redeemed successfully');
                                // Optionally handle response
                                $('#activityTable').DataTable().ajax.reload();
                            },
                            error: function() {
                                toastr.error('Failed to redeem points.');
                            }
                        });

                        $('#redeemPointsModal').modal('hide');
                    });
                });
                // jQuery is used for handling modal and AJAX requests
                function submitClientId() {
                    // Get the client ID entered by the user
                    var clientId = $('#clientIdInput').val() || $('#clientQRId').val();
                    if (clientId) {
                        // Call your backend API to fetch client data
                        $.ajax({
                            url: 'getClientInfo.php', // Replace with your actual endpoint
                            type: 'POST',
                            data: {
                                clientId: clientId
                            },
                            success: function(response) {
                                // Parse the JSON response (ensure it's valid JSON)
                                var data = JSON.parse(response);

                                if (data.success) {
                                    $('#clientIdInput').val('');
                                    // Populate the client information modal with data from the response
                                    $('#clientId').val(data.clientId);
                                    $('#username').val(data.username);
                                    $('#name').val(data.name);
                                    $('#email').val(data.email);
                                    $('#contactNumber').val(data.contactNumber);
                                    $('#remainingPoints').val(data.remainingPoints);

                                    // Display the QR code
                                    $('#qrCodeImage').attr('src', data.qrCodeUrl);

                                    // Hide the client ID modal and show the client info modal
                                    $('#clientIdModal').modal('hide'); // Close the first modal
                                    $('#qrScannerModal').modal('hide'); // Close the first modal
                                    $('#clientInfoModal').modal('show'); // Show the client info modal
                                }
                            },
                            error: function(xhr, status, error) {
                                // Log any errors that occur during the request
                                console.error('AJAX Error: ' + status + error);
                                alert('Error fetching client data.');
                            }
                        });
                    }
                }

                $('#downloadQRBtn').on('click', function() {
                    var qrCodeUrl = $('#qrCodeImage').attr('src');
                    var clientId = $('#clientId').val(); // Assuming client ID is stored in an input with id="clientId"

                    var a = document.createElement('a');
                    a.href = qrCodeUrl;
                    a.download = clientId + '.png'; // Set the filename to be the client ID with a '_qr_code' suffix
                    a.click();
                });

                // QR SCANNER
                // Get video element and output container
                const video = document.getElementById('preview');

                // Set up the camera stream
                async function startCamera() {
                    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                        try {
                            const stream = await navigator.mediaDevices.getUserMedia({
                                video: {
                                    facingMode: 'environment'
                                }
                            });
                            video.srcObject = stream;
                            video.play();
                            requestAnimationFrame(scanQRCode);
                        } catch (err) {
                            console.error('Error accessing camera:', err);
                            alert('Camera access is required for QR code scanning.');
                        }
                    } else {
                        console.error('getUserMedia not supported on this browser.');
                        alert('Your browser does not support camera access. Please use a modern browser.');
                    }
                }


                // Function to scan QR codes
                function scanQRCode() {
                    if (video.readyState === video.HAVE_ENOUGH_DATA) {
                        const canvas = document.createElement('canvas');
                        const context = canvas.getContext('2d');

                        // Set canvas dimensions to match the video feed
                        canvas.height = video.videoHeight;
                        canvas.width = video.videoWidth;

                        // Draw the current video frame onto the canvas
                        context.drawImage(video, 0, 0, canvas.width, canvas.height);

                        // Extract ImageData from the canvas
                        const imageData = context.getImageData(0, 0, canvas.width, canvas.height);

                        // Pass the ImageData to jsQR
                        const code = jsQR(imageData.data, imageData.width, imageData.height);

                        if (code) {
                            // Display the decoded QR code data in the input field
                            $('#clientQRId').val(code.data);

                            // Optionally send the data to decrypt.php using AJAX
                            sendToDecryptPHP(code.data);
                        }
                    }
                    // Keep scanning
                    requestAnimationFrame(scanQRCode);
                }


                // Start the camera when the modal is opened
                $('#qrScannerModal').on('shown.bs.modal', startCamera);

                // Optionally, stop the camera when the modal is closed
                $('#qrScannerModal').on('hidden.bs.modal', () => {
                    const stream = video.srcObject;
                    if (stream) {
                        const tracks = stream.getTracks();
                        tracks.forEach(track => track.stop());
                        video.srcObject = null;
                    }
                });

                // Function to send data to decrypt.php using AJAX
                function sendToDecryptPHP(qrData) {
                    $.ajax({
                        url: 'decrypt.php', // The PHP file where you want to send the data
                        method: 'POST', // Using POST method to send data
                        data: {
                            encryptedData: qrData // Send the QR code data as 'client_id'
                        },
                        success: function(response) {
                            console.log('Response from server:', response);
                            $('#clientQRId').val(response);
                            submitClientId();
                        },
                        error: function(xhr, status, error) {
                            console.error('Error sending data:', error);
                        }
                    });
                }
            </script>
</body>

</html>
<!-- beautify ignore:end -->