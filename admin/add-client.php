<?php
require("../config/db_connection.php");

?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr"
    data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Add Client</title>
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
        <div class="container mt-5">
            <!-- Card Container -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Client</h3>
                </div>
                <div class="card-body">
                    <form id="addClientForm">
                        <div class="mb-3">
                            <label for="username" class="form-label">
                                Username <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="username" placeholder="Enter username" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="name" placeholder="Enter full name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                Email
                            </label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email address (optional)">
                        </div>
                        <div class="mb-3">
                            <label for="contactNumber" class="form-label">
                                Contact Number
                            </label>
                            <input type="text" class="form-control" id="contactNumber" placeholder="Enter contact number (optional)">
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="button" class="btn btn-primary" id="saveClientBtn">Save Client</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Confirmation Modal -->
        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Double Check Your Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Please double-check your information before saving.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                        <button type="button" class="btn btn-primary" id="confirmSaveBtn">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal to display Client ID and QR Code -->
<div class="modal fade" id="clientInfoModal" tabindex="-1" aria-labelledby="clientInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="clientInfoModalLabel">Client Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Client ID:</strong> <span id="clientIDDisplay"></span></p>
                <p><strong>QR Code:</strong></p>
                <img id="qrCodeImage" src="" alt="QR Code" class="img-fluid" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
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
            // Handle Save Client button click
            $('#saveClientBtn').on('click', function() {
                // Get form values
                const username = $('#username').val().trim();
                const name = $('#name').val().trim();
                const email = $('#email').val().trim();
                const contactNumber = $('#contactNumber').val().trim();

                const emailInput = $('#email');
                const emailDomain = "@gmail.com";


                // Check if required fields are filled
                // Check if required fields are filled
                if (username && name) {
                    // Validate email only if it is provided
                    if (email) {
                        if (!email.endsWith(emailDomain)) {
                            toastr.warning('Please use a valid @gmail.com email address.');
                            emailInput.css('border-color', 'red'); // Optional: change border to red for invalid email
                            return; // Stop further processing
                        } else {
                            emailInput.css('border-color', 'green'); // Optional: change border to green for valid email
                        }
                    }

                    // Validate other form fields (e.g., contact number) if necessary
                    var phonePattern = /^09\d{9}$/;
                    if (!phonePattern.test(contactNumber) && contactNumber != '') {
                        toastr.warning('Contact number must start with 09 and be 11 digits long.');
                        return; // Stop form submission if validation fails
                    }
                    // Show confirmation modal
                    $('#confirmationModal').modal('show');
                } else {
                    toastr.error('Please fill in all required fields!');
                }


            });


            // Handle confirmation of saving client
$('#confirmSaveBtn').on('click', function() {
    // Get form values
    const username = $('#username').val();
    const name = $('#name').val();
    const email = $('#email').val();
    const contactNumber = $('#contactNumber').val();

    // You can send the form data to the server using AJAX
    $.ajax({
        url: 'addClient.php', // Replace with your server endpoint
        method: 'POST',
        data: {
            username: username,
            name: name,
            email: email,
            contactNumber: contactNumber
        },
        success: function(response) {
            // Parse the response
            const data = JSON.parse(response);

            if (data.status === 'success') {
                // Display success message
                toastr.success('Client added successfully!');
                $('#addClientForm')[0].reset(); // Reset the form
                $('#confirmationModal').modal('hide'); // Close the confirmation modal

                // Display the new modal with Client ID and QR code
                $('#clientIDDisplay').text(data.clientID); // Display the client ID in the modal
                $('#qrCodeImage').attr('src', data.qrCodePath); // Display the QR code image in the modal

                // Show the modal containing the client ID and QR code
                $('#clientInfoModal').modal('show');
            } else {
                toastr.error('Error: ' + data.message);
            }
        },
        error: function(xhr, status, error) {
            // Handle error (e.g., show error message)
            toastr.error('Failed to add client. Please try again.');
        }
    });
});


            // Close modal on cancel button click
            $('.btn-secondary').on('click', function() {
                $('#confirmationModal').modal('hide');
            });
        });
    </script>

    </script>
</body>

</html>
<!-- beautify ignore:end -->