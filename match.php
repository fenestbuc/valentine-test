<?php
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

    // Get all the responses from the database
    $sql = "SELECT * FROM responses";
    $result = $conn->query($sql);

    // Create an array to store all the responses
    $responses = array();

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $responses[] = $row;
        }
    } else {
        echo "0 results";
    }

    // Create an array to store all the matches
    $matches = array();

    // Loop through all the responses and match them
    foreach($responses as $response) {
        // Get the gender preference of the current response
        $gender = $response['gender'];

        // Check if the gender preference is "Yes"
        if($gender == "yes") {
            // Get all the other responses of the same gender
            foreach($responses as $otherResponse) {
                if($otherResponse['gender'] == "yes" && $otherResponse['id'] != $response['id']) {
                    // Create an array to store the two responses
                    $match = array(
                        $response,
                        $otherResponse
                    );

                    // Add the array to the matches array
                    $matches[] = $match;
                }
            }
        } else {
            // Get all the other responses
            foreach($responses as $otherResponse) {
                if($otherResponse['id'] != $response['id']) {
                    // Create an array to store the two responses
                    $match = array(
                        $response,
                        $otherResponse
                    );

                    // Add the array to the matches array
                    $matches[] = $match;
                }
            }
        }
    }

    // Loop through all the matches and email them
    foreach($matches as $match) {
        // Get the email addresses of the two people
        $email1 = $match[0]['email'];
        $email2 = $match[1]['email'];

        // Send the email
        mail($email1, "You have a Valentine's Day match!", "You have been matched with ".$email2." as part of the Ashoka Valentine's Day mixer. Have a great day!");
        mail($email2, "You have a Valentine's Day match!", "You have been matched with ".$email1." as part of the Ashoka Valentine's Day mixer. Have a great day!");
    }

    $conn->close();
?>