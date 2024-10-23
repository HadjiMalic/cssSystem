<?php
session_start();

$servername = "localhost";
$dbusername = "username";
$dbpassword = "password";
$dbname = "css_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if responseId is provided
if (isset($_GET['responseId'])) {
    $responseId = $_GET['responseId'];

    // Fetch the response from survey_responses
    $sqlSelectResponse = "SELECT * FROM survey_responses WHERE id = $responseId";
    $resultSelectResponse = $conn->query($sqlSelectResponse);

    if ($resultSelectResponse->num_rows > 0) {
        // Get the response data
        $responseData = $resultSelectResponse->fetch_assoc();

        // Log the response data
        error_log(print_r($responseData, true));

        // Insert the response into surveys_archive
        $sqlInsertArchive = "INSERT INTO surveys_archives (question1, question2, question3, question4, question5, question6, question7, question8, question9, created_at, office_type)
                             VALUES ('{$responseData['question1']}', '{$responseData['question2']}', '{$responseData['question3']}', '{$responseData['question4']}', '{$responseData['question5']}',
                                     '{$responseData['question6']}', '{$responseData['question7']}', '{$responseData['question8']}', '{$responseData['question9']}', '{$responseData['created_at']}', '{$responseData['office_type']}')";

        // Log the SQL query
        error_log($sqlInsertArchive);

        if ($conn->query($sqlInsertArchive) === TRUE) {
            // If insertion into surveys_archive is successful, delete the response from survey_responses
            $sqlDeleteResponse = "DELETE FROM survey_responses WHERE id = $responseId";
            if ($conn->query($sqlDeleteResponse) === TRUE) {
                echo "Response archived successfully";
            } else {
                echo "Error deleting response: " . $conn->error;
            }
        } else {
            echo "Error archiving response: " . $conn->error;
        }
    } else {
        echo "Response not found";
    }
} else {
    echo "Invalid parameters";
}

$conn->close();
?>
