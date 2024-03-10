<?php
session_start();
if (isset($_SESSION['names'])) {
    $name = $_SESSION['names'];
} else {
    echo 'No session data available.';
    exit;
}

$email = $_SESSION['email'];
$transfer = $_POST['transfer'];
$email2 = $_POST['email2'];
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "login";

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()) {
    die('Connect Error ('. mysqli_connect_errno() .') ' . mysqli_connect_error());
} else {
    // Check if recipient email exists in the table
    $recipient_query = "SELECT email FROM register WHERE email = '$email2'";
    $recipient_result = mysqli_query($conn, $recipient_query);

    if (mysqli_num_rows($recipient_result) == 0) {
        echo'<!DOCTYPE html>
        <html lang="en">
        <head>
        </head>
        <body>
        <script>
        alert("Recipient email not found in the database.");
        window.location = "transferfund.html";
        </script>
        </body>
        </html>';
        exit;
    }

    $sql = "SELECT * FROM register WHERE email = '$email'";
    $query = mysqli_query($conn, $sql);
    $balance = $query->fetch_assoc()['balance'];
    
    if ($balance < $transfer) {
        echo'<!DOCTYPE html>
        <html lang="en">
        <head>
        </head>
        <body>
        <script>
        alert("Insufficient Balance");
        window.location = "transferfund.html";
        </script>
        </body>
        </html>';
    } else {
        // Deduct the transferred amount from the sender's balance
        $sql_sender = "UPDATE register SET balance = balance - '$transfer' WHERE email = '$email'";
        $result_sender = mysqli_query($conn, $sql_sender);

        // Increase the transferred amount to the recipient's balance
        $sql_recipient = "UPDATE register SET balance = balance + '$transfer' WHERE email = '$email2'";
        $result_recipient = mysqli_query($conn, $sql_recipient);

        if ($result_sender && $result_recipient) {
            echo'<!DOCTYPE html>
            <html lang="en">
            <head>
            </head>
            <body>
            <script>
            alert("transfered sucessfully");
            window.location = "transferfund.html";
            </script>
            </body>
            </html>';
        } else {
            echo "Error in transfer: " . mysqli_error($conn);
        }
    }

    $conn->close();
}
?>
