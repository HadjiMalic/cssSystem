<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(./images/ustp.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h1 {
            font-size: 36px;
            color: blue;
            margin: 20px 0;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 50px;
            margin: 20px auto;
            width: 20%;
        }

        .login-input {
            width: 100%;
            padding: 15px;
            margin: 15px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .login-input:focus {
            background-color: #f2f2f2;
        }

        .login-button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 15px 20px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-button:hover {
            background-color: #2577b5;
        }

        .back-button {
            background-color: red;
            color: #fff;
            border: none;
            padding: 15px 20px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: red;
        }
    </style>
</head>

<body>
    <br><br>
    <h1>Admin Login</h1>
    <br><br>
    <div class="login-container">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];

            // Replace these with your actual database credentials
            $servername = "localhost";
            $dbusername = "root";
            $dbpassword = "";
            $dbname = "css_system";

            // Create connection
            $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // SQL query to fetch admin credentials
            $sql = "SELECT * FROM administrators WHERE username = '$username' AND password = '$password'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Valid admin credentials, redirect to the dashboard
                header("Location: adminDashboard.php");
                exit();
            } else {
                // Invalid credentials, show an error message
                echo "<p style='color: red;'>Invalid username or password.</p>";
            }

            $conn->close();
        }
        ?>
        <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" class="login-input" name="username" placeholder="Username" required>
            <input type="password" class="login-input" name="password" placeholder="Password" required>
            <button class="login-button" type="submit">Login</button>
            <button class="back-button" onclick="goBack()">Back</button>
        </form>
    </div>
    <script>
        function goBack() {
            window.location.href = "index.php"; // Redirect to the index.html page
        }
    </script>
</body>

</html>
