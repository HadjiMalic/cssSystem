<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(./images/ustpalter.png);
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
            width: 30%;
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
    <h1 class="text-4xl text-blue-500">Admin Login</h1>
    <br><br>
    <div class="login-container bg-white bg-opacity-90 rounded-lg p-10 m-20 auto w-1/3 shadow-md">
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
                // Valid admin credentials, show SweetAlert and redirect to the dashboard
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Login Successful',
                            text: 'Welcome back, $username!',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(function() {
                            window.location.href = 'adminOffice.php';
                        });
                      </script>";
                exit();
            } else {
                // Invalid credentials, show an error message with SweetAlert
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Credentials',
                            text: 'Please check your username or password.',
                            showConfirmButton: false,
                            timer: 2000
                        });
                      </script>";
            }

            $conn->close();
        }
        ?>
          <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" class="login-input" name="username" placeholder="Username" required>
            <input type="password" class="login-input" name="password" placeholder="Password" required>

            <button class="login-button bg-blue-500 text-white hover:bg-blue-700 transition duration-300" type="submit">Login</button>
            <button class="back-button bg-red-500 text-white hover:bg-red-700 transition duration-300" onclick="goBack()">Back</button>
        </form>
    </div>
    <script>
        function goBack() {
            window.location.href = "index.php"; // Redirect to the index.html page
        }

    </script>
</body>

</html>
