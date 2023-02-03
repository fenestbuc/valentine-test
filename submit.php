<?php
    // Get the data from the form
    $comfortFood = $_POST['comfort_food'];
    $quote = $_POST['quote'];
    $webseries = $_POST['webseries'];
    $gender = $_POST['gender'];

    // Connect to the database
    $servername = "localhost";
    $username = "your_username";
    $password = "your_password";
    $dbname = "ashoka_valentines_mixer";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    // Insert the data into the database
    $sql = "INSERT INTO responses (comfort_food, quote, webseries, gender)
    VALUES ('$comfortFood', '$quote', '$webseries', '$gender')";

    if ($conn->query($sql) === TRUE) {
        echo "Your responses have been submitted successfully. We will match you with someone special soon!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?> 