<?php
require_once "controllerUserData.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="EF.png">
    <title>Signup Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="stylee.css">
    <style>
        .btn-toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4 form">
            <form action="signup-user.php" method="POST" autocomplete="">
                <h2 class="text-center">Signup Form</h2>
                <p class="text-center">It's quick and easy.</p>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="name" placeholder="Full Name" required
                           value="<?php echo $name ?>">
                </div>
                <div class="form-group">
                    <input class="form-control" type="email" name="email" placeholder="Email Address" required
                           value="<?php echo $email ?>">
                </div>
                <div class="form-group">
                    <div class="position-relative">
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="toggleButton" onclick="togglePasswordVisibility()">Hide</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="cpassword" placeholder="Confirm password" required>
                    <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="toggleButton" onclick="togglePasswordVisibility()">Hide</button>
                        </div>
                </div>
                <div class="form-group">
                    <input class="form-control button" type="submit" name="signup" value="Signup">
                </div>
                <div class="link login-link text-center">Already a member? <a href="login-user.php">Login here</a></div>
            </form>
        </div>
    </div>
</div>

<script>
    function togglePasswordVisibility() {
        var passwordField = document.getElementById("password");
        var toggleButton = document.querySelector(".btn-toggle-password");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleButton.innerHTML = '<i class="fa fa-eye-slash"></i>';
        } else {
            passwordField.type = "password";
            toggleButton.innerHTML = '<i class="fa fa-eye"></i>';
        }
    }
</script>

</body>
</html>
