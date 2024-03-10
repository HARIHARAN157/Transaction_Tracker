<?php
session_start();
if (session_status() === PHP_SESSION_DISABLED) {
    echo 'Session is disabled.';
    exit;
}

if (isset($_SESSION['names'])) {
    $name = $_SESSION['names'];
} else {
    echo 'No session data available.';
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <center>
        <h1>Welcome Account Holder: <?php echo $name?></h1>
    </center>
    <h2>My Portfolio</h2>
    <center>
        <form action="logout.php">
        <table border="1" cellpadding="50" cellspacing="6">
            <tr>
                <td><a href="javascript:void(0);" onclick="submitForm('transferFund');"><img src="images/TransferFund.png" alt="Transfer Fund" width="100" height="100"></a><p>Transfer Fund</p></td>
                <td><a href="javascript:void(0);" onclick="submitForm('deposit');"><img src="images/Deposit.jpg" alt="Deposit" width="100" height="100"></a><p>Deposit</p></td>
                <td><a href="#"><img src="images/UPi-logo.jpg.crdownload" alt="UPi" width="130" height="100"></a><p>UPi</p></td>
            </tr>
            <tr>
                <td><a href="#"><img src="images/Balance check.jpg" alt="Balance Check" width="100" height="100"></a><p>Balance Check</p></td>
                <td><a href="#"><img src="images/Bill Payment.jpg" alt="Bill Payment" width="100" height="100"></a><p>Bill Payment</p></td>
                <td><a href="#"><img src="images/Mobile Recharge.png" alt="Mobile Recharge" width="100" height="100"></a><p>Mobile Recharge</p></td>

            </tr>
        </table>
        <br><br>
        <input type="submit" name="" value="Logout">
    </form>
    <form id="transferFund" action="transferFund.html" method="post"></form>
    <form id="deposit" action="deposit.html" method="post"></form>

    </center>
    <script>
        function submitForm(formId) {
            document.getElementById(formId).submit();
        }
    </script>
</body>
</html>

