<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="icon" href="EF.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="stylee.css">
    <style>
       .dropbtn {
            background-color: red;
            color: white;
            padding: 6px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 150px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }

        .input-group-append .btn-toggle-password {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
    </style>
</head>
<body>
<script type="text/javascript">
    window.history.forward();
</script>
<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4 form login-form">
            <div class="dropdown">
                <button class="dropbtn">User</button>
                <div class="dropdown-content">
                    <a href="login-user.php">User</a>
                    <a href="trainerlogin.php">Trainer</a>
                </div>
            </div>

            <form action="login-user.php" method="POST" autocomplete="">
                <h2 class="text-center">Login Form</h2>
                <p class="text-center">Login with your email and password.</p>
                <?php
                if (count($errors) > 0) {
                    ?>
                    <div class="alert alert-danger text-center">
                        <?php
                        foreach ($errors as $showerror) {
                            echo $showerror;
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
                <div class="form-group">
                    <input class="form-control" type="email" name="email" placeholder="Email Address" required
                           value="<?php echo $email ?>">
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="toggleButton" onclick="togglePasswordVisibility()">Hide</button>
                        </div>
                    </div>
                </div>
                <div class="link forget-pass text-left"><a href="forgot-password.php">Forgot password?</a></div>
                <div class="form-group">
                    <input class="form-control button" type="submit" name="login" value="Login">
                </div>
                <div class="link login-link text-center">Not yet a member? <a href="signup-user.php">Signup now</a></div>
            </form>
        </div>
    </div>
</div>

<script>
    function togglePasswordVisibility() {
        var passwordField = document.getElementById("password");
        var toggleButton = document.getElementById("toggleButton");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleButton.textContent = "Hide";
        } else {
            passwordField.type = "password";
            toggleButton.textContent = "Unhide";
        }
    }
</script>

</body>
</html>
