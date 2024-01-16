<!DOCTYPE php>
<php>
<head>
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
        .box {
            background-color: rgba(255, 255, 255, 0.2);
            border-style: ridge;
            padding: 100px;
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
        .bg-cover {
            background-size: cover;
        }

        .text-blue-800 {
            color: #1a365d;
        }

       
        .hover\:bg-blue-700:hover {
            background-color: #0056b3;
        }

        .border-blue-800 {
            border-color: #1a365d;
        }

        .text-white {
            color: #fff;
        }

        .bg-red-700 {
            background-color: #ff0000;
        }

        .hover\:bg-red-800:hover {
            background-color: #cc0000;
        }

        .w-40 {
            width: 10rem;
        }
    </style>
</head>
<body class="bg-cover">
    <div class="sidebar bg-blue-500 text-white">
        <a href="adminOffice.php" class="py-3">Manage Responses</a>
        <a href="feedbacks.php" class="py-3">Collect Feedbacks and Comments</a>
        <a href="surveyQuestionnaire.php" class="py-3">Manage Questionnaires</a>
        <a href="archives.php" class="py-3">Archives</a>
    </div>
    <div class="content ml-64 p-4">
        <!-- Display counter for survey responses -->
        <div class="counter-box bg-white bg-opacity-50 border-2 border-blue-800 rounded p-4">
            <h2 class="text-blue-800">Users Response:</h2>
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

            // Fetch count of users who responded
            $sqlCount = "SELECT COUNT(DISTINCT id) AS userCount FROM survey_responses";
            $resultCount = $conn->query($sqlCount);
            
            if ($resultCount && $resultCount->num_rows > 0) {
                $row = $resultCount->fetch_assoc();
                echo '<h1 class="text-3xl font-bold">' . $row['userCount'] . '</h1>';
            } else {
                echo '<p>No responses found.</p>';
            }

            $conn->close();
            ?>
        </div>

        <button class="logout-button bg-red-700 text-white hover:bg-red-800 px-4 py-2 rounded mt-4" onclick="confirmLogout()">Logout</button>

        <script>
            function confirmLogout() {
                var confirmLogout = confirm("Are you sure you want to log out?");
                if (confirmLogout) {
                    logout();
                } else {
                    // If the user clicks "Cancel," do nothing
                    // You can add additional actions here if needed
                }
            }

            function logout() {
                window.location.href = 'admin.php';
            }
        </script>
    </div>
</body>
</php>