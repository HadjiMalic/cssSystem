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

// Pagination variables
$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page

$start = ($page - 1) * $limit; // Calculate the starting point for the results on this page

$sql = "SELECT * FROM surveys_archives LIMIT $start, $limit"; // Note: Change this query to fetch data from surveys_archive
$result = $conn->query($sql);

// Check if the current month is different from the stored month
if (!isset($_SESSION['currentMonth']) || $_SESSION['currentMonth'] != $currentMonth) {
    // Reset user IDs and update the stored month
    $_SESSION['currentMonth'] = $currentMonth;

    // Check if data is being moved to archive.php
    if (isset($_GET['archiveId'])) {
        // Reset the auto-increment value of the ID column in surveys_archive
        $resetIdsSql = "ALTER TABLE surveys_archive AUTO_INCREMENT = 1";
        $conn->query($resetIdsSql);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
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

        .navbar {
            background-color: #007bff;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar select,
        .navbar button {
            padding: 10px;
            font-size: 16px;
            margin-right: 10px;
        }

        .box {
            background-color: rgba(255, 255, 255, 0.8);
            border-style: ridge;
            padding: 20px;
            border-radius: 10px;
            margin: 10px;
        }

        .box h1, .box h2 {
            text-align: center;
        }

        .logout-button {
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

        .logout-button:hover {
            background-color: #cc0000;
        }

        table {
            margin-top: 10px;
            border-collapse: collapse;
            width: 100%;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.1);
        }

        .delete-button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 5px;
        }

        .delete-button:hover {
            background-color: red;
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

<div class="content">
    <h2>Survey Responses</h2>
    
    <?php
    if ($result->num_rows > 0) {
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
        echo '<th class="py-2 px-2 bg-blue-800 text-white border">Date Submitted</th>';
        echo '<th class="py-2 px-2 bg-blue-800 text-white border">OFFICE</th>';
        echo '<th class="py-2 px-2 bg-blue-800 text-white border">Action</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
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
            echo '<td class="py-2 px-2 border ml-2">' . $row["created_at"] . '</td>';
            echo '<td class="py-2 px-2 border ml-2">' . $row["office_type"] . '</td>';
            echo '<td><button class="delete-button" onclick="deleteResponse(' . $row["id"] . ')">Remove</button></td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo 'No survey responses found.';
    }
    ?>

    <a href="adminDashboard.php" class="arrow-link">
        &#9664; Back
    </a>

    <script>
        function deleteResponse(id) {
            // Display a confirmation dialog
            var confirmDelete = window.confirm("Are you sure you want to remove this survey response?");

            // If the user clicks OK in the confirmation dialog, proceed with deletion
            if (confirmDelete) {
                // Use AJAX to send a request to the server for deletion
                $.ajax({
                    type: "POST",
                    url: "deleteResponse.php", // Point to the PHP file handling the deletion
                    data: {id: id}, // Pass the ID of the record to be deleted
                    success: function (data) {
                        // Show SweetAlert for success
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Survey response removed successfully!',
                        }).then(function () {
                            // Reload the page after successful deletion
                            location.reload();
                        });
                    },
                    error: function () {
                        // Show SweetAlert for error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error deleting the survey response.',
                        });
                    }
                });
            }
        }
    </script>
</body>
</html>
