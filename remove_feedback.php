<?php
// Check if the feedbackId parameter is set
if (isset($_GET['feedbackId'])) {
    // Your database connection code (replace with your actual details)
    $servername = "localhost";
    $dbusername = "username";
    $dbpassword = "password";
    $dbname = "css_system";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize the input
    $feedbackId = mysqli_real_escape_string($conn, $_GET['feedbackId']);

    // Perform the SQL query to remove feedback
    $sql = "DELETE FROM survey_responses WHERE id = $feedbackId";

    if ($conn->query($sql) === TRUE) {
        echo "Feedback removed successfully";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
} else {
    echo "FeedbackId parameter not set";
}
?>
