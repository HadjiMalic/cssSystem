<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-image: url('images/ustp.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            color: #333;
        }

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 50px;
            background-image: url('pics/logo.png');
            background-position: left top;
            background-repeat: no-repeat;
            background-size: 50%;
            border-right: 1px solid #ddd;
            background-color: rgba(0, 1, 55, 0.9);
            font-weight: bolder;
            transition: width 0.3s;
        }

        .sidebar a {
            padding: 15px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            transition: 0.3s;
        }

        .sidebar.active {
            width: 40px;
        }

        .sidebar a:hover {
            font-size: 20px;
            color: #ffc000;
        }

        .sidebar a.active {
            color: whitesmoke;
            font-size: 20px;
            border-radius: 10px;
        }

        .sidebar a.active:hover {
            color: white;
        }

        .content {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
    margin-left: 250px; /* Adjust the margin to match the width of your sidebar */
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

        #pieChart {
            max-width: 100%;
            height: auto;
            margin: 10px;
        }

        table {
    margin-top: 10px; /* Adjusted margin */
    border-collapse: collapse;
    width: 100%;
    background-color: #fff;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px; /* Added margin-bottom for spacing */
}

th, td {
    padding: 10px; /* Reduced padding */
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

.archive-button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 5px;
        }

        .archive-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="adminOffice.php">Manage Responses</a>
        <a href="feedbacks.php">Collect Feedbacks and Comments</a>
        <a href="surveyQuestionnaire.php">Manage Questionnaires</a>
        <a href="archives.php">Archives</a>
    </div>

    <div class="content">
        <h2>Survey Responses</h2>

        <?php
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
        $sql = "SELECT * FROM survey_responses";
        $result = $conn->query($sql);

        // Display the table if there are rows in the result
        // Display the table if there are rows in the result
if ($result->num_rows > 0) {
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Question 1</th>';
    echo '<th>Question 2</th>';
    echo '<th>Question 3</th>'; // Add this line for question3
    echo '<th>Question 4</th>'; // Add this line for question4
    echo '<th>Question 5</th>'; // Add this line for question5
    echo '<th>Question 6</th>'; // Add this line for question6
    echo '<th>Question 7</th>'; // Add this line for question7
    echo '<th>Question 8</th>'; // Add this line for question8
    echo '<th>Question 9</th>'; // Add this line for question9
    echo '<th>Feedback</th>';
    echo '<th>Created At</th>';
    echo '<th>Office Type</th>';
    echo '<th>Action</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row["id"] . '</td>';
        echo '<td>' . $row["question1"] . '</td>';
        echo '<td>' . $row["question2"] . '</td>';
        echo '<td>' . $row["question3"] . '</td>';
        echo '<td>' . $row["question4"] . '</td>';
        echo '<td>' . $row["question5"] . '</td>';
        echo '<td>' . $row["question6"] . '</td>';
        echo '<td>' . $row["question7"] . '</td>';
        echo '<td>' . $row["question8"] . '</td>';
        echo '<td>' . $row["question9"] . '</td>';
        // Add more cells for other questions as needed
        echo '<td>' . $row["feedback"] . '</td>';
        echo '<td>' . $row["created_at"] . '</td>';
        echo '<td>' . $row["office_type"] . '</td>';
        echo '<td><button class="archive-button" onclick="archiveResponse(' . $row["id"] . ')">Archive</button></td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo 'No survey responses found.';
}


        $conn->close();
        ?>

        <button class="logout-button" onclick="logout()">Logout</button>
    </div>

    <script>
        // Your existing functions here (e.g., archiveResponses)
        function archiveResponse(responseId) {
            // Display a confirmation dialog
            var confirmArchive = window.confirm("Are you sure you want to archive this response?");

            // If the user clicks OK in the confirmation dialog, proceed with archiving
            if (confirmArchive) {
                // Send an AJAX request to the PHP script to handle the archiving
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // Handle the response from the server, if needed
                        alert(this.responseText);
                        // You can reload the page or update the UI as needed
                    }
                };
                xhttp.open("GET", "archive_response.php?responseId=" + responseId, true);
                xhttp.send();
            }
        }
        function logout() {
    // Display a confirmation dialog
    var confirmLogout = window.confirm("Are you sure you want to log out?");

    // If the user clicks OK in the confirmation dialog, proceed with logout
    if (confirmLogout) {
        // Redirect to the new page (e.g., logout.php)
        window.location.href = 'admin.php';
    }
}
    </script>
</body>
</html>
