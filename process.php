<?php

// Get the data from the form
$name = $_POST['name'];
$gender = $_POST['gender'];
$comfort_food = $_POST['comfort_food'];
$quote = $_POST['quote'];
$webseries = $_POST['webseries'];

// Connect to database
$conn = mysqli_connect('localhost', 'root', '', 'valentines_day_mixer');

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Store the data in the database
$sql = "INSERT INTO participants (name, gender, comfort_food, quote, webseries)
VALUES ('$name', '$gender', '$comfort_food', '$quote', '$webseries')";

if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);

// Match the participants

// Get the participants from the database
$sql = "SELECT * FROM participants";
$result = mysqli_query($conn, $sql);

// Store the participants in an array
$participants = array();
while ($row = mysqli_fetch_assoc($result)) {
  array_push($participants, $row);
}

// Match the participants
$matches = array();
foreach ($participants as $participant) {
  // Find a match with the same gender preference
  foreach ($participants as $potential_match) {
    if ($participant['gender'] == $potential_match['gender'] && $participant['name'] != $potential_match['name']) {
      array_push($matches, array($participant['name'], $potential_match['name']));
    }
  }
}

// Send out the matches
foreach ($matches as $match) {
  // Send an email to each participant in the match
  $to = $match[0] . ',' . $match[1];
  $subject = 'Valentine\'s Day Mixer Match';
  $message = 'Congratulations! You have been matched with ' . $match[1] . ' for the Valentine\'s Day Mixer at Ashoka University. We hope you both have fun!';
  $headers = 'From: matchmaker@ashoka.edu';

  mail($to, $subject, $message, $headers);
}

