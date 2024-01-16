<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "css_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['question_id']) && isset($_POST['question_text'])) {
    $question_id = $_POST['question_id'];
    $question_text = $_POST['question_text'];

    $sql = "UPDATE survey_questions SET question_text = '$question_text' WHERE question_id = $question_id";

    if ($conn->query($sql) === TRUE) {
        echo "Question updated successfully";
    } else {
        echo "Error updating question: " . $conn->error;
    }
} else {
    echo "Invalid parameters";
}

$conn->close();
?>
