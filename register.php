<?php
$uname1 = $_POST['uname1'];
$email  = $_POST['email'];
$upswd1 = $_POST['upswd1'];
$upswd1 = password_hash($upswd1, PASSWORD_DEFAULT);
if (!empty($uname1) || !empty($email) || !empty($upswd1) )
{
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "login";
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT email From register Where email = ? Limit 1";
  $INSERT = "INSERT Into register (uname1 , email ,upswd1 )values(?,?,?)";
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sss", $uname1,$email,$upswd1);
      $stmt->execute();
      echo '<!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
      </head>
      <body>
      <form action="login.html" method="POST">
      <center><h1>Registered sucessfully   <button type="submit">Login here<?button></center>
      </h1>
      </body>
      </html>';
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>