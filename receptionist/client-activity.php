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
                    <li class="menu-item">
                        <a href="dashboard.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div class="text-truncate" data-i18n="Dashboard">Dashboard</div>
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
                    <li class="menu-item active open">
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
                            <div class="d-flex justify-content-between mb-2">
                                <h4 for="">Client Activity History</h4>
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="reportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        Generate Report
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="reportDropdown">
                                        <li><a class="dropdown-item" href="#" id="byToday">By Today</a></li>
                                        <li><a class="dropdown-item" href="#" id="byWeek" data-bs-toggle="modal" data-bs-target="#weekModal">By Week</a></li>
                                        <li><a class="dropdown-item" href="#" id="byMonth" data-bs-toggle="modal" data-bs-target="#monthModal">By Month</a></li>
                                        <li><a class="dropdown-item" href="#" id="byDate" data-bs-toggle="modal" data-bs-target="#yearModal">By Year</a></li>
                                        <li><a class="dropdown-item" href="#" id="byDate" data-bs-toggle="modal" data-bs-target="#dateModal">By Date</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="d-flex w-25 justify-content-between mb-2">
                                <div class="form-group">
                                    <label for="searchStartDate">Start Date:</label>
                                    <input type="date" id="searchStartDate" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="searchEndDate">End Date:</label>
                                    <input type="date" id="searchEndDate" class="form-control" placeholder="End Date (mm/dd/yyyy)">
                                </div>
                            </div>

                            <table id="clientTable" class="mr-2 table table-hover table-bordered table-responsive display">
                                <thead>
                                    <tr>
                                        <th><strong>Client ID</strong></th>
                                        <th><strong>Username</strong></th>
                                        <th><strong>Name</strong></th>
                                        <th><strong>Email</strong></th>
                                        <th><strong>Contact Number</strong></th>
                                        <th><strong>Service</strong></th>
                                        <th><strong>Acquired Points</strong></th>
                                        <th><strong>Attending Receptionist</strong></th>
                                        <th><strong>Date & Time</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>NXS-2025-000001</td>
                                        <td>johndoe</td>
                                        <td>John Doe</td>
                                        <td>johndoe@example.com</td>
                                        <td>09123456789</td>
                                        <td>Basic Massage</td>
                                        <td>150</td>
                                        <td>Sarah Lee</td>
                                        <td>December 3, 2024 3:00 PM</td>
                                    </tr>
                                    <tr>
                                        <td>NXS-2025-000002</td>
                                        <td>janesmith</td>
                                        <td>Jane Smith</td>
                                        <td>janesmith@example.com</td>
                                        <td>09198765432</td>
                                        <td>Basic Massage</td>
                                        <td>200</td>
                                        <td>Mark Johnson</td>
                                        <td>December 2, 2024 3:00 PM</td>
                                    </tr>
                                    <tr>
                                        <td>NXS-2025-000003</td>
                                        <td>michaelbrown</td>
                                        <td>Michael Brown</td>
                                        <td>michaelbrown@example.com</td>
                                        <td>09187654321</td>
                                        <td>Basic Massage</td>
                                        <td>180</td>
                                        <td>Emma Davis</td>
                                        <td>December 1, 2024 3:00 PM</td>
                                    </tr>
                                    <tr>
                                        <td>NXS-2025-000004</td>
                                        <td>emilywhite</td>
                                        <td>Emily White</td>
                                        <td>emilywhite@example.com</td>
                                        <td>09176543210</td>
                                        <td>Basic Massage</td>
                                        <td>120</td>
                                        <td>David Clark</td>
                                        <td>November 30, 2024 3:00 PM</td>
                                    </tr>
                                    <tr>
                                        <td>NXS-2025-000005</td>
                                        <td>chrisgreen</td>
                                        <td>Chris Green</td>
                                        <td>chrisgreen@example.com</td>
                                        <td>09165432109</td>
                                        <td>Basic Massage</td>
                                        <td>250</td>
                                        <td>Amy Miller</td>
                                        <td>November 29, 2024 3:00 PM</td>
                                    </tr>

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

            <!-- GENERATE REPORT MODAL START -->
            <div class="modal fade" id="weekModal" tabindex="-1" aria-labelledby="weekModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="weekModalLabel">Select Week</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label for="weekStartDate">Start Date:</label>
                            <input type="date" class="form-control" id="weekStartDate" placeholder="Start Date" required>
                            <label for="weekEndDate" class="mt-2">End Date (Automatically adjusted):</label>
                            <input type="date" class="form-control" id="weekEndDate" placeholder="End Date" disabled>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="generateWeekReport">Generate Report</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for By Month -->
            <div class="modal fade" id="monthModal" tabindex="-1" aria-labelledby="monthModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="monthModalLabel">Select Month</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label for="monthInput">Select Month and Year:</label>
                            <input type="month" class="form-control" id="monthInput" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="generateMonthReport">Generate Report</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for By Date -->
            <div class="modal fade" id="dateModal" tabindex="-1" aria-labelledby="dateModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="dateModalLabel">Select Date Range</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label for="dateStart">Start Date:</label>
                            <input type="date" class="form-control" id="dateStart" required>
                            <label for="dateEnd" class="mt-2">End Date:</label>
                            <input type="date" class="form-control" id="dateEnd" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="generateDateRangeReport">Generate Report</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for By Year -->
            <div class="modal fade" id="yearModal" tabindex="-1" aria-labelledby="dateModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="dateModalLabel">Select Year</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label for="dateStart">Start Year:</label>
                            <select class="form-control" id="yearInput" required>
                                <option value="" disabled selected>Select Year</option>
                                <!-- Generate the options dynamically using JavaScript -->
                            </select>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="generateYearReport">Generate Report</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- GENERATE REPORT MODAL END -->

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
            <script src="assets/js/client-activity.js"></script>
</body>

</html>
<!-- beautify ignore:end -->