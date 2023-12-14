<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Form</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            text-align: center;
            background-image: url('images/ustp.jpg');
            background-size: cover;
            background-repeat: no-repeat;
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

        .app-table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .app-table th,
        .app-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .app-table th {
            background-color: #3498db;
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .app-table td input[type="radio"] {
            display: none;
        }

        .app-table td .radio-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .app-table td label {
            display: inline-block;
            width: 30px;
            height: 30px;
            border: 1px solid #ddd;
            border-radius: 50%;
            text-align: center;
            line-height: 30px;
            cursor: pointer;
            margin-right: 5px;
        }

            /* Add these styles for the background colors */
            .app-table th:nth-child(2) { background-color: #45a049; color: white; } /* Strongly Agree */
        .app-table th:nth-child(3) { background-color: #4CAF50; color: white; } /* Agree */
        .app-table th:nth-child(4) { background-color: #f0ad4e; color: white; } /* Neutral */
        .app-table th:nth-child(5) { background-color: #d9534f; color: white; } /* Disagree */
        .app-table th:nth-child(6) { background-color: #c9302c; color: white; } /* Strongly Disagree */
        .app-table th:nth-child(7) { background-color: gray; color: white; } /* Not Applicable */


        .app-table td input[type="radio"]:checked+label {
            background-color: #2577b5;
        }

        .app-table td input[type="radio"][value="5"]:checked+label {
            background-color: #45a049;
        }

        .app-table td input[type="radio"][value="4"]:checked+label {
            background-color: #4CAF50;
        }

        .app-table td input[type="radio"][value="3"]:checked+label {
            background-color: #f0ad4e;
        }

        .app-table td input[type="radio"][value="2"]:checked+label {
            background-color: #d9534f;
        }

        .app-table td input[type="radio"][value="1"]:checked+label {
            background-color: #c9302c;
        }

        .app-table td input[type="radio"][value="NA"]:checked+label {
            background-color: gray;
        }

        .app-table td .number {
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            color: #333;
            font-weight: bold;
        }

        .submitButton
         {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px 10px;
            transition: background-color 0.3s;
        }

        .back-button {
            background-color: red;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px 10px;
            transition: background-color 0.3s;
            
        }

        .submitButton:hover
         {
            background-color: green;
        }
        
        .back-button:hover{

            background-color: cr;
        }

        .feedback-box {
    width: 100%;
    max-width: 600px; /* Adjust as needed */
    margin: 20px auto;
    text-align: left;
    padding: 20px;
    border-radius: 10px;
    background-color: aqua;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    margin-bottom: 20px;
}


.feedback-box label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
  
}

.feedback-box textarea {
    width: 98%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    resize: vertical;
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
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            max-width: 600px;
            margin: auto;
            text-align: center;
            padding: 20px;
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
</style>


</head>

<body>
    <h1>Survey Form</h1>
   
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Instructions and Guidelines</h2>
            <p>This Client Satisfaction Survey Measurement (CSM) tracks the customer experience of the government offices. Your feedback on your <u>recently concluded transaction</u> will help this office provide a better service. Personal information shared will be kept confidential.</p>
            <p>INSTRUCTIONS: Please answer all of the 9 questions provided by the survey by rating from the highest number to the lowest. Please be guided accordingly.</p>
            <button class="continue-button" onclick="closeModal()">Continue</button>
        </div>
    </div>

<!-- Add this code where you want the dropdown menu to appear in your form -->
<label for="office_type">Select Office:</label>
<select id="office_type" name="office_type" class="select">
<option value="" disabled selected>Select Office</option>

 <option value="Guidance">Guidance</option>
    <option value="ICT">ICT</option>
    <option value="Accreditation">Accreditation</option>
    <option value="Admin">Admin</option>
    <option value="Registrar">Registrar</option>
</select>


    <form action="process_form.php" method="post" onsubmit="return validateForm()">
    
        <!-- The rest of your form remains unchanged -->

        <table class="app-table">
            <tr>
                <th>Service Quality Dimensions</th>
                <th>Strongly Agree</th>
                <th>Agree</th>
                <th>Neutral</th>
                <th>Disagree</th>
                <th>Strongly Disagree</th>
                <th>Not Applicable</th>
            </tr>
            <tr>
                <td>1. I am satisfied with the services that I availed.</td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q1_1" name="question1" value="5">
                        <label for="q1_1" class="number">5</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q1_2" name="question1" value="4">
                        <label for="q1_2" class="number">4</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q1_3" name="question1" value="3">
                        <label for="q1_3" class="number">3</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q1_4" name="question1" value="2">
                        <label for="q1_4" class="number">2</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q1_5" name="question1" value="1">
                        <label for="q1_5" class="number">1</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q1_na" name="question1" value="NA">
                        <label for="q1_na" class="number">NA</label>
                    </div>
                </td>
            </tr>
            <tr>
            <tr>
                <td>2. I spent a reasonable time amount of my transaction.</td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q2_1" name="question2" value="5">
                        <label for="q2_1" class="number">5</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q2_2" name="question2" value="4">
                        <label for="q2_2" class="number">4</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q2_3" name="question2" value="3">
                        <label for="q2_3" class="number">3</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q2_4" name="question2" value="2">
                        <label for="q2_4" class="number">2</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q2_5" name="question2" value="1">
                        <label for="q2_5" class="number">1</label>
                    </div>
                </td>
                <td>
                <div class="radio-container">
                        <input type="radio" id="q2_na" name="question2" value="NA">
                        <label for="q2_na" class="number">NA</label>
                    </div>

                </td>
            </tr>
            <tr>
                <td>3. The office followed the transaction's requirements and steps based on the information provided.</td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q3_1" name="question3" value="5">
                        <label for="q3_1" class="number">5</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q3_2" name="question3" value="4">
                        <label for="q3_2" class="number">4</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q3_3" name="question3" value="3">
                        <label for="q3_3" class="number">3</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q3_4" name="question3" value="2">
                        <label for="q3_4" class="number">2</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q3_5" name="question3" value="1">
                        <label for="q3_5" class="number">1</label>
                    </div>
                </td>
                <td>
                <div class="radio-container">
                        <input type="radio" id="q3_na" name="question3" value="NA">
                        <label for="q3_na" class="number">NA</label>
                    </div>

                </td>
            </tr>
                
            </tr>
            <tr>
                <td>4. The steps (including paymen)t I needed to do for my transaction were easy and simple</td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q4_1" name="question4" value="5">
                        <label for="q4_1" class="number">5</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q4_2" name="question4" value="4">
                        <label for="q4_2" class="number">4</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q4_3" name="question4" value="3">
                        <label for="q4_3" class="number">3</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q4_4" name="question4" value="2">
                        <label for="q4_4" class="number">2</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q4_5" name="question4" value="1">
                        <label for="q4_5" class="number">1</label>
                    </div>
                </td>
                <td>
                <div class="radio-container">
                        <input type="radio" id="q4_na" name="question4" value="NA">
                        <label for="q4_na" class="number">NA</label>
                    </div>

                </td>
            </tr>
            </tr>
            <tr>
                <td>5. I easily found information about my transaction from the office or it's website</td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q5_1" name="question5" value="5">
                        <label for="q5_1" class="number">5</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q5_2" name="question5" value="4">
                        <label for="q5_2" class="number">4</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q5_3" name="question5" value="3">
                        <label for="q5_3" class="number">3</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q5_4" name="question5" value="2">
                        <label for="q5_4" class="number">2</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q5_5" name="question5" value="1">
                        <label for="q5_5" class="number">1</label>
                    </div>
                </td>
                <td>
                <div class="radio-container">
                        <input type="radio" id="q5_na" name="question5" value="NA">
                        <label for="q5_na" class="number">NA</label>
                    </div>

                </td>
            </tr>
            </tr>
            <tr>
                <td>6. I paid a reasonable amount of fees for my transaction.</td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q6_1" name="question6" value="5">
                        <label for="q6_1" class="number">5</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q6_2" name="question6" value="4">
                        <label for="q6_2" class="number">4</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q6_3" name="question6" value="3">
                        <label for="q6_3" class="number">3</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q6_4" name="question6" value="2">
                        <label for="q6_4" class="number">2</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q6_5" name="question6" value="1">
                        <label for="q6_5" class="number">1</label>
                    </div>
                </td>
                <td>
                <div class="radio-container">
                        <input type="radio" id="q6_na" name="question6" value="NA">
                        <label for="q6_na" class="number">NA</label>
                    </div>

                </td>
            </tr>
            </tr>
            <tr>
                <td>7. I feel the office was fair to everyone or "walang palakasan", during my transaction</td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q7_1" name="question7" value="5">
                        <label for="q7_1" class="number">5</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q7_2" name="question7" value="4">
                        <label for="q7_2" class="number">4</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q7_3" name="question7" value="3">
                        <label for="q7_3" class="number">3</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q7_4" name="question7" value="2">
                        <label for="q7_4" class="number">2</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q7_5" name="question7" value="1">
                        <label for="q7_5" class="number">1</label>
                    </div>

                </td>
                <td>
                <div class="radio-container">
                        <input type="radio" id="q7_na" name="question7" value="NA">
                        <label for="q7_na" class="number">NA</label>
                    </div>

                </td>
            </tr>
            </tr>
            <td>8. I was treated courteously by the staff and (if asked for help) the staff was helpful</td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q8_1" name="question8" value="5">
                        <label for="q8_1" class="number">5</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q8_2" name="question8" value="4">
                        <label for="q8_2" class="number">4</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q8_3" name="question8" value="3">
                        <label for="q8_3" class="number">3</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q8_4" name="question8" value="2">
                        <label for="q8_4" class="number">2</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q8_5" name="question8" value="1">
                        <label for="q8_5" class="number">1</label>
                    </div>
                </td>
                <td>
                <div class="radio-container">
                        <input type="radio" id="q8_na" name="question8" value="NA">
                        <label for="q8_na" class="number">NA</label>
                    </div>

                </td>
            </tr>
            </tr>
            <td>9. I got what I needed from the government office, or (if got denied) denial of the request was successfully explained it to me</td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q9_1" name="question9" value="5">
                        <label for="q9_1" class="number">5</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q9_2" name="question9" value="4">
                        <label for="q9_2" class="number">4</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q9_3" name="question9" value="3">
                        <label for="q9_3" class="number">3</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q9_4" name="question9" value="2">
                        <label for="q9_4" class="number">2</label>
                    </div>
                </td>
                <td>
                    <div class="radio-container">
                        <input type="radio" id="q9_5" name="question9" value="1">
                        <label for="q9_5" class="number">1</label>
                    </div>
                </td>
                <td>
                <div class="radio-container">
                        <input type="radio" id="q9_na" name="question9" value="NA">
                        <label for="q9_na" class="number">NA</label>
                    </div>

                </td>
            </tr>
            </tr>
            
        </table>
        <div class="feedback-box">
            <label for="feedback">Do you have any additional comments or feedback?</label>
            <textarea id="feedback" name="feedback" rows="4" placeholder="Type your feedback here..." ></textarea>
        </div>
        <button class="submitButton" type="submit">Submit</button>
        </form>
        <button class="back-button" onclick="goBack()">Back</button>

        <script>
    // JavaScript function to go back
    function goBack() {
        window.location.href = 'index.php'; // Change 'index.php' to the actual URL you want to redirect to
    }

    // Close the modal
    function closeModal() {
        const modal = document.getElementById('myModal');
        modal.style.display = 'none';
    }

    // Get the modal element
    const modal = document.getElementById('myModal');

    // Open the modal when the page loads
    window.onload = function () {
        modal.style.display = 'block';
        
    };

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
            alert("Please select the office type.");
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

        // Display success message (optional)
        alert("Survey submitted successfully!");

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