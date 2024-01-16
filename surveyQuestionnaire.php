<!DOCTYPE php>
<php>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url(images/ustpalter.png);
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

        .content-form {
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .content-form h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .question-item {
            margin: 15px 0;
        }

        .question-label {
            font-weight: bold;
        }

        .question-text {
            font-size: 16px;
        }

        .edit-button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            padding: 5px 10px;
            margin-left: 10px;
            transition: background-color 0.3s;
        }

        .edit-button:hover {
            background-color: #0056b3;
        }

        .update-button {
            background-color: blue;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            padding: 5px 10px;
            margin-left: 10px;
            transition: background-color 0.3s;
        }

        
        .cancel-button {
            background-color: red;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            padding: 5px 10px;
            margin-left: 10px;
            transition: background-color 0.3s;
        }

        .update-button:hover,
        .cancel-button:hover {
            background-color: #0056b3;
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
        <div class="content-form">


<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "css_system";


$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch questions from the database
$sql = "SELECT * FROM survey_questions";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<h2>Survey Questions</h2>';
    echo '<div class="question-container">';

    while ($row = $result->fetch_assoc()) {
        // Add an additional attribute 'data-question-id' to each question
        echo '<div class="question-item" data-question-id="' . $row['question_id'] . '">';
        echo '<span class="question-label">Question ' . $row['question_id'] . ':</span>';
        echo '<p class="question-text" id="question' . $row['question_id'] . 'Text">' . $row['question_text'] . '</p>';
        echo '<button class="edit-button" onclick="editQuestion(' . $row['question_id'] . ')">Edit</button>';
        echo '<button class="update-button" onclick="updateQuestion(' . $row['question_id'] . ')" style="display: none;">Update</button>';
        echo '<button class="cancel-button" onclick="cancelEdit(' . $row['question_id'] . ')" style="display: none;">Cancel</button>';
        echo '</div>';
    }

    echo '</div>';
} else {
    echo "No questions found";
}

$conn->close();
?>

<script>
function logout() {
    var confirmLogout = window.confirm("Are you sure you want to log out?");
    if (confirmLogout) {
        window.location.href = 'admin.php';
    }
}

function editQuestion(questionNumber) {
    const questionItem = document.querySelector(`.question-item[data-question-id="${questionNumber}"]`);
    const questionText = questionItem.querySelector('.question-text');
    const editButton = questionItem.querySelector('.edit-button');
    const updateButton = questionItem.querySelector('.update-button');
    const cancelButton = questionItem.querySelector('.cancel-button');

    questionText.contentEditable = true;
    questionText.focus();
    questionItem.classList.add('editing');
    editButton.style.display = 'none';
    updateButton.style.display = 'inline-block';
    cancelButton.style.display = 'inline-block';
}

function updateQuestion(questionNumber) {
    const questionItem = document.querySelector(`.question-item[data-question-id="${questionNumber}"]`);
    const questionText = questionItem.querySelector('.question-text');
    const editButton = questionItem.querySelector('.edit-button');
    const updateButton = questionItem.querySelector('.update-button');
    const cancelButton = questionItem.querySelector('.cancel-button');

    questionText.innerHTML = questionText.innerText;
    questionItem.classList.remove('editing');

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_question.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
        }
    };

    const params = `question_id=${questionNumber}&question_text=${encodeURIComponent(questionText.innerText)}`;
    xhr.send(params);

    editButton.style.display = 'inline-block';
    updateButton.style.display = 'none';
    cancelButton.style.display = 'none';
}

function cancelEdit(questionNumber) {
    const questionItem = document.querySelector(`.question-item[data-question-id="${questionNumber}"]`);
    const questionText = questionItem.querySelector('.question-text');
    const editButton = questionItem.querySelector('.edit-button');
    const updateButton = questionItem.querySelector('.update-button');
    const cancelButton = questionItem.querySelector('.cancel-button');

    questionText.innerText = questionText.innerHTML;
    questionItem.classList.remove('editing');

    editButton.style.display = 'inline-block';
    updateButton.style.display = 'none';
    cancelButton.style.display = 'none';
}
</script>
</div>
</div>
</body>
</html>
