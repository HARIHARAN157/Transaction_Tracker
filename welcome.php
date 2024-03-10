<?php
$conn = mysqli_connect("localhost", "root", "", "login");
if ($conn) {
  $sql = "SELECT * FROM register email;
  $result = mysqli_query($conn, $sql);
  if ($result) {
    echo "<table>";
    echo "<tr>Name</th><th>Email</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>{$row['uname1']}</td>";
      echo "</tr>";
    }
    echo "</table>";
  } else {
    echo "Error: " . mysqli_error($conn);
  }
} else {
  echo "Error: Could not connect to database";
}
?>