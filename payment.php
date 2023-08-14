<?php require_once "pay.php";
include_once('controllerUserData.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form input values
    $email = $_POST['email'];
    $amount = $_POST['amount'];

    // Validate the form inputs
    if (!empty($email) && !empty($amount)) {
        // Send email with payment details
        $to = $email;
        $subject = 'Payment Confirmation';
        $message = "Thank you for your payment!\n\n" .
                   "Payment Details:\n" .
                   "Email: $email\n" .
                   "Amount: $amount\n";
        $headers = 'From: fitnessextreme51@gmail.com' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();

        // Send the email
        if (mail($to, $subject, $message, $headers)) {
            echo "Payment successful! Email confirmation has been sent.";
        } else {
            echo "Payment successful! Failed to send email confirmation.";
        }
        
        // Redirect to selecttrainer.php with the email as a URL parameter+
        header("Location: selecttrainer.php?email=" . urlencode($email));
        exit;
    } else {
        echo "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript">
        window.history.forward();
    </script>
    <script>
        // JavaScript functions...
        function checkIfAvailable(zip) {
            let zones = ["574118", "576101", "", "576103", "576104", "576102"];
            return zones.indexOf(zip) >= 0;
        }

        function validateZip() {
            let zip = document.getElementById("zipCode").value;
            let msg = "";
            if (checkIfAvailable(zip)) {
                msg = "Our service is available in this area!";
            } else {
                msg = "Sorry, our service is not available in this area";
                document.getElementById("pay");
            }
            document.getElementById("msg").innerHTML = msg;
        }

        function validateCreditCard() {
        var cardno = document.getElementById("cardno").value;
        var cvv = document.getElementById("cvv").value;
        var strippedCardNumber = cardno.replace(/[\s-]/g, "");

        if (/^\d+$/.test(strippedCardNumber) && /^\d+$/.test(cvv)) {
            alert("Credit card information is valid!");
            // You can submit the form or perform further actions here
        } else {
            if (!/^\d+$/.test(strippedCardNumber)) {
                alert("Card number must contain only numeric characters.");
            } else if (!/^\d+$/.test(cvv)) {
                alert("CVV must contain only numeric characters.");
            } else {
                alert("Credit card information is invalid. Please check the number and CVV.");
            }
        }
    }



    function validateForm() {
            var cardno = document.getElementById("cardno").value;
            var cvv = document.getElementById("cvv").value;
            var strippedCardNumber = cardno.replace(/[\s-]/g, "");
        
            if (/^\d+$/.test(strippedCardNumber) && /^\d+$/.test(cvv)) {
                // You can submit the form or perform further actions here
                return true;
            } else {
                if (!/^\d+$/.test(strippedCardNumber)) {
                    alert("Card number must contain only numeric characters.");
                } else if (!/^\d+$/.test(cvv)) {
                    alert("CVV must contain only numeric characters.");
                } else {
                    alert("Credit card information is invalid. Please check the number and CVV.");
                }
                return false;
            }
        }
    </script>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payments</title>
    <link rel="icon" href="EF.png">
    <link rel="stylesheet" type="text/css" href="payment.css">
</head>
<body>
    <header>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validateForm()">
            <!-- Form fields... -->
            <label for="email">EMAIL:</label>
            <input type="email" placeholder="" id="email" name="email" value="<?php echo $email; ?>" required><br>

            <label for="zipcode">ZIPCODE:</label>
            <input type="text" name="zipcode" id="zipCode" required onkeyup="validateZip()">
            <div id="msg"></div>        
            <br>
            
            <label for="amount">AMOUNT:</label>
            <input type="text" name="amount" id="amount" value="<?php echo $_GET['amt']; ?>" readonly><br>

            <label for="creditCardNumber">Card Number:</label>
            <input type="text" id="cardno" name="cardno"maxlength="16" required><br>
            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" maxlength="3" required><br>
            <button type="button" onclick="validateCreditCard()">Validate</button>

            <button type="submit" onclick="validateForm()">SUBMIT PAYMENT</button>
        </form>
    </header>
</body>
</html>



