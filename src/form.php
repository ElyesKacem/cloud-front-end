<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "myDatabase";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE ".$dbname;
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}

// Close connection
$conn->close();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create table if it does not exist
$sql = "CREATE TABLE IF NOT EXISTS person (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  firstname VARCHAR(30) NOT NULL,
  lastname VARCHAR(30) NOT NULL,
  password VARCHAR(50) NOT NULL,
  email VARCHAR(50) NOT NULL UNIQUE
)";

if ($conn->query($sql) === TRUE) {
  echo "Table created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

// Get data from POST
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$password = $_POST["password"];
$email = $_POST["email"];

// Prepare and execute SQL statement to insert data
$stmt = $conn->prepare("INSERT INTO person (firstname, lastname, password, email) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $firstname, $lastname, $password, $email);

if ($stmt->execute() === TRUE) {
  echo "Data inserted successfully";
} else {
  echo "Error inserting data: " . $conn->error;
}

// Close connection
$conn->close();
?>
