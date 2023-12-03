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

        .update-button,
        .cancel-button {
            background-color: #007bff;
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
            <h2>Survey Questionnaires</h2>
            <div class="question-item">
                <span class="question-label">Question 1:</span>
                <p class="question-text" id="question1Text">What is your favorite color?</p>
                <button class="edit-button" onclick="editQuestion(1)">Edit</button>
                <button class="update-button" onclick="updateQuestion(1)" style="display: none;">Update</button>
                <button class="cancel-button" onclick="cancelEdit(1)" style="display: none;">Cancel</button>
            </div>
            <div class="question-item">
                <span class="question-label">Question 2:</span>
                <p class="question-text" id="question2Text">How satisfied are you with our service?</p>
                <button class="edit-button" onclick="editQuestion(2)">Edit</button>
                <button class="update-button" onclick="updateQuestion(2)" style="display: none;">Update</button>
                <button class="cancel-button" onclick="cancelEdit(2)" style="display: none;">Cancel</button>
            </div>
            <!-- Add more questions here -->
        </div>
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

        function editQuestion(questionNumber) {
            const questionText = document.querySelector(`#question${questionNumber}Text`);
            const editButton = document.querySelector(`.question-item:nth-child(${questionNumber}) .edit-button`);
            const updateButton = document.querySelector(`.question-item:nth-child(${questionNumber}) .update-button`);
            const cancelButton = document.querySelector(`.question-item:nth-child(${questionNumber}) .cancel-button`);
            
            questionText.contentEditable = true;
            questionText.focus();
            editButton.style.display = 'none';
            updateButton.style.display = 'inline-block';
            cancelButton.style.display = 'inline-block';
        }

        function updateQuestion(questionNumber) {
            const questionText = document.querySelector(`#question${questionNumber}Text`);
            const editButton = document.querySelector(`.question-item:nth-child(${questionNumber}) .edit-button`);
            const updateButton = document.querySelector(`.question-item:nth-child(${questionNumber}) .update-button`);
            const cancelButton = document.querySelector(`.question-item:nth-child(${questionNumber}) .cancel-button`);
            
            questionText.contentEditable = false;
            editButton.style.display = 'inline-block';
            updateButton.style.display = 'none';
            cancelButton.style.display = 'none';
        }

        function cancelEdit(questionNumber) {
            const questionText = document.querySelector(`#question${questionNumber}Text`);
            const editButton = document.querySelector(`.question-item:nth-child(${questionNumber}) .edit-button`);
            const updateButton = document.querySelector(`.question-item:nth-child(${questionNumber}) .update-button`);
            const cancelButton = document.querySelector(`.question-item:nth-child(${questionNumber}) .cancel-button`);
            
            questionText.contentEditable = false;
            editButton.style.display = 'inline-block';
            updateButton.style.display = 'none';
            cancelButton.style.display = 'none';
        }
    </script>
</body>
</php>
