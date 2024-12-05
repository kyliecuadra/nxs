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
    <title>Client Records</title>
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
    <link rel="stylesheet" type="text/css" href="../assets/js/buttons.dataTables.min.css">
    <!-- DataTables Buttons JS (for Excel, PDF, etc.) -->
    <script type="text/javascript" charset="utf8" src="../assets/js/dataTables.buttons.min.js"></script>

    <!-- JSZip (required for Excel export) -->
    <script type="text/javascript" charset="utf8" src="../assets/js/jszip.min.js"></script>

    <!-- Excel export (from DataTables Buttons) -->
    <script type="text/javascript" charset="utf8" src="../assets/js/buttons.html5.min.js"></script>

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
                    <li class="menu-item">
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
                    <li class="menu-item active open">
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
                        <!-- TODAY'S ACTIVITY TABLE -->
                        <div class="card px-4 py-4">
                            <div class="d-flex justify-content-between mb-4">
                                <h4 for="">Client Records</h4>
                                <a href="add-client.php" class="btn w-auto" target="_blank">
                                    Add Client
                                </a>
                            </div>
                            <table id="clientTable" class="mr-2 table table-hover table-bordered table-responsive display">
                                <thead>
                                    <tr>
                                        <th><strong>Client ID</strong></th>
                                        <th><strong>Username</strong></th>
                                        <th><strong>Name</strong></th>
                                        <th><strong>Email</strong></th>
                                        <th><strong>Contact Number</strong></th>
                                        <th><strong>Remaining Points</strong></th>
                                        <th><strong>Action</strong></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- / Layout page -->
                </div>
                <!-- Overlay -->
                <div class="layout-overlay layout-menu-toggle"></div>
                <!-- Drag Target Area To SlideIn Menu On Small Screens -->
                <div class="drag-target"></div>
            </div>

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
                                            <input type="text" class="form-control" id="clientName" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="contactNumber" class="form-label">Contact Number <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="clientContactNumber" placeholder="Enter Contact Number" pattern="^09\d{9}$" title="Contact number must start with 09 and be 11 digits long." required>
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
                            <button type="submit" class="btn btn-primary" id="saveClientInfo">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- VIEW CLIENT MODAL END -->

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
                    setInterval(function() {
                        $('#clientTable').DataTable().ajax.reload(null, false); // 'null, false' to prevent table state reset
                    }, 1000); // 1000 ms = 1 second
                    // Initialize the DataTable
                    var table = $('#clientTable').DataTable({
                        "ajax": {
                            "url": "fetch_clients.php", // Fetch client data from the PHP file
                            "type": "GET",
                            "dataSrc": function(json) {
                                return json; // Return the data for DataTables
                            }
                        },
                        "columns": [{
                                "data": "client_id"
                            },
                            {
                                "data": "username"
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
                                "data": "remaining_points"
                            },
                            {
                                "data": null,
                                "defaultContent": '<button class="btn btn-info view-btn">View</button>'
                            }
                        ],
                        paging: true,
                        searching: true,
                        ordering: true,
                        responsive: true
                    });

                    // Event handler for "View" button
                    $('#clientTable').on('click', '.view-btn', function() {
                        var rowData = table.row($(this).parents('tr')).data(); // Get row data

                        // Populate modal with client data
                        $('#clientId').val(rowData.client_id);
                        $('#username').val(rowData.username);
                        $('#clientName').val(rowData.name);
                        $('#email').val(rowData.email);
                        $('#clientContactNumber').val(rowData.contact_number);
                        $('#remainingPoints').val(rowData.remaining_points);
                        $('#qrCodeImage').attr('src', rowData.qr_code_path); // Assuming qr_code_path is the path to the QR code image

                        // Show the modal
                        $('#clientInfoModal').modal('show');
                    });
                });

                // When the "Download QR Code" button is clicked
                $('#downloadQRBtn').click(function() {
                    // Get the client ID (Account Number) from the input field
                    var clientId = $('#clientId').val(); // The clientId input field holds the account number

                    // Get the image source URL
                    var qrCodeImageSrc = $('#qrCodeImage').attr('src');

                    // Create a temporary anchor tag to simulate a download
                    var downloadLink = document.createElement('a');
                    downloadLink.href = qrCodeImageSrc;
                    downloadLink.download = clientId + '.png'; // Set the filename to be the client ID with a .png extension

                    // Trigger the download by clicking the anchor tag programmatically
                    downloadLink.click();
                });

                $('#saveClientInfo').on('click', function(e) {
                    e.preventDefault(); // Prevent form submission

                    var clientId = $('#clientId').val();
                    var name = $('#clientName').val();
                    var contactNumber = $('#clientContactNumber').val().trim(); // Ensure no extra spaces

                    // Validation for Name and Contact Number
                    if (name === "") {
                        toastr.warning("Name is required.");
                        return;
                    }
                    var phonePattern = /^09\d{9}$/;
                    if (!phonePattern.test(contactNumber)) {
                        toastr.warning("Contact number must start with 09 and be 11 digits long.");
                        return;
                    }
                    // Send data to PHP script for updating
                    $.ajax({
                        url: 'update_client.php', // The PHP file that will handle the update
                        type: 'POST',
                        data: {
                            client_id: clientId,
                            name: name,
                            contact_number: contactNumber
                        },
                        dataType: 'json', // Ensure response is expected as JSON
                        success: function(response) {
                            if (response.success) {
                                toastr.success('Client information updated successfully!');
                                $('#clientInfoModal').modal('hide');
                                $('#clientTable').DataTable().ajax.reload(); // Reload the DataTable to reflect changes
                            } else {
                                toastr.error('Error updating client information: ' + (response.message || 'Unknown error.'));
                            }
                        },
                        error: function() {
                            toastr.error('An error occurred while updating the client.');
                        }
                    });

                });
            </script>
</body>

</html>
<!-- beautify ignore:end -->