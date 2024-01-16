<!DOCTYPE php>
<php>
<head>
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url(images/ustpalter.png);
            background-repeat: no-repeat;
            background-size: cover;
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
            margin-left: 270px;
            padding: 20px;
        }

        .navbar {
            background-color: #007bff;
            color: white;
            padding: 15px;
        }

        div {
            text-align: center;
        }

        /* Style for the boxes */

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
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
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
        <button class="logout-button" onclick="logout()">Logout</button>

        <!-- Display data in a table -->
        <?php
            // Your database connection code (replace with your actual details)
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "css_system";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch data from the survey_responses table
            $sql = "SELECT id, feedback, office_type, created_at FROM survey_responses WHERE feedback IS NOT NULL AND feedback <> ''";
            $result = $conn->query($sql);

            // Display the table if there are rows in the result
            if ($result->num_rows > 0) {
                echo '<table class="w-full border-collapse mt-20 bg-white">';
                echo '<thead>';
                echo '<tr>';
                echo '<th class="border py-2 px-2 bg-blue-800 text-white">Feedback</th>';
                echo '<th class="border py-2 px-2 bg-blue-800 text-white">Office Type</th>';
                echo '<th class="border py-2 px-2 bg-blue-800 text-white">Date Created</th>';
                echo '<th class="border py-2 px-2 bg-blue-800 text-white">Action</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td class="border ml-2">' . $row["feedback"] . '</td>';
                    echo '<td class="border ml-2">' . $row["office_type"] . '</td>';
                    echo '<td class="border ml-2">' . $row["created_at"] . '</td>';
                    echo '<td class="border ml-2">';
                    echo '<button class="remove-feedback-button bg-red-500 text-white px-2 py-1 rounded transition duration-300" onclick="removeFeedback(' . $row["id"] . ')">';
                    echo 'Remove';
                    echo '</button>';
                    echo '</td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
            } else {
                echo 'No survey responses found with feedback.';
            }

            $conn->close();
        ?>
    </div>

    <script>
        // Your existing JavaScript functions here
        function logout() {
            // Display a confirmation dialog
            var confirmLogout = window.confirm("Are you sure you want to log out?");

            // If the user clicks OK in the confirmation dialog, proceed with logout
            if (confirmLogout) {
                // Redirect to the new page (e.g., logout.php)
                window.location.href = 'admin.php';
            }
        }
        function removeFeedback(feedbackId) {
                // Display a confirmation dialog
                var confirmRemove = window.confirm("Are you sure you want to remove this feedback?");

                // If the user clicks OK in the confirmation dialog, proceed with removal
                if (confirmRemove) {
                    // Send an AJAX request to the PHP script to handle the removal
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function () {
                        if (this.readyState == 4) {
                            if (this.status == 200) {
                                // Handle the response from the server
                                if (this.responseText.includes("Feedback removed successfully")) {
                                    // Use SweetAlert to show a success message
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Feedback removed successfully!',
                                    }).then(function () {
                                        // Reload the page after the SweetAlert is closed
                                        location.reload();
                                    });
                                } else {
                                    // If there's an error, show an alert
                                    alert("Error removing feedback: " + this.responseText);
                                }
                            } else {
                                // Handle the case where the request failed
                                alert("Error removing feedback.");
                            }
                        }
                    };
                    xhttp.open("GET", "remove_feedback.php?feedbackId=" + feedbackId, true);
                    xhttp.send();
                }
            }
    </script>
</body>
</html>