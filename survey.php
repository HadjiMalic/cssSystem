<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <title>Survey Form</title>
       <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            text-align: center;
            background-image: url('images/ustpalter.png');
           background-size: cover; 
        }
        h1 {
            font-size: 32px;
            color: #333;
            margin: 20px 0;
        }
        .user-type-card {
            width: 80%;
            margin: 20px auto;
            display: flex;
            justify-content: space-around;
        }
        .user-type-option {
            margin: 10px;
        }
        .submitButton:hover
         {
            background-color: green;
        }
        .modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    z-index: 1;
    backdrop-filter: blur(5px);
    transition: opacity 0.3s, visibility 0.3s;
}
.modal-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    max-width: 600px;
    margin: auto;
    text-align: center;
    padding: 20px;
    transition: transform 0.3s ease-in-out;
}
/* Add these styles for the backdrop overlay */
.modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1;
    transition: opacity 0.3s, visibility 0.3s;
}
/* Add styles for the "Continue" button */
.continue-button,
.cancel-button {
    transition: background-color 0.3s, transform 0.3s;
}
.modal-open .modal {
    pointer-events: none;
}
.modal-open .modal-content {
    pointer-events: auto;
}
/* Add these styles for the backdrop overlay */
.blur {
            filter: blur(4px);
            pointer-events: none; /* Disable interactions on the blurred survey */
            transition: filter 0.3s, pointer-events 0.3s;

        }
        /* Add these styles for the backdrop overlay */
        .modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1;
    transition: opacity 0.3s, visibility 0.3s;
}
        body.modal-open {
            overflow: hidden;
        }
        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }

        /* Add styles for the "Continue" button */
        .continue-button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s;
        }
        .continue-button:hover {
            background-color: #2980b9;
        }
        .cancel-button {
            background-color: #3498db;
            color: red;
            font-weight: 900;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        /* Style for all dropdown menus on the page */
/* Style for the dropdown menu with the class "select" */
/* Style for the dropdown menu with the class "select" */
.select {
    width: 80%; /* Set a specific width */
    max-width: 300px; /* Optionally, set a maximum width to prevent it from being too wide */
    padding: 10px;
    border: 1px solid #3498db; /* Border color for unselected state */
    border-radius: 5px;
    margin-bottom: 20px;
    background-color: #fff; /* Background color for unselected state */
    color: #333; /* Text color for unselected state */
}

/* Style for dropdown options */
.select option {
    padding: 10px;
    background-color: #fff;
}

/* Style for the selected option */
.select:focus {
    outline: none;
    border-color: #2980b9; /* Highlight border color on focus */
    box-shadow: 0 0 5px rgba(52, 152, 219, 0.5); /* Add a subtle box shadow on focus */
}

/* Style for the selected option's text color */
.select option:checked {
    color: #2980b9;
}

.survey-container {
    width: 80%;
    margin: 20px auto;
    padding: 20px;
    background-color: rgba(255, 255, 255, 0.8);
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    overflow-y: auto; /* Enable scrolling for the survey form if needed */
    max-height: calc(100vh - 40px); /* Adjust the max height based on your needs */
}

/* Add a new class for the blurred effect */
.survey-container.blur {
    filter: blur(4px);
    pointer-events: none; /* Disable interactions on the blurred survey */
}

/* Add a class to apply the blurred effect to the survey */
.blur .survey-container {
    filter: blur(4px);
    pointer-events: none; /* Disable interactions on the blurred survey */
}
.radio-container {
        @apply relative cursor-pointer;
        @apply user-select-none;
    }

    .radio-container input {
        @apply absolute opacity-0 cursor-pointer;
    }

    .custom-radio {
        @apply absolute top-0 left-0 h-8 w-8 bg-white border-2 border-blue-500 rounded-full;
    }

    .number {
        @apply absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-white font-bold;
    }

    .radio-container input:checked + .custom-radio {
        @apply bg-blue-500;
        @apply border-blue-500;
    }
</style>
</head>

<body class="bg-gray-100">
<div id="myModal" class="modal">
<div class="modal-content bg-white p-8 rounded-lg shadow-lg max-w-screen-md mx-auto">
        <span class="close" onclick="closeModal()">&times;</span>
        <h1 class="text-3xl font-bold mb-6 text-blue-800">Instructions & Guidelines</h1>
<p class="text-lg text-gray-700 mb-4">
    This Client Satisfaction Survey Measurement (CSM) tracks the customer experience of the government offices. Your feedback on your <u class="text-blue-600">recently concluded transaction</u> will help this office provide a better service. Personal information shared will be kept confidential.
</p>
<p class="text-base text-gray-700 mb-2">
    <span class="font-semibold">INSTRUCTIONS:</span>
    <ol class="list-decimal pl-4 mt-2">
        <li>Select first an office that you want before taking the survey.</li>
        <li>Please answer all the nine questions in the given form.</li>
        <li>You can freely leave any comments or violent reactions about your latest transaction in the feedback box below. It's an optional.</li>
    </ol>
</p>
<p class="text-base italic text-gray-700">
    Please take note that the system will not submit the form if there's any question that is left unanswered.
</p>


        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300" onclick="closeModal()">Continue</button>

<button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-300" onclick="cancelSurvey()">Cancel</button>
    </div>
</div>
<!-- Your survey content goes here -->
    <h1 class="text-2xl font-bold mb-6">Survey Form</h1>
<!-- Add this code where you want the dropdown menu to appear in your form -->
<label for="office_type" class="block text-gray-700 mb-2" ></label>
<div class="relative">
    <select id="office_type" name="office_type" class="select w-full border-2 border-gray-300 rounded-md p-2 focus:outline-none focus:border-blue-500">
        <option value="" disabled selected>Choose an Office HERE!!!</option>
        <option value="Guidance">Guidance</option>
        <option value="ICT">ICT</option>
        <option value="Accreditation">Accreditation</option>
        <option value="Admin">Admin</option>
        <option value="Registrar">Registrar</option>
    </select>
    <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
        <!-- You can add an icon or other elements here if needed -->
    </div>
</div>
<form action="process_form.php" method="post" onsubmit="return validateForm()">
        <!-- The rest of your form remains unchanged -->
   <div class="container mx-auto mt-8 bg-blue-100 p-8 rounded-lg shadow-lg max-w-screen-lg">
    <h1 class="text-2xl font-bold mb-6">Service Quality Survey</h1>
    <div class="overflow-x-auto mt-8 mb-0 rounded-lg">
    <table class="w-full table-auto bg-white border border-gray-300 shadow-md rounded-md divide-y divide-gray-300">
    <thead>
            <tr>
                    <th class="p-3 bg-blue-800 text-white border">Service Quality Dimensions</th>
                    <th class="p-3 bg-green-700 text-white border">Strongly Agree</th>
                    <th class="p-3 bg-green-500 text-white border">Agree</th>
                    <th class="p-3 bg-yellow-500 text-white border">Neutral</th>
                    <th class="p-3 bg-red-500 text-white border">Disagree</th>
                    <th class="p-3 bg-red-700 text-white border">Strongly Disagree</th>
                    <th class="p-3 bg-gray-500 text-white border">Not Applicable</th>
                </tr>
            </thead>
<tr>
<?php

// Assuming you have a database connection
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

// Check if there are questions
if ($result->num_rows > 0) {
    // Output the questions in a form
    echo '<form action="submit_survey.php" method="post">';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td class="p-4 border">' . $row['question_text'] . '</td>';
        // Output radio options
        for ($i = 5; $i >= 1; $i--) {
            echo '<td class="p-4 border">';
            echo '<div class="radio-container">';
            echo '<input type="radio" id="q' . $row['question_id'] . '_' . $i . '" name="question' . $row['question_id'] . '" value="' . $i . '">';
            echo '<div class="custom-radio"></div>';
            echo '<label for="q' . $row['question_id'] . '_' . $i . '" class="number">' . $i . '</label>';
            echo '</div>';
            echo '</td>';
        }
        // Additional option for "NA"
        echo '<td class="p-4 border">';
        echo '<div class="radio-container">';
        echo '<input type="radio" id="q' . $row['question_id'] . '_na" name="question' . $row['question_id'] . '" value="NA">';
        echo '<div class="custom-radio"></div>';
        echo '<label for="q' . $row['question_id'] . '_na" class="number">NA</label>';
        echo '</div>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</form>';
} else {
    echo "No questions found";
}

// Close the database connection
$conn->close();
?>
</table>     
<div class="p-6 bg-gradient-to-r from-purple-400 via-pink-200 to-blue-400 rounded-lg shadow-md">
<label for="feedback" class="block text-lg font-semibold text-gray-800 mb-2">Feedback</label>
<textarea id="feedback" name="feedback" rows="4" class="mt-1 p-2 w-full border-2 border-purple-300 rounded-md focus:outline-none focus:border-purple-500 bg-white text-gray-700" placeholder="Do you have any comments or violent reactions regarding your transaction? Feel free to write."></textarea>
</div>
<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300" type="submit">Submit</button>
</form>
<script>
// Declare the modal variable globally
    const modal = document.getElementById('myModal');
    // Close the modal
    function closeModal() {
        modal.style.display = 'none';

        // Remove the modal-open class from the body
        document.body.classList.remove('modal-open');
    }

    // Open the modal when the page loads
    window.onload = function () {
        modal.style.display = 'block';

        // Add the modal-open class to the body
        document.body.classList.add('modal-open');
    };

    window.onload = function () {
    openModal();
};

// Open the modal
function openModal() {
            modal.style.display = 'block';
            document.body.classList.add('modal-open');
            document.querySelector('.survey-container').classList.add('blur'); // Apply the blurred effect
        }

        // Close the modal
        function closeModal() {
            modal.style.display = 'none';
            document.body.classList.remove('modal-open');
            document.querySelector('.survey-container').classList.remove('blur'); // Remove the blurred effect
        }
        function cancelSurvey() {
    // Redirect the user to index.php
    window.location.href = 'index.php';
}


        // Function to remove the blurred effect when "Continue" is clicked
        function removeBlur() {
            document.querySelector('.survey-container').classList.remove('blur');
        }

        // Add an event listener to close the modal when clicking on the backdrop overlay
        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                closeModal();
            }
        });

    function validateForm() {
        // Check if any radio button is not selected for each question
        const questions = ['question1', 'question2', 'question3', 'question4', 'question5', 'question6', 'question7', 'question8', 'question9'];

        // Create an object to store the selected values for each question
        const selectedValues = {};

        for (const question of questions) {
            const selectedRadio = document.querySelector(`input[name="${question}"]:checked`);

            if (!selectedRadio) {
                alert(`Please answer question ${question.substring(8)}.`);
                return false; // Prevent form submission
            }

            // Store the selected value in the object
            selectedValues[question] = selectedRadio.value;
        }

        const officeType = document.getElementById('office_type').value;

        // Check if the office type is selected
        if (!officeType) {
            alert("Please select the designated office type.");
            return false; // Prevent form submission
        }

        // Create FormData object
        const formData = new FormData();

        // Append the selected values for each question
        for (const [question, value] of Object.entries(selectedValues)) {
            formData.append(question, value);
        }

        // Append the office_type value
        formData.append('office_type', officeType);

        const feedback = document.getElementById('feedback').value;

        // Append the feedback value to the FormData object
        formData.append('feedback', feedback);

        // Ask for confirmation before submitting the form
        const isConfirmed = confirm("Are you sure you want to submit?");

        if (!isConfirmed) {
            return false; // Prevent form submission
        }
        if (isConfirmed){
            alert("Form submitted successfully");
        }


        // Continue with form submission

        // You may want to replace this with actual form submission logic
        // For example, using fetch() to send the form data to the server
        // Replace 'process_form.php' with the actual server-side processing script
        // You can adjust the URL and other options based on your server setup
        fetch('process_form.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => {
            // Handle the response from the server if needed
            console.log(response);
        })
        .catch(error => {
            console.error('Error:', error);
        });

        

        return true;
    }
</script>
