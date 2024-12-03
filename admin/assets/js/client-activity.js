$(document).ready(function () {
  // Initialize the DataTable for client table
  var table = $("#clientTable").DataTable({
    paging: true,
    searching: true,
    ordering: true,
    responsive: true,
  });

  // Set today's date for the end date input (yyyy-mm-dd format)
  var today = new Date();
  var formattedToday = today.toISOString().split("T")[0]; // Format as yyyy-mm-dd
  $("#searchEndDate").val(formattedToday); // Set today's date in the End Date field

  // Function to format date as mm/dd/yyyy
  function formatDate(date) {
    var month = date.getMonth() + 1; // Months are 0-based
    var day = date.getDate();
    var year = date.getFullYear();
    return (
      (month < 10 ? "0" : "") +
      month +
      "/" +
      (day < 10 ? "0" : "") +
      day +
      "/" +
      year
    );
  }

  // Function to parse and convert table date to Date object (ignoring time)
  function parseTableDate(dateStr) {
    var parts = dateStr.split(" ");
    var month = new Date(Date.parse(parts[0] + " 1, 2021")).getMonth(); // Get month index from month name
    var day = parseInt(parts[1]);
    var year = parseInt(parts[2]);
    var dateObj = new Date(year, month, day);
    dateObj.setHours(0, 0, 0, 0); // Set time to 00:00:00 for accurate date comparison
    return dateObj;
  }

  // Function to format a Date object to a human-readable string (MM/DD/YYYY)
function formatToReadableDate(date) {
  // Get the month, day, and year from the date object
  var month = date.getMonth() + 1; // Months are 0-based (January = 0, February = 1, etc.)
  var day = date.getDate(); // Get the day of the month (1-31)
  var year = date.getFullYear(); // Get the full year (e.g., 2024)

  // Format the month and day to ensure they are always two digits (e.g., "03" instead of "3")
  // Return the formatted date as a string in the format MM/DD/YYYY
  return (month < 10 ? '0' : '') + month + '/' + (day < 10 ? '0' : '') + day + '/' + year;
}

  // Listen for changes in the Start Date or End Date for Date Range
  $("#searchStartDate, #searchEndDate").on("change", function () {
    var startDate = $("#searchStartDate").val();
    var endDate = $("#searchEndDate").val();

    if (startDate && endDate) {
      var startDateObj = new Date(startDate);
      var endDateObj = new Date(endDate);
      startDateObj.setHours(0, 0, 0, 0);
      endDateObj.setHours(23, 59, 59, 999); // Ensure end date includes the full day

      var rowsVisible = false; // Flag to check if any rows match

      table.rows().every(function () {
        var row = this.node();
        var dateCell = $(row).find("td").eq(8).text(); // Get the "Date" column text

        // Convert the date in the table (assumed format is "Month Day, Year") to Date object
        var tableDateObj = parseTableDate(dateCell);

        // Check if the date is within the range (inclusive)
        if (tableDateObj >= startDateObj && tableDateObj <= endDateObj) {
          $(row).show();
          rowsVisible = true;
        } else {
          $(row).hide();
        }
      });

      if (!rowsVisible) {
        $("#clientTable tbody").html(
          '<tr><td colspan="9" class="text-center">No data available</td></tr>'
        );
      } else {
        table.draw();
      }
    } else {
      table.rows().show();
      table.draw();
    }
  });

  // Handle "By Today" selection
  $("#byToday").click(function () {
    $("#weekModal, #monthModal, #dateModal").modal("hide");
    generateReportForToday(); // Automatically generate report for today's date
  });

  // Handle "Generate Report" button click for "By Today"
  $("#generateTodayReport").click(function () {
    generateReportForToday(); // Generate the report for today's date
  });

  // Function to handle report generation for today
  function generateReportForToday() {
    var today = new Date();
    var formattedDate = formatDate(today); // Format today's date to dd/mm/yyyy

    console.log("Generating report for today's date:", formattedDate);
    generateExcelReport("Client_Activity_" + formattedDate, today, today);
  }

  // Open the modal when clicking on the 'By Week' button
  $("#byWeek").click(function () {
    $("#weekModal").modal("show"); // Show the week modal
  });

  // Adjust start and end dates when the user selects a start date
  $("#weekStartDate").on("change", function () {
    var startDate = $(this).val();

    if (!startDate) return;

    var startDateObj = new Date(startDate);
    var adjustedStartDate = getStartOfWeek(startDateObj); // Adjust the start of the week
    var adjustedEndDate = getEndOfWeek(adjustedStartDate); // Adjust the end of the week

    $("#weekStartDate").val(formatDateForInput(adjustedStartDate));
    $("#weekEndDate").val(formatDateForInput(adjustedEndDate));

    console.log("Adjusted start date:", formatDate(adjustedStartDate));
    console.log("Adjusted end date:", formatDate(adjustedEndDate));
  });

  // Handle "Generate Report" button click for "By Week"
  $("#generateWeekReport").click(function () {
    var startDate = $("#weekStartDate").val();
    var endDate = $("#weekEndDate").val();

    if (!startDate || !endDate) {
      alert("Please select both start and end dates for the week.");
      return;
    }

    var formattedStartDate = formatDate(new Date(startDate));
    var formattedEndDate = formatDate(new Date(endDate));

    console.log(
      "Generating report for week:",
      formattedStartDate + " to " + formattedEndDate
    );

    var adjustedStartDate = new Date(startDate);
    var adjustedEndDate = new Date(endDate);

    adjustedStartDate = getStartOfWeek(adjustedStartDate);
    adjustedEndDate = getEndOfWeek(adjustedEndDate);

    formattedStartDate = formatDate(adjustedStartDate);
    formattedEndDate = formatDate(adjustedEndDate);

    console.log(
      "Adjusted week:",
      formattedStartDate + " to " + formattedEndDate
    );

    generateExcelReport(
      "Client_Activity_" +
        formattedStartDate.replace(/\//g, "-") +
        "_" +
        formattedEndDate.replace(/\//g, "-") +
        ".xlsx",
      adjustedStartDate,
      adjustedEndDate
    );
  });

  // Helper function to get the start of the week (Monday)
  function getStartOfWeek(date) {
    var startOfWeek = new Date(date);
    var day = startOfWeek.getDay();
    var diff = startOfWeek.getDate() - day;
    startOfWeek.setDate(diff);
    startOfWeek.setHours(0, 0, 0, 0);
    return startOfWeek;
  }

  // Helper function to get the end of the week (Sunday)
  function getEndOfWeek(date) {
    var endOfWeek = new Date(date);
    var day = endOfWeek.getDay();
    var diff = endOfWeek.getDate() - day + 6;
    endOfWeek.setDate(diff);
    endOfWeek.setHours(23, 59, 59, 999);
    return endOfWeek;
  }

  // Function to format date as yyyy-MM-dd (for use with input fields)
  function formatDateForInput(date) {
    var day = date.getDate();
    var month = date.getMonth() + 1; // Months are 0-based
    var year = date.getFullYear();
    return (
      year +
      "-" +
      (month < 10 ? "0" : "") +
      month +
      "-" +
      (day < 10 ? "0" : "") +
      day
    );
  }

  // Handle "By Month" selection
  $("#byMonth").click(function () {
    $("#monthModal").modal("show");
  });

  // Handle "Generate Report" button click for "By Month"
  $("#generateMonthReport").click(function () {
    var selectedMonth = $("#monthInput").val();

    if (!selectedMonth) {
      alert("Please select a month.");
      return;
    }

    var monthStartDate = new Date(selectedMonth + "-01");
    var monthEndDate = new Date(
      monthStartDate.getFullYear(),
      monthStartDate.getMonth() + 1,
      0
    );

    var formattedDate = formatMonthDate(monthStartDate);
    var formattedStartDate = formatDate(monthStartDate);
    var formattedEndDate = formatDate(monthEndDate);

    console.log(
      "Generating report for month:",
      formattedStartDate + " to " + formattedEndDate
    );
    generateExcelReport(
      "Client_Activity_" + formattedDate.replace(/\//g, "-") + ".xlsx",
      monthStartDate,
      monthEndDate
    );
  });

  // Function to format date to YYYY-MM (Year-Month) format
  function formatMonthDate(date) {
    var year = date.getFullYear();
    var month = ("0" + (date.getMonth() + 1)).slice(-2);
    return month + "-" + year;
  }

  // Handle "By Date Range" selection
  $("#byDateRange").click(function () {
    $("#dateModal").modal("show");
  });

  // Handle "Generate Report" button click for "By Date Range"
  $("#generateDateRangeReport").click(function () {
    var startDate = $("#dateStart").val();
    var endDate = $("#dateEnd").val();

    if (!startDate || !endDate) {
      alert("Please select both start and end dates.");
      return;
    }

    var formattedStartDate = formatDate(new Date(startDate));
    var formattedEndDate = formatDate(new Date(endDate));

    console.log(
      "Generating report for date range:",
      formattedStartDate + " to " + formattedEndDate
    );

    generateExcelReport(
      "Client_Activity_" +
        formattedStartDate.replace(/\//g, "-") +
        "_" +
        formattedEndDate.replace(/\//g, "-") +
        ".xlsx",
      new Date(startDate),
      new Date(endDate)
    );
  });

  // Initialize Year
  var currentYear = new Date().getFullYear();
  var startYear = 2024;
  var endYear = currentYear + 10; // Adjust as needed (e.g., next 10 years)
  
  // Populate the dropdown with years
  for (var year = startYear; year <= endYear; year++) {
      $('#yearInput').append($('<option>', {
          value: year,
          text: year
      }));
  }

  // Handle the "Generate Report" button click for "By Year"
  $('#generateYearReport').click(function() {
    var selectedYear = $('#yearInput').val();

    if (!selectedYear) {
      alert("Please select a year.");
      return;
    }

    // Convert selected year into a start and end date for the entire year
    var startDate = new Date(selectedYear, 0, 1);  // January 1st of the selected year
    var endDate = new Date(selectedYear, 11, 31);   // December 31st of the selected year

    // Format the dates
    var formattedStartDate = formatDate(startDate);
    var formattedEndDate = formatDate(endDate);

    console.log("Generating report for year:", selectedYear);
    console.log("Start Date:", formattedStartDate, "End Date:", formattedEndDate);

    // Generate the report for the selected year
    generateExcelReport("Client_Activity_" + selectedYear + ".xlsx", startDate, endDate);
  });

  // Function to generate an Excel report
  function generateExcelReport(filename, filterStartDate, filterEndDate) {
    if (!filename.endsWith(".xlsx")) {
      filename += ".xlsx";
    }

    // Define the headers for the table
    var headers = [
      "Client ID",
      "Username",
      "Name",
      "Email",
      "Contact Number",
      "Service",
      "Acquired Points",
      "Attending Receptionist",
      "Date",
    ];

    var tableData = [];
    tableData.push(headers); // Add headers to the first row of the data
    filterStartDate = formatToReadableDate(filterStartDate);
    filterEndDate = formatToReadableDate(filterEndDate);
    console.log("Filter Start Date: ", filterStartDate);
    console.log("Filter End Date: ", filterEndDate);

    // Iterate over each visible row in the table
    $("#clientTable tbody tr:visible").each(function () {
      var row = [];

      // Get the date from the "Date" column (index 8)
      var dateCell = $(this).find("td").eq(8).text();

      console.log("Row Date: ", dateCell); // Debugging line to see the date in the table

      // Convert the date string to a JavaScript Date object
      var parsedDate = new Date(dateCell);

      // Format the parsed date to "December 3, 2024"
      var rowDate = formatToReadableDate(parsedDate);

      if (rowDate) {
        // Include rows that fall within the specified date range
        if (
          new Date(filterStartDate) &&
          new Date(rowDate) >= new Date(filterStartDate) &&
          new Date(filterEndDate) &&
          new Date(rowDate) <= new Date(filterEndDate)
        ) {
          $(this)
            .find("td")
            .each(function (index) {
              row.push($(this).text()); // Add cell value to the row
            });
          console.log("ROW" + row);
          tableData.push(row); // Add the row data to the tableData array
        } else {
          console.log("Row Date is out of range: ", rowDate); // Debugging line if the row date is out of range
        }
      } else {
        console.log("Invalid date in row: ", dateCell); // Debugging line if the date parsing fails
      }
    });

    // Generate the Excel report using the table data
    var wb = XLSX.utils.book_new();
    var ws = XLSX.utils.aoa_to_sheet(tableData);
    XLSX.utils.book_append_sheet(wb, ws, "Client Activity");

    // Save the Excel file with the specified filename
    XLSX.writeFile(wb, filename);
  }
});
