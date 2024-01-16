<?php
session_start();

// Function to get the current month
function getCurrentMonth()
{
    return date('m');
}

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "css_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch survey responses from the database
$currentMonth = getCurrentMonth();
$sql = "SELECT * FROM survey_responses";
$result = $conn->query($sql);

// Check if the current month is different from the stored month
if (!isset($_SESSION['currentMonth']) || $_SESSION['currentMonth'] != $currentMonth) {
    // Reset user IDs and update the stored month
    $_SESSION['currentMonth'] = $currentMonth;
    $resetIdsSql = "ALTER TABLE survey_responses AUTO_INCREMENT = 1";
    $conn->query($resetIdsSql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          integrity="sha512-pzjw8/0ZYs0n8RW36ByRlA5RMyW5tZj3GlRIqPBHvQ5e85ZvA1BEJRKM5QmLkG9UYbSz8pT2cjs3tt4/GbD6KNsMw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <title>Home</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-image: url('images/ustpalter.png');
            background-repeat: no-repeat;
            background-size: cover;
            color: #333;
        }

        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            margin-left: 250px;
        }

        .arrow-link {
            position: fixed;
            bottom: 10px;
            left: 10px;
            padding: 10px;
            background-color: #ff0000;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
    </style>
</head>
<body>
<div class="content relative">

    <!-- Arrow Icon to redirect to adminDashboard.php -->
    <a href="adminDashboard.php" class="arrow-link">
        &#9664; Back
    </a>

    <div class="mt-4 flex items-center space-x-2">
        <label class="mr-2"></label>
        <select id="sortOfficeType" class="px-2 py-1 rounded border">
            <option value="">By Office</option>
            <?php
            $sqlOfficeTypes = "SELECT DISTINCT office_type FROM survey_responses";
            $resultOfficeTypes = $conn->query($sqlOfficeTypes);
            $officeTypes = $resultOfficeTypes->fetch_all(MYSQLI_ASSOC);
            foreach ($officeTypes as $office) {
                echo '<option value="' . $office['office_type'] . '">' . $office['office_type'] . '</option>';
            }
            ?>
        </select>
        <select id="sortMonth" class="px-2 py-1 rounded border">
            <option value="">By Month</option>
            <?php
            for ($month = 1; $month <= 12; $month++) {
                $monthName = date('F', mktime(0, 0, 0, $month, 1));
                echo '<option value="' . $month . '">' . $monthName . '</option>';
            }
            ?>
        </select>
        <select id="sortYear" class="px-2 py-1 rounded border">
            <option value="">By Year</option>
            <?php
            $currentYear = date('Y');
            for ($year = $currentYear; $year >= $currentYear - 1; $year--) {
                echo '<option value="' . $year . '">' . $year . '</option>';
            }
            ?>
        </select>
        <button class="px-4 py-2 bg-blue-500 text-white rounded border hover:bg-blue-700" onclick="applySort()">Search</button>
        <button class="px-4 py-2 bg-green-500 text-white rounded border hover:bg-green-700 ml-2" onclick="printTable()">Print</button>
    </div>

    <?php
    // Pagination settings
    $resultsPerPage = 7; // Number of results per page

    // Fetch data with pagination based on sorting criteria
    $sortOfficeType = isset($_GET['sortOfficeType']) ? $_GET['sortOfficeType'] : '';
    $sortMonth = isset($_GET['sortMonth']) ? $_GET['sortMonth'] : '';
    $sortYear = isset($_GET['sortYear']) ? $_GET['sortYear'] : '';

    $sqlCount = "SELECT COUNT(*) as count FROM survey_responses WHERE 
                 (office_type = '$sortOfficeType' OR '$sortOfficeType' = '') AND 
                 (MONTH(created_at) = '$sortMonth' OR '$sortMonth' = '') AND 
                 (YEAR(created_at) = '$sortYear' OR '$sortYear' = '')";
    $resultCount = $conn->query($sqlCount);
    $totalResults = $resultCount->fetch_assoc()['count'];
    $totalPages = ceil($totalResults / $resultsPerPage);

    // Get current page or set a default
    $currentPage = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
    $currentPage = max(min($currentPage, $totalPages), 1);

    // Calculate the offset for the query
    $offset = ($currentPage - 1) * $resultsPerPage;

    $sqlPagination = "SELECT * FROM survey_responses WHERE 
                     (office_type = '$sortOfficeType' OR '$sortOfficeType' = '') AND 
                     (MONTH(created_at) = '$sortMonth' OR '$sortMonth' = '') AND 
                     (YEAR(created_at) = '$sortYear' OR '$sortYear' = '') 
                     LIMIT $resultsPerPage OFFSET $offset";
    $resultPagination = $conn->query($sqlPagination);

    // Display the selected sorting criteria
    echo '<div class="mt-2">';
    if (!empty($sortOfficeType)) {
        echo '<span class="mr-2 bg-yellow-500 text-white px-2 py-1 rounded">Office Type: ' . $sortOfficeType . '</span>';
    }
    if (!empty($sortMonth)) {
        echo '<span class="mr-2 bg-yellow-500 text-white px-2 py-1 rounded">Month: ' . date('F', mktime(0, 0, 0, $sortMonth, 1)) . '</span>';
    }
    if (!empty($sortYear)) {
        echo '<span class="mr-2 bg-yellow-500 text-white px-2 py-1 rounded">Year: ' . $sortYear . '</span>';
    }
    echo '</div>';

    // Display the table if there are rows in the result
    if ($resultPagination && $resultPagination->num_rows > 0) {
        echo '<table class="min-w-full bg-white border border-gray-300 shadow-md rounded-md divide-y divide-gray-300">';
        echo '<thead>';
        echo '<tr>';
        echo '<th class="py-2 px-2 bg-blue-800 text-white border">ID</th>';
        echo '<th class="py-2 px-2 bg-blue-800 text-white border">Question 1</th>';
        echo '<th class="py-2 px-2 bg-blue-800 text-white border">Question 2</th>';
        echo '<th class="py-2 px-2 bg-blue-800 text-white border">Question 3</th>';
        echo '<th class="py-2 px-2 bg-blue-800 text-white border">Question 4</th>';
        echo '<th class="py-2 px-2 bg-blue-800 text-white border">Question 5</th>';
        echo '<th class="py-2 px-2 bg-blue-800 text-white border">Question 6</th>';
        echo '<th class="py-2 px-2 bg-blue-800 text-white border">Question 7</th>';
        echo '<th class="py-2 px-2 bg-blue-800 text-white border">Question 8</th>';
        echo '<th class="py-2 px-2 bg-blue-800 text-white border">Question 9</th>';
        // Add more cells for other questions as needed
        echo '<th class="py-2 px-2 bg-blue-800 text-white border">Date Submitted</th>';
        echo '<th class="py-2 px-2 bg-blue-800 text-white border">Office Type</th>';
        echo '<th class="py-2 px-2 bg-blue-800 text-white border">Action</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // Output data of each row
        while ($row = $resultPagination->fetch_assoc()) {
            echo '<tr>';
            echo '<td class="py-2 px-2 border ml-2">' . $row["id"] . '</td>';
            echo '<td class="py-2 px-2 border ml-2">' . $row["question1"] . '</td>';
            echo '<td class="py-2 px-2 border ml-2">' . $row["question2"] . '</td>';
            echo '<td class="py-2 px-2 border ml-2">' . $row["question3"] . '</td>';
            echo '<td class="py-2 px-2 border ml-2">' . $row["question4"] . '</td>';
            echo '<td class="py-2 px-2 border ml-2">' . $row["question5"] . '</td>';
            echo '<td class="py-2 px-2 border ml-2">' . $row["question6"] . '</td>';
            echo '<td class="py-2 px-2 border ml-2">' . $row["question7"] . '</td>';
            echo '<td class="py-2 px-2 border ml-2">' . $row["question8"] . '</td>';
            echo '<td class="py-2 px-2 border ml-2">' . $row["question9"] . '</td>';
            // Add more cells for other questions as needed
            echo '<td class="py-2 px-2 border ml-2">' . $row["created_at"] . '</td>';
            echo '<td class="py-2 px-2 border ml-2">' . $row["office_type"] . '</td>';
            echo '<td class="py-2 px-2 border text-center ml-2">';
            echo '<button class="archive-button bg-blue-500 text-white hover:bg-red-700 px-2 py-1 rounded transition duration-300" onclick="archiveResponse(' . $row["id"] . ')">';
            echo '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">';
            echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 8l-8 8-4-4-4 4"></path>';
            echo '</svg>';
            echo '</button>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';

        // Pagination links
        echo '<div class="mt-4">';
        if ($totalPages > 1) {
            echo '<span class="mr-2 bg-blue-500 text-white px-2 py-1 rounded">Page ' . $currentPage . ' of ' . $totalPages . '</span>';

            for ($i = 1; $i <= $totalPages; $i++) {
                echo '<a href="?page=' . $i . '&sortOfficeType=' . $sortOfficeType . '&sortMonth=' . $sortMonth . '&sortYear=' . $sortYear . '" class="pagination-link px-2 py-1 rounded hover:bg-gray-300 text-white bg-blue-500">' . $i . '</a>';
            }
        }
        echo '</div>';
        
    } else {
        echo 'No survey responses found.';
    }
    ?>


    <script>
         function applySort() {
            var sortOfficeType = document.getElementById('sortOfficeType').value;
            var sortMonth = document.getElementById('sortMonth').value;
            var sortYear = document.getElementById('sortYear').value;

            // Redirect to the same page with sorting parameters
            window.location.href = '?page=1&sortOfficeType=' + sortOfficeType + '&sortMonth=' + sortMonth + '&sortYear=' + sortYear;
        }
    // Your existing functions here (e.g., archiveResponses)
        function archiveResponse(responseId) {
            // Display a confirmation dialog
            var confirmArchive = window.confirm("Are you sure you want to archive this response?");

            // If the user clicks OK in the confirmation dialog, proceed with archiving
            if (confirmArchive) {
                // Send an AJAX request to the PHP script to handle the archiving
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4) {
                        if (this.status == 200) {
                            // Handle the response from the server
                            if (this.responseText.includes("Response archived successfully")) {
                                // Use SweetAlert to show a success message
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Response archived successfully!',
                                }).then(function () {
                                    // Reload the page after the SweetAlert is closed
                                    location.reload();
                                });
                            } else {
                                // If there's an error, show an alert
                                alert("Error archiving response: " + this.responseText);
                            }
                        } else {
                            // Handle the case where the request failed
                            alert("Error archiving response.");
                        }
                    }
                };
                xhttp.open("GET", "archive_response.php?responseId=" + responseId, true);
                xhttp.send();
            }
        }
        function printTable() {
        // Create a copy of the current table
        var tableToPrint = document.querySelector('.content table').cloneNode(true);

        // Create a new window for printing
        var printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Print</title></head><body>');

        // Append the cloned table to the new window
        printWindow.document.body.appendChild(tableToPrint);

        // Close the HTML document
        printWindow.document.write('</body></html>');
        printWindow.document.close();

        // Focus and print the new window
        printWindow.focus();
        printWindow.print();
        printWindow.close();
    }
    </script>
</body>
</html>
