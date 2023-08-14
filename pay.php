<?php
$servername="localhost";
$username="root";
$password="";
$dbname="userform";

$conn=new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email=$_POST["email"];
    $zipcode=$_POST["zipcode"];
    $cardno=$_POST["cardno"];
    $paymentDate=date("Y-m-d H:i:s");
    $amount=$_POST["amount"];
    
    $sql="INSERT INTO payments (email,zipcode,cardno,payment_date,amount) values(?,?,?,?,?)";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("ssssd",$email,$zipcode,$cardno,$paymentDate,$amount);
   
    if($stmt->execute()){
        header("Location:selecttrainer.php");
    }else{
        echo "Error: ". $stmt->error;

    }
    $stmt->close();
    // header("Location:#");
}
$conn->close();
?>