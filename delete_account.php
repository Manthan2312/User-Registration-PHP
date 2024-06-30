<?php
session_start();

if (!isset($_SESSION['email'])) {
  header("Location: login.php");
  exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "manthan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$email = $_SESSION['email'];

$sql = "DELETE FROM user WHERE email='$email'";
if ($conn->query($sql) === TRUE) {
  session_destroy();
  header("Location: goodbye.php");
  exit;
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
