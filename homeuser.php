<?php
require_once "controllerUserData.php";

$email = $_SESSION['email'];
$password = $_SESSION['password'];

if ($email != false && $password != false) {
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);

    if ($run_Sql) {
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];

        if ($status == "verified") {
            if ($code != 0) {
                header('Location: reset-code.php');
            } else {
                // Retrieve the email from the URL parameter or session
                $userEmail = isset($_GET['email']) ? $_GET['email'] : $email;

                // Connect to the database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "userform";

                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Retrieve the amount from the payments table for the provided email
                $sql = "SELECT amount FROM payments WHERE email = '$userEmail'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $amount = $row['amount'];

                    // Determine the membership plan based on the amount
                    if ($amount >= 10000) {
                        $membership = "Premium";
                    } elseif ($amount >= 5000) {
                        $membership = "Gold";
                    } elseif ($amount >= 3000) {
                        $membership = "Silver";
                    } else {
                        $membership = "Standard";
                    }

                    // Update the plan column in the usertable
                    $updateSql = "UPDATE usertable SET plan = '$membership' WHERE email = '$userEmail'";
                    $conn->query($updateSql);

                    // Display the membership message in the user's dashboard
                    echo '<div id="header">
                            <a href="#" class="logo">
                              <i class="fas fa-dumbbell"> EXTREME FITNESS</i> 
                            </a>
                          </div>
                          
                          <div id="navbar">
                            <ul>
                              <li><a href="video.php">Videos</a></li>
                              <li><a href="membership.php">Renewal</a></li>
                              <li><a href="index (1).php">Logout</a></li>
                            </ul>
                          </div>
                          
                          <div id="content">
                            <h2>Welcome ' . $fetch_info['name'] . '</h2>
                            <p>Thank you for choosing Extreme Fitness as your fitness partner.</p>
                            <p>Your membership: ' . $membership . '</p>
                          </div>
                          
                          <div id="footer">
                            <p>© 2023 Extreme Fitness. All rights reserved.</p>
                          </div>';
                } else {
                    // Display a message prompting the user to make a payment
                    echo '<div id="header">
                            <a href="#" class="logo">
                              <i class="fas fa-dumbbell"> EXTREME FITNESS</i> 
                            </a>
                          </div>
                          
                          <div id="navbar">
                            <ul>
                              <li><a href="video.php">Videos</a></li>
                              <li><a href="membership.php">Renewal</a></li>
                              <li><a href="index (1).php">Logout</a></li>
                            </ul>
                          </div>
                          
                          <div id="content">
                            <h2>Welcome ' . $fetch_info['name'] . '</h2>
                            <p>Thank you for choosing Extreme Fitness as your fitness partner.</p>
                            <p>Please make a payment to access our membership plans.</p>
                          </div>
                          
                          <div id="footer">
                            <p>© 2023 Extreme Fitness. All rights reserved.</p>
                          </div>';
                }

                // Close the database connection
                $conn->close();
            }
        } else {
            header('Location: user-otp.php');
        }
    }
} else {
    header('Location: login-user.php');
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <link rel="icon" href="EF.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="home.css">
</head>
<body>  
</body>
</html>
