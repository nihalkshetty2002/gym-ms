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

// Initialize a variable to track if the email exists in usertable
$emailExists = false;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the submitted email
    $email = $_POST["email"];

    // Check if the email exists in the usertable
    $userQuery = "SELECT * FROM usertable WHERE email = '$email'";
    $userResult = $conn->query($userQuery);

    if ($userResult->num_rows > 0) {
        // Email exists in usertable
        $emailExists = true;

        // Insert the attendance record into the attendance table
        $date = date("Y-m-d");
        $insertQuery = "INSERT INTO attendance (email, date) VALUES ('$email', '$date')";

        if ($conn->query($insertQuery) === TRUE) {
            echo "Attendance recorded successfully.";
        } else {
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    } else {
        // Email does not exist in usertable
        echo "Email does not exist.";
    }
}

// Retrieve the attendance records from the database
$sql = "SELECT * FROM attendance";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Attendance Tracker</title>
    <link rel="icon" href="EF.png">
    <link rel="stylesheet" type="text/css" href="#">
</head>
<body>
    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
        <div class="row">
            <!-- Table Panel -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>Attendance List</b>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-condensed table-hover">
                            <colgroup>
                                <col width="5%">
                                <col width="15%">
                                <col width="20%">
                                <col width="20%">
                                <col width="20%">
                                <col width="20%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>Member ID</th>
                                    <th class="">Email</th>
                                    <th class="">Date</th>
                                    <th class="">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                while ($row = $result->fetch_assoc()) :
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i++ ?></td>
                                        <td class="">
                                            <p><b><?php echo $row['email'] ?></b></p>
                                        </td>
                                        <td class="">
                                            <p><b><?php echo $row['date'] ?></b></p>
                                        </td>
                                        <td class="">
                                            <p><b><?php echo $row['status'] ?></b></p>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Table Panel -->
        </div>
    </div>	
</body>
</html> 

<?php
// Close the database connection
$conn->close();
?>
