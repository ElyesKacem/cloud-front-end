<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "myDatabase";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Create database
$sql = "CREATE DATABASE".dbname;
if (mysqli_query($conn, $sql)) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);




// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Create table if it does not exist
$sql = "CREATE TABLE IF NOT EXISTS person (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  firstname VARCHAR(30) NOT NULL,
  lastname VARCHAR(30) NOT NULL,
  password VARCHAR(50) NOT NULL,
  email VARCHAR(50) NOT NULL UNIQUE
)";

if (mysqli_query($conn, $sql)) {
  echo "Table created successfully";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}

// Get data from POST
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$password = $_POST["password"];
$email = $_POST["email"];

// Prepare and execute SQL statement to insert data
$sql = "INSERT INTO person (firstname, lastname, password, email) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssss", $firstname, $lastname, $password, $email);

if (mysqli_stmt_execute($stmt)) {
  echo "Data inserted successfully";
} else {
  echo "Error inserting data: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>
