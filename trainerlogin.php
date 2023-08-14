<?php 
require_once("trconnection.php");
$error_msg="";
?>

<?php 
if(empty($_POST['email']) || empty($_POST['password']))
{
    $error_msg="";
}
else
if(isset($_POST['login'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $qry="select *from trainers where email='$email' and contact='$password'";
    $query=$con->query($qry);
    if($query->num_rows>0){
        header("Location: trainerDash.php?email=$email");
        exit;
    }
    else{
        $error_msg="Wrong credentials";
    }
}
else{
    $error_msg="no errpr";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="EF.png">
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="icon" href="ef.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="stylee.css">
</head>
<script type="text/javascript">
    // function clearerror(){
    //   document.getElementById("error").innerHTML="";
    // }
  </script>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
            <div class="dropdown">
                <button class="dropbtn">Trainer</button>
                <div class="dropdown-content">
                    <a href="login-user.php">User</a>
                    <a href="trainerlogin.php">Trainer</a>
                </div>
            </div>
<style>
.dropbtn {
  background-color: red;
  color: white;
  padding: 6px;
  font-size: 16px;
  border:none;
  border-radius:5px;
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
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #3e8e41;}
</style>
                <form action="trainerlogin.php" method="POST" autocomplete="">
                    <h2 class="text-center">Login Form</h2>
                    <p class="text-center">Login with your email and password.</p>
                
                        <div class="alert alert-danger text-center" id="error">
                            <?php echo $error_msg;?>
                        </div> 
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email Address" required value="">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                    </div>
                    <!-- <div class="link forget-pass text-left"><a href="forgot-password.php">Forgot password?</a></div> -->
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="login" value="Login">
                    </div>
                
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>