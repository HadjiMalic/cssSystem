<?php
// Start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have validated and sanitized the input
    $office_type = $_POST['office_type'];
    $question1 = $_POST['question1'];
    $question2 = $_POST['question2'];
    $question3 = $_POST['question3'];
    $question4 = $_POST['question4'];
    $question5 = $_POST['question5'];
    $question6 = $_POST['question6'];
    $question7 = $_POST['question7'];
    $question8 = $_POST['question8'];
    $question9 = $_POST['question9'];
    $feedback = $_POST['feedback'];

    // Insert the survey responses into your table, including the office type and questions
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "css_system";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the same data already exists
    $checkSql = "SELECT * FROM survey_responses WHERE office_type = '$office_type' AND question1 = '$question1' AND question2 = '$question2' AND question3 = '$question3' AND question4 = '$question4' AND question5 = '$question5' AND question6 = '$question6' AND question7 = '$question7' AND question8 = '$question8' AND question9 = '$question9' AND feedback = '$feedback'";

    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {
        // Data already exists, you can update the existing record or handle it accordingly
        echo "Data already exists.";
    } else {
        // Check if office_type is not empty before inserting
        if (!empty($office_type)) {
            // Data doesn't exist, insert into the table
            $insertSql = "INSERT INTO survey_responses (question1, question2, question3, question4, question5, question6, question7, question8, question9, feedback, office_type)
                VALUES ('$question1', '$question2', '$question3', '$question4', '$question5', '$question6', '$question7', '$question8', '$question9', '$feedback', '$office_type')";

            if ($conn->query($insertSql) === TRUE) {
                echo "Survey response submitted successfully.";
            } else {
                echo "Error: " . $insertSql . "<br>" . $conn->error;
            }
        } else {
            echo "Error: office_type cannot be empty.";
        }
    }

    $conn->close();

    // Mark the form as submitted
    $_SESSION['form_submitted'] = true;

    // Redirect after the database operations are complete
    header("Location: survey.php");
    exit;
}
?>
