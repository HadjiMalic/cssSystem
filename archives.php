<!DOCTYPE php>
<php>
<head>
    <title>Home</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url(images/ustp.jpg);
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

        .navbar select,
        .navbar button {
            padding: 10px;
            font-size: 16px;
            margin-right: 10px;
        }

        .box {
            background-color: rgba(255, 255, 255, 0.2);
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
        <div class="navbar">
            <!-- Your filter options here -->
            <select id="filterMonth">
                <option value="">Select Month</option>
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April </option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
                <!-- Add more months here -->
            </select>
            <select id="filterYear">
                <option value="">Select Year</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
                <option value="2022">2022</option>
                <!-- Add more years here -->
            </select>
            <select id="filterType">
                <option value="">Select Type</option>
                <option value="Guidance Office">Guidance Office</option>
                <option value="ICT Office">ICT Office</option>
                <option value="Accreditation Office">Accreditation Office</option>
                <option value="Admin Office">Admin Office</option>
                <option value="Registrar">Registrar</option>
            </select>
           
            <button id="generateButton" onclick="generatePieChart">Generate Pie Graph</button>
        </div>

        <!-- Your survey response content here -->
        <div class="box">
            <h1>Survey Response 1</h1>
        </div>
        <div class="box">
            <h2>Survey Response 2</h2>
        </div>

        
        <canvas id="pieChart" width="200" height="100"></canvas>

        <button class="logout-button" onclick="logout()">Logout</button>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data for the pie chart (example data)
        const pieChartData = {
            labels: ['Strongly Agree', 'Agree', 'Neutral' , 'Disagree' , 'Strongly Disagree'],
            datasets: [{
                data: [10, 10, 30, 10, 10], // Replace with your data
                backgroundColor: ['green', 'aqua', 'white' , 'red' , 'black'], // Colors for the segments
            }]
        };

        const pieChartOptions = {
            responsive: true,
        };

        // Function to generate the pie chart
        function generatePieChart() {
            const pieChartCanvas = document.getElementById('pieChart').getContext('2d');
            new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieChartData,
                options: pieChartOptions,
                
            });
        }

        // Add a click event to the "Generate" button
        document.getElementById('generateButton').addEventListener('click', generatePieChart);

        // Your existing functions here (e.g., archiveResponses)

        function archiveResponses() {
            alert("Responses has been archived.")
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
</php>
