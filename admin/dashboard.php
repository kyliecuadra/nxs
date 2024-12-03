<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr"
    data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Receptionist Dashboard</title>
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
                    <a href="dashboard.html" class="app-brand-link">
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
                    <!-- Logout -->
                    <li class="menu-item">
                        <a href="../logout.php?logout=true" class="menu-link">
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
                                                        class="fw-medium d-block">First Name</span>
                                                    <small class="text-muted">Receptionist</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" style="cursor: pointer;">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">My Profile</span>
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
                                    <tr>
                                        <td>NXS-2025-000001</td>
                                        <td>John Doe</td>
                                        <td>johndoe@example.com</td>
                                        <td>09123456789</td>
                                        <td>Spa Services</td>
                                        <td>250</td>
                                        <td>Maria</td>
                                        <td>3:00 PM</td>
                                    </tr>
                                    <tr>
                                        <td>NXS-2025-000002</td>
                                        <td>Jane Smith</td>
                                        <td>janesmith@example.com</td>
                                        <td>09123456780</td>
                                        <td>Spa Services</td>
                                        <td>150</td>
                                        <td>Anna</td>
                                        <td>3:00 PM</td>
                                    </tr>
                                    <tr>
                                        <td>NXS-2025-000003</td>
                                        <td>Michael Johnson</td>
                                        <td>mjohnson@example.com</td>
                                        <td>09123456781</td>
                                        <td>Spa Services</td>
                                        <td>300</td>
                                        <td>John</td>
                                        <td>3:00 PM</td>
                                    </tr>
                                    <tr>
                                        <td>NXS-2025-000004</td>
                                        <td>Emily White</td>
                                        <td>emily.white@example.com</td>
                                        <td>09123456782</td>
                                        <td>Spa Services</td>
                                        <td>200</td>
                                        <td>Maria</td>
                                        <td>3:00 PM</td>
                                    </tr>
                                    <tr>
                                        <td>NXS-2025-000005</td>
                                        <td>David Brown</td>
                                        <td>david.brown@example.com</td>
                                        <td>09123456783</td>
                                        <td>Spa Services</td>
                                        <td>100</td>
                                        <td>Anna</td>
                                        <td>3:00 PM</td>
                                    </tr>
                                    <tr>
                                        <td>NXS-2025-000006</td>
                                        <td>Sarah Lee</td>
                                        <td>sarah.lee@example.com</td>
                                        <td>09123456784</td>
                                        <td>Spa Services</td>
                                        <td>50</td>
                                        <td>John</td>
                                        <td>3:00 PM</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

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
                                    <input type="text" id="clientIdInput" class="form-control mb-3" placeholder="Enter Client ID" />
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="submitClientId">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CLIENT ID MODAL END -->


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
                        dom: 'Bfrtip',
                        buttons: [{
                            extend: 'excelHtml5',
                            title: 'ACTIVITY AS OF ' + formattedDate.toUpperCase(),
                            filename: function() {
                                // Generate filename using the formatted date with underscores
                                return "Activity_as_of_" + noDashesDate; // Returns the formatted filename with underscores
                            },
                            customize: function(xlsx) {
                                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                // Optionally, add any sheet customization here
                            }
                        }],
                        paging: true,
                        searching: true,
                        ordering: true,
                        responsive: true
                    });
                });
            </script>
</body>

</html>
<!-- beautify ignore:end -->