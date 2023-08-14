<?php require_once "controllerUserData.php"; ?>
<?php
$pcon=new mysqli("localhost","root","","userform");
$pres=$pcon->query("select * from packages");
?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: user-otp.php');
        }
    }
}else{
    header('Location: login-user.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>MEMBERSHIP</title>
	<link rel="stylesheet" href="plans.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="EF.png">
</head>
<body>
    <div class="plans">
			<h2>Select Membership Plans</h2>
			<ul>
        <?php
        while($res9=$pres->fetch_array()){
          $stmt= "<li><img src=".$res9['img']." alt='Plan 1'><h3>".$res9['package']."</h3><p>".$res9['description']."</p><a href='payment.php?amt=".$res9['amount']."' class='cta'>"
          .$res9['amount']."</a></li>";
          echo $stmt;
        }?>
      </ul>
    </div>
</body>
</html>