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
    <div class="box">
        <h1>This content box will display several Feedbacks.</h1>
        
    </div>
  
<script>
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
