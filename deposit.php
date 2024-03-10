<?php
session_start();
if (isset($_SESSION['names'])&&isset($_SESSION['email'])) {
    $name = $_SESSION['names'];
    $email = $_SESSION['email'];

} else {
    echo 'No session data available.';
    exit;
}
?>
<?php
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "login";
$amount=$_POST['Amount'];
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '. mysqli_connect_error());
}
else{
    $sql = "UPDATE register SET balance = balance+'$amount' WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
if ($result){
 echo '<!DOCTYPE html>
    <html lang="en">
    <head>
    </head>
    <body>
    <script>
    alert("deposited sucessfully");
    window.location = "deposit.html";
    </script>
    </body>
    </html>';

}
 else {
    echo "Error in Depositing: " . mysqli_error($conn);
}    
     $conn->close();  }?>