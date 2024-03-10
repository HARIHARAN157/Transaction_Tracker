<?php
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "login";
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
$email = $_POST['email'];
$userInputPassword = $_POST['upswd'];
$sql = "SELECT * FROM register WHERE email='$email'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 1) {
    $row = $result->fetch_assoc();
    $storedHashedPassword = $row['upswd1'];
    if (password_verify($userInputPassword, $storedHashedPassword)) {
        session_start();
        $_SESSION['names'] = $row['uname1'];
        $_SESSION['email'] = $email;
        header("location:postlogin.php");
    } else {
        echo "
        <!DOCTYPE html>
        <html>
        <body>
            <center><h1 style='color:red'>Oops, Login Failed! Incorrect email or password <a style='color:black' href='login.html'>Login here</a></h1></center>
        </body>
        </html>
        ";
    }
} else {
    echo "
    <!DOCTYPE html>
    <html>
    <body>
        <center><h1 style='color:red'>User not found. <a style='color:black' href='login.html'>Login here</a></h1></center>
    </body>
    </html>
    ";
}

$conn->close();
?>
