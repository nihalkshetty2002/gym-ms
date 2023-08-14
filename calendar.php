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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $date = $_POST["date"];
    $status = $_POST["status"];
    
    // Check if the email exists in the usertable
    $emailCheckQuery = "SELECT * FROM usertable WHERE email = '$email'";
    $emailCheckResult = $conn->query($emailCheckQuery);

    if ($emailCheckResult->num_rows > 0) {
        // Email exists in the usertable, check attendance
        $attendanceCheckQuery = "SELECT * FROM attendance WHERE email = '$email' AND date = '$date'";
        $attendanceCheckResult = $conn->query($attendanceCheckQuery);

        if ($attendanceCheckResult->num_rows > 0) {
            // User has already given attendance for the selected date
            echo "Attendance has already been given for the selected date.";
        } else {
            // User has not given attendance for the selected date, insert the attendance record into the database
            $sql = "INSERT INTO attendance (email, date, status) VALUES ('$email', '$date', '$status')";
            if ($conn->query($sql) === TRUE) {
                echo "Attendance recorded successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        // Email does not exist in the usertable
        echo "Email does not exist.";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="calendar.css">
  <link rel="icon" href="EF.png">
  <script>
    // Function to disable other dates and allow only today's date
    function disableFutureDates() {
      var today = new Date().toISOString().split("T")[0];
      document.getElementById("date").value = today;
    }

    // Function to validate the date field
    function validateDate() {
      var inputDate = document.getElementById("date").value;
      var today = new Date().toISOString().split("T")[0];

      if (inputDate !== today) {
        alert("Please select today's date.");
        return false;
      }

      return true;
    }
  </script>
</head>
<body onload="disableFutureDates()">
  <h1>Attendance Register</h1>
  <div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateDate()">
      <label for="email">User Email:</label>
      <input type="text" id="email" name="email" required>

      <label for="date">Date:</label>
      <input type="text" id="date" name="date" required readonly>

      <label for="status">Status:</label>
      <select id="status" name="status" required>
        <option value="present">Present</option>
       ```html
        <option value="absent">Absent</option>
      </select>

      <button type="submit">Submit</button>
      <a href="index (1).php" class="cta">Exit</a>
    </form>
  </div>
</body>
</html>
