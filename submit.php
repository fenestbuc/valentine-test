<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $comfortFood = $_POST['comfortFood'];
  $quote = $_POST['quote'];
  $webseries = $_POST['webseries'];
  $genderPreference = $_POST['genderPreference'];

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

  // Insert data into the database
  $sql = "INSERT INTO users (comfortFood, quote, webseries, genderPreference)
  VALUES ('$comfortFood', '$quote', '$webseries', '$genderPreference');";

  if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
}
?>