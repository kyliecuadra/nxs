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
    <title>Points Configuration</title>
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.0/css/buttons.dataTables.min.css">
    <!-- DataTables Buttons JS (for Excel, PDF, etc.) -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.0/js/dataTables.buttons.min.js"></script>

    <!-- JSZip (required for Excel export) -->
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <!-- Excel export (from DataTables Buttons) -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.0/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
    <script src="assets/js/register.js"></script>
    <script src="../assets/js/toastr.min.js"></script>
    <link rel="stylesheet" href="../assets/css/toastr.css" />
    <script type="text/javascript" src="../config/toastr_config.js"></script>
</head>
<style>
    .nav-tabs {
    border-bottom: 1px solid #dee2e6;
}
    .nav-tabs .nav-link.active {
    border-color: #dee2e6 #dee2e6 #fff !important;
    }
</style>
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
                    <li class="menu-item active open">
                        <a href="#" class="menu-link">
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
                                                        class="fw-medium d-block"><?php echo $_SESSION['username'];?></span>
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
                            <div class="container">
                                <!-- Tabs Navigation -->
                                <ul class="nav nav-tabs" id="pointsTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="add-tab" data-bs-toggle="tab" href="#add" role="tab" aria-controls="add" aria-selected="true">Add Points</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="redeem-tab" data-bs-toggle="tab" href="#redeem" role="tab" aria-controls="redeem" aria-selected="false">Redeem Points</a>
                                    </li>
                                </ul>
                                <!-- Tab Content -->
                                <div class="tab-content mt-3" id="pointsTabContent">
                                    <!-- Add Points Tab -->
                                    <div class="tab-pane fade show active" id="add" role="tabpanel" aria-labelledby="add-tab">
                                        <h3>Add Points Configuration</h3>
                                        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addServiceModal">Add Service</button>
                                        <table class="table table-bordered" id="addPointsTable">
                                            <thead>
                                                <tr>
                                                    <th>Service Name</th>
                                                    <th>Equivalent Points</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Redeem Points Tab -->
                                    <div class="tab-pane fade" id="redeem" role="tabpanel" aria-labelledby="redeem-tab">
                                        <h3>Redeem Points Configuration</h3>
                                        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#redeemServiceModal">Add Service</button>
                                        <table class="table table-bordered w-100" id="redeemPointsTable">
                                            <thead>
                                                <tr>
                                                    <th>Service Name</th>
                                                    <th>Equivalent Points</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
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

            <!-- Modal for Adding Service (Add Points) -->
            <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addServiceModalLabel">Add Service</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addServiceForm">
                                <div class="mb-3">
                                    <label for="addServiceName" class="form-label">Service Name</label>
                                    <input type="text" class="form-control" id="addServiceName" placeholder="Enter Service Name">
                                </div>
                                <div class="mb-3">
                                    <label for="addEquivalentPoints" class="form-label">Equivalent Points</label>
                                    <input type="number" class="form-control" id="addEquivalentPoints" placeholder="Enter Points">
                                </div>
                                <button type="submit" class="btn btn-primary">Add Service</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for Adding Service (Redeem Points) -->
            <div class="modal fade" id="redeemServiceModal" tabindex="-1" aria-labelledby="redeemServiceModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="redeemServiceModalLabel">Add Service</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="redeemServiceForm">
                                <div class="mb-3">
                                    <label for="redeemServiceName" class="form-label">Service Name</label>
                                    <input type="text" class="form-control" id="redeemServiceName" placeholder="Enter Service Name">
                                </div>
                                <div class="mb-3">
                                    <label for="redeemEquivalentPoints" class="form-label">Equivalent Points</label>
                                    <input type="number" class="form-control" id="redeemEquivalentPoints" placeholder="Enter Points">
                                </div>
                                <button type="submit" class="btn btn-primary">Add Service</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Service Modal -->
            <div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editServiceModalLabel">Edit Service</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editServiceForm">
                                <input type="hidden" id="editConfigId">
                                <div class="mb-3">
                                    <label for="editServiceName" class="form-label">Service Name</label>
                                    <input type="text" class="form-control" id="editServiceName" placeholder="Enter Service Name">
                                </div>
                                <div class="mb-3">
                                    <label for="editPoints" class="form-label">Equivalent Points</label>
                                    <input type="number" class="form-control" id="editPoints" placeholder="Enter Points">
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Delete Service Modal -->
            <div class="modal fade" id="deleteServiceModal" tabindex="-1" aria-labelledby="deleteServiceModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteServiceModalLabel">Delete Service</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this service?</p>
                            <input type="hidden" id="deleteConfigId">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" id="confirmDelete" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </div>
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
                    // INITIALIZING TABLES
                    const addPointsTable = $('#addPointsTable').DataTable({
                        ajax: 'fetch_add_points.php', // PHP script for fetching data
                        columns: [{
                                data: 'service_name'
                            },
                            {
                                data: 'points_acquired'
                            },
                            {
                                data: null,
                                render: function(data) {
                                    return `
                            <button class="btn btn-warning edit-btn" data-id="${data.config_id}">Edit</button>
                            <button class="btn btn-danger delete-btn" data-id="${data.config_id}">Delete</button>
                        `;
                                }
                            }
                        ],
                        paging: true,
                        searching: true,
                        ordering: true,
                        responsive: true
                    });

                    // Initialize DataTable for Redeem Points Configuration
                    const redeemPointsTable = $('#redeemPointsTable').DataTable({
                        ajax: 'fetch_redeem_points.php', // PHP script for fetching data
                        columns: [{
                                data: 'service_name'
                            },
                            {
                                data: 'points_redeemed'
                            },
                            {
                                data: null,
                                render: function(data) {
                                    return `
                            <button class="btn btn-warning edit-btn" data-id="${data.config_id}">Edit</button>
                            <button class="btn btn-danger delete-btn" data-id="${data.config_id}">Delete</button>
                        `;
                                }
                            }
                        ],
                        paging: true,
                        searching: true,
                        ordering: true,
                        responsive: true
                    });

                    // ADD POINTS START
                    // Handle form submission
                    $('#addServiceForm').submit(function(event) {
                        event.preventDefault(); // Prevent default form submission

                        // Get form data
                        const serviceName = $('#addServiceName').val().trim();
                        const equivalentPoints = $('#addEquivalentPoints').val().trim();

                        // Validate inputs
                        if (serviceName === '' || equivalentPoints === '' || equivalentPoints <= 0) {
                            toastr.error('Please enter a valid service name and points.');
                            return;
                        }

                        // Send AJAX request to PHP script
                        $.ajax({
                            url: 'add_service.php', // Path to your PHP script
                            type: 'POST',
                            data: {
                                service_name: serviceName,
                                points_acquired: equivalentPoints
                            },
                            success: function(response) {
                                // Handle success
                                const result = JSON.parse(response);
                                if (result.success) {
                                    toastr.success('Service added successfully!');
                                    $('#addServiceForm')[0].reset(); // Clear form
                                    $('#addServiceModal').modal('hide'); // Hide modal
                                    $('#addPointsTable').DataTable().ajax.reload();
                                } else {
                                    toastr.error('Error: ' + result.message);
                                }
                            },
                            error: function() {
                                // Handle error
                                toastr.error('An error occurred while adding the service.');
                            }
                        });
                    });
                    // ADD POINTS END

                    // REDEMPTION POINTS START
                    // Handle form submission
                    $('#redeemServiceForm').submit(function(event) {
                        event.preventDefault(); // Prevent default form submission

                        // Get form data
                        const serviceName = $('#redeemServiceName').val().trim();
                        const equivalentPoints = $('#redeemEquivalentPoints').val().trim();

                        // Validate inputs
                        if (serviceName === '' || equivalentPoints === '' || equivalentPoints <= 0) {
                            toastr.error('Please enter a valid service name and points.');
                            return;
                        }

                        // Send AJAX request to PHP script
                        $.ajax({
                            url: 'add_redeem_service.php', // Path to your PHP script
                            type: 'POST',
                            data: {
                                service_name: serviceName,
                                points_redeemed: equivalentPoints
                            },
                            success: function(response) {
                                // Handle success
                                const result = JSON.parse(response);
                                if (result.success) {
                                    toastr.success('Service added successfully!');
                                    $('#redeemServiceForm')[0].reset(); // Clear form
                                    $('#redeemServiceModal').modal('hide'); // Hide modal
                                    $('#redeemPointsTable').DataTable().ajax.reload();
                                } else {
                                    toastr.error('Error: ' + result.message);
                                }
                            },
                            error: function() {
                                // Handle error
                                toastr.error('An error occurred while adding the service.');
                            }
                        });
                    });
                    // REDEMPTION POINTS END

                    // Edit Service
                    $('#addPointsTable, #redeemPointsTable').on('click', '.edit-btn', function() {
                        const configId = $(this).data('id');

                        // Fetch existing data
                        $.ajax({
                            url: 'get_service.php',
                            type: 'POST',
                            data: {
                                config_id: configId
                            },
                            success: function(response) {
                                const service = JSON.parse(response);

                                // Populate modal fields
                                $('#editConfigId').val(service.config_id);
                                $('#editServiceName').val(service.service_name);
                                $('#editPoints').val(service.points_acquired || service.points_redeemed);

                                // Show modal
                                $('#editServiceModal').modal('show');
                            },
                            error: function() {
                                alert('Failed to fetch service data.');
                            }
                        });
                    });

                    // Submit edit form
                    $('#editServiceForm').submit(function(event) {
                        event.preventDefault();

                        const configId = $('#editConfigId').val();
                        const serviceName = $('#editServiceName').val().trim();
                        const points = $('#editPoints').val().trim();

                        if (serviceName === '' || points <= 0) {
                            toastr.error('Please enter valid values.');
                            return;
                        }

                        $.ajax({
                            url: 'edit_service.php',
                            type: 'POST',
                            data: {
                                config_id: configId,
                                service_name: serviceName,
                                points: points
                            },
                            success: function(response) {
                                const result = JSON.parse(response);
                                if (result.success) {
                                    toastr.success('Service updated successfully!');
                                    $('#editServiceModal').modal('hide');
                                    $('#addPointsTable').DataTable().ajax.reload();
                                    $('#redeemPointsTable').DataTable().ajax.reload();
                                } else {
                                    toastr.error('Error: ' + result.message);
                                }
                            },
                            error: function() {
                                toastr.error('Failed to update service.');
                            }
                        });
                    });

                    // Delete Service
                    $('#addPointsTable, #redeemPointsTable').on('click', '.delete-btn', function() {
                        const configId = $(this).data('id');
                        $('#deleteConfigId').val(configId);
                        $('#deleteServiceModal').modal('show');
                    });

                    // Confirm delete
                    $('#confirmDelete').click(function() {
                        const configId = $('#deleteConfigId').val();

                        $.ajax({
                            url: 'delete_service.php',
                            type: 'POST',
                            data: {
                                config_id: configId
                            },
                            success: function(response) {
                                const result = JSON.parse(response);
                                if (result.success) {
                                    toastr.success('Service deleted successfully!');
                                    $('#deleteServiceModal').modal('hide');
                                    $('#addPointsTable').DataTable().ajax.reload();
                                    $('#redeemPointsTable').DataTable().ajax.reload();
                                } else {
                                    toastr.error('Error: ' + result.message);
                                }
                            },
                            error: function() {
                                toastr.error('Failed to delete service.');
                            }
                        });
                    });
                });
            </script>
</body>

</html>
<!-- beautify ignore:end -->