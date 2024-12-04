<?php
require("../config/db_connection.php");

session_start();
require("../config/session_timeout.php");

if (!isset($_SESSION['id'])) {
  header("location: ../config/not_login-error.html");
} else {
  if ($_SESSION['role'] != "receptionist") {
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
                                                    <small class="text-muted">Receptionist</small>
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
                <div class="modal-dialog modal-dialog-centered">
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
                <div class="modal-dialog modal-dialog-centered">
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
                <div class="modal-dialog modal-dialog-centered">
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
                <div class="modal-dialog modal-dialog-centered">
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
            <script>
                $(document).ready(function() {
    // Initialize DataTable
    var table = $("#clientTable").DataTable({
        destroy: true,
        ajax: {
            url: "fetch_activity.php",
            type: "GET",
            dataSrc: function(json) {
                return json;
            },
        },
        columns: [{
                data: "client_id"
            },
            {
                data: "name"
            },
            {
                data: "email"
            },
            {
                data: "contact_number"
            },
            {
                data: "service"
            },
            {
                data: "points_acquired"
            },
            {
                data: "receptionist"
            },
            {
                data: "formatted_date"
            },
        ],
        paging: true,
        searching: true,
        ordering: true,
        responsive: true,
        order: [
            [7, "desc"]
        ],
    });

    // Function to parse the date from "Month Day, Year" format to Date object
    function parseTableDate(dateStr) {
        // Format is assumed to be "Month Day, Year" (e.g., "December 4, 2024")
        var parts = dateStr.split(' ');
        var month = new Date(Date.parse(parts[0] + " 1, 2021")).getMonth(); // Get month index from month name
        var day = parseInt(parts[1]);
        var year = parseInt(parts[2]);
        return new Date(year, month, day); // Create Date object
    }

    // Set the end date to today's date on page load
    var today = new Date();
    var formattedToday = today.toISOString().split('T')[0]; // Formats the date as YYYY-MM-DD
    $("#searchEndDate").val(formattedToday);

    $("#searchStartDate, #searchEndDate").on("change", function() {
    var startDate = $("#searchStartDate").val();
    var endDate = $("#searchEndDate").val();

    // Ensure that both start and end dates are selected
    if (startDate && endDate) {
        var startDateObj = new Date(startDate);
        var endDateObj = new Date(endDate);
        startDateObj.setHours(0, 0, 0, 0); // Set to the start of the day
        endDateObj.setHours(23, 59, 59, 999); // Set to the end of the day

        var rowsVisible = false; // Flag to check if any rows match

        // Iterate through each row in the table
        table.rows().every(function() {
            var row = this.node();
            var dateCell = $(row).find("td").eq(7).text(); // Get the "Date & Time" column text

            // Parse the date in the "Date & Time" column
            var tableDateObj = parseTableDate(dateCell);

            // Check if the date is within the range (inclusive)
            if (tableDateObj >= startDateObj && tableDateObj <= endDateObj) {
                $(row).show();
                rowsVisible = true;
            } else {
                $(row).hide();
            }
        });

        // If no rows match the filter, show a message without breaking DataTable settings
        if (!rowsVisible) {
            $("#clientTable tbody").html(
                '<tr><td colspan="8" class="text-center">No data available</td></tr>'
            );
        }
    } else {
        // Show all rows if no date range is specified
        table.rows().show();
        table.draw();
    }
});


    // Handle By Today selection
    $('#byToday').click(function() {
        var today = new Date();
        var day = ("0" + today.getDate()).slice(-2);
        var month = ("0" + (today.getMonth() + 1)).slice(-2);  // Months are 0-based
        var year = today.getFullYear();
        
        var todayDate = year + "-" + month + "-" + day;  // Format date as YYYY-MM-DD

        // Open the modal or directly trigger the report generation
        generateReport('today', todayDate);  // Using 'today' for this case
    });

    function generateReport(reportType, date) {
        $.ajax({
            url: 'generate_report.php',  // PHP script to generate the report
            method: 'GET',
            data: {
                report_type: reportType,
                date: date  // Passing today's date only
            },
            success: function(response) {
                console.log(response);
                window.location.href = 'generate_report.php?report_type=today&date=' + date;
                // Handle successful response (e.g., download the file or show success message)
                toastr.success('Report generated successfully');
            },
            error: function(xhr, status, error) {
                toastr.error('Error generating report: ' + error);
            }
        });
    }
    // Initialize the Year Options
    function populateYearOptions() {
        var currentYear = new Date().getFullYear();
        var yearSelect = $("#yearInput");
        for (var i = 2000; i <= currentYear; i++) {
            yearSelect.append('<option value="' + i + '">' + i + '</option>');
        }
    }

    populateYearOptions(); // Call function to populate year options

    // Adjust End Date when Start Date is selected for Week Modal
    $("#weekStartDate").on("change", function () {
        var startDate = new Date($("#weekStartDate").val());
        startDate.setDate(startDate.getDate() + 6); // Add 6 days to start date for end date
        var endDate = startDate.toISOString().split("T")[0]; // Format as yyyy-mm-dd
        $("#weekEndDate").val(endDate); // Set end date
    });

    // Generate Week Report
    $("#generateWeekReport").on("click", function () {
        var startDate = $("#weekStartDate").val();
        var endDate = $("#weekEndDate").val();

        if (startDate && endDate) {
            $.ajax({
                url: "generate_report.php",
                type: "GET",
                data: {
                    report_type: 'week',
                    start_date: startDate,
                    end_date: endDate
                },
                success: function (response) {
                    window.location.href = 'generate_report.php?report_type=week&start_date=' + startDate + '&end_date=' + endDate;
                    // Handle response, such as showing a success message or displaying the report
                    toastr.success("Week Report Generated Successfully");
                },
                error: function () {
                    toastr.error("Error generating report.");
                }
            });
        } else {
            toastr.warning("Please select both start and end dates.");
        }
    });

    // Generate Monthly Report
    $("#generateMonthReport").on("click", function () {
        var monthYear = $("#monthInput").val();

        if (monthYear) {
            $.ajax({
                url: "generate_report.php",
                type: "GET",
                data: {
                    report_type: 'month',
                    month_year: monthYear
                },
                success: function (response) {
                    window.location.href = 'generate_report.php?report_type=month&month_year=' + monthYear;
                    // Handle response, such as showing a success message or displaying the report
                    toastr.success("Month Report Generated Successfully");
                },
                error: function () {
                    toastr.error("Error generating report.");
                }
            });
        } else {
            toastr.warning("Please select a month.");
        }
    });

    // Generate Date Range Report
    $("#generateDateRangeReport").on("click", function () {
        var startDate = $("#dateStart").val();
        var endDate = $("#dateEnd").val();

        if (startDate && endDate) {
            $.ajax({
                url: "generate_report.php",
                type: "GET",
                data: {
                    report_type: 'date_range',
                    start_date: startDate,
                    end_date: endDate
                },
                success: function (response) {
                    window.location.href = 'generate_report.php?report_type=date_range&start_date=' + startDate + '&end_date=' + endDate;
                    // Handle response, such as showing a success message or displaying the report
                    toastr.success("Date Range Report Generated Successfully");
                },
                error: function () {
                    toastr.error("Error generating report.");
                }
            });
        } else {
            toastr.warning("Please select both start and end dates.");
        }
    });

    // Generate Yearly Report
    $("#generateYearReport").on("click", function () {
        var year = $("#yearInput").val();

        if (year) {
            $.ajax({
                url: "generate_report.php",
                type: "GET",
                data: {
                    report_type: 'year',
                    year: year
                },
                success: function (response) {
                    window.location.href = 'generate_report.php?report_type=year&year=' + year;
                    // Handle response, such as showing a success message or displaying the report
                    toastr.success("Year Report Generated Successfully");
                },
                error: function () {
                    toastr.error("Error generating report.");
                }
            });
        } else {
            toastr.warning("Please select a year.");
        }
    });
});

            </script>
</body>

</html>
<!-- beautify ignore:end -->