<?php
// archive_response.php

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

// Get the response ID from the AJAX request
$responseId = $_GET['responseId'];

// Fetch the response data from the survey_responses table
$sql = "SELECT * FROM survey_responses WHERE id = $responseId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Insert the response data into the surveys_archive table
    $row = $result->fetch_assoc();
    $insertSql = "INSERT INTO surveys_archive (id, question1, question2, question3, question4, question5, question6, question7, question8, question9, feedback, created_at, office_type) 
                  VALUES ('$row[id]', '$row[question1]', '$row[question2]', '$row[question3]', '$row[question4]', '$row[question5]', '$row[question6]', '$row[question7]', '$row[question8]', '$row[question9]', '$row[feedback]', '$row[created_at]', '$row[office_type]')";
    
    if ($conn->query($insertSql) === TRUE) {
        // Delete the response from the survey_responses table
        $deleteSql = "DELETE FROM survey_responses WHERE id = $responseId";
        if ($conn->query($deleteSql) === TRUE) {
            echo "Response archived successfully.";
        } else {
            echo "Error deleting response: " . $conn->error;
        }
    } else {
        echo "Error archiving response: " . $conn->error;
    }
} else {
    echo "Response not found.";
}
$conn->close();

?>
