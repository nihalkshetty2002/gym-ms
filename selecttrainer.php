<?php
// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userform";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$emailExists = false;
$selectedTrainer = "";
$successMessage = "";
$userEmail = isset($_GET['email']) ? $_GET['email'] : ''; // Retrieve the email from URL parameter

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if the email exists in the usertable
  $checkSQL = "SELECT * FROM usertable WHERE email = '$userEmail'";
  $result = $conn->query($checkSQL);
  if ($result->num_rows > 0) {
    $emailExists = true;

    // Save the selected trainer
    if (isset($_POST['saveTrainer'])) {
      $selectedTrainer = $_POST['trainer'];

      // Update the usertable with the trainer's email
      $updateSQL = "UPDATE usertable SET tid = '$selectedTrainer' WHERE email = '$userEmail'";
      if ($conn->query($updateSQL) === TRUE) {
        // Set success message
        $successMessage = "Trainer saved successfully!";
        // Execute JavaScript to redirect to homeuser.php with email as URL parameter
        echo "<script>
          setTimeout(function() {
            window.location.href = 'homeuser.php?email=" . urlencode($userEmail) . "';
          }, 2000);
        </script>";
      } else {
        echo "Error: " . $updateSQL . "<br>" . $conn->error;
      }
    }
  } else {
    echo "Email does not exist in the usertable.";
  }
}

// Retrieve trainers from the trainers table
$trainersSQL = "SELECT * FROM trainers";
$trainersResult = $conn->query($trainersSQL);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
        window.history.forward();
    </script>
  <title>Select Trainer</title>
  <link rel="icon" href="EF.png">
  <style>
    /* CSS styles for the page */
    body {
      background-color: black;
      color: white;
    }

    h1 {
      text-align: center;
    }

    form {
      margin: 0 auto;
      width: 300px;
    }

    label {
      display: block;
      margin-bottom: 10px;
    }

    select,
    input[type="submit"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
    }

    input[type="submit"] {
      background-color: red;
      color: white;
    }

    .success-message {
      text-align: center;
      font-size: 24px;
      color: green;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <?php if (!$emailExists) : ?>
    <h1>Select Your Trainer</h1>
    <form id="trainerForm" action="" method="POST">
      <label for="email">Enter Your Email:</label>
      <input type="email" name="email" id="email" required value="<?php echo $userEmail; ?>"readonly>
      <br><br>
      <input type="submit" value="Check Email">
    </form>
  <?php else : ?>
    <?php if (!empty($successMessage)) : ?>
      <div class="success-message">
        <?php echo $successMessage; ?>
      </div>
    <?php endif; ?>

    <h1>Select Your Trainer</h1>
    <form id="trainerForm" action="" method="POST">
      <input type="hidden" name="email" value="<?php echo $userEmail; ?>">
      <label for="trainer">Choose a Trainer:</label>
      <select name="trainer" id="trainer">
        <?php while ($row = $trainersResult->fetch_assoc()) : ?>
          <option value="<?php echo $row["email"]; ?>"><?php echo $row["name"]; ?></option>
        <?php endwhile; ?>
      </select>
      <br><br>
      <input type="submit" value="Save Trainer" name="saveTrainer">
    </form>
  <?php endif; ?>
</body>
</html>
