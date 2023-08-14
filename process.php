<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userform";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Get the form data
  $email = $_POST["email"];
  $date = $_POST["date"];
  $status = $_POST["status"];

  // Prepare and execute an SQL statement to insert the attendance data into the database
  $stmt = $conn->prepare("INSERT INTO attendance (email, date, status) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $email, $date, $status);
  $stmt->execute();
  $stmt->close();

  // Redirect back to the attendance tracker page
  //header("Location: attendance.php");
  echo "<script type='text/javascript'>alert('success');</script>";
  exit;
}

// Close the database connection
$conn->close();
?>
