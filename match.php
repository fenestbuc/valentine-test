<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ashoka_valentines";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the gender preference of the user
$genderPreference = $_GET['genderPreference'];

// Get all the users with the same gender preference
$sql = "SELECT * FROM users WHERE genderPreference = '$genderPreference'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Pick a random user
  $randomUser = rand(0, $result->num_rows - 1);
  $row = $result->fetch_assoc();
  $match = $row['comfortFood'] . " " . $row['quote'] . " " . $row['webseries'];

  echo "Your match is: " . $match;
} else {
  echo "No matches found";
}

$conn->close();
?>