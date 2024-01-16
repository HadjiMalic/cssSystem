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

// Check if the ID is set in the POST request
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // SQL statement to delete the record with the specified ID
    $sql = "DELETE FROM surveys_archive WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid request";
}

$conn->close();
?>
